<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends EMAIL_Controller {

    protected $session_data;

	function __construct(){
        parent::__construct();
    }

    function index(){
        redirect('med.nu.ac.th');
        exit; 
    }

}
