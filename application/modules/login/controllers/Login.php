<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Auth_Controller {

	function __construct(){
		parent::__construct();
        $this->load->library(['auth_ldap']);
        
        $login = $this->session->userdata('authentication');

        if(!isset($login['status']) or (isset($login['status']) and $login['status'])){
            redirect('https://med.nu.ac.th/');
        }

    }
    
    function index(){
        $this->load->view('login');
    }

    function auth(){
        $post = $this->input->post();

        if(!(isset($post['username']) or !isset($post['password']))){
            redirect(url_index().'login/?status=error');
        }elseif(!(empty($post['username']) or !empty($post['password']))){
            redirect(url_index().'login/?status=validate');
        }

        $dest = '';
        if(isset($post['dest'])){
            $dest = trim($post['dest']);
        }

		$this->auth_ldap->Set_User(trim($post['username']),trim($post['password']));
        $result = $this->auth_ldap->Connect();
        
        if($result){
            set_auth_session(['status'=>true]);
            redirect(url_index().'leave/'.$dest);
        }else{
            redirect(url_index().'login/?status=fail');
        }
        
	}
}
