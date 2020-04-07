<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/REST_Controller.php');

class Api_v1 extends REST_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('auth/Token_model');
    }
    
    function primary_course_post(){
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


        $this->load->model(['Course_model']);

        $primary = $this->Course_model->course_tag_primary();
        $course = $this->Course_model->course();

        $res['data'] = [];
        $res['count'] = 0;
        if(count($primary)>0){
            foreach($primary as $key=>$val){
                if(isset($course[$val['course_id']])){
                    $res['data'][$val['course_id']] = $course[$val['course_id']];
                    $res['count']++;
                }
            }
        }

        $res['status'] = true;
        $this->response($res, REST_Controller::HTTP_OK); //404
    }

    
}
