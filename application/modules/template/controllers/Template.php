<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MY_Controller {

	function index(){
		$this->load->view('blank');
	}

	function login(){
		$this->load->view('login');
	}

	function blank(){
		$this->load->view('blank');
	}
}
