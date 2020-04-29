<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends Leave_Controller {

    protected $session_data;
    protected $url_qr;

	function __construct(){
        parent::__construct();
        
        $this->session_data = $this->session->userdata();
        $this->load->library(['restclient']);
        $this->url_qr = base_url(url_index().'auth?dest=leave/signature/');
    }
    
    function index(){
        $set = [];

        $set['personnel'] = $this->session_data['personnel'];
        $this->load->model('sql_personnel/Sql_personnel_model');
        $this->load->model('personnel/Personnel_model');
        $this->load->model('leave/Leave_model');
        $this->load->model('leave/Leave_type_model');
        $personnel = $this->Personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
        $sql_personnel = $this->Sql_personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
        $set['personnel']['position_name'] = $sql_personnel['data'][0]['positionname'];
        $set['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];
        $set['personnel']['img']           = $personnel['data'][0]['img'];

        $api = [];
        $api['APP-KEY']     = $this->api_key;
        $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
        $api['ip']          = get_client_ip();
        $api['personnel_id'] = isset($this->session_data['personnel']['personnel_id'])?$this->session_data['personnel']['personnel_id']:'';
        $result = $this->restclient->post(base_url(url_index().'leave/api_v1/leave_history'),$api);

        $set['leave_history']['data'] = $result['data'];
        $set['leave_history']['count'] = $result['count'];

        $set['leave_type'] = $this->Leave_type_model->get_type();

        $this->load->view('index',$set);
    }

    function add(){

        $this->load->model([
            'Leave_type_model',
            'Leave_model'
        ]);
        $this->load->model('personnel/Personnel_model');

        $set = [];
        $set['personnel'] = $this->session_data['personnel'];
        $personnel = $this->Personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
        $result = $this->Personnel_model->get_boss(['smu_main_id'=>$personnel['data'][0]['smu_main_id']]);

        $set['boss'] = '';
        $boss_id = [];
        if($result['count']>0){
            foreach($result['data'] as $key=>$val){
                $boss_id[] = $val['personnel_id'];
            }

            $set['boss'] = $this->Personnel_model->get_personnel(['personnel_list'=>$boss_id]);
        }

        $set['friend'] = [];
        $result = $this->Personnel_model->get_personnel(['smu_main_id'=>$personnel['data'][0]['smu_main_id']]);
        if($result['count']>0){
            $set['friend'] = $result;
        }

        $url_qr['personnel'] = $this->Leave_model->url_qr();
        $url_qr['workmate'] = $this->Leave_model->url_qr();
        $url_qr['boss'] = $this->Leave_model->url_qr();
        $set['url_qr'] = $url_qr;

        $set['leave_type'] = $this->Leave_type_model->get_type();

        $this->load->view('add_leave',$set);
    }

    function save_leave(){
        $post = $this->input->post();

        if(count($post)>0){
            foreach($post as $key=>$val){
                if(trim($val)==''){
                    redirect(url_index().'leave/add/?status=validate');
                }
            }
        }else{
            redirect(url_index().'leave/add/?status=validate');
        }

        $api = [];
        $api['APP-KEY']     = $this->api_key;
        $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
        $api['ip']          = get_client_ip();
        $api['data']        = $post;
        $api['data']['personnel_id'] = isset($this->session_data['personnel']['personnel_id'])?$this->session_data['personnel']['personnel_id']:'';
        $api['data']['smu_main_id'] = isset($this->session_data['personnel']['smu_main_id'])?$this->session_data['personnel']['smu_main_id']:'';
        $result = $this->restclient->post(base_url(url_index().'leave/api_v1/save_leave'),$api);

        if($result['status']){
            redirect(url_index().'leave/?status=save_complete');// to view
        }else{
            redirect(url_index().'leave/add/?status=fail');
        }
    }

    function view($leave_id = 0){

        if(intval($leave_id)!=0){
            $this->load->model('sql_personnel/Sql_personnel_model');
            $this->load->model('personnel/Personnel_model');
            $this->load->model('leave/Leave_type_model');

            $set = [];

            $api = [];
            $api['APP-KEY']     = $this->api_key;
            $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
            $api['ip']          = get_client_ip();
            $api['leave_id'] = intval($leave_id);
            $result = $this->restclient->post(base_url(url_index().'leave/api_v1/view_leave'),$api);
            $set['data'] = $result['data'];
            
            $set['personnel'] = $this->session_data['personnel'];
            $personnel = $this->Personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
            $sql_personnel = $this->Sql_personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
            $set['personnel']['position_name'] = $sql_personnel['data'][0]['positionname'];
            $set['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];
            $set['personnel']['img']           = $personnel['data'][0]['img'];
            $set['personnel']['data']          = $personnel['data'][0];

            $set['leave_type'] = $this->Leave_type_model->get_type();

            $set['workmate'] = [];
            if(intval($set['data']['worker_personnel_id'])!=0){
                $workmate = $this->Personnel_model->get_personnel(['personnel_id'=>trim($set['data']['worker_personnel_id'])]);
                $set['workmate'] = $workmate['data'][0];
            }

            $set['boss'] = [];
            $boss = $this->Personnel_model->get_personnel(['personnel_id'=>trim($set['data']['boss_personnel_id'])]);
            $set['boss'] = $boss['data'][0];

            $this->load->view('view_leave',$set);

        }else{
            redirect(url_index().'leave');
        }
    }

    function check_print(){
        //auth login
        //dest to check print
        //scan
    }

    function calendar(){
        $set = [];
        $set['APP_KEY']     = $this->api_key;
        $set['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
        $set['ip']          = get_client_ip();
        $set['personnel'] = $this->session_data['personnel'];
        $this->load->view('calendar',$set);
    }

    private function save_weekend(){

        $this->load->model(['leave/Calendar_model']);

        $set = [];
        $date = date('Y-m-d');
        $year = date('Y',strtotime('+1 years'));

        $i=1;
        while(date('Y',strtotime($date)) <= $year) {

            $sat = date('Y-m-d', strtotime($date.' this Saturday'));
            $sun = date('Y-m-d', strtotime($date.' this Sunday'));

            if(date('Y',strtotime($sat)) > $year or date('Y',strtotime($sun)) > $year ){
                break;
            }

            if(!isset($set[$sat])){
                $set[$sat] = [
                    'cal_id'=>$sat,
                    'mktime'=>strtotime($sat),
                    'name'=>'วันเสาร์',
                ];
            }
            if(!isset($set[$sun])){
                $set[$sun] = [
                    'cal_id'=>$sun,
                    'mktime'=>strtotime($sun),
                    'name'=>'วันอาทิตย์',
                ];
            }

            $date = date('Y-m-d',strtotime('+'.$i.' day'));
            $i++;
        }

        if(count($set)>0){
            foreach($set as $key=>$val){

                $con = [];
                $con['data']['cal_id'] = $val['cal_id'];
                $con['data']['mktime'] = $val['mktime'];
                $con['data']['name'] = $val['name'];
                $con['data']['status'] = 0;

                $this->Calendar_model->to_insert($con);
            }
        }
    }

    function get_weekend($type=''){
        $this->load->model(['leave/Calendar_model']);
        if($type==''){
            header('Content-Type: application/json');
        }

        $con = [];
        $con['where'] = 'status = 0';
        $con['array_key'] = true;

        echo ($type=='js'?'var date_fix = ':'').json_encode($this->Calendar_model->to_select($con));
    }

    function signature($signature=''){ //dest to this

        $this->load->model('sql_personnel/Sql_personnel_model');
        $this->load->model('personnel/Personnel_model');
        $this->load->model('leave/Leave_type_model');

        if(trim($signature)!=''){
            $set = [];

            $this->load->model(['leave/Leave_model']);

            $url_signature = $this->url_qr.$signature;
            $result = $this->Leave_model->view_leave(['signature'=>$url_signature]);

            $set['signature_type'] = 0;
            $set['personnel_id'] = 0;
            
            if($result['data']['url_personnel'] == $url_signature){
                $set['signature_type'] = 1;
                $set['personnel_id'] = $result['data']['personnel_id'];
            }elseif($result['data']['url_workmate'] == $url_signature){
                $set['signature_type'] = 2;
                $set['personnel_id'] = $result['data']['worker_personnel_id'];
            }elseif($result['data']['url_boss'] == $url_signature){
                $set['signature_type'] = 3;
                $set['personnel_id'] = $result['data']['boss_personnel_id'];
            }

            $leave_id = $set['leave_id'] = $result['data']['leave_id'];

            $personnel = $this->session_data['personnel'];
            if($personnel['personnel_id']!=$set['personnel_id']){
                redirect(base_url(url_index().'leave'));
            }

            $api = [];
            $api['APP-KEY']     = $this->api_key;
            $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
            $api['ip']          = get_client_ip();
            $api['leave_id'] = intval($leave_id);
            $result = $this->restclient->post(base_url(url_index().'leave/api_v1/view_leave'),$api);
            $set['data'] = $result['data'];
            
            $set['personnel'] = $this->session_data['personnel'];
            $personnel = $this->Personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
            $sql_personnel = $this->Sql_personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
            $set['personnel']['position_name'] = $sql_personnel['data'][0]['positionname'];
            $set['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];
            $set['personnel']['img']           = $personnel['data'][0]['img'];
            $set['personnel']['data']          = $personnel['data'][0];

            $set['leave_type'] = $this->Leave_type_model->get_type();

            $set['workmate'] = [];
            if(intval($set['data']['worker_personnel_id'])!=0){
                $workmate = $this->Personnel_model->get_personnel(['personnel_id'=>trim($set['data']['worker_personnel_id'])]);
                $set['workmate'] = $workmate['data'][0];
            }

            $set['boss'] = [];
            $boss = $this->Personnel_model->get_personnel(['personnel_id'=>trim($set['data']['boss_personnel_id'])]);
            $set['boss'] = $boss['data'][0];

            $this->load->view('signature',$set);

        }else{
            redirect(base_url(url_index().'leave'));
        }

    }

    function save_signature(){
        $post = $this->input->post();

        if(count($post)==4 and isset($post['personnel_id']) and isset($post['type']) and isset($post['leave_id']) and isset($post['signature']) and intval($post['personnel_id'])!=0 and intval($post['leave_id'])!=0 and intval($post['type'])!=0){

            $this->load->model('leave/Leave_model');
            $this->Leave_model->save_signature($post);

        }

        redirect(base_url(url_index().'leave'));
    }


    



}
