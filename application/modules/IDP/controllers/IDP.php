<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IDP extends IDP_Controller {

    protected $session_data;

	function __construct(){
        parent::__construct();
        $this->load->library(['restclient']);
        //$this->load->model('auth/Token_model');

        $this->session_data = $this->session->userdata();
    }

    function index(){
        $this->my_course();
    }
    function my_course(){

        $ip = get_client_ip();
        $set = [];
        $set['APP-KEY']     = $this->api_key;
        $set['username']    = isset($this->session_data['authentication']['username'])?$this->session_data['authentication']['username']:'';
        $set['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
        $set['ip']          = $ip;
        $sql_personnel = $this->restclient->post(base_url(url_index().'sql_personnel/api_v1/personnel'),$set);

        $set = [];
        $set['personnel'] = $this->session_data['personnel'];
        $set['personnel']['position_name'] = $sql_personnel['data'][0]['positionname'];
        $set['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];

        $this->load->view('my_course',$set);
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
