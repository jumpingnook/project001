<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave_quota_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
		$this->table = 'hr_leave_quota';
	}

	function check_seed($set=[]){
		if(isset($set['personnel_id']) and intval($set['personnel_id'])!=0){

			$result = $this->get_last_quote(['personnel_id'=>intval($set['personnel_id'])]);

			return count($result)==0?$this->save_quota(['personnel_id'=>intval($set['personnel_id']),'create_seed'=>true]):false;
		}
	}

	function save_quota($set=[]){

		//create seed quota
		if(isset($set['create_seed']) and $set['create_seed'] and intval($set['personnel_id'])!=0){
			$con = [];
			$con['data']['personnel_id'] 	= intval($set['personnel_id']);
			$con['data']['quota_total'] 	= 10;
			$con['data']['create_date'] 	= date('Y-m-d H:i:s');
			$con['data']['status'] 			= 0;
			$this->to_insert($con);
		}elseif(isset($set['personnel_id']) and isset($set['leave_id']) and isset($set['quota_use']) and intval($set['personnel_id'])!=0 and intval($set['leave_id'])!=0 and floatval($set['quota_use'])!=0){

			$result = $this->get_last_quote(['personnel_id'=>intval($set['personnel_id'])]);

			if(count($result)>0){
				$con = [];
				$con['data']['personnel_id'] 	= intval($set['personnel_id']);
				$con['data']['leave_id'] 		= intval($set['leave_id']);
				$con['data']['quota_use'] 		= floatval($set['quota_use']);
				$con['data']['quota_total'] 	= floatval($result[0]['quota_total'])-floatval($set['quota_use']);
				$con['data']['create_date'] 	= date('Y-m-d H:i:s');
				$this->to_insert($con);
			}

		}

	}

	function get_last_quote($set=[]){
		if(isset($set['personnel_id']) and !isset($set['leave_id']) and intval($set['personnel_id'])!=0){
			$con = [];
			$con['where'] = 'personnel_id = "'.intval($set['personnel_id']).'" and status = 0';
			$con['limit'] = '0,1';
			$con['order_by'] = 'quota_id DESC';
			return $this->to_select($con);
		}
		if(isset($set['personnel_id']) and isset($set['leave_id']) and intval($set['personnel_id'])!=0 and intval($set['leave_id'])!=0){
			$con = [];
			$con['where'] = 'personnel_id = "'.intval($set['personnel_id']).'" and leave_id = "'.intval($set['leave_id']).'"';
			$con['limit'] = '0,1';
			$con['order_by'] = 'quota_id DESC';
			return $this->to_select($con);
		}
		
	}

	function cancel_quota($set=[]){
		if(isset($set['personnel_id']) and isset($set['leave_id']) and intval($set['personnel_id'])!=0 and intval($set['leave_id'])!=0){

			$con = [];
			$con['data']['status'] = 1;
			$con['data']['cancel_date'] = date('Y-m-d H:i:s');
			$con['data']['cancel_personnel_id'] = intval($set['personnel_id']);
			$con['where'] = 'leave_id = "'.intval($set['leave_id']).'"';
			$this->to_update($con);

			return true;
		}
		return false;
	}

}
