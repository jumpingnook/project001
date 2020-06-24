<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/REST_Controller.php');

class Api_v1 extends REST_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('auth/Token_model');
    }

    function send_post(){
        
        $post = $this->post();

        if(isset($post['subject']) and isset($post['body']) and $post['to'] and trim($post['subject'])!='' and trim($post['body'])!='' and (trim($post['to'])!='' or (is_array($post['to'] and count($post['to'])>0)))){

            $this->load->library('email');

            $con = [];
            $con['subject']     = trim($post['subject']);//'[ระบบลา] พิจารณาการลา';
            $con['body']        = trim($post['body']);//'ทดสอบ';
            $con['from_name']   = isset($post['from_name'])?$post['from_name']:'MyMed - med.nu.ac.th';
            $con['to']          = $post['to'];
            $con['bcc']         = isset($post['bcc'])?$post['bcc']:'sananr@nu.ac.th';
            $con['reply']       = isset($post['reply'])?$post['reply']:'no-reply@nu.ac.th';

            $this->email->from('sananr@nu.ac.th',$con['from_name']);
            $this->email->reply_to($con['reply']);
            $this->email->to($con['to']);
            $this->email->bcc($con['bcc']);
            $this->email->subject($con['subject']);
            $this->email->message($con['body']);
            $result = $this->email->send();

            if($result){
                $res['status']  = true;
                $this->response($res, REST_Controller::HTTP_OK);
            }else{
                $msg = $this->email->print_debugger();
                $res['status']  = false;
                $res['msg']     = $msg;
                $this->response($res, REST_Controller::HTTP_OK);
            }
            
        }else{
            $res['status']  = false;
            $res['msg']     = 'Invalid Data';
            $this->response($res, REST_Controller::HTTP_OK);
        }
    }
}
