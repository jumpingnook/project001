<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Course_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
      	$this->tb_default();
	}

	private function tb_default(){
		$this->table = 'idp_course';
	}

	function course($set=[]){
		$this->tb_default();
		$con = [];
		$con['where'] 		= 'status = 0';
		$con['order_by'] 	= 'course_id ASC';
		$con['array_key'] 	= true;
		return $this->to_select($con);
	}

	function course_tag_primary(){
		$this->table = 'idp_tag_group';
		$con = [];
		$con['where'] 		= 'tag_id = "99999"';
		$con['order_by'] 	= 'group_id ASC';
		//$con = ['array_key'=>true];
		return $this->to_select($con);
	}

}