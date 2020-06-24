<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Emp_type_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
      	$this->table = 'hr_emp_type';
	}

	function get_type($main = true){
		$con = ['array_key'=>$main];
		return $this->to_select($con);
	}

	
	
}