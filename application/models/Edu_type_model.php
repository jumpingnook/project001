<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Edu_type_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
      	$this->table = 'hr_personnel_edu_type';
	}

	function get_edu($main = true){
		$con = ['array_key'=>$main];
		return $this->to_select($con);
	}

	
	
}