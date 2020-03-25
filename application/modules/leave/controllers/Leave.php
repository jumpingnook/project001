<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends Leave_Controller {

	function __construct(){
		parent::__construct();
		//$this->load->library(['auth_ldap']);
    }
    
    function index(){
        $this->load->view('index');
    }

    function add(){
        $this->load->view('add_leave');
    }

    function view(){
        $this->load->view('view_leave');
    }
}
