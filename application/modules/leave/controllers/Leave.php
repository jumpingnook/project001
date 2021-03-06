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
        $this->load->model('leave/Leave_spec_model');
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
        $set['personnel']['personnel_id']     = $personnel['data'][0]['personnel_id'];
        $set['personnel']['emp_type_id']     = $personnel['data'][0]['emp_type_id'];

        $set['personnel']['last_login'] = false;
        if($personnel['data'][0]['last_login']=='0000-00-00 00:00:00' or is_null($personnel['data'][0]['last_login'])){
            $set['personnel']['last_login'] = true;
        }elseif(date('Y-m') != date('Y-m',strtotime($personnel['data'][0]['last_login']))){
            $set['personnel']['last_login'] = true;
        }

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
                if($val['status']<98 and $val['status']!=2 and $val['status']!=3){
                    $set['leave_history']['count_new']++;
                }
                if(isset($val['signature_cancel_date_5']) and $val['signature_cancel_date_5']!='' and $val['approve_personnel_5']==1){
                    $set['leave_history']['count_end']++;
                }
            }
        }

        $set['leave_type'] = $this->Leave_type_model->get_type($api['personnel_id']);
        $set['leave_quota'] = $this->Leave_quota_model->get_last_quote(['personnel_id'=>$personnel['data'][0]['personnel_id']]);

        $result = $this->Leave_spec_model->to_select([]);
        
        $set['leave_spec'] = [];
        foreach($result as $key => $val){
            $set['leave_spec'][$val['leave_type_id']][$val['emp_type_id']] = $val;
        }

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
        $set['personnel']['gender'] = intval($personnel['data'][0]['gender']);
        $set['personnel']['phone'] = $personnel['data'][0]['phone'];

        if(count($personnel['data'])<=0){
            redirect(url_index().'leave/');
        }
        // if(trim($personnel['data'][0]['signature']) == ''){
        //     redirect(url_index().'leave/'); //sanan
        // }

        $url_approve['url_personnel_1'] = $this->Leave_model->url_approve();
        $url_approve['url_personnel_2'] = $this->Leave_model->url_approve();
        $url_approve['url_personnel_3'] = $this->Leave_model->url_approve();
        $url_approve['url_personnel_4'] = $this->Leave_model->url_approve();
        $url_approve['url_personnel_5'] = $this->Leave_model->url_approve();
        $url_approve['url_personnel_6'] = $this->Leave_model->url_approve();
        $set['url_approve'] = $url_approve;

        $set['emp_type'] = $personnel['data'][0]['emp_type_id']; 
        $set['count_job_exp'] = count_job_exp($personnel['data'][0]['work_start_date']);

        $set['leave_type'] = $this->Leave_type_model->get_type(['month'=>$set['count_job_exp']['month'],'day'=>$set['count_job_exp']['day'],'emp_type'=>$set['emp_type'],'gender'=>$set['personnel']['gender'],'all'=>false]); //sanan

        $set['leave_quota'] = $this->Leave_quota_model->get_last_quote(['personnel_id'=>$set['personnel']['personnel_id']]);

        $con = [];
        $con['where'] = 'personnel_id = "'.$set['personnel']['personnel_id'].'" and (status = 0 or status = 1) and (leave_type_id=7)';
        $count = $this->Leave_model->to_count($con);
        if($count!=0){
            unset($set['leave_type'][7]);
        }
        $con['where'] = 'personnel_id = "'.$set['personnel']['personnel_id'].'" and (status = 0 or status = 1) and (leave_type_id=10)';
        $count = $this->Leave_model->to_count($con);
        if($count!=0){
            unset($set['leave_type'][10]);
        }

        $post = $this->session->flashdata();
        if(isset($post['post']) and count($post['post'])>0){
            $set['post_data'] = $post['post'];
        }  

        $this->load->view('add_leave',$set);
    }

    function edit($leave_id = 0){

        $this->load->model([
            'Leave_type_model',
            'Leave_model'
        ]);
        $this->load->model('personnel/Personnel_model');
        $this->load->model('leave/Leave_quota_model');

        $set = [];

        $set['leave_data'] = $this->Leave_model->view_leave(['leave_id'=>intval($leave_id)]);
        if(isset($set['leave_data']['data']) and count($set['leave_data']['data'])!=0){
            $set['leave_data'] = $set['leave_data']['data'];
        }else{
            redirect(url_index().'leave');
        }

        $api = [];
        $api['APP-KEY']     = $this->api_key;
        $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
        $api['ip']          = get_client_ip();

        $set['personnel'] = $this->session_data['personnel'];
        $set['api'] = $api;
        $personnel = $this->Personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
        $set['personnel']['gender'] = intval($personnel['data'][0]['gender']);
        $set['personnel']['phone'] = $personnel['data'][0]['phone'];

        $url_approve['url_personnel_1'] = $this->Leave_model->url_approve();
        $url_approve['url_personnel_2'] = $this->Leave_model->url_approve();
        $url_approve['url_personnel_3'] = $this->Leave_model->url_approve();
        $url_approve['url_personnel_4'] = $this->Leave_model->url_approve();
        $url_approve['url_personnel_5'] = $this->Leave_model->url_approve();
        $url_approve['url_personnel_6'] = $this->Leave_model->url_approve();
        $set['url_approve'] = $url_approve;

        $set['emp_type'] = $personnel['data'][0]['emp_type_id']; 
        $set['count_job_exp'] = count_job_exp($personnel['data'][0]['work_start_date']);

        $set['leave_type'] = $this->Leave_type_model->get_type(['month'=>$set['count_job_exp']['month'],'day'=>$set['count_job_exp']['day'],'emp_type'=>$set['emp_type'],'gender'=>$set['personnel']['gender'],'all'=>false]);
        $set['leave_quota'] = $this->Leave_quota_model->get_last_quote(['personnel_id'=>$set['personnel']['personnel_id']]);

        $con = [];
        $con['where'] = 'personnel_id = "'.$set['personnel']['personnel_id'].'" and (status = 0 or status = 1) and (leave_type_id=7)';
        $count = $this->Leave_model->to_count($con);
        if($count!=0){
            unset($set['leave_type'][7]);
        }
        $con['where'] = 'personnel_id = "'.$set['personnel']['personnel_id'].'" and (status = 0 or status = 1) and (leave_type_id=10)';
        $count = $this->Leave_model->to_count($con);
        if($count!=0){
            unset($set['leave_type'][10]);
        }

        $set['leave_id'] =intval($leave_id);

        $con = [];
        $con[] = $set['leave_data']['personnel_id'];
        for($i=1;$i<=6;$i++){
            $con[] = $set['leave_data']['personnel_id_'.$i];
        }
        $set['personnel_list'] = $this->Personnel_model->get_personnel(['personnel_list'=>$con,'array_key'=>true]);

        if($set['personnel_list']['count']>0){
            for($i=1;$i<=6;$i++){
                if(isset($set['personnel_list']['data'][$set['leave_data']['personnel_id_'.$i]])){
                    $set['leave_data']['name_personnel_'.$i] = $set['personnel_list']['data'][$set['leave_data']['personnel_id_'.$i]]['title'].$set['personnel_list']['data'][$set['leave_data']['personnel_id_'.$i]]['name_th'].' '.$set['personnel_list']['data'][$set['leave_data']['personnel_id_'.$i]]['surname_th'];
                }
                ;
            }
        }




        // $post = $this->session->flashdata();
        // if(isset($post['post']) and count($post['post'])>0){
        //     $set['post_data'] = $post['post'];
        // }

        //echo '<pre>';print_r($set);exit;

        // $personnel = $this->Personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
        // $set['emp_type'] = $personnel['data'][0]['emp_type_id']; 
        // $set['check_leave'] = check_leave_type($personnel['data'][0]['work_start_date']);
        // $set['leave_type'] = $this->Leave_type_model->get_type(['check_leave'=>$set['check_leave']['status'],'emp_type'=>$set['emp_type']]);
        //$set['leave_quota'] = $this->Leave_quota_model->get_last_quote(['personnel_id'=>$set['personnel']['personnel_id']]);

        //$set['form_edit'] = true;

        //echo '<pre>';print_r($set);exit;

        $this->load->view('edit_leave',$set);
    }

    function save_leave(){
        $post = $this->input->post();

        //echo '<pre>';print_r($post);exit;

        $this->session->set_flashdata('post', $post);

        if(!isset($post['leave_type_id']) or !isset($post['write_at']) or !isset($post['to']) or !isset($post['title']) or !isset($post['period_start']) or !isset($post['period_end']) or !isset($post['period_count']) or !isset($post['period_count_all'])){
            redirect(url_index().'leave/add/?status=validate');
        }
        if(isset($post['leave_type_id']) && intval($post['leave_type_id'])==0){
            redirect(url_index().'leave/add/?status=validate');
        }

        $url_p1 = $post['url_personnel_1'];

        

        if(count($post)>0){


            if($post['leave_type_id']==5 || $post['leave_type_id']==4){
                for($i=1;$i<=5;$i++){
                    if(isset($post['personnel_id_'.$i]) and intval($post['personnel_id_'.$i])==0){
                        unset($post['personnel_id_'.$i]);
                        unset($post['position_personnel_'.$i]);
                        unset($post['url_personnel_'.$i]);
                        unset($post['name_personnel_'.$i]);
                    }
                }
                if(isset($post['to']) && intval($post['to'])==1){
                    if(!isset($post['personnel_id_'.$i]) || !isset($post['position_personnel_'.$i]) || !isset($post['name_personnel_'.$i]) || trim($post['position_personnel_'.$i])=='' || trim($post['name_personnel_'.$i])==''){
                        redirect(url_index().'leave/add/?status=6-0'); //sanan
                    }
                }else{
                    unset($post['personnel_id_6']);
                    unset($post['position_personnel_6']);
                    unset($post['url_personnel_6']);
                    unset($post['name_personnel_6']);
                }
            }else{
                for($i=1;$i<=4;$i++){
                    if(isset($post['personnel_id_'.$i]) and intval($post['personnel_id_'.$i])==0){
                        unset($post['personnel_id_'.$i]);
                        unset($post['position_personnel_'.$i]);
                        unset($post['url_personnel_'.$i]);
                        unset($post['name_personnel_'.$i]);
                    }
                }
                if(isset($post['to']) && intval($post['to'])==1){

                    if(!isset($post['personnel_id_6']) or intval($post['personnel_id_'.$i])!=0){
                        if(!isset($post['personnel_id_'.$i]) || !isset($post['position_personnel_'.$i]) || !isset($post['name_personnel_'.$i]) || trim($post['position_personnel_'.$i])=='' || trim($post['name_personnel_'.$i])==''){
                            redirect(url_index().'leave/add/?status=6-0'); //sanan
                        }
                        unset($post['personnel_id_6']);
                        unset($post['position_personnel_6']);
                        unset($post['url_personnel_6']);
                        unset($post['name_personnel_6']);
                    }else{

                        if(!isset($post['personnel_id_6']) || !isset($post['position_personnel_6']) || !isset($post['name_personnel_6']) || trim($post['position_personnel_6'])=='' || trim($post['name_personnel_6'])==''){
                            redirect(url_index().'leave/add/?status=8-0'); //sanan
                        }

                        unset($post['personnel_id_5']);
                        unset($post['position_personnel_5']);
                        unset($post['url_personnel_5']);
                        unset($post['name_personnel_5']);
                    }
                    

                    
                }else{
                    unset($post['personnel_id_5']);
                    unset($post['position_personnel_5']);
                    unset($post['url_personnel_5']);
                    unset($post['name_personnel_5']);
                }
            }

            foreach($post as $key=>$val){
                if(trim($val)==''){
                    redirect(url_index().'leave/add/?status=5-0');
                }
            }

        }else{
            redirect(url_index().'leave/add/?status=5-0');
        }

        for($i=1;$i<=6;$i++){
            if(isset($post['name_personnel_'.$i])){
                unset($post['name_personnel_'.$i]);
            }
        }
        
        $set = [];
        $set['data'] = $post;
        $set['data']['personnel_id']    = isset($this->session_data['personnel']['personnel_id'])?$this->session_data['personnel']['personnel_id']:'';
        $set['data']['smu_main_id']     = isset($this->session_data['personnel']['smu_main_id'])?$this->session_data['personnel']['smu_main_id']:'';
        $set['data']['url_personnel_1'] = $url_p1;

        #check Leave detail
        $this->load->model(['personnel/Personnel_model']);
        $personnel = $this->Personnel_model->get_personnel(['personnel_id'=>$set['data']['personnel_id']]);
        $api = [];
        $api['APP-KEY']      = $this->api_key;
        $api['leave_type']   = intval($post['leave_type_id']);
        $api['emp_type']     = $personnel['data'][0]['emp_type_id'];
        $api['personnel']    = $set['data']['personnel_id'];
        $api['period_count']        = $post['period_count'];
        $api['period_count_all']    = $post['period_count_all'];
        $api['period_start']    = $post['period_start'];
        $api['period_end']      = $post['period_end'];
        $api['edit']            = $post['edit_leave_id'];
        $leave_spec = $this->restclient->post(base_url(url_index().'leave/api_v2/leave_spec_alert'),$api);
        
        if(isset($leave_spec['status']) and $leave_spec['status']){

            $leave_spec = $leave_spec['data'];

            if(isset($leave_spec['before'][0]) and intval($leave_spec['before'][0])!=0){
                redirect(url_index().'leave/add/?status=1-'.$leave_spec['before'][0]);
            }
            if(isset($leave_spec['before'][1]) and intval($leave_spec['before'][1])!=0){
                redirect(url_index().'leave/add/?status=2-'.$leave_spec['before'][1]);
            }
            if(isset($leave_spec['limit']) and intval($leave_spec['limit'])!=0){
                redirect(url_index().'leave/add/?status=3-'.$leave_spec['limit']);
            }
            if(isset($leave_spec['limit_rest']) and intval($leave_spec['limit_rest'])!=0){
                redirect(url_index().'leave/add/?status=4-'.$leave_spec['limit_rest']);
            }

            if(isset($leave_spec['approve']) and (intval($leave_spec['approve'])==1 or intval($leave_spec['approve'])==2)){
                $set['data']['to'] = 1;
            }elseif(isset($leave_spec['approve']) and intval($leave_spec['approve'])==3){
                $set['data']['to'] = 2;
            }

            if(isset($leave_spec['duplicate_leave']) and $leave_spec['duplicate_leave'] and !isset($post['edit_leave_id'])){
                redirect(url_index().'leave/add/?status=7-0');
            }
        }

        #file
        if(isset($_FILES['med_cer']) && !$_FILES['med_cer']['error']){
            $set['data']['file'] = '';
            $set['data']['file_type'] = '';
            $set['data']['file_name'] = $_FILES['med_cer']['name'];
            $set['data']['file_type'] = $_FILES['med_cer']['type'];
            $data = file_get_contents($_FILES['med_cer']['tmp_name']);
            $set['data']['file'] = 'data:'.$set['data']['file_type'].';base64,' . base64_encode($data);
        }
        if(isset($_FILES['marr_cer']) && !$_FILES['marr_cer']['error']){
            $set['data']['file'] = '';
            $set['data']['file_type'] = '';
            $set['data']['file_name'] = $_FILES['marr_cer']['name'];
            $set['data']['file_type'] = $_FILES['marr_cer']['type'];
            $data = file_get_contents($_FILES['marr_cer']['tmp_name']);
            $set['data']['file'] = 'data:'.$set['data']['file_type'].';base64,' . base64_encode($data);
        }
        if(isset($_FILES['birth_cer']) && !$_FILES['birth_cer']['error']){
            $set['data']['file_2'] = '';
            $set['data']['file_type_2'] = '';
            $set['data']['file_name_2'] = $_FILES['birth_cer']['name'];
            $set['data']['file_type_2'] = $_FILES['birth_cer']['type'];
            $data = file_get_contents($_FILES['birth_cer']['tmp_name']);
            $set['data']['file_2'] = 'data:'.$set['data']['file_type'].';base64,' . base64_encode($data);
        }

        #last Leave
        $this->load->model(['Leave_model']);
        $last_leave = $this->Leave_model->last_leave(['leave_id'=>0,'leave_type'=>intval($post['leave_type_id']),'personnel_id'=>$api['personnel']]);
        $last_leave = count($last_leave)>0?end($last_leave):[];
        $set['data']['last_leave_id'] = isset($last_leave['leave_id'])?$last_leave['leave_id']:0;

        #insert
        $result = $this->Leave_model->save_leave($set['data'],(isset($post['edit_leave_id']) && intval($post['edit_leave_id'])!=0?intval($post['edit_leave_id']):0));

        $this->load->model(['leave/Leave_approve_model']);
        $con = [];
        for($i=2;$i<=6;$i++){
            if(isset($post['personnel_id_'.$i]) && intval($post['personnel_id_'.$i])!=0 && isset($post['position_personnel_'.$i]) && trim($post['position_personnel_'.$i])!=''){
                $con['data']['personnel_id_'.$i]        = $post['personnel_id_'.$i];
                $con['data']['position_personnel_'.$i]  = $post['position_personnel_'.$i];
            }
        }
        $con['data']['last_update']         = date('Y-m-d H:i:s');
        $con['where'] = 'personnel_id = "'.$set['data']['personnel_id'].'"';
        $this->Leave_approve_model->to_update($con);

        if(intval($result)!=0 && !isset($post['edit_leave_id'])){
            
            $this->load->model(['Leave_quota_model']);
            if((intval($post['leave_type_id'])==1 or intval($post['leave_type_id'])==7) and !isset($post['edit_leave_id'])){
                $this->Leave_quota_model->save_quota(['personnel_id'=>$api['personnel'],'leave_id'=>intval($result),'quota_use'=>floatval($post['period_count'])]);
            }

            redirect(url_index().'leave/view/'.intval($result));
        }elseif(intval($result)!=0 && isset($post['edit_leave_id'])){
            redirect(url_index().'leave/view/'.intval($post['edit_leave_id']));
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
            $set['personnel']['subdepartment_name'] = substr($sql_personnel['data'][0]['subdepart'],7);
            $set['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];
            $set['personnel']['img']           = $personnel['data'][0]['img'];
            $set['personnel']['data']          = $personnel['data'][0];
            $set['personnel']['signature']     = $personnel['data'][0]['signature'];


            $set['leave_type'] = $this->Leave_type_model->get_type();

            $con = [];
            $con[] = $set['data']['personnel_id_1'];
            $con[] = $set['data']['personnel_id_2'];
            $con[] = $set['data']['personnel_id_3'];
            $con[] = $set['data']['personnel_id_4'];
            $con[] = $set['data']['personnel_id_5'];
            $con[] = $set['data']['personnel_id_6'];
            $con[] = $set['data']['hr_personnel_id'];
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
			if(intval($set['data']['leave_type_id'])==1 or intval($set['data']['leave_type_id'])==7 || intval($set['data']['leave_type_id'])==2 || intval($set['data']['leave_type_id'])==10){
                $this->load->model('leave/Leave_model');
                $this->load->model('leave/Leave_quota_model');

                $set['leave_quota'] = $this->Leave_quota_model->get_last_quote(['personnel_id'=>$personnel['data'][0]['personnel_id'],'leave_id'=>$set['leave_id']]);

                $last = $this->Leave_model->last_leave(['last_leave_id'=>$set['data']['last_leave_id']]);
                if(count($last)>0){
                    $set['last_leave'] = $last[0];

                    $set['last_leave']['leave_type_name'] = $set['leave_type'][$set['last_leave']['leave_type_id']]['leave_name'];
                }
                

                $result = $this->Leave_model->last_leave(['leave_id'=>$set['leave_id'],'leave_type'=>$set['data']['leave_type_id']]);

                $set['old_leave_count'] = 0;
                if(count($result)>0){
                    foreach($result as $key=>$val){
                        $set['old_leave_count']+= $val['period_count'];
                    }
                }
            }

            $this->load->model('leave/Leave_spec_model');
            $con = [];
            $con['leave_type_id']   = $set['data']['leave_type_id'];
            $con['emp_type_id']     = $set['personnel']['data']['emp_type_id'];
            $spec = $this->Leave_spec_model->spec($con);

            $set['approve_leave_type'] = isset($spec[0]['approve_type'])?$spec[0]['approve_type']:0;
            if($set['approve_leave_type'] == 0 && $set['data']['to']==1){
                $set['approve_leave_type'] = 2;
            }elseif($set['approve_leave_type'] == 0 && $set['data']['to']==2){
                $set['approve_leave_type'] = 1;
            }

            $approve_list = $this->approve_list($set['personnel']['data']['personnel_id']);
            foreach($approve_list as $key=>$val){
                $set['approve_list'][($val+1)] = $val;
            }
            
            //echo '<pre>';print_r($set);exit;

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

        if($type=='php'){
            return $this->Calendar_model->to_select($con);
        }else{
            echo ($type=='js'?'var date_fix = ':'').json_encode($this->Calendar_model->to_select($con));
        }

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
            // if($personnel['personnel_id']!=$set['personnel_id']){
            //     redirect(base_url(url_index().'leave'));
            // }

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

        if(isset($post['personnel_id']) and isset($post['signature']) and intval($post['personnel_id'])!=0 ){
            $this->load->model('personnel/Personnel_model');
            $this->Personnel_model->save_signature_personnel($post);
        }

        if(isset($post['res']) and $post['res']){
            echo json_encode(['status'=>true]);exit;
        }else{
            redirect(base_url(url_index().'leave?signature=ds1df4d51s8af4dsa1'));
        }
        
    }

    function approve($signature='',$type=''){ //dest to this $type='n29gknk626e3gh';

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

            if($result['data']['url_personnel_1'] == $url_signature){
                $set['signature_type'] = 1;
                $set['personnel_id'] = $result['data']['personnel_id_1'];
                $set['approve_status'] = $result['data']['approve_personnel_1']==0?false:true;
            }elseif($result['data']['url_personnel_2'] == $url_signature){
                $set['signature_type'] = 2;
                $set['personnel_id'] = $result['data']['personnel_id_2'];
                $set['approve_status'] = $result['data']['approve_personnel_2']==0?false:true;
            }elseif($result['data']['url_personnel_3'] == $url_signature){
                $set['signature_type'] = 3;
                $set['personnel_id'] = $result['data']['personnel_id_3'];
                $set['approve_status'] = $result['data']['approve_personnel_3']==0?false:true;
            }elseif($result['data']['url_personnel_4'] == $url_signature){
                $set['signature_type'] = 4;
                $set['personnel_id'] = $result['data']['personnel_id_4'];
                $set['approve_status'] = $result['data']['approve_personnel_4']==0?false:true;
            }elseif($result['data']['url_personnel_5'] == $url_signature){
                $set['signature_type'] = 5;
                $set['personnel_id'] = $result['data']['personnel_id_5'];
                $set['approve_status'] = $result['data']['approve_personnel_5']==0?false:true;
            }elseif($result['data']['url_personnel_6'] == $url_signature){
                $set['signature_type'] = 6;
                $set['personnel_id'] = $result['data']['personnel_id_6'];
                $set['approve_status'] = $result['data']['approve_personnel_6']==0?false:true;
            }

            $set['signature_url'] = $this->Personnel_model->url_qr_personnel($set['personnel_id']);

            $leave_id = $set['leave_id'] = $result['data']['leave_id'];
            
            $personnel = $this->session_data['personnel'];


            if(isset($_GET['complete'])){

            }elseif($personnel['personnel_id']!=$set['personnel_id']){ //sanan
                redirect(base_url(url_index().'leave'));
            }

            $api = [];
            $api['APP-KEY']     = $this->api_key;
            $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
            $api['ip']          = get_client_ip();
            $api['leave_id'] = intval($leave_id);
            $result = $this->restclient->post(base_url(url_index().'leave/api_v1/view_leave'),$api);
            $set['data'] = $result['data'];
            
            //$set['personnel'] = $this->session_data['personnel'];
            $personnel = $this->Personnel_model->get_personnel(['personnel_id'=>trim($set['data']['personnel_id'])]);
            $set['personnel']                  = $personnel['data'][0];
            $set['personnel']['img']           = $personnel['data'][0]['img'];
            $set['personnel']['data']          = $personnel['data'][0];
            $sql_personnel = $this->Sql_personnel_model->get_personnel(['username'=>trim($set['personnel']['internet_account'])]);
            $set['personnel']['position_name'] = $sql_personnel['data'][0]['positionname'];
            $set['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];
            $set['personnel']['department_name'] = substr($sql_personnel['data'][0]['departname'],7);
            
            $set['leave_type'] = $this->Leave_type_model->get_type();

            $con = [];
            $con[] = $set['data']['personnel_id_1'];
            $con[] = $set['data']['personnel_id_2'];
            $con[] = $set['data']['personnel_id_3'];
            $con[] = $set['data']['personnel_id_4'];
            $con[] = $set['data']['personnel_id_5'];
            $con[] = $set['data']['personnel_id_6'];
            $set['personnel_list'] = $this->Personnel_model->get_personnel(['personnel_list'=>$con,'array_key'=>true]);

            if(intval($set['data']['leave_type_id'])>=2 and intval($set['data']['leave_type_id'])<=4){
                $this->load->model('leave/Leave_model');

                //echo '<pre>';print_r(['test'=>'1']);exit;

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

                $set['leave_quota'] = $this->Leave_quota_model->get_last_quote(['personnel_id'=>$set['personnel']['personnel_id'],'leave_id'=>$set['leave_id']]);

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

            $set['cancel_approve'] = $type=='n29gknk626e3gh'?true:false;

            $api = [];
            $api['APP-KEY']     = $this->api_key;
            $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
            $api['ip']          = get_client_ip();
            $set['api'] = $api;

            $approve_list = $this->approve_list($set['data']['personnel_id']);

            foreach($approve_list as $key=>$val){
                $set['approve_list'][($val+1)] = $val;
            }

            $set['own_session'] = $this->session_data['personnel'];

            $this->load->view('approve',$set);

        }else{
            redirect(base_url(url_index().'leave'));
        }

    }

    function save_approve(){
        $post = $this->input->post();

        //echo '<pre>';print_r($post);exit;

        if(count($post)>=4 and isset($post['personnel_id']) and isset($post['type']) and isset($post['leave_id']) and isset($post['approve']) and intval($post['personnel_id'])!=0 and intval($post['leave_id'])!=0 and intval($post['type'])!=0 and (intval($post['approve']) == 1 or intval($post['approve'])==2)){
            $this->load->model('leave/Leave_model');
            
            $result = $this->Leave_model->save_approve($post);

            if(isset($post['cancel']) and trim($post['cancel'])=='n29gknk626e3gh'){
                if(intval($post['type'])==5 and intval($post['approve']) == 1){
                    $this->load->model('leave/Leave_quota_model');
                    $this->Leave_quota_model->cancel_quota(['leave_id'=>intval($post['leave_id']),'personnel_id'=>intval($post['personnel_id'])]);
                }
            }else{
                if(intval($post['type'])==5 and intval($post['approve']) == 1 and !isset($post['next_approve'])){// leave status 2
                    $this->Leave_model->leave_status(['leave_id'=>intval($post['leave_id']),'type'=>2]);
                    $this->send_complete(['leave'=>intval($post['leave_id'])]);

                }elseif(intval($post['type'])==6 and intval($post['approve']) == 1){// leave status 2
                    $this->Leave_model->leave_status(['leave_id'=>intval($post['leave_id']),'type'=>2]);
                }elseif(intval($post['approve']) == 2){// leave status 3
                    $this->load->model('leave/Leave_quota_model');
                    $test = $this->Leave_model->leave_status(['leave_id'=>intval($post['leave_id']),'type'=>3]);
                    $this->Leave_quota_model->cancel_quota(['leave_id'=>intval($post['leave_id']),'personnel_id'=>intval($post['personnel_id'])]);
                }
            }
        }

        if(($result and intval($post['approve']) == 1 and intval($post['type'])!=5 and !isset($post['cancel'])) || isset($post['next_approve'])){
            $this->send_approve(['leave'=>intval($post['leave_id']),'cancel'=>(isset($post['cancel']) and trim($post['cancel'])=='n29gknk626e3gh'?true:false)]);
        }

        redirect(base_url(url_index().'leave?approve=ds1df4d51s8af4dsa1'));
    }

    function send_approve($set=[]){
        $post = $this->input->post();

        $this->load->model('personnel/Personnel_model');
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

            $max_approve = 5;
            if(intval($result['data']['personnel_id_6'])!=0){
                $max_approve = 6;
            }

            $ex_personnel_id = 0;
            $type = '';

            if(isset($result['data']) and count($result['data']>0)){

                $approve_list = $this->approve_list($result['data']['personnel_id']);

                if(isset($post['cancel']) and $post['cancel']){
                    $ex_personnel_id = 0;
                    $ex_personnel = [];

                    if(count($approve_list)>0){
                        foreach($approve_list as $key=>$val){
                            if(intval($result['data']['personnel_id_'.($val+1)]) != 0 and intval($result['data']['approve_personnel_'.($val+1)]) == 1 and $ex_personnel_id == 0){
                                $ex_personnel[($val+1)] = intval($result['data']['personnel_id_'.($val+1)]);
                            }else{
                                break;
                            }
                        }
                    }else{
                        for($i=2;$i<=$max_approve;$i++){
                            if(intval($result['data']['personnel_id_'.$i]) != 0 and intval($result['data']['approve_personnel_'.$i]) == 1 and $ex_personnel_id == 0){
                                $ex_personnel[$i] = intval($result['data']['personnel_id_'.$i]);
                            }else{
                                break;
                            }
                        }
                    }

                }else{
                    if($result['data']['leave_type_id']==4 or $result['data']['leave_type_id']==5){
                        $approve_list[] = 5;
                    }
                    if(count($approve_list)>0){
                        foreach($approve_list as $key=>$val){
                            if(intval($result['data']['personnel_id_'.($val+1)]) != 0 and intval($result['data']['approve_personnel_'.($val+1)]) == 0 and $ex_personnel_id == 0){
                                $ex_personnel_id = intval($result['data']['personnel_id_'.($val+1)]);
                                $type = ($val+1);
                                break;
                            }
                        }
                        
                    }else{
                        for($i=1;$i<=$max_approve;$i++){
                            if(intval($result['data']['personnel_id_'.$i]) != 0 and intval($result['data']['approve_personnel_'.$i]) == 0 and $ex_personnel_id == 0){
                                $ex_personnel_id = intval($result['data']['personnel_id_'.$i]);
                                $type = $i;
                                break;
                            }
                        }
                    }
                }

                if($ex_personnel_id>0){

                    $this->load->model('sql_personnel/Sql_personnel_model');
                    
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
                    $subject = '[ระบบลา] พิจารณาการลา เลขที่ '.$set['leave_data']['leave_no'];

                    if(isset($set['personnel_receive']['data'][0]['email']) and trim($set['personnel_receive']['data'][0]['email'])!=''){

                        $api['subject']     = $subject;
                        $api['body']        = $html;
                        //$api['to']          = 'ela.somniyam@gmail.com';
                        //$api['to']          = 'blackbullet.social@gmail.com';//$set['personnel_receive']['data'][0]['email']; //sanan
                        $api['to']          = $set['personnel_receive']['data'][0]['email'];//$set['personnel_receive']['data'][0]['email']; //sanan
                        $send = $this->restclient->post(base_url(url_index().'email/api_v1/send'),$api);

                        if($send['status']){
                            $this->Leave_model->send_approve(intval($post['leave']),isset($post['cancel']) and $post['cancel']?true:false);
                        }
                    }
                    
                    $res['status'] = $send['status'];
                    
                    if($res_type){
                        return true;
                    }else{
                        echo json_encode($res);exit;
                    }

                }elseif($ex_personnel_id==0){

                    $this->load->model('sql_personnel/Sql_personnel_model');
                    
                    $this->load->model('leave/Leave_type_model');
                    $this->load->model('leave/Leave_model');

                    $personnel_list = $this->Personnel_model->get_personnel(['personnel_list'=>$ex_personnel,'array_key'=>true]);

                    $email = [];
                    if($personnel_list['count']>0){
                        foreach($personnel_list['data'] as $key=>$val){
                            $email[] = $val['email'];
                        }
                    }

                    // echo '<pre>';print_r($ex_personnel);exit;

                    // $test['status'] = false;
                    // $test['ex_personnel_id'] = $ex_personnel_id;
                    // $test['ex_personnel'] = $personnel_list;
                    // echo json_encode($test);exit;

                    $set['personnel'] = $this->session_data['personnel'];
                    $personnel = $this->Personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
                    $sql_personnel = $this->Sql_personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
                    $set['personnel']['position_name'] = $sql_personnel['data'][0]['positionname'];
                    $set['personnel']['department_name'] = substr($sql_personnel['data'][0]['departname'],7);
                    $set['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];
                    $set['personnel']['data']          = $personnel['data'][0];

                    foreach($ex_personnel as $key=>$val){

                        $set['personnel_receive']['data'][0] = $personnel_list['data'][$val];

                        $set['leave_type'] = $this->Leave_type_model->get_type();

                        $set['leave_data'] = $result['data'];

                        $set['url_type'] = $key;


                        $html = $this->load->view('email/cancel',$set,true);
                        $subject = '[ระบบลา] พิจารณายกเลิกวันลา เลขที่ '.$set['leave_data']['leave_no'];

                        $api['subject']     = $subject;
                        $api['body']        = $html;
                        //$api['to']          = 'ela.somniyam@gmail.com';
                        //$api['to']          = 'blackbullet.social@gmail.com';//$set['personnel_receive']['data'][0]['email']; //sanan
                        $api['to']          = $set['personnel_receive']['data'][0]['email'];//$set['personnel_receive']['data'][0]['email']; //sanan
                        $send = $this->restclient->post(base_url(url_index().'email/api_v1/send'),$api);
                    }

                    if($send['status']){
                        $this->Leave_model->send_approve(intval($post['leave']),isset($post['cancel']) and $post['cancel']?true:false);
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

    function send_complete($set=[]){
        $this->load->model('leave/Leave_model');
        

        $con=[];
        $con['where'] = 'leave_id = "'.intval($set['leave']).'"';
        $result = $this->Leave_model->to_select($con);
        
        $to_list = [];
        if(count($result)>0){
            for($i=2;$i<=4;$i++){
                if(isset($result[0]['personnel_id_'.$i]) and intval($result[0]['personnel_id_'.$i])!=0){

                    $con=[];
                    $con['where'] = 'personnel_id = "'.intval($result[0]['personnel_id_'.$i]).'"';
                    $personnel = $this->Personnel_model->to_select($con);

                    if(isset($personnel[0])){
                        $to_list[intval($result[0]['personnel_id_'.$i])] = $personnel[0];
                    }

                }
            }
        }

        if(count($to_list)>0){

            $this->load->model('personnel/Personnel_model');
            $this->load->model('sql_personnel/Sql_personnel_model');
            $this->load->model('leave/Leave_type_model');

            $set_mail = [];
            $set_mail['personnel'] = $this->session_data['personnel'];
            $personnel = $this->Personnel_model->get_personnel(['username'=>trim($set_mail['personnel']['username'])]);
            $sql_personnel = $this->Sql_personnel_model->get_personnel(['username'=>trim($set_mail['personnel']['username'])]);
            $set_mail['personnel']['position_name'] = $sql_personnel['data'][0]['positionname'];
            $set_mail['personnel']['department_name'] = substr($sql_personnel['data'][0]['departname'],7);
            $set_mail['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];
            $set_mail['personnel']['data']          = $personnel['data'][0];

            $set_mail['leave_type'] = $this->Leave_type_model->get_type();

            $set_mail['leave_data'] = $result[0];

            $api = [];
            $api['APP-KEY']     = $this->api_key;
            $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
            $api['ip']          = get_client_ip();
            $api['bcc']         = 'sananr@nu.ac.th';
            $api['to']          = '';
            $api['subject']     = '[ระบบลา] แจ้งผลพิจารณาการลา เลขที่ '.$result[0]['leave_no'];
            $api['body']        = $this->load->view('email/complete',$set_mail,true);

            

            $count = 0;
            foreach($to_list as $key=>$val){
                if(trim($val['email'])!=''){
                    if(trim($api['bcc'])!=''){
                        $api['bcc'] .= ',blackbullet.social@gmail.com';
                        //$api['bcc'] .= ','.$val['email'];
                    }else{
                        $api['bcc'] .= 'blackbullet.social@gmail.com';
                        //$api['bcc'] .= $val['email'];
                    }

                    $api['to'] = $val['email'];

                    $count++;
                }
            }
        }

        if($count>0){
            $send = $this->restclient->post(base_url(url_index().'email/api_v1/send'),$api);
        }
        //echo $api['body'];exit;

        return false;
    }

    function print(){
        $post = $this->input->post();
        $res= ['status'=>false,'token'=>''];

        if(isset($post['leave']) and intval($post['leave'])!=0){
            
            $this->load->model(['Leave_print_model','Leave_model']);
            $personnel = $this->session_data['personnel'];
            $leave = $this->Leave_model->view_leave(['leave_id'=>intval($post['leave'])]);

            if($leave['data']['to'] == 2){
                $con = [];
                $con['data']['status'] = 1;
                $con['data']['send_mail_date'] = date('Y-m-d H:i:s');
                $con['where'] = 'leave_id = '.intval($post['leave']);
                $this->Leave_model->to_update($con);
            }

            $result = $this->Leave_print_model->gen_token(['leave_id'=>intval($post['leave']),'personnel'=>$personnel,'leave'=>$leave]);

            echo json_encode(['status'=>true,'data'=>$result]);exit;

        }

        echo json_encode(['status'=>false]);exit;
    }

    function cancel_leave($type=''){
        $post = $this->input->post();

        if(isset($post['type']) and isset($post['leave']) and intval($post['leave'])!=0){
            $this->load->model([
                'Leave_model',
                'Leave_quota_model'
            ]);

            $type = 0;
            if($post['type']=='a'){
                $type = 98;
            }elseif($post['type']=='b'){
                $type = 99;
            }

            $detail = isset($post['detail'])?$post['detail']:'';

            $result = $this->Leave_model->cancel($post['leave'],$type,$detail);
            if($post['type']=='b'){
                $this->Leave_quota_model->cancel_quota(['leave_id'=>intval($post['leave']),'personnel_id'=> -1]);
            }elseif($post['type']=='a'){
                $this->send_approve(['leave'=>intval($post['leave']),'cancel'=>true]);
            }

            if($post['type']=='a'){
                redirect(url_index().'leave/view/'.intval($post['leave']).'?status=cancel_complete');// to view
            }elseif($post['type']=='b'){
                echo json_encode(['status'=>true]);exit;
            }



            
        }
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

    function list_hr(){
        $set = [];

        $set['personnel'] = $this->session_data['personnel'];
        $this->load->model('personnel/Personnel_model');
        $this->load->model('personnel/Smu_model');
        $this->load->model('leave/Leave_model');
        $this->load->model('leave/Leave_type_model');
        $this->load->model('leave/Leave_quota_model');

        $personnel = $this->Personnel_model->get_personnel(['username'=>trim($set['personnel']['username'])]);
        $set['personnel']['signature_url'] = isset($personnel['data'][0]['signature']) && trim($personnel['data'][0]['signature'])==''?$this->Personnel_model->url_qr_personnel($set['personnel']['personnel_id']):'';

        $set['personnel_list'] = $this->Personnel_model->get_personnel(['all'=>true,'array_key'=>true])['data'];
        $set['main_smu'] = $this->Smu_model->get_main_smu();

        $api = [];
        $api['APP-KEY']     = $this->api_key;
        $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
        $api['ip']          = get_client_ip();
        $api['hr']          = true;
        $api['leave_year']  = date('Y');
        $api['leave_year_b']  = true;
        $result = $this->restclient->post(base_url(url_index().'leave/api_v1/leave_history'),$api);

        $set['leave_history']['data'] = $result['data'];
        $set['leave_history']['count'] = $result['count'];
        $set['leave_history']['count_new'] = 0;
        $set['leave_history']['count_complete'] = 0;
        $set['leave_history']['count_unapprove'] = 0;
        $set['leave_history']['count_cancel_b'] = 0;
        $set['leave_history']['count_cancel_a'] = 0;
        $set['leave_history']['count_cancel_a_c'] = 0;
        if(count($set['leave_history']['data'])>0){
            foreach($set['leave_history']['data'] as $key=>$val){
                if($val['status']<98 and $val['status']!=2 and $val['status']!=3){
                    $set['leave_history']['count_new']++;
                }
                if($val['status']==2){
                    $set['leave_history']['count_complete']++;
                }
                if($val['status']==3){
                    $set['leave_history']['count_unapprove']++;
                }
                if($val['status']==99){
                    $set['leave_history']['count_cancel_b']++;
                }
                if($val['status']==98){
                    $set['leave_history']['count_cancel_a']++;
                }
                if($val['status']==98 and $val['deputy_dean_approve_cancel']==1){
                    $set['leave_history']['count_cancel_a_c']++;
                }
            }
        }

        $set['leave_type'] = $this->Leave_type_model->get_type($personnel['data'][0]['personnel_id']);
        $set['leave_quota'] = $this->Leave_quota_model->get_last_quote(['personnel_id'=>$personnel['data'][0]['personnel_id']]);

        //echo '<pre>';print_r($set['leave_history']);exit;

        $this->load->view('list_hr',$set);
    }

    function view_hr($leave_id = 0){

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
            
            //$set['personnel'] = $this->session_data['personnel'];
            $personnel = $this->Personnel_model->get_personnel(['personnel_id'=>trim($set['data']['personnel_id'])]);
            $sql_personnel = $this->Sql_personnel_model->get_personnel(['username'=>trim($personnel['data'][0]['internet_account'])]);
            $set['personnel']                   = $personnel['data'][0];
            $set['personnel']['position_name']  = $sql_personnel['data'][0]['positionname'];
            $set['personnel']['department_name'] = substr($sql_personnel['data'][0]['departname'],7);
            $set['personnel']['emp_type_name']  = $sql_personnel['data'][0]['pgroupname'];
            $set['personnel']['img']            = $personnel['data'][0]['img'];
            $set['personnel']['data']           = $personnel['data'][0];

            //echo '<pre>';print_r($set['personnel']);exit;

            $set['leave_type'] = $this->Leave_type_model->get_type();

            $con = [];
            $con[] = $set['data']['personnel_id_1'];
            $con[] = $set['data']['personnel_id_2'];
            $con[] = $set['data']['personnel_id_3'];
            $con[] = $set['data']['personnel_id_4'];
            $con[] = $set['data']['personnel_id_5'];
            $con[] = $set['data']['personnel_id_6'];
            $con[] = $set['data']['hr_personnel_id'];
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

            $approve_list = $this->approve_list($set['data']['personnel_id']);
            foreach($approve_list as $key=>$val){
                $set['approve_list'][($val+1)] = $val;
            }

            //echo '<pre>';print_r($set);exit;

            $this->load->view('view_leave_hr',$set);
            
        }else{
            redirect(url_index().'leave');
        }
    }

    function approve_hr(){
        $post = $this->input->post();

        $res = ['status'=>false];

        if(isset($post['leave']) and intval($post['leave'])!=0 and isset($post['hr']) and intval($post['hr'])!=0){
            $this->load->model([
                'leave/Leave_model',
                'leave/Leave_quota_model'
            ]);
            if(isset($post['type']) and intval($post['type'])==1){
                $test = $this->Leave_model->approve_hr(['leave'=>intval($post['leave']),'type'=>1,'hr'=>intval($post['hr'])]);
                $res['status'] = true;
                echo json_encode($res);exit;
            }elseif(isset($post['type']) and intval($post['type'])==2){
                $this->Leave_model->approve_hr(['leave'=>intval($post['leave']),'type'=>2,'hr'=>intval($post['hr'])]);
                $this->Leave_quota_model->cancel_quota(['leave_id'=>intval($post['leave']),'personnel_id'=> intval($post['hr'])]);
                $res['status'] = true;
                echo json_encode($res);exit;
            }else{
                echo json_encode($res);exit;
            }
        }
        echo json_encode($res);exit;
    }

    function report_smu_hr(){
        $post = $this->input->post();

        $res = [];
        $res['personnel'] = $this->session_data['personnel'];
        $this->load->model([
            'sql_personnel/Sql_personnel_model',
            'personnel/Personnel_model',
            'personnel/Smu_model',
            'leave/Leave_model'
        ]);
        $res['sql_personnel'] = $this->Sql_personnel_model->get_personnel(['all'=>true,'select'=>'empcode,positionname,departname']);
        $res['personnel_all'] = $this->Personnel_model->get_personnel(['all'=>true]);
        $res['main_smu'] = $this->Smu_model->get_main_smu();
        unset($res['main_smu'][0]);
        $weekend = $this->get_weekend('php');

        $set=[];
        $set['hr']          = true;
        $set['status']      = 2;
        $set['leave_year']  = isset($post['year'])?$post['year']:date('Y');

        if(isset($post['month']) and intval($post['month'])!=0){
            $set['start_date']  = date($set['leave_year'].'-'.$post['month'].'-01');
            $set['end_date']    = date('Y-m-t',strtotime($set['start_date']));
        }

        $result = $this->Leave_model->leave_history($set);

        $leave = [];
        if($result['count']>0){
            foreach($result['data'] as $key => $val){

                if(isset($leave[$val['personnel_id']][$val['leave_type_id']])){

                    $day_count = $val['period_count'];
                    $leave[$val['personnel_id']][$val['leave_type_id']] += $day_count;

                }else{

                    $day_count = $val['period_count'];

                    if(isset($set['start_date']) and isset($set['end_date']) and date('Y-m',strtotime($set['end_date'])) != date('Y-m',strtotime($val['period_end'])) and date('Y-m',strtotime($set['start_date'])) != date('Y-m',strtotime($val['period_start'])) and $val['period_end']!=''){
                        $day_count = 0;
                        for($i=0;$i<$val['period_count_all'];$i++){
                            $day = date('Y-m-d',strtotime($val['period_start'].' +'.$i.' day'));
                            if(date('Y-m',strtotime($day)) >= date('Y-m',strtotime($set['start_date'])) and date('Y-m',strtotime($day)) <= date('Y-m',strtotime($set['end_date']))){
                                if(!isset($weekend[$day])){
                                    $day_count++;
                                }
                            }
                        }
                    }elseif(isset($set['start_date']) and isset($set['end_date']) and date('Y-m',strtotime($set['end_date'])) != date('Y-m',strtotime($val['period_end'])) and $val['period_end']!=''){ //วันสิ้นสุดวันลาไม่ต้องกลับช่วงวันที่เลือก
                        $day_count = 0;
                        
                        for($i=0;$i<$val['period_count_all'];$i++){
                            $day = date('Y-m-d',strtotime($val['period_start'].' +'.$i.' day'));
                            if(date('Y-m',strtotime($set['start_date'])) != date('Y-m',strtotime($day))){
                                break;
                            }elseif(!isset($weekend[$day])){
                                $day_count++;
                            }
                        }
                    }elseif(isset($set['start_date']) and isset($set['end_date']) and date('Y-m',strtotime($set['start_date'])) != date('Y-m',strtotime($val['period_start'])) and $val['period_end']!=''){ //วันเริ่มวันลาไม่ต้องกลับช่วงวันที่เลือก
                        $day_count = 0;
                        for($i=0;$i<$val['period_count_all'];$i++){
                            $day = date('Y-m-d',strtotime($val['period_end'].' -'.$i.' day'));
                            if(date('Y-m',strtotime($set['end_date'])) != date('Y-m',strtotime($day))){
                                break;
                            }elseif(!isset($weekend[$day])){
                                $day_count++;
                            }
                        }
                    }

                    $leave[$val['personnel_id']][$val['leave_type_id']] = $day_count;

                }
            }
        }

        $res['leave'] = $leave;

        $res['smu_personnel'] = [];
        foreach($res['personnel_all']['data'] as $key=>$val){
            $res['smu_personnel'][$val['smu_main_id']][$val['personnel_code']] = $val;
        }
        //echo '<pre>';print_r($res['smu_personnel']);exit;


        $this->load->view('report_smu_hr',$res);
    }

    function update_email_personnel(){
        $post = $this->input->post();
        if(isset($post['email']) and trim($post['email'])!=''){
            $this->load->model('personnel/Personnel_model');

            $this->Personnel_model->update_email(['email'=>trim($post['email']), 'personnel_id'=>intval($post['personnel_id'])]);

            echo json_encode(['status'=>true]);
        }else{
            echo json_encode(['status'=>false]);
        }
        
    }

    function list_approve(){
        $this->load->model('leave/Leave_model');
        $this->load->model('personnel/Personnel_model');
        $set['personnel'] = $this->session_data['personnel'];
        $set['leave_history']['data'] = $this->Leave_model->list_approve(['personnel_id'=>$set['personnel']['personnel_id']]);

        $personnel = $this->Personnel_model->get_personnel(['personnel_id'=>$set['personnel']['personnel_id']]);
        $set['personnel']['signature']     = $personnel['data'][0]['signature'];
        $set['personnel']['signature_url'] = trim($set['personnel']['signature'])==''?$this->Personnel_model->url_qr_personnel($set['personnel']['personnel_id']):'';

        if(count($set['leave_history']['data'])>0){
            $con = [];
            $target_emp = 0;
            foreach($set['leave_history']['data'] as $key=>$val){
                $target_emp = $val['personnel_id'];
            }


            $api = [];
            $api['APP-KEY']     = $this->api_key;
            $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
            $api['ip']          = get_client_ip();
            $set['api'] = $api;

            $approve_list = $this->approve_list($target_emp);

            foreach($approve_list as $key=>$val){
                $set['approve_list'][($val+1)] = $val;
            }

            //echo '<pre>';print_r($set['approve_list']);exit;

            foreach($set['leave_history']['data'] as $key=>$val){
                $con[$val['personnel_id']] = $val['personnel_id'];


                //echo '<pre>';print_r($val);exit;
                /*if($val['personnel_id_1'] == $set['personnel']['personnel_id']){
                    $set['leave_history']['data'][$key]['approve_data'] = $val['url_personnel_1'];
                }else*/
                
                if($val['personnel_id_2'] == $set['personnel']['personnel_id'] and isset($set['approve_list'][2]) and $val['approve_personnel_2']==0){
                    $set['leave_history']['data'][$key]['approve_data'] = $val['url_personnel_2'];
                }elseif($val['personnel_id_3'] == $set['personnel']['personnel_id'] and isset($set['approve_list'][3]) and $val['approve_personnel_3']==0){
                    $set['leave_history']['data'][$key]['approve_data'] = $val['url_personnel_3'];
                }elseif($val['personnel_id_4'] == $set['personnel']['personnel_id'] and isset($set['approve_list'][4]) and $val['approve_personnel_4']==0){
                    $set['leave_history']['data'][$key]['approve_data'] = $val['url_personnel_4'];
                }elseif($val['personnel_id_5'] == $set['personnel']['personnel_id'] and isset($set['approve_list'][5]) and $val['approve_personnel_5']==0){
                    $set['leave_history']['data'][$key]['approve_data'] = $val['url_personnel_5'];
                }elseif($val['personnel_id_6'] == $set['personnel']['personnel_id'] and isset($set['approve_list'][6]) and $val['approve_personnel_6']==0){
                    $set['leave_history']['data'][$key]['approve_data'] = $val['url_personnel_6'];
                }
            }

            $personnel_list = $this->Personnel_model->get_personnel(['personnel_list'=>$con,'array_key'=>true]);
            $set['personnel_list'] = $personnel_list['data'];
        }

        $this->load->model('leave/Leave_type_model');
        $set['leave_type'] = $this->Leave_type_model->get_type();

        $this->load->model('personnel/Smu_model');
        $set['main_smu'] = $this->Smu_model->get_main_smu();
        
        $this->load->view('list_approve',$set);

    }

    function assign_approve(){
        $post = $this->input->post();

        $this->load->model(['Leave_model']);
        $leave_id = $post['leave_id'];
        unset($post['leave_id']);
        $result = $this->Leave_model->save_leave($post,$leave_id);

        if($result){

            $this->load->model('sql_personnel/Sql_personnel_model');
            $this->load->model('personnel/Personnel_model');
            $this->load->model('leave/Leave_type_model');

            $leave_data = $this->Leave_model->view_leave(['leave_id'=>intval($leave_id)]);

            $set['personnel_receive'] = $this->Personnel_model->get_personnel(['personnel_id'=>$post['personnel_id_5']]);

            $personnel = $this->Personnel_model->get_personnel(['personnel_id'=>trim($leave_data['data']['personnel_id'])]);
            $set['personnel']                  = $personnel['data'][0];
            $set['personnel']['img']           = $personnel['data'][0]['img'];
            $set['personnel']['data']          = $personnel['data'][0];
            $sql_personnel = $this->Sql_personnel_model->get_personnel(['username'=>trim($set['personnel']['internet_account'])]);
            $set['personnel']['position_name'] = $sql_personnel['data'][0]['positionname'];
            $set['personnel']['emp_type_name'] = $sql_personnel['data'][0]['pgroupname'];

            $set['leave_type'] = $this->Leave_type_model->get_type();

            $set['leave_data'] = $leave_data['data'];

            $set['url_type'] = 5;

            $html = $this->load->view('email/approve',$set,true);
            $subject = '[ระบบลา] พิจารณาการลา เลขที่ '.$set['leave_data']['leave_no'];

            if(isset($set['personnel_receive']['data'][0]['email']) and trim($set['personnel_receive']['data'][0]['email'])!=''){

                $api = [];
                $api['APP-KEY']     = $this->api_key;
                $api['token']       = isset($this->session_data['authentication']['token'])?$this->session_data['authentication']['token']:'';
                $api['ip']          = get_client_ip();

                $api['subject']     = $subject;
                $api['body']        = $html;
                //$api['to']          = 'ela.somniyam@gmail.com';
                //$api['to']          = 'blackbullet.social@gmail.com';//$set['personnel_receive']['data'][0]['email']; //sanan
                $api['to']          = $set['personnel_receive']['data'][0]['email'];//$set['personnel_receive']['data'][0]['email']; //sanan
                $send = $this->restclient->post(base_url(url_index().'email/api_v1/send'),$api);

                redirect(base_url(url_index().'leave?approve=assign_complete'));

            }
        }
    }

    function special_fn(){
        $set['personnel'] = $this->session_data['personnel'];
        $this->load->view('special_fn',$set);
    }

    function ajax_delete_file(){
        $post = $this->input->post();
        $this->load->model(['Leave_model']);
        $this->Leave_model->delete_file($post['leave_id'],$post['type']);
        echo json_encode(['status'=>true]);exit;
    }

    function approve_list($personnel_id=0){
        $this->load->model('leave/Special_fn_model');
        $this->load->model('personnel/Personnel_model');

        $con = [];
        $con['select'] = 'smu_main_id'; 
        $con['where'] = 'personnel_id = "'.intval($personnel_id).'"';
        $smu = $this->Personnel_model->to_select($con);

        $con = [];
        $con['select'] = 'approve_list'; 
        $con['where'] = 'personnel_id = "'.intval($personnel_id).'" and special_type = 1 and status = 1';
        $approve_list = $this->Special_fn_model->to_select($con);
        if(count($approve_list)==0){
            if(isset($smu[0]['smu_main_id']) and intval($smu[0]['smu_main_id'])!=0){
                $con = [];
                $con['select'] = 'approve_list'; 
                $con['where'] = 'smu_main_id = "'.intval($smu[0]['smu_main_id']).'" and special_type = 1 and status = 1';
                $approve_list = $this->Special_fn_model->to_select($con);
            }
        }

        if(count($approve_list)==0){
            if($smu[0]['smu_main_id'][0] == 1 or $smu[0]['smu_main_id'][0] == 5 or $smu[0]['smu_main_id'][0] == 6){
                $approve_list[0]['approve_list'] = '2,4,';
            }elseif($smu[0]['smu_main_id'][0] == 2){
                $approve_list[0]['approve_list'] = '4,';
            }elseif($smu[0]['smu_main_id'][0] == 4){
                $approve_list[0]['approve_list'] = '1,2,4';
            }
        }

        $approve_list = explode(',',$approve_list[0]['approve_list']);
        $approve_list = array_filter($approve_list);

        return $approve_list;
    }

    function list_email_hr(){

        $this->load->model('personnel/Personnel_model');

        $res = [];

        $con = [];
        $con['select'] = 'title,name_th,surname_th,email,phone,tel,internal_tel';
        $con['where'] = '(work_end_date = "0000-00-00" or work_end_date IS NULL)';
        $res['list'] = $this->Personnel_model->to_select($con);
        $con['where'] .= ' and email = ""';
        $res['not_email'] = $this->Personnel_model->to_count($con);

        $this->load->view('list_email_hr',$res);
    }

    function list_approve_hr(){

        $this->load->model('personnel/Personnel_model');
        $this->load->model('personnel/Smu_model');
        $this->load->model('Leave_approve_model');

        $res = [];

        $con = [];
        $con['select'] = 'personnel_id,title,name_th,surname_th,email,phone,tel,internal_tel,smu_main_id,smu_sub_id';
        $con['array_key'] = true;
        $res['personnel'] = $this->Personnel_model->to_select($con);

        $con['where'] = '(work_end_date = "0000-00-00" or work_end_date IS NULL)';
        $res['personnel_list'] = $this->Personnel_model->to_select($con);
        $res['count'] = $this->Personnel_model->to_count($con);

        $con = [];
        $con['array_key'] = 'personnel_id';
        $res['list'] = $this->Leave_approve_model->to_select($con);

        

        $res['smu_sub'] = $this->Smu_model->get_sub_smu();
        $res['smu_main'] = $this->Smu_model->get_main_smu();

        //echo '<pre>';print_r( $res['smu_sub']);exit;



        $this->load->view('list_approve_hr',$res);
    }

    
}
