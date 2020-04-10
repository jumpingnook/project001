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

		if(isset($set['id']) and !is_array($set['id'])){
			$con['where'] .= ' and course_id = "'.intval($set['id']).'"';
		}
		
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

	function course_tag(){
		$this->table = 'idp_tag';
		$con = [];
		$con['order_by'] 	= 'tag_id ASC';
		$con = ['array_key'=>true];
		return $this->to_select($con);
	}

	function course_group_tag($set=[]){

		if(isset($set['course']) and intval($set['course'])!=0){
			$this->table = 'idp_tag_group';
			$con = [];
			$con['where'] 		= 'course_id = "'.intval($set['course']).'"';
			$con['order_by'] 	= 'group_id ASC';
			$con['array_key']  	= true;
			return $this->to_select($con);
		}

		return [];
	}

}