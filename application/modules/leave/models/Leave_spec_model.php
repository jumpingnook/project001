<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave_spec_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
		$this->table = 'hr_leave_spec';
	}

	function spec($set = []){
		if(isset($set['leave_type_id']) and isset($set['emp_type_id']) and intval($set['leave_type_id'])!=0 and intval($set['emp_type_id'])!=0){
			$con = [];
			$con['where'] = 'leave_type_id = "'.intval($set['leave_type_id']).'" and emp_type_id = "'.intval($set['emp_type_id']).'"';
			return $this->to_select($con);
		}
		return [];
	}

	
}
