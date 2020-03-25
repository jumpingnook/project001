<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Auth_Controller {

	function __construct(){
		parent::__construct();
        $this->load->library(['auth_ldap']);
        $this->load->model('auth/Token_model');
    }
    
    function index(){
        $login = $this->session->userdata('authentication');
        if(isset($login['status']) and $login['status']){
            redirect('https://med.nu.ac.th/');
        }

        $token = genTOKEN();
        $this->session->set_flashdata('token_login', $token);
        $this->load->view('login',['token_login'=>$token]);
    }

    function login(){
        $post = $this->input->post();

        if(!isset($post['username']) or !isset($post['password']) or !isset($post['token'])){
            redirect(url_index().'auth/?status=error');
        }
        if(empty($post['username']) or empty($post['password']) or empty($post['token'])){
            redirect(url_index().'auth/?status=validate');
        }
        if(trim($post['token']) != $this->session->flashdata('token_login')){
            redirect(url_index().'auth/?status=valid_token');
        }

        $dest = '';
        if(isset($post['dest'])){
            $dest = trim($post['dest']);
        }

		$this->auth_ldap->Set_User(trim($post['username']),trim($post['password']));
        $result = $this->auth_ldap->Connect();

        $token = $this->Token_model->create_token(['personnel_id'=>'9999','ip'=>get_client_ip()]);

        #find new personnel

        if($result){
            set_auth_session(['status'=>true,'token'=>$token]);
            redirect(url_index().'leave/'.$dest);
        }else{
            redirect(url_index().'auth/?status=fail');
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
