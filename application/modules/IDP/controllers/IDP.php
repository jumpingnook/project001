<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#require_once(APPPATH.'vendor/autoload.php');

class IDP extends IDP_Controller {

    protected $session_data;

	function __construct(){
        parent::__construct();
        $this->load->library(['restclient']);

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
        $primary_course = $this->restclient->post(base_url(url_index().'IDP/api_v1/primary_course'),$set);

        $set = [];
        $set['personnel'] = $this->session_data['personnel'];
        $set['personnel']['position_name'] = $sql_personnel['data'][0]['positionname'];
        $set['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];

        $set['primary_course'] = [];
        if($primary_course['status']){
            $set['primary_course'] = $primary_course['data'];
        }

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

    function manage_course(){

        $set = [];
        $set['APP-KEY']     = $this->api_key;
        $set['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
        $set['ip']          = get_client_ip();
        $course = $this->restclient->post(base_url(url_index().'IDP/api_v1/course'),$set);

        $set['course'] = [];
        if($course['status']){
            $set['course'] = $course['data'];
        }

        $this->load->view('manage_course',$set);
    }

    function view_m_course($course = 0){

        if(intval($course)==0){
            redirect(url_index().'idp/manage_course/?admin=1');
        }

        $set = [];
        $set['APP-KEY']     = $this->api_key;
        $set['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
        $set['ip']          = get_client_ip();
        $set['course']      = intval($course);
        $course = $this->restclient->post(base_url(url_index().'IDP/api_v1/course'),$set);
        $group_tag = $this->restclient->post(base_url(url_index().'IDP/api_v1/group_tag'),$set);

        $res['course'] = $res['group_tag'] = $res['tag'] = [];
        if($course['status'] and $group_tag['status']){
            $res['course']      = array_shift($course['data']);
            $res['group_tag']   = $group_tag['group_tag'];
            $res['tag']         = $group_tag['tag'];
        }

        //echo '<pre>';print_r($res);exit;

        $this->load->view('view_m_course',$res);
    }

    function add_m_course(){
        $res = [];
        $this->load->view('add_m_course',$res);
    }


    

    

}
