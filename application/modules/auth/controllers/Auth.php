<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Auth_Controller {

	function __construct(){
		parent::__construct();
        $this->load->library(['auth_ldap','restclient']);
        $this->load->model('auth/Token_model');
    }
    
    function index(){
        
        $login = $this->session->userdata('authentication');
        if(isset($login['status']) and $login['status']){
            #destination
            $dest = 'auth/select_module/'; //default leavesys
            if(isset($post['dest']) and trim($post['dest'])!=''){
                $dest = trim($post['dest']);
            }
        }

        #generate token_login
        $token = genTOKEN();

        $this->session->set_flashdata('token_login', $token);
        $this->load->view('login',['token_login'=>$token]);
    }

    function login(){
        $post = $this->input->post();

        if(!isset($post['username']) or !isset($post['password']) or !isset($post['token'])){
            redirect(url_index().'auth/?status=error');//not submit
        }
        if(empty($post['username']) or empty($post['password']) or empty($post['token'])){
            redirect(url_index().'auth/?status=validate');//validate input
        }

        $flash_data = $this->session->flashdata('post_login');
        if(is_array($flash_data) and count($flash_data)>0){
            $post = $flash_data;
        }else{
            $this->session->set_flashdata('post_login', $post);

            if(trim($post['token']) != $this->session->flashdata('token_login')){
                redirect(url_index().'auth/?status=valid_token');//validate token_login
            }
        }

		$this->auth_ldap->Set_User(trim($post['username']),trim($post['password']));
        $status_login = $this->auth_ldap->Connect();

        $ip = get_client_ip();
        $token = $this->Token_model->create_token(['internet_account'=>trim($post['username']),'ip'=>$ip]);

        $set = [];
        $set['APP-KEY']     = $this->api_key;
        $set['username']    = trim($post['username']);
        $set['token']       = $token;
        $set['ip']          = $ip;
        $result = $this->restclient->post(base_url(url_index().'personnel/api_v1/personnel'),$set);

        $personnel_id = isset($result['data']) && count($result['data'])>0?$result['data'][0]['personnel_id']:0;

        #check new tb personnel
        if(isset($result['status']) and $result['status'] and !intval($result['count'])){

            $this->load->model('sql_personnel/Sql_personnel_model');
            $result = $this->Sql_personnel_model->get_personnel(['username'=>trim($set['username'])]);

            #check old tb personnel
            if(isset($result['status']) and $result['status'] and count($result['data'])==1){
                #transfer new tb personnel

                $set = $result['data'][0];
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

            }
        }elseif(intval($personnel_id) != 0){
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
            $result = $this->restclient->post(base_url(url_index().'personnel/api_v1/transfer_update_personnel'),$set);

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
                'surname_en'    =>  (isset($personnel['surname_en'])?$personnel['surname_en']:'')
            ]);

            #destination
            $dest = 'auth/select_module/'; //default leavesys
            if(isset($post['dest']) and trim($post['dest'])!=''){
                $dest = trim($post['dest']);
            }

            redirect(url_index().$dest);
        }else{
            redirect(url_index().'auth/?status=fail'); //login fail
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
}
