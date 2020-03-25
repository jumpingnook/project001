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
		if(isset($set['ip']) and isset($set['personnel_id'])){
			$token = $this->user_token();

			$create_date = date('Y-m-d H:i:s'); 

			$con = [];
			$con['data']['token'] 			= $token;
			$con['data']['personnel_id'] 	= intval($set['personnel_id']);
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
			$con['where'] 				= 'token = "'.trim($set['token']).'"';
			$this->to_update($con);
		}
		
    }
	
}