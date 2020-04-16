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

        $set['personnel_id']    = isset($this->session_data['personnel']['personnel_id'])?$this->session_data['personnel']['personnel_id']:'';
        $enroll = $this->restclient->post(base_url(url_index().'IDP/api_v1/enroll'),$set);

        

        $set = [];
        $set['personnel'] = $this->session_data['personnel'];
        $set['personnel']['position_name'] = $sql_personnel['data'][0]['positionname'];
        $set['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];

        $set['primary_course'] = [];
        if($primary_course['status']){
            $set['primary_course'] = $primary_course['data'];
        }

        $set['enroll'] = [];
        if($enroll['status']){
            $set['enroll'] = $enroll['data'];
        }
        
        $set['APP_KEY']     = $this->api_key;
        $set['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
        $set['ip']          = get_client_ip();

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
        $ip = get_client_ip();
        $con = [];
        $set = [];
        $con['APP-KEY']     = $this->api_key;
        $con['username']    = isset($this->session_data['authentication']['username'])?$this->session_data['authentication']['username']:'';
        $con['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
        $con['ip']          = $ip;
        $course = $this->restclient->post(base_url(url_index().'IDP/api_v1/course'),$con);
        $con['personnel_id']    = isset($this->session_data['personnel']['personnel_id'])?$this->session_data['personnel']['personnel_id']:'';
        $enroll = $this->restclient->post(base_url(url_index().'IDP/api_v1/enroll'),$con);



        

        
        // $set['personnel'] = $this->session_data['personnel'];
        // $set['personnel']['position_name'] = $sql_personnel['data'][0]['positionname'];
        // $set['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];

        $set['course'] = [];
        if($course['status']){
            $set['course'] = $course['data'];
        }

        $set['enroll'] = [];
        $personnel = [];
        $set['count'] = [];
        $set['count']['personnel'] = [];
        $set['count'][0] = 0;
        $set['count'][1] = 0;
        $set['count'][2] = 0;
        if($enroll['status'] and count($enroll['data'])>0){
            
            foreach($enroll['data'] as $key=>$val){
                $set['enroll'][$val['personnel_id']][$val['course_id']] = $val;
                $personnel[] = $val['personnel_id'];
                $set['count'][$val['status']]++;
                $set['count']['personnel'][$val['personnel_id']] = 1;
            }

        }

        $con['personnel_list'] = $personnel;
        $personnel = $this->restclient->post(base_url(url_index().'personnel/api_v1/personnel'),$con);
        $set['personnel'] = [];
        if($personnel['status'] and count($personnel['data'])>0){
            $set['personnel'] = $personnel['data'];
        }

        $this->load->view('report',$set);
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

        $this->load->view('view_m_course',$res);
    }

    function add_m_course(){
        #generate token_login
        $token = genTOKEN();

        $this->session->set_flashdata('token_course', $token);

        $res = [];
        $res['method']  = 'add';
        $res['token']   = $token;
        $this->load->view('add_m_course',$res);
    }

    function edit_m_course($course=0){

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

        $res = [];
        $res['course'] = $res['group_tag'] = $res['tag'] = [];
        if($course['status'] and $group_tag['status']){
            $res['course']      = array_shift($course['data']);
            $res['group_tag']   = $group_tag['group_tag'];
            $res['tag']         = $group_tag['tag'];
        }else{
            redirect(url_index().'idp/manage_course/?admin=1');
        }

        #generate token_login
        $token = genTOKEN();
        $this->session->set_flashdata('token_course', $token);

        //echo '<pre>';print_r($res);exit;
        $res['method']  = 'edit';
        $res['token']   = $token;
        $this->load->view('add_m_course',$res);
    }

    function save_course(){
        $post = $this->input->post();

        if(trim($post['token']) != $this->session->flashdata('token_course')){
            redirect(url_index().'idp/manage_course/?admin=1');
        }

        if(isset($post['course_name']) and trim($post['course_name'])==''){
            redirect(url_index().'idp/manage_course/?admin=1');
        }elseif(isset($post['course_link']) and trim($post['course_link'])==''){
            redirect(url_index().'idp/manage_course/?admin=1');
        }

        $set = $post;
        $set['APP-KEY']     = $this->api_key;
        $set['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
        $set['ip']          = get_client_ip();

        if(count($post)>0 and isset($post['method']) and trim($post['method'])=='add'){
            
            $result = $this->restclient->post(base_url(url_index().'IDP/api_v1/save_course'),$set);
            redirect(url_index().'idp/manage_course/?admin=1');
            
        }elseif(count($post)>0 and isset($post['method']) and trim($post['method'])=='edit'){

            //echo '<pre>';print_r($post);exit;

            if(isset($post['course']) and trim($post['course'])==''){
                redirect(url_index().'idp/manage_course/?admin=1');
            }

            $result = $this->restclient->post(base_url(url_index().'IDP/api_v1/update_course'),$set);
            redirect(url_index().'idp/manage_course/?admin=1');
        }

    }

    // function test(){
    //     $this->load->model('sql_personnel/Sql_personnel_model');
    //     header("Content-Type: image/jpeg");
    //     $test = $this->Sql_personnel_model->get_personnel(['username'=>'pimonpanl']);
    //     echo $test['data'][0]['picture'];
    // }


    

    

}
