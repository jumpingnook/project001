<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/REST_Controller.php');

class Api_v1 extends REST_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model(['leave/Calendar_model','auth/Token_model']);
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



    
}
