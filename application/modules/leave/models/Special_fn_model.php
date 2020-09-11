<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Special_fn_model extends MY_Model {

	protected $url_approve;

	function __construct(){
    	parent::__construct();
      	$this->load->database();
		$this->table = 'hr_special_fn';
	}

	function get_type(){
		$con = [];
		$con['select'] = 'special_type';
		$con['group_by'] = 'special_type';
		$con['order_by'] = 'special_type ASC';
		return $this->to_select($con);
	}

}