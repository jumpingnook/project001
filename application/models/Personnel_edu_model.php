<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Personnel_edu_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
      	$this->table = 'hr_personnel_edu';
	}

	
	
}