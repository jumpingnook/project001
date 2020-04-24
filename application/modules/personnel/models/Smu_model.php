<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Smu_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
		
		$this->tb_default();
	}

	private function tb_default(){
		$this->table = 'smu_sub';
	}

	function get_sub_smu(){
		$con = [];
		$con['array_key'] = 'smu_sub_id';
		return $this->to_select($con);
	}
	
	function get_main_smu(){
		$this->table = 'smu_main';
		$con = [];
		$con['array_key'] = true;
		return $this->to_select($con);
	}
	
}