<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/REST_Controller.php');

class Api_v1 extends REST_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model(['leave/Calendar_model','auth/Token_model','leave/Leave_model']);
    }


    function add_date_post(){
        $post = $this->post();

        $token = $this->check_token($post);

        if(isset($post['date']) and isset($post['name']) and trim($post['date'])!='' and trim($post['name'])!=''){

            $date_val = date('Y-m-d',strtotime($post['date']));

            if(isset($post['plus']) and intval($post['plus'])>0){
                $date_val = date('Y-m-d',strtotime($date_val.' +'.intval($post['plus']).' day'));
            }

            $con = [];
            $con['where'] = 'cal_id = "'.$date_val.'" and status = 0';
            $count = $this->Calendar_model->to_count($con);

            if($count==0){
                $con = [];
                $con['data']['cal_id'] = $date_val;
                $con['data']['mktime'] = strtotime($date_val);
                $con['data']['name'] = trim($post['name']);
                $con['data']['status'] = 0;
                $this->Calendar_model->to_insert($con);

                $result['status'] = true;
                $this->response($result, REST_Controller::HTTP_OK); //200

            }else{
                $this->response([
                    'status' => false,
                    'message' => 'Not Create'
                ], REST_Controller::HTTP_OK); //200
            }

        }else{
            $this->response([
                'status' => false,
                'message' => 'Invalid Data'
            ], REST_Controller::HTTP_OK); //200
        }

    }

    function del_date_post(){
        $post = $this->post();

        $token = $this->check_token($post);

        if(isset($post['cal']) and trim($post['cal'])!=''){

            $date_val = date('Y-m-d',strtotime($post['cal']));

            $con = [];
            $con['where'] = 'cal_id = "'.$date_val.'" and status = 0';
            $count = $this->Calendar_model->to_count($con);

            if($count==1){
                $con['data']['status'] = 1;
                $this->Calendar_model->to_update($con);

                $result['status'] = true;
                $this->response($result, REST_Controller::HTTP_OK); //200

            }else{
                $this->response([
                    'status' => false,
                    'message' => 'Not Delete'
                ], REST_Controller::HTTP_OK); //200
            }

        }else{
            $this->response([
                'status' => false,
                'message' => 'Invalid Data'
            ], REST_Controller::HTTP_OK); //200
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

    function save_leave_post(){
        $post = $this->post();

        $token = $this->check_token($post);

        if(isset($post['data']) and count($post['data'])>0){
            foreach($post['data'] as $key=>$val){
                if(trim($val)==''){
                    $this->response([
                        'status' => false,
                        'message' => 'Invalid Data'
                    ], REST_Controller::HTTP_OK); //200
                }
            }
        }else{
            $this->response([
                'status' => false,
                'message' => 'Invalid Data'
            ], REST_Controller::HTTP_OK); //200
        }

        $result = $this->Leave_model->save_leave($post['data']);
        if($result!=0){
            $this->response([
                'status' => true,
                'value' => $result
            ], REST_Controller::HTTP_OK); //200
        }else{
            $this->response([
                'status' => false,
                'message' => 'Not Insert'
            ], REST_Controller::HTTP_OK); //200
        }

    }

    function leave_history_post(){
        $post = $this->post();
        $token = $this->check_token($post);

        if(isset($post['personnel_id']) and intval($post['personnel_id'])!=0){

            $result = $this->Leave_model->leave_history(['personnel_id'=>intval($post['personnel_id'])]);
            $this->response([
                'status' => true,
                'data' => $result['data'],
                'count' => $result['count']
            ], REST_Controller::HTTP_OK); //200

        }else{
            $this->response([
                'status' => true,
                'data' => [],
                'count' => 0
            ], REST_Controller::HTTP_OK); //200
        }

    }

    function view_leave_post(){
        $post = $this->post();
        $token = $this->check_token($post);

        if(isset($post['leave_id']) and intval($post['leave_id'])!=0){

            $result = $this->Leave_model->view_leave(['leave_id'=>intval($post['leave_id'])]);
            $this->response([
                'status' => true,
                'data' => $result['data']
            ], REST_Controller::HTTP_OK); //200

        }else{
            $this->response([
                'status' => true,
                'data' => [],
                'count' => 0
            ], REST_Controller::HTTP_OK); //200
        }

    }



    
}
