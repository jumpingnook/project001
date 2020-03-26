<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Token_model extends MY_Model {

	protected $token_time = 25;

	function __construct(){
    	parent::__construct();
      	$this->load->database();
      	$this->table = 'token';
	}

	function create_token($set=[]){

		$res = '';
		if(isset($set['ip']) and isset($set['internet_account'])){
			$token = $this->user_token();

			$create_date = date('Y-m-d H:i:s'); 

			$con = [];
			$con['data']['token'] 			= $token;
			$con['data']['internet_account'] = trim($set['internet_account']);
			$con['data']['personnel_id'] 	= isset($set['personnel_id'])?intval($set['personnel_id']):9999;
			$con['data']['ip'] 				= trim($set['ip']);
			$con['data']['create_date'] 	= $create_date;
			$con['data']['exp_date'] 		= date('Y-m-d H:i:s',strtotime('+'.$this->token_time.' minutes', strtotime($create_date)));
			$this->to_insert($con);

			$res = $token;
		}

		return $res;
	}

	function delete_token($set=[]){
		$res = '';
		if(isset($set['token'])){
			$con = [];
			$con['data']['status'] 	= 1;
			$con['where'] 			= 'token = "'.trim($set['token']).'"';	
			$this->to_update($con);
		}
		return $res;
	}

	function update_token_session($set=[]){
		if(isset($set['token'])){
			$con = [];
			$con['data']['exp_date']	= date('Y-m-d H:i:s',strtotime('+'.$this->token_time.' minutes', strtotime(date('Y-m-d H:i:s'))));
			$con['where'] 				= 'token = "'.trim($set['token']).'" and status <> 1';
			$this->to_update($con);
		}
	}
	
	function check_token($set=[]){

		$res = ['count_find'=>0,'count'=>0,'data'=>''];

		if(isset($set['token']) and isset($set['ip'])){
			$con = [];
			$con['where'] = 'token = "'.trim($set['token']).'" and ip = "'.trim($set['ip']).'"';
			$res['count_find'] = $this->to_count($con);
			$con['where'] .= ' and exp_date > NOW() and status <> 1';
			$res['count'] = $this->to_count($con);

			if($res['count']==1){
				$res['data'] = $this->to_select($con);
			}
		}

		return $res;
	}

	function update_token_user($set=[]){
		if(isset($set['token']) and isset($set['personnel_id'])){
			$con = [];
			$con['data']['personnel_id']	= intval($set['personnel_id']);
			$con['where'] 					= 'token = "'.trim($set['token']).'"';
			$this->to_update($con);
		}
	}
	
}