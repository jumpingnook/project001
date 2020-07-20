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
        if(isset($login['status']) and $login['status']){
            redirect(url_index().'auth-medicine/auth');
        }

        $this->load->view('login');
    }

    function _login($login = []){

        $post = $this->input->post();

        if(!isset($post['username']) or !isset($post['password']) or !isset($post['token'])){
            redirect(url_index().'auth/?status=error');//not submit
        }
        if(empty($post['username']) or empty($post['password']) or empty($post['token'])){
            redirect(url_index().'auth/?status=validate');//validate input
        }

		$this->auth_ldap->Set_User(trim($post['username']),trim($post['password']));
        $status_login = $this->auth_ldap->Connect();

        $ip = get_client_ip();

        #create session and redirect
        if($status_login and intval($personnel_id)!=0){

            #set session

            redirect(url_index());
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
}
