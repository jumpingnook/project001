<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Option extends CI_Controller {

    protected $session_data;

	function __construct(){
        parent::__construct();
        //$this->load->library(['restclient']);
    }

    function index(){


        $this->load->view('signature');
    }

    function qrcode(){

        
        $this->load->view('qrcode');
    }

}
