<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/REST_Controller.php');

class Api_v1 extends REST_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('sql_personnel/Sql_personnel_model');
        $this->load->model('auth/Token_model');
    }
    
    function personnel_post(){
        $post = $this->post();

        $token = $this->check_token($post);

        if(isset($post['username']) and trim($post['username'])!=''){
            $result = $this->Sql_personnel_model->get_personnel(['username'=>trim($post['username'])]);
            $result['status'] = true;
            $this->response($result, REST_Controller::HTTP_NOT_FOUND); //404
		}else{
            $this->response([
                'status' => false,
                'message' => 'Invalid Data'
            ], REST_Controller::HTTP_NOT_FOUND); //404
        }
    }

    private function check_token($set=[]){
        $token = [];
        if(isset($set['token']) and isset($set['ip']) and trim($set['token'])!='' and trim($set['ip'])!=''){
            $token = $this->Token_model->check_token(['token'=>$set['token'],'ip'=>$set['ip']]);
            if(intval($token['count']) == 0){
                $this->response([
                    'status' => false,
                    'message' => 'Expire Token'
                ], REST_Controller::HTTP_NOT_FOUND); //404 
            }else{
                $this->Token_model->update_token_session(['token'=>$set['token']]);
            }
        }else{
            $this->response([
                'status' => false,
                'message' => 'Invalid Token'
            ], REST_Controller::HTTP_NOT_FOUND); //404 
        }

        return $token;
    }

    
}
