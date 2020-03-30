<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Posit_level_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
      	$this->table = 'hr_posit_level';
	}

	function get_level($main = true){
		$con = ['array_key'=>$main];
		return $this->to_select($con);
	}

	
	
}