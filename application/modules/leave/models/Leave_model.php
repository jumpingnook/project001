<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave_model extends MY_Model {

	protected $url_qr;

	function __construct(){
    	parent::__construct();
      	$this->load->database();
		$this->table = 'hr_leave';
		$this->url_qr = base_url(url_index().'option/signature/');
	}

	function url_qr($num = 16){
		$this->load->helper('string');
		$token = random_string('alnum', $num);
		$token = $this->url_qr.$token;
		$con = array();
		$con['where'] = 'url_personnel = "'.$token.'" or url_workmate = "'.$token.'" or url_boss = "'.$token.'"';
		$used = $this->to_select($con);
		return empty($used)?$token:$this->url_qr();
	}




	
}