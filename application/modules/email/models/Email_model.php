<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Course_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
		$this->table = 'send_mail_log';
	}

	function send_request($set = []){

		$con = [];
		$con['data']['to'];
		if(isset($set['to']) and is_array($set['to'])){
			$con['to'] = json_encode($set['to']);
		}elseif(isset($set['to'])){
			$con['to'] = $set['to'];
		}
		$con['data']['subject'] = $set['subject'];
		$con['data']['request_date'] = date('Y-m-d H:i:s');

		if(!empty($con['data']['to'])){
			return $this->to_insert_last_id($con);
		}
		
		return 0;

	}

	function send_response($set=[]){
		if(isset($set['request_id']) and intval($set['request_id'])!=0 and isset('status') and intval($set['status'])!=0){
			$con = [];
			$con['data']['response_date'] = date('Y-m-d H:i:ss');
			$con['data']['status'] =  intval($set['status']);
			$con['data']['response_detail'] = isset($set['detail'])?$set['detail']:'';
			$con['where'] = 'send_mail_id = "'.intval($set['request_id']).'"';
			$this->to_update($con);

			return true;
		}
		return false;
	}
	

}