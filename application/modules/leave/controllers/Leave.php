<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends Leave_Controller {

    protected $session_data;
    protected $url_qr;
    protected $url_approve;

	function __construct(){
        parent::__construct();
        
        $this->session_data = $this->session->userdata();
        $this->load->library(['restclient']);
        $this->url_qr = base_url(url_index().'auth?dest=leave/signature/');
        $this->url_approve = base_url(url_index().'auth?dest=leave/approve/');
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
        $set['personnel']['department_name'] = substr($sql_personnel['data'][0]['departname'],7);
        $set['personnel']['img']           = $personnel['data'][0]['img'];
        $set['personnel']['email']         = $personnel['data'][0]['email'];
        $set['personnel']['signature']     = $personnel['data'][0]['signature'];

        $set['personnel']['signature_url'] = trim($set['personnel']['signature'])==''?$this->Personnel_model->url_qr_personnel($set['personnel']['personnel_id']):'';

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

        $api = [];
        $api['APP-KEY']     = $this->api_key;
        $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
        $api['ip']          = get_client_ip();

        $set = [];
        $set['personnel'] = $this->session_data['personnel'];
        $set['api'] = $api;
        $personnel = $this->Personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
        $set['smu_main_id'] = $personnel['data'][0]['smu_main_id'];
        $result = $this->Personnel_model->get_boss(['smu_main_id'=>$set['smu_main_id']]);

        $set['boss'] = '';
        $boss_id = [];
        if($result['count']>0){
            foreach($result['data'] as $key=>$val){
                $boss_id[] = $val['personnel_id'];
            }

            $set['boss'] = $this->Personnel_model->get_personnel(['personnel_list'=>$boss_id]);

        }

        $set['friend'] = [];
        $result = $this->Personnel_model->get_personnel(['smu_main_id'=>$set['smu_main_id']]);
        if($result['count']>0){
            $set['friend'] = $result;
            foreach($set['friend']['data'] as $key=>$val){
                $set['boss']['data'][] = $val;
            }
        }

        $url_approve['workmate'] = $this->Leave_model->url_approve();
        $url_approve['head_unit'] = $this->Leave_model->url_approve();
        $url_approve['head_dept'] = $this->Leave_model->url_approve();
        $url_approve['supervisor'] = $this->Leave_model->url_approve();
        $url_approve['deputy_dean'] = $this->Leave_model->url_approve();
        $url_approve['hr'] = $this->Leave_model->url_approve();
        $set['url_approve'] = $url_approve;

        $set['leave_type'] = $this->Leave_type_model->get_type();

        $this->load->view('add_leave',$set);
    }

    function save_leave(){
        $post = $this->input->post();

        //echo '<pre>';print_r($post);exit;

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
        // $api['APP-KEY']     = $this->api_key;
        // $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
        // $api['ip']          = get_client_ip();

        $api['data']        = $post;
        $api['data']['personnel_id'] = isset($this->session_data['personnel']['personnel_id'])?$this->session_data['personnel']['personnel_id']:'';
        $api['data']['smu_main_id'] = isset($this->session_data['personnel']['smu_main_id'])?$this->session_data['personnel']['smu_main_id']:'';
        //$result = $this->restclient->post(base_url(url_index().'leave/api_v1/save_leave'),$api);

        $this->load->model(['Leave_model']);

        $result = $this->Leave_model->save_leave($api['data']);

        if(intval($result)!=0){
            redirect(url_index().'leave/view/'.(intval($result)).'?status=save_complete');// to view
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

            if(count($result['data'])==0){
                redirect(url_index().'leave');
            }

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
            $boss = $this->Personnel_model->get_personnel(['personnel_id'=>trim($set['data']['head_unit_personnel_id'])]);
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

            $url_signature = $this->url_qr.$signature;
            $result = $this->Personnel_model->get_personnel(['url_signature'=>$url_signature]);

            if($result['count']==0){
                redirect(base_url(url_index().'leave'));
            }

            $set['signature_type'] = 0;
            $set['personnel_id'] = $result['data'][0]['personnel_id'];

            $personnel = $this->session_data['personnel'];
            if($personnel['personnel_id']!=$set['personnel_id']){
                redirect(base_url(url_index().'leave'));
            }

            $api = [];
            $api['APP-KEY']     = $this->api_key;
            $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
            $api['ip']          = get_client_ip();
            
            $set['personnel'] = $this->session_data['personnel'];
            $sql_personnel = $this->Sql_personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
            $set['personnel']['position_name'] = $sql_personnel['data'][0]['positionname'];
            $set['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];
            $set['personnel']['img']           = $result['data'][0]['img'];
            $set['personnel']['data']          = $result['data'][0];

            $this->load->view('signature_personnel',$set);

        }else{
            redirect(base_url(url_index().'leave'));
        }

    }

    function save_signature_personnel(){
        $post = $this->input->post();

        if(count($post)==2 and isset($post['personnel_id']) and isset($post['signature']) and intval($post['personnel_id'])!=0 ){
            $this->load->model('personnel/Personnel_model');
            $this->Personnel_model->save_signature_personnel($post);
        }

        redirect(base_url(url_index().'leave'));
    }

    function approve($signature=''){ //dest to this

        $this->load->model('sql_personnel/Sql_personnel_model');
        $this->load->model('personnel/Personnel_model');
        $this->load->model('leave/Leave_type_model');

        if(trim($signature)!=''){
            $set = [];

            $this->load->model(['leave/Leave_model']);

            $url_signature = $this->url_approve.$signature;
            $result = $this->Leave_model->view_leave(['signature'=>$url_signature]);

            $set['signature_type'] = 0;
            $set['personnel_id'] = 0;
            
            if($result['data']['url_workmate'] == $url_signature){
                $set['signature_type'] = 1;
                $set['personnel_id'] = $result['data']['worker_personnel_id'];
            }elseif($result['data']['url_head_unit'] == $url_signature){
                $set['signature_type'] = 2;
                $set['personnel_id'] = $result['data']['head_unit_personnel_id'];
            }elseif($result['data']['url_head_dept'] == $url_signature){
                $set['signature_type'] = 3;
                $set['personnel_id'] = $result['data']['head_dept_personnel_id'];
            }elseif($result['data']['url_supervisor'] == $url_signature){
                $set['signature_type'] = 4;
                $set['personnel_id'] = $result['data']['head_supervisor_personnel_id'];
            }elseif($result['data']['url_deputy_dean'] == $url_signature){
                $set['signature_type'] = 5;
                $set['personnel_id'] = $result['data']['head_deputy_dean_personnel_id'];
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

            $con = [];
            $con[] = $set['data']['worker_personnel_id'];
            $con[] = $set['data']['head_unit_personnel_id'];
            $con[] = $set['data']['head_dept_personnel_id'];
            $con[] = $set['data']['supervisor_personnel_id'];
            $con[] = $set['data']['deputy_dean_personnel_id'];
            $set['personnel_list'] = $this->Personnel_model->get_personnel(['personnel_list'=>$con,'array_key'=>true]);

            $this->load->view('approve',$set);

        }else{
            redirect(base_url(url_index().'leave'));
        }

    }

    function save_approve(){
        $post = $this->input->post();

        if(count($post)==4 and isset($post['personnel_id']) and isset($post['type']) and isset($post['leave_id']) and isset($post['approve']) and intval($post['personnel_id'])!=0 and intval($post['leave_id'])!=0 and intval($post['type'])!=0 and (intval($post['approve']) == 1 or intval($post['approve'])==2)){

            $this->load->model('leave/Leave_model');
            $test = $this->Leave_model->save_approve($post);

        }

        redirect(base_url(url_index().'leave'));
    }

}
