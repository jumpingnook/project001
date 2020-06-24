<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subsmu_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
      	$this->table = 'smu_sub';
	}

	function get_smu(){
		$con = ['array_key'=>true];
		return $this->to_select($con);
	
	}

	
	
}