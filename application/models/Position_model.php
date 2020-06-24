<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Position_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
      	$this->table = 'hr_position';
	}

	function get_position($main = true){
		$con = ['array_key'=>$main];
		return $this->to_select($con);
	}

	
	
}