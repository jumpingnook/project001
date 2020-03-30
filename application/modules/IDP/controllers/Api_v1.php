<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/REST_Controller.php');

class Api_v1 extends REST_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('personnel/Personnel_model');
        $this->load->model('auth/Token_model');
    }
    
    function personnel_post(){
        $post = $this->post();

        if(isset($post['token']) and isset($post['ip']) and trim($post['token'])!='' and trim($post['ip'])!=''){
            $token = $this->Token_model->check_token(['token'=>$post['token'],'ip'=>$post['ip']]);
            if(intval($token['count']) == 0){
                $this->response([
                    'status' => false,
                    'message' => 'Expire Token'
                ], REST_Controller::HTTP_NOT_FOUND); //404 
            }else{
                $this->Token_model->update_token_session(['token'=>$post['token']]);
            }
        }else{
            $this->response([
                'status' => false,
                'message' => 'Invalid Token'
            ], REST_Controller::HTTP_NOT_FOUND); //404 
        }

        if(isset($post['username']) and trim($post['username'])!=''){
            $result = $this->Personnel_model->get_personnel(['username'=>trim($post['username'])]);
            $result['status'] = true;
            $this->response($result, REST_Controller::HTTP_NOT_FOUND); //404
		}else{
            $this->response([
                'status' => false,
                'message' => 'Invalid Data'
            ], REST_Controller::HTTP_NOT_FOUND); //404
        }


    }

    
}
