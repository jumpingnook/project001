<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Auth_Controller {

	function __construct(){
		parent::__construct();
        $this->load->library(['auth_ldap','restclient']);
        $this->load->model('auth/Token_model');
    }
    
    function index(){
        $get = $this->input->get();

        $login = $this->session->userdata('authentication');
        if(isset($login['status']) and $login['status'] and isset($get['dest']) and trim($get['dest'])!=''){
            redirect(url_index().trim($get['dest']).(isset($get['complete'])?'?complete=1':''));
        }/*elseif(isset($login['status']) and $login['status']){
            redirect(url_index().'idp/my_course/');
        }*/

        #generate token_login
        $token = genTOKEN();
        $this->session->set_flashdata('token_login', $token);
        $this->load->view('login',['token_login'=>$token]);

        // status=fail
        if(isset($get['status']) and $get['status']=='fail'){
            
        }
    }

    function login($re_login = []){

        $post = $this->input->post();

        //echo '<pre>';print_r($post);exit;

        $f_data = $this->session->flashdata('re_login');

        if(count($f_data)>0){
            $post = $f_data;
        }

        if(!isset($post['username']) or !isset($post['password']) or !isset($post['token'])){
            redirect(url_index().'auth/?status=error');//not submit
        }
        if(empty($post['username']) or empty($post['password']) or empty($post['token'])){
            redirect(url_index().'auth/?status=validate');//validate input
        }

        if(!isset($post['login_as']) and !isset($post['skip']) and trim($post['token']) != $this->session->flashdata('token_login')){
            redirect(url_index().'auth/?status=valid_token');//validate token_login
        }

		$this->auth_ldap->Set_User(trim($post['username']),trim($post['password']));
        $status_login = $this->auth_ldap->Connect();

        $ip = get_client_ip();
        $token = $this->Token_model->create_token(['internet_account'=>trim($post['username']),'ip'=>$ip]);

        if(isset($post['login_as']) and trim($post['login_as'])!=''){
            $post['username'] = trim($post['login_as']);
        }
        
        $set = [];
        $set['APP-KEY']     = $this->api_key;
        $set['username']    = trim($post['username']);
        $set['token']       = $token;
        $set['ip']          = $ip;
        $personnel = $this->restclient->post(base_url(url_index().'personnel/api_v1/personnel'),$set);
        $personnel_id = isset($personnel['data']) && count($personnel['data'])>0?$personnel['data'][0]['personnel_id']:0;

        if(count($f_data)==0 and !isset($personnel['sql_on'])){
            $post['skip'] = true;
            $this->session->set_flashdata('re_login', $post);
            redirect(url_index().'auth/login');//validate token_login


        }elseif(isset($personnel['status']) and $personnel['status'] and intval($personnel['count'])==0){ #check new tb personnel

            $this->load->model('sql_personnel/Sql_personnel_model');
            $personnel_sql = $this->Sql_personnel_model->get_personnel(['username'=>trim($set['username'])]);

            if(isset($personnel_sql['data']) and count($personnel_sql['data'])==1){
                #transfer new tb personnel
                $set = $personnel_sql['data'][0];
                $set['APP-KEY']     = $this->api_key;
                $set['username']    = trim($post['username']);
                $set['token']       = $token;
                $set['ip']          = $ip;
                if(trim($set['picture'])!=''){
                    $set['picture']     = 'data:image/jpeg;base64,'.base64_encode($set['picture']);
                }else{
                    $set['picture'] = '';
                }
                $result = $this->restclient->post(base_url(url_index().'personnel/api_v1/transfer_personnel'),$set);
                
                if(isset($result['status']) and $result['status']){
                    $personnel_id = isset($result['personnel_id'])?intval($result['personnel_id']):0;
                }else{
                    $this->Token_model->delete_token(['token'=>$token]);
                    redirect(url_index().'auth/?status=db'); //login fail db
                }
            }else{
                redirect(url_index().'auth/?status=fail1'); //login fail
            }
    

        }elseif(intval($personnel_id) != 0 and isset($personnel['status']) and $personnel['status']){
            #update old tb personnel to new tb personnel

            $this->load->model('sql_personnel/Sql_personnel_model');
            $result = $this->Sql_personnel_model->get_personnel(['username'=>trim($post['username'])]);

            $set = $result['data'][0];
            $set['APP-KEY']     = $this->api_key;
            $set['personnel_id']    = intval($personnel_id);
            $set['token']       = $token;
            $set['ip']          = $ip;
            if(trim($set['picture'])!=''){
                $set['picture']     = 'data:image/png;base64,'.base64_encode($set['picture']);
            }else{
                $set['picture'] = '';
            }
            $result = $this->restclient->post(base_url(url_index().'personnel/api_v1/transfer_update_personnel'),$set);//sanan
            $result = true;
            if(isset($result['status']) and !$result['status']){
                $this->Token_model->delete_token(['token'=>$token]);
                redirect(url_index().'auth/?status=db'); //login fail db
            }
            
        }







        $this->Token_model->update_token_user(['personnel_id'=>intval($personnel_id),'token'=>$token]);

        #create session and redirect
        if($status_login and intval($personnel_id)!=0){

            set_auth_session([
                'status'=>true,
                'token'=>$token,
                'username'=>trim($post['username']),
            ]);

            $set = [];
            $set['APP-KEY']     = $this->api_key;
            $set['username']    = trim($post['username']);
            $set['token']       = $token;
            $set['ip']          = $ip;
            
            $personnel = $this->restclient->post(base_url(url_index().'personnel/api_v1/personnel'),$set);
            $personnel = count($personnel['data'])>=0?$personnel['data'][0]:[];

            set_personnel_session([
                'token'         =>  (isset($personnel['token'])?$personnel['token']:''),
                'personnel_id'  =>  (isset($personnel['personnel_id'])?$personnel['personnel_id']:''),
                'username'      =>  (isset($personnel['internet_account'])?$personnel['internet_account']:''),
                'personnel_code'      =>  (isset($personnel['personnel_code'])?$personnel['personnel_code']:''),
                'title'         =>  (isset($personnel['title'])?$personnel['title']:''),
                'name_th'       =>  (isset($personnel['name_th'])?$personnel['name_th']:''),
                'surname_th'    =>  (isset($personnel['surname_th'])?$personnel['surname_th']:''),
                'name_en'       =>  (isset($personnel['name_en'])?$personnel['name_en']:''),
                'surname_en'    =>  (isset($personnel['surname_en'])?$personnel['surname_en']:''),
                'smu_main_id'   =>  (isset($personnel['smu_main_id'])?$personnel['smu_main_id']:''),
                'smu_sub_id'    =>  (isset($personnel['smu_sub_id'])?$personnel['smu_sub_id']:''),
                'work_start_date'   =>  (isset($personnel['work_start_date'])?$personnel['work_start_date']:''),
                'work_end_date'     =>  (isset($personnel['work_end_date'])?$personnel['work_end_date']:'')
            ]);

            #destination
            $dest = 'auth/select_module/'; //default leavesys
            if(isset($post['dest']) and trim($post['dest'])!=''){
                $dest = trim($post['dest']);
            }
            $complete = '';
            if(isset($post['complete']) and intval($post['complete'])==1){
                $complete = '?complete=1';
            }

            redirect(url_index().$dest.$complete);
        }else{
            redirect(url_index().'auth/?status=fail2'); //login fail
        }
    }

    function logout(){
        $session = $this->session->userdata('authentication');
        if(isset($session['status']) and $session['status'] and isset($session['token'])){
            $this->Token_model->delete_token(['token'=>$session['token']]);
        }
        $this->session->sess_destroy();
        redirect(url_index().'auth/');
    }

    function select_module(){
        // $login = $this->session->userdata('authentication');
        // if(isset($login['status']) and $login['status']){
        //     redirect('https://med.nu.ac.th/');
        // }

        $this->load->view('select_module');
    }

    function login2($re_login = []){ //sanan

        $post = $this->input->post();

        $f_data = $this->session->flashdata('re_login');

        if(count($f_data)>0){
            $post = $f_data;
        }

        if(!isset($post['username']) or !isset($post['password']) or !isset($post['token'])){
            redirect(url_index().'auth/?status=error');//not submit
        }
        if(empty($post['username']) or empty($post['password']) or empty($post['token'])){
            redirect(url_index().'auth/?status=validate');//validate input
        }

        if(!isset($post['skip']) and trim($post['token']) != $this->session->flashdata('token_login')){
            redirect(url_index().'auth/?status=valid_token');//validate token_login
        }

		$this->auth_ldap->Set_User(trim($post['username']),trim($post['password']));
        $status_login = $this->auth_ldap->Connect();

        $ip = get_client_ip();
        $token = $this->Token_model->create_token(['internet_account'=>trim($post['username']),'ip'=>$ip]);

        $post['username'] = 'thongwilaik';
        $set = [];
        $set['APP-KEY']     = $this->api_key;
        $set['username']    = trim($post['username']);
        $set['token']       = $token;
        $set['ip']          = $ip;
        $personnel = $this->restclient->post(base_url(url_index().'personnel/api_v1/personnel'),$set);
        $personnel_id = isset($personnel['data']) && count($personnel['data'])>0?$personnel['data'][0]['personnel_id']:0;

        if(count($f_data)==0 and !isset($personnel['sql_on'])){
            $post['skip'] = true;
            $this->session->set_flashdata('re_login', $post);
            redirect(url_index().'auth/login');//validate token_login


        }elseif(isset($personnel['status']) and $personnel['status'] and intval($personnel['count'])==0){ #check new tb personnel

            $this->load->model('sql_personnel/Sql_personnel_model');
            $personnel_sql = $this->Sql_personnel_model->get_personnel(['username'=>trim($set['username'])]);

            if(isset($personnel_sql['data']) and count($personnel_sql['data'])==1){
                #transfer new tb personnel
                $set = $personnel_sql['data'][0];
                $set['APP-KEY']     = $this->api_key;
                $set['username']    = trim($post['username']);
                $set['token']       = $token;
                $set['ip']          = $ip;
                if(trim($set['picture'])!=''){
                    $set['picture']     = 'data:image/jpeg;base64,'.base64_encode($set['picture']);
                }else{
                    $set['picture'] = '';
                }
                $result = $this->restclient->post(base_url(url_index().'personnel/api_v1/transfer_personnel'),$set);
                
                if(isset($result['status']) and $result['status']){
                    $personnel_id = isset($result['personnel_id'])?intval($result['personnel_id']):0;
                }else{
                    $this->Token_model->delete_token(['token'=>$token]);
                    redirect(url_index().'auth/?status=db'); //login fail db
                }
            }else{
                redirect(url_index().'auth/?status=fail1'); //login fail
            }
    

        }elseif(intval($personnel_id) != 0 and isset($personnel['status']) and $personnel['status']){
            #update old tb personnel to new tb personnel

            $this->load->model('sql_personnel/Sql_personnel_model');
            $result = $this->Sql_personnel_model->get_personnel(['username'=>trim($post['username'])]);

            $set = $result['data'][0];
            $set['APP-KEY']     = $this->api_key;
            $set['personnel_id']    = intval($personnel_id);
            $set['token']       = $token;
            $set['ip']          = $ip;
            if(trim($set['picture'])!=''){
                $set['picture']     = 'data:image/png;base64,'.base64_encode($set['picture']);
            }else{
                $set['picture'] = '';
            }
            $result = $this->restclient->post(base_url(url_index().'personnel/api_v1/transfer_update_personnel'),$set);//sanan
            $result = true;
            if(isset($result['status']) and !$result['status']){
                $this->Token_model->delete_token(['token'=>$token]);
                redirect(url_index().'auth/?status=db'); //login fail db
            }
            
        }







        $this->Token_model->update_token_user(['personnel_id'=>intval($personnel_id),'token'=>$token]);

        #create session and redirect
        if($status_login and intval($personnel_id)!=0){

            set_auth_session([
                'status'=>true,
                'token'=>$token,
                'username'=>trim($post['username']),
            ]);

            $set = [];
            $set['APP-KEY']     = $this->api_key;
            $set['username']    = trim($post['username']);
            $set['token']       = $token;
            $set['ip']          = $ip;
            
            $personnel = $this->restclient->post(base_url(url_index().'personnel/api_v1/personnel'),$set);
            $personnel = count($personnel['data'])>=0?$personnel['data'][0]:[];

            set_personnel_session([
                'token'         =>  (isset($personnel['token'])?$personnel['token']:''),
                'personnel_id'  =>  (isset($personnel['personnel_id'])?$personnel['personnel_id']:''),
                'username'      =>  (isset($personnel['internet_account'])?$personnel['internet_account']:''),
                'personnel_code'      =>  (isset($personnel['personnel_code'])?$personnel['personnel_code']:''),
                'title'         =>  (isset($personnel['title'])?$personnel['title']:''),
                'name_th'       =>  (isset($personnel['name_th'])?$personnel['name_th']:''),
                'surname_th'    =>  (isset($personnel['surname_th'])?$personnel['surname_th']:''),
                'name_en'       =>  (isset($personnel['name_en'])?$personnel['name_en']:''),
                'surname_en'    =>  (isset($personnel['surname_en'])?$personnel['surname_en']:''),
                'smu_main_id'   =>  (isset($personnel['smu_main_id'])?$personnel['smu_main_id']:''),
                'smu_sub_id'    =>  (isset($personnel['smu_sub_id'])?$personnel['smu_sub_id']:''),
                'work_start_date'   =>  (isset($personnel['work_start_date'])?$personnel['work_start_date']:''),
                'work_end_date'     =>  (isset($personnel['work_end_date'])?$personnel['work_end_date']:'')
            ]);

            #destination
            $dest = 'auth/select_module/'; //default leavesys
            if(isset($post['dest']) and trim($post['dest'])!=''){
                $dest = trim($post['dest']);
            }

            redirect(url_index().$dest);
        }else{
            redirect(url_index().'auth/?status=fail2'); //login fail
        }
    }

    function admin(){
        $get = $this->input->get();

        $login = $this->session->userdata('authentication');
        if(isset($login['status']) and $login['status'] and isset($get['dest']) and trim($get['dest'])!=''){
            redirect(url_index().trim($get['dest']));
        }/*elseif(isset($login['status']) and $login['status']){
            redirect(url_index().'idp/my_course/');
        }*/

        #generate token_login
        $token = genTOKEN();
        $this->session->set_flashdata('token_login', $token);
        $this->load->view('login_admin',['token_login'=>$token]);

        // status=fail
        if(isset($get['status']) and $get['status']=='fail'){
            
        }
    }

    function login_as_list(){
        $post = $this->input->post();

        $res['op'] = [];
        $res['np'] = [];

        $this->load->model('personnel/Personnel_model');

        $con = [];
        $con['where'] = 'internet_account LIKE "'.trim($post['term']).'%" or name_th LIKE "'.trim($post['term']).'%" or name_en LIKE "'.trim($post['term']).'%"';
        $res['op'] = $this->Personnel_model->to_select($con);

        if(count($res['op'])==0){
            $this->load->model('sql_personnel/Sql_personnel_model');
            $con = [];
			$con['where']	= "internetaccount LIKE '".trim($post['term'])."%'";
			$res['np'] = $this->Sql_personnel_model->sqlsrv_select($con);
        }
        
        echo json_encode($res);exit;
    }
}
