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

        $token = $this->check_token($post);

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

    function course_post(){
        $post = $this->post();

        $token = $this->check_token($post);

        $this->load->model(['Course_model']);

        $set = [];
        if(isset($post['course']) and intval($post['course'])!=0){
            $set['id'] = intval($post['course']);
        }

        $course = $this->Course_model->course($set);
        $res['data'] = $course;
        $res['count'] = count($course);

        $res['status'] = true;
        $this->response($res, REST_Controller::HTTP_OK); //404
    }

    function group_tag_post(){
        $post = $this->post();

        $token = $this->check_token($post);

        $this->load->model(['Course_model']);

        $set = [];
        if(isset($post['course']) and intval($post['course'])!=0){
            $set['course'] = intval($post['course']);
        }
        $group_tag = $this->Course_model->course_group_tag($set);
        $tag = $this->Course_model->course_tag();

        $res['group_tag'] = $group_tag;
        $res['tag'] = $tag;
        $res['count'] = count($group_tag);

        $res['status'] = true;
        $this->response($res, REST_Controller::HTTP_OK); //404
    }

    function save_course_post(){
        $post = $this->post();

        $token = $this->check_token($post);

        $this->load->model(['Course_model']);

        $post['sheet_token'] = sheet_token($post['sheet_token']);

        $result = $this->Course_model->save_course($post);

        if(isset($result) and $result==false){
            $res['status'] = false;
            $this->response($res, REST_Controller::HTTP_OK);
        }

        $res['status'] = true;
        $res['course'] = $result;
        $this->response($res, REST_Controller::HTTP_OK);

    }

    function update_course_post(){
        $post = $this->post();

        $token = $this->check_token($post);

        $this->load->model(['Course_model']);

        $post['sheet_token'] = sheet_token($post['sheet_token']);

        $result = $this->Course_model->update_course($post);

        if(isset($result) and $result==false){
            $res['status'] = false;
            $this->response($res, REST_Controller::HTTP_OK);
        }

        $res['status'] = true;
        $res['course'] = $result;
        $this->response($res, REST_Controller::HTTP_OK);

    }

    function learn_course_post(){
        $post = $this->post();

        $token = $this->check_token($post);

        if(isset($post['course']) and intval($post['course'])!=0){

            $this->load->model(['Course_model']);

            $file = '';
            if(isset($post['file']) and trim($post['file'])!=''){
                $status = 2;
                $file = $post['file'];
            }else{
                $status = (isset($post['status'])?intval($post['status']):1);
            }

            $result = $this->Course_model->set_learning(['personnel_id'=>$token['data'][0]['personnel_id'],'course_id'=>intval($post['course']),'status'=>$status,'file_upload'=>$file]);

            if($result){
                $res['status'] = true;
                $this->response($res, REST_Controller::HTTP_OK); 
            }else{
                $res['status'] = false;
                $res['msg'] = 'Not Complete';
                $this->response($res, REST_Controller::HTTP_OK);  
            }
        }else{
            $res['status'] = false;
            $res['msg'] = 'Invalid Data';
            $this->response($res, REST_Controller::HTTP_OK);  
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

    function enroll_post(){
        $post = $this->post();

        $token = $this->check_token($post);

        

        if(isset($post['personnel_id']) and intval($post['personnel_id'])!=0){

            $set = [];
            $set['personnel_id'] = intval($post['personnel_id']);
            

            $this->load->model(['Course_model']);

            $result = $this->Course_model->enroll_history($set);

            

            $res['data'] = [];
            $res['count'] = 0;

            if(count($result)>0){
                $res['data'] = $result;
                $res['count'] = count($result);
            }

            $res['status'] = true;
            $this->response($res, REST_Controller::HTTP_OK);

        }else{
            $this->response([
                'status' => false,
                'message' => 'Invalid DAta'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    
}
