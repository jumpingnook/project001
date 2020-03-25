<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Personnel_model extends MY_Model {

	protected $token_time = 25;

	function __construct(){
    	parent::__construct();
      	$this->load->database();
      	$this->table = 'hr_personnel';
	}

	function check_account($set = []){
		$res = true;
		if(isset($set['username']) and trim($set['username'])!=''){
			$con = [];
			$con['where'] = 'internet_account = "'.trim($set['username']).'"';
			$count = $this->to_count($con);

			if($count){
				$res = false;
			}
		}

		return $res;
	}

	
	
}