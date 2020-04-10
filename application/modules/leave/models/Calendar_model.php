<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Calendar_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
		$this->table = 'hr_calendar';
	}

	
}