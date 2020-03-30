<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IDP extends IDP_Controller {

	function __construct(){
        parent::__construct();
        $this->load->library(['restclient']);
        //$this->load->model('auth/Token_model');
    }

    function index(){
        $this->my_course();
    }
    function my_course(){

        $session = $this->session->userdata('authentication');

        $ip = get_client_ip();

        $set = [];
        $set['APP-KEY']     = $this->api_key;
        $set['username']    = isset($session['username'])?$session['username']:'';
        $set['token']       = isset($session['token'])?$session['token']:'';
        $set['ip']          = $ip;
        $result = $this->restclient->post(base_url(url_index().'sql_personnel/api_v1/personnel'),$set);

        $this->load->view('my_course');
    }
    function view_course(){
        $this->load->view('view_course');
    }
    function measure(){
        $this->load->view('measure');
    }
    function search_course(){
        $this->load->view('search_course');
    }
    function request_course(){
        $this->load->view('request_course');
    }
    function list_personnel(){
        $this->load->view('list_personnel');
    }
    function report(){
        $this->my_course();
        //$this->load->view('report');
    }

}
