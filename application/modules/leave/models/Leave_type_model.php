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
		if(isset($set['check_leave']) and !$set['check_leave']){
			$con['where'] = 'leave_type_id <> 1 and leave_type_id <> 7';
		}

		if(isset($set['emp_type']) and (intval($set['emp_type'])== 5 or intval($set['emp_type'])== 6)){
			if($con['where']!=''){
				$con['where'] .= ' and leave_type_id <> 5 and leave_type_id <> 6';
			}else{
				$con['where'] .= 'leave_type_id <> 5 and leave_type_id <> 6';
			}
		}

		$con['array_key'] = true;
		return $this->to_select($con);
	}

	
}
