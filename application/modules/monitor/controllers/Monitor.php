<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitor extends Monitor_Controller {

    protected $session_data;

	function __construct(){
        parent::__construct();
        //$this->load->library(['restclient']);
    }

    function index(){
        $this->login();
    }

    function login(){
        $this->load->view('index'); 
    }
}
