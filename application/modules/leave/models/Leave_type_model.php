<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave_type_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
		$this->table = 'hr_leave_type';
	}

	function get_type($set=[]){
		$con = [];

		$con['where'] = '';
		//note
		// if(isset($set['check_leave']) and !$set['check_leave']){
		// 	$con['where'] = 'leave_type_id <> 1 and leave_type_id <> 7';
		// }

		$con['where'] = 'exp_permission <= '.intval($set['month']);

		if(isset($set['emp_type'])){
			if($con['where']!=''){
				$con['where'] .= ' and emp_type_permission like "%'.intval($set['emp_type']).'%"';
			}else{
				$con['where'] .= 'emp_type_permission = "%'.intval($set['emp_type']).'%"';
			}
		}

		if(isset($set['gender'])){
			if($con['where']!=''){
				$con['where'] .= ' and (gender_permission = '.intval($set['gender']).' or gender_permission = 0)';
			}else{
				$con['where'] .= '(gender_permission = '.intval($set['gender']).' or gender_permission = 0)';
			}
		}

		$con['where'] = isset($set['all']) && $set['all']?'':$con['where'];

		$con['order_by'] = 'sort ASC';
		$con['array_key'] = true;
		return $this->to_select($con);
	}
}
