<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#require_once(APPPATH.'vendor/autoload.php');

class Meeting_room_booking extends Meeting_room_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library(['restclient']);
    }

    function index(){
        $this->load->view('index');
    }

}
