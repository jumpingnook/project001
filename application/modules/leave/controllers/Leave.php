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
        $this->load->model(['Leave_quota_model']);

        $personnel = $this->Personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
        $sql_personnel = $this->Sql_personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
        $set['personnel']['position_name'] = $sql_personnel['data'][0]['positionname'];
        $set['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];
        $set['personnel']['department_name'] = substr($sql_personnel['data'][0]['departname'],7);
        $set['personnel']['img']           = $personnel['data'][0]['img'];
        $set['personnel']['email']         = $personnel['data'][0]['email'];
        $set['personnel']['signature']     = $personnel['data'][0]['signature'];
        $set['personnel']['work_start_date']     = $personnel['data'][0]['work_start_date'];
        $set['personnel']['work_end_date']     = $personnel['data'][0]['work_end_date'];

        $set['personnel']['signature_url'] = trim($set['personnel']['signature'])==''?$this->Personnel_model->url_qr_personnel($set['personnel']['personnel_id']):'';

        $api = [];
        $api['APP-KEY']     = $this->api_key;
        $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
        $api['ip']          = get_client_ip();
        $api['personnel_id'] = isset($this->session_data['personnel']['personnel_id'])?$this->session_data['personnel']['personnel_id']:'';
        $result = $this->restclient->post(base_url(url_index().'leave/api_v1/leave_history'),$api);

        $set['leave_history']['data'] = $result['data'];
        $set['leave_history']['count'] = $result['count'];
        $set['leave_history']['count_new'] = 0;
        $set['leave_history']['count_end'] = 0;
        if(count($set['leave_history']['data'])>0){
            foreach($set['leave_history']['data'] as $key=>$val){
                if($val['status']<98){
                    $set['leave_history']['count_new']++;
                }
                if($val['signature_deputy_dean_date']!='' and $val['deputy_dean_approve']==1){
                    $set['leave_history']['count_end']++;
                }
            }
        }

        $set['leave_type'] = $this->Leave_type_model->get_type($api['personnel_id']);
        $set['leave_quota'] = $this->Leave_quota_model->get_last_quote(['personnel_id'=>$personnel['data'][0]['personnel_id']]);

        //echo '<pre>';print_r($set['leave_history']);exit;

        $this->load->view('index',$set);
    }

    function add(){

        $this->load->model([
            'Leave_type_model',
            'Leave_model'
        ]);
        $this->load->model('personnel/Personnel_model');
        $this->load->model('leave/Leave_quota_model');

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

        // $set['boss'] = '';
        // $boss_id = [];
        // if($result['count']>0){
        //     foreach($result['data'] as $key=>$val){
        //         $boss_id[] = $val['personnel_id'];
        //     }
        //     $set['boss'] = $this->Personnel_model->get_personnel(['personnel_list'=>$boss_id]);
        // }

        // $set['friend'] = [];
        // $result = $this->Personnel_model->get_personnel(['smu_main_id'=>$set['smu_main_id']]);
        // if($result['count']>0){
        //     $set['friend'] = $result;
        //     foreach($set['friend']['data'] as $key=>$val){
        //         $set['boss']['data'][] = $val;
        //     }
        // }

        $url_approve['workmate'] = $this->Leave_model->url_approve();
        $url_approve['head_unit'] = $this->Leave_model->url_approve();
        $url_approve['head_dept'] = $this->Leave_model->url_approve();
        $url_approve['supervisor'] = $this->Leave_model->url_approve();
        $url_approve['deputy_dean'] = $this->Leave_model->url_approve();
        $url_approve['hr'] = $this->Leave_model->url_approve();
        $set['url_approve'] = $url_approve;

        
        $set['emp_type'] = $personnel['data'][0]['emp_type_id']; 
        $set['check_leave'] = check_leave_type($personnel['data'][0]['work_start_date']);
        $set['leave_type'] = $this->Leave_type_model->get_type(['check_leave'=>$set['check_leave']['status'],'emp_type'=>$set['emp_type']]);

        $set['leave_quota'] = $this->Leave_quota_model->get_last_quote(['personnel_id'=>$set['personnel']['personnel_id']]);

        //echo '<pre>';print_r($set);exit;

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

            if((intval($post['leave_type_id'])==1 or intval($post['leave_type_id'])==7) and $post['period_type']=='c' and ($post['period_start']>$post['period_end'])){
                redirect(url_index().'leave/add/?status=validate_date');
            }

        }else{
            redirect(url_index().'leave/add/?status=validate');
        }

        $set = [];
        $set['data']                    = $post;
        $set['data']['personnel_id']    = isset($this->session_data['personnel']['personnel_id'])?$this->session_data['personnel']['personnel_id']:'';
        $set['data']['smu_main_id']     = isset($this->session_data['personnel']['smu_main_id'])?$this->session_data['personnel']['smu_main_id']:'';
        

        $this->load->model(['Leave_model']);
        
        if((intval($post['leave_type_id'])==1 or intval($post['leave_type_id'])==7)){
            $this->load->model(['Leave_quota_model']);
            $quota = $this->Leave_quota_model->get_last_quote(['personnel_id'=>$set['data']['personnel_id']]);
            $quota = isset($quota[0]['quota_total'])?$quota[0]['quota_total']:0;

            if($quota<$post['period_count']){
                redirect(url_index().'leave/add/?status=over_quota');
            }
        }

        $this->load->model(['personnel/Personnel_model']);
        $personnel = $this->Personnel_model->get_personnel(['personnel_id'=>$set['data']['personnel_id']]);

        $api = [];
        $api['APP-KEY']     = $this->api_key;
        //$api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
        //$api['ip']          = get_client_ip();
        $api['leave_type']   = intval($post['leave_type_id']);
        $api['emp_type']     = $personnel['data'][0]['emp_type_id'];
        $api['personnel']    = $set['data']['personnel_id'];
        $api['day']          = $post['period_count'];

        $leave_spec = $this->restclient->post(base_url(url_index().'leave/api_v1/leave_spec_alert'),$api);

        if(isset($leave_spec['process']) and isset($leave_spec['process_redirect']) and isset($leave_spec['msg']) and !$leave_spec['process']){
            redirect(url_index().'leave/add/'.$leave_spec['process_redirect'].'&msg='.urlencode($leave_spec['msg']));
        }

        $last_leave = $this->Leave_model->last_leave(['leave_id'=>0,'leave_type'=>$api['leave_type']]);
        $last_leave = count($last_leave)>0?end($last_leave):0;
        $set['data']['last_leave_id'] = isset($last_leave['leave_id'])==1?$last_leave['leave_id']:0;

        $result = $this->Leave_model->save_leave($set['data']);
        
        if(intval($result)!=0){

            if(intval($post['leave_type_id'])==1 or intval($post['leave_type_id'])==7){
                $this->Leave_quota_model->save_quota(['personnel_id'=>$api['data']['personnel_id'],'leave_id'=>intval($result),'quota_use'=>floatval($post['period_count'])]);
            }

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
            $set['personnel']['department_name'] = substr($sql_personnel['data'][0]['departname'],7);
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

            $set['leave_id'] =intval($leave_id);
            
            if(intval($set['data']['leave_type_id'])>=2 and intval($set['data']['leave_type_id'])<=4){
                $this->load->model('leave/Leave_model');

                $last = $this->Leave_model->last_leave(['last_leave_id'=>$set['data']['last_leave_id']]);
                if(count($last)>0){
                    $set['last_leave'] = $last[0];
                }                

                $result = $this->Leave_model->last_leave(['leave_id'=>$set['leave_id'],'leave_type'=>$set['data']['leave_type_id']]);

                $set['old_leave_type'] = [2=>0,3=>0,4=>0];
                if(count($result)>0){
                    foreach($result as $key=>$val){
                        $set['old_leave_type'][$val['leave_type_id']] += $val['period_count'];
                    }
                }                
			}
			if(intval($set['data']['leave_type_id'])==1 or intval($set['data']['leave_type_id'])==7){
                $this->load->model('leave/Leave_model');
                $this->load->model('leave/Leave_quota_model');

                $set['leave_quota'] = $this->Leave_quota_model->get_last_quote(['personnel_id'=>$personnel['data'][0]['personnel_id'],'leave_id'=>$set['leave_id']]);

                $last = $this->Leave_model->last_leave(['last_leave_id'=>$set['data']['last_leave_id']]);
                if(count($last)>0){
                    $set['last_leave'] = $last[0];
                }

                $result = $this->Leave_model->last_leave(['leave_id'=>$set['leave_id'],'leave_type'=>$set['data']['leave_type_id']]);

                $set['old_leave_count'] = 0;
                if(count($result)>0){
                    foreach($result as $key=>$val){
                        $set['old_leave_count']+= $val['period_count'];
                    }
                }
            }

            $this->load->view('view_leave',$set);
            
        }else{
            redirect(url_index().'leave');
        }
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

        if(trim($signature)!=''){
            $this->load->model('sql_personnel/Sql_personnel_model');
            $this->load->model('personnel/Personnel_model');
            $this->load->model('leave/Leave_type_model');
            $this->load->model(['leave/Leave_model']);

            $set = [];

            $url_signature = $this->url_approve.$signature;
            $result = $this->Leave_model->view_leave(['signature'=>$url_signature]);

            $set['signature_type'] = 0;
            $set['personnel_id'] = 0;
            $set['approve_status'] = false;

            if($result['data']['url_workmate'] == $url_signature){
                $set['signature_type'] = 1;
                $set['personnel_id'] = $result['data']['worker_personnel_id'];
                $set['approve_status'] = $result['data']['workmate_approve']==0?false:true;
            }elseif($result['data']['url_head_unit'] == $url_signature){
                $set['signature_type'] = 2;
                $set['personnel_id'] = $result['data']['head_unit_personnel_id'];
                $set['approve_status'] = $result['data']['head_unit_approve']==0?false:true;
            }elseif($result['data']['url_head_dept'] == $url_signature){
                $set['signature_type'] = 3;
                $set['personnel_id'] = $result['data']['head_dept_personnel_id'];
                $set['approve_status'] = $result['data']['head_dept_approve']==0?false:true;
            }elseif($result['data']['url_supervisor'] == $url_signature){
                $set['signature_type'] = 4;
                $set['personnel_id'] = $result['data']['supervisor_personnel_id'];
                $set['approve_status'] = $result['data']['supervisor_approve']==0?false:true;
            }elseif($result['data']['url_deputy_dean'] == $url_signature){
                $set['signature_type'] = 5;
                $set['personnel_id'] = $result['data']['deputy_dean_personnel_id'];
                $set['approve_status'] = $result['data']['deputy_dean_approve']==0?false:true;
            }

            $set['signature_url'] = $this->Personnel_model->url_qr_personnel($set['personnel_id']);

            $leave_id = $set['leave_id'] = $result['data']['leave_id'];

            $personnel = $this->session_data['personnel'];
            // if($personnel['personnel_id']!=$set['personnel_id']){
            //     redirect(base_url(url_index().'leave'));
            // }

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


            if(intval($set['data']['leave_type_id'])>=2 and intval($set['data']['leave_type_id'])<=4){
                $this->load->model('leave/Leave_model');

                $last = $this->Leave_model->last_leave(['last_leave_id'=>$set['data']['last_leave_id']]);
                if(count($last)>0){
                    $set['last_leave'] = $last[0];
                }

                $result = $this->Leave_model->last_leave(['leave_id'=>$set['leave_id'],'leave_type'=>$set['data']['leave_type_id']]);

                $set['old_leave_type'] = [2=>0,3=>0,4=>0];
                if(count($result)>0){
                    foreach($result as $key=>$val){
                        $set['old_leave_type'][$val['leave_type_id']] += $val['period_count'];
                    }
                }
			}
			if(intval($set['data']['leave_type_id'])==1 or intval($set['data']['leave_type_id'])==7){
                $this->load->model('leave/Leave_model');
                $this->load->model('leave/Leave_quota_model');

                $set['leave_quota'] = $this->Leave_quota_model->get_last_quote(['personnel_id'=>$personnel['personnel_id'],'leave_id'=>$set['leave_id']]);

                $last = $this->Leave_model->last_leave(['last_leave_id'=>$set['data']['last_leave_id']]);
                if(count($last)>0){
                    $set['last_leave'] = $last[0];
                }

                $result = $this->Leave_model->last_leave(['leave_id'=>$set['leave_id'],'leave_type'=>$set['data']['leave_type_id']]);

                $set['old_leave_count'] = 0;
                if(count($result)>0){
                    foreach($result as $key=>$val){
                        $set['old_leave_count']+= $val['period_count'];
                    }
                }
            }

            $this->load->view('approve',$set);

        }else{
            redirect(base_url(url_index().'leave'));
        }

    }

    function save_approve(){
        $post = $this->input->post();

        if(count($post)==4 and isset($post['personnel_id']) and isset($post['type']) and isset($post['leave_id']) and isset($post['approve']) and intval($post['personnel_id'])!=0 and intval($post['leave_id'])!=0 and intval($post['type'])!=0 and (intval($post['approve']) == 1 or intval($post['approve'])==2)){
            $this->load->model('leave/Leave_model');
            $result = $this->Leave_model->save_approve($post);

            if(intval($post['type'])==5 and intval($post['approve']) == 1){// leave status 2
                $test = $this->Leave_model->leave_status(['leave_id'=>intval($post['leave_id']),'type'=>2]);
            }elseif(intval($post['approve']) == 2){// leave status 3
                $this->load->model('leave/Leave_quota_model');
                $test = $this->Leave_model->leave_status(['leave_id'=>intval($post['leave_id']),'type'=>3]);
                $this->Leave_quota_model->cancel_quota(['leave_id'=>intval($post['leave_id']),'personnel_id'=>intval($post['personnel_id'])]);
            }

        }

        if($result and intval($post['approve']) == 1 and intval($post['type'])!=5){
            $this->send_approve(['leave'=>intval($post['leave_id'])]);
        }

        redirect(base_url(url_index().'leave?approve=ds1df4d51s8af4dsa1'));
    }

    function send_approve($set=[]){
        $post = $this->input->post();

        $post = isset($set['leave']) && intval($set['leave'])!=0?$set:$post;
        $res_type = isset($set['leave']) && intval($set['leave'])!=0?true:false;

        $res = ['status'=> false];

        if(isset($post['leave']) and intval($post['leave'])!=0){

            $set = [];

            $api = [];
            $api['APP-KEY']     = $this->api_key;
            $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
            $api['ip']          = get_client_ip();
            $api['leave_id']    = intval($post['leave']);
            $result = $this->restclient->post(base_url(url_index().'leave/api_v1/view_leave'),$api);

            $ex_personnel_id = 0;
            $type = '';

            if(isset($result['data']) and count($result['data']>0)){

                if(intval($result['data']['worker_personnel_id']) != 0 and intval($result['data']['workmate_approve']) == 0 and $ex_personnel_id == 0){
                    $ex_personnel_id = intval($result['data']['worker_personnel_id']);
                    $type = 'workmate';
                }
                if(intval($result['data']['head_unit_personnel_id']) != 0 and intval($result['data']['head_unit_approve']) == 0 and $ex_personnel_id == 0){
                    $ex_personnel_id = intval($result['data']['head_unit_personnel_id']);
                    $type = 'head_unit';
                }
                if(intval($result['data']['head_dept_personnel_id']) != 0 and intval($result['data']['head_dept_approve']) == 0 and $ex_personnel_id == 0){
                    $ex_personnel_id = intval($result['data']['head_dept_personnel_id']);
                    $type = 'head_dept';
                }
                if(intval($result['data']['supervisor_personnel_id']) != 0 and intval($result['data']['supervisor_approve']) == 0 and $ex_personnel_id == 0){
                    $ex_personnel_id = intval($result['data']['supervisor_personnel_id']);
                    $type = 'supervisor';
                }
                if(intval($result['data']['deputy_dean_personnel_id']) != 0 and intval($result['data']['deputy_dean_approve']) == 0 and $ex_personnel_id == 0){
                    $ex_personnel_id = intval($result['data']['deputy_dean_personnel_id']);
                    $type = 'deputy_dean';
                }

                if($ex_personnel_id!=0){
                    $this->load->model('sql_personnel/Sql_personnel_model');
                    $this->load->model('personnel/Personnel_model');
                    $this->load->model('leave/Leave_type_model');
                    $this->load->model('leave/Leave_model');

                    $set['personnel_receive'] = $this->Personnel_model->get_personnel(['personnel_id'=>$ex_personnel_id]);

                    $set['personnel'] = $this->session_data['personnel'];
                    $personnel = $this->Personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
                    $sql_personnel = $this->Sql_personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
                    $set['personnel']['position_name'] = $sql_personnel['data'][0]['positionname'];
                    $set['personnel']['department_name'] = substr($sql_personnel['data'][0]['departname'],7);
                    $set['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];
                    $set['personnel']['data']          = $personnel['data'][0];

                    $set['leave_type'] = $this->Leave_type_model->get_type();

                    $set['leave_data'] = $result['data'];

                    $set['url_type'] = $type;

                    $html = $this->load->view('email/approve',$set,true);

                    if(isset($set['personnel_receive']['data'][0]['email']) and trim($set['personnel_receive']['data'][0]['email'])!=''){

                        $api['subject']     = '[ระบบลา] พิจารณาการลา เลขที่ '.$set['leave_data']['leave_no'];
                        $api['body']        = $html;
                        $api['to']          = 'blackbullet.social@gmail.com';//$set['personnel_receive']['data'][0]['email'];
                        $send = $this->restclient->post(base_url(url_index().'email/api_v1/send'),$api);

                        if($send['status']){
                            $this->Leave_model->send_approve(intval($post['leave']));
                        }
                    }
                    
                    $res['status'] = $send['status'];
                    
                    if($res_type){
                        return true;
                    }else{
                        echo json_encode($res);exit;
                    }

                }else{
                    if($res_type){
                        return false;
                    }else{
                        echo json_encode($res);exit;
                    }
                }
            }else{
                if($res_type){
                    return false;
                }else{
                    echo json_encode($res);exit;
                }
            }
            if($res_type){
                return false;
            }else{
                echo json_encode($res);exit;
            }
        }
    }

    function print(){
        $post = $this->input->post();
        $res= ['status'=>false,'token'=>''];

        $post['leave'] = 4;

        if(isset($post['leave']) and intval($post['leave'])!=0){
            
            $this->load->model(['Leave_print_model','Leave_model']);
            $personnel = $this->session_data['personnel'];
            $leave = $this->Leave_model->view_leave(['leave_id'=>intval($post['leave'])]);

            $result = $this->Leave_print_model->gen_token(['leave_id'=>intval($post['leave']),'personnel'=>$personnel,'leave'=>$leave]);

            echo json_encode(['status'=>true,'data'=>$result]);exit;

        }

        echo json_encode(['status'=>false]);exit;
    }

    function cancel_leave($type=''){
        $post = $this->input->post();
        
        $post['leave'] = 4;
        $type = b;


        if(trim($type)=='b' and isset($post['leave']) and intval($post['leave'])!=0){
            $this->load->model([
                'Leave_model',
                'Leave_quota_model'
            ]);
            $result = $this->Leave_model->cancel($post['leave'],99);
            $this->Leave_quota_model->Leave_quota_model(['leave_id'=>intval($post['leave']),'personnel_id'=> -1]);

            echo json_encode(['status'=>true]);exit;

        }// type == a
    }

    function check_print($token=''){

        if(trim($token)!=''){
            $this->load->model('sql_personnel/Sql_personnel_model');
            $this->load->model('personnel/Personnel_model');
            $this->load->model('leave/Leave_type_model');
            $this->load->model(['leave/Leave_model']);
            $this->load->model(['leave/Leave_print_model']);

            $set = [];

            $token = $token;
            $check = $this->Leave_print_model->check_print($token);

            $leave_id = 0;
            if(isset($check['status']) and $check['status'] and count($check['data'])!=0){
                $leave_id = $check['data'][0]['leave_id'];
            }else{
                $set['view_only'] = false;
                $this->load->view('view_leave',$set);
                return true;
            }

            $result = $this->Leave_model->view_leave(['leave_id'=>$leave_id]);
            $leave_id = $set['leave_id'] = $result['data']['leave_id'];

            if(count($result['data'])<=0){
                $set['view_only'] = false;
                $this->load->view('view_leave',$set);
                return true;
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

            $con = [];
            $con[] = $set['data']['worker_personnel_id'];
            $con[] = $set['data']['head_unit_personnel_id'];
            $con[] = $set['data']['head_dept_personnel_id'];
            $con[] = $set['data']['supervisor_personnel_id'];
            $con[] = $set['data']['deputy_dean_personnel_id'];
            $set['personnel_list'] = $this->Personnel_model->get_personnel(['personnel_list'=>$con,'array_key'=>true]);

            $set['view_only'] = true;
            $this->load->view('view_leave',$set);
            return true;

        }else{
            redirect(base_url(url_index().'leave'));
        }
    }
    
}
