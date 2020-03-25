<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Auth_Controller {

	function __construct(){
		parent::__construct();
        $this->load->library(['auth_ldap']);
        $this->load->model('auth/Token_model');
        $this->load->model('auth/Personnel_model');
    }
    
    function index(){
        $login = $this->session->userdata('authentication');
        if(isset($login['status']) and $login['status']){
            redirect('https://med.nu.ac.th/');
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
        if(trim($post['token']) != $this->session->flashdata('token_login')){
            redirect(url_index().'auth/?status=valid_token');//validate token_login
        }

		$this->auth_ldap->Set_User(trim($post['username']),trim($post['password']));
        $status_login = $this->auth_ldap->Connect();

        $token = $this->Token_model->create_token(['personnel_id'=>'9999','ip'=>get_client_ip()]);

        #check new tb personnel
        $result = $this->Personnel_model->check_account(['username'=>trim($post['username'])]);
        if($result){
            #check old tb personnel
            #tranfer new tb personnel
        }

        #create session and redirect
        if($status_login){
            set_auth_session(['status'=>true,'token'=>$token]);

            #destination
            $dest = 'leave/'; //default leavesys
            if(isset($post['dest'])){
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
}
