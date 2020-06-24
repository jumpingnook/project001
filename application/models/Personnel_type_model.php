<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Personnel_type_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
      	$this->table = 'hr_personnel_type';
	}

	function get_type(){
		$con = ['array_key'=>true];
		return $this->to_select($con);
	}

	
	
}