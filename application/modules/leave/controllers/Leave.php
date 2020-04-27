<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends Leave_Controller {

    protected $session_data;

	function __construct(){
        parent::__construct();
        
        $this->session_data = $this->session->userdata();
        $this->load->library(['restclient']);
    }
    
    function index(){
        $set = [];

        $set['personnel'] = $this->session_data['personnel'];
        $this->load->model('sql_personnel/Sql_personnel_model');
        $this->load->model('personnel/Personnel_model');
        $personnel = $this->Personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
        $sql_personnel = $this->Sql_personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
        $set['personnel']['position_name'] = $sql_personnel['data'][0]['positionname'];
        $set['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];
        $set['personnel']['img']           = $personnel['data'][0]['img'];

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
        $api['data']['smu_main_id'] = isset($this->session_data['personnel']['smu_main_id'])?$this->session_data['personnel']['smu_main_id']:'';
        $result = $this->restclient->post(base_url(url_index().'leave/api_v1/save_leave'),$api);

        if($result['status']){
            redirect(url_index().'leave/?status=save_complete');// to view
        }else{
            redirect(url_index().'leave/add/?status=fail');
        }
    }

    function view(){
        $set = [];
        $set['personnel'] = $this->session_data['personnel'];
        $this->load->view('view_leave',$set);
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

    



}
