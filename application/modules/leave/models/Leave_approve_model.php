<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave_approve_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
		$this->table = 'hr_leave_approve';
	}

	function get_list_approve($set=[]){
		$con = [];
		$con['where'] = 'personnel_id = "'.intval($set['personnel']).'"';
		$con['limit'] = '0,1';
		$result = $this->to_select($con);

		if(count($result)==0){
			$con = [];
			$con['data']['personnel_id'] = intval($set['personnel']);
			$this->to_insert($con);
		}

		return $result;
	}

}
