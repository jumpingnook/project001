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

        $token = $this->check_token($post);

        if(isset($post['username']) and trim($post['username'])!=''){
            $result = $this->Personnel_model->get_personnel(['username'=>trim($post['username'])]);
            $result['status'] = true;
            $this->response($result, REST_Controller::HTTP_OK); //200
		}else{
            $this->response([
                'status' => false,
                'message' => 'Invalid Data'
            ], REST_Controller::HTTP_NOT_FOUND); //404
        }


    }

    function transfer_personnel_post(){
        $post = $this->post();

        $token = $this->check_token($post);

        if(isset($post['username']) and trim($post['username'])!=''){

            $set = [];
            $set['username'] 	    = isset($post['username'])?trim($post['username']):'';
            $set['personnel_code'] 	= isset($post['empcode'])?trim($post['empcode']):'';
            $set['title'] 			= isset($post['pname'])?trim($post['pname']):'';
            $set['name_th'] 		= isset($post['fname'])?trim($post['fname']):'';
            $set['surname_th'] 		= isset($post['lname'])?trim($post['lname']):'';
            $set['name_en'] 		= isset($post['engfname'])?trim($post['engfname']):'';
            $set['surname_en'] 		= isset($post['englname'])?trim($post['englname']):'';
            $set['nickname'] 		= isset($post['nickname'])?trim($post['nickname']):'';
            $set['brithdate'] 		= isset($post['birthday'])?date('Y-m-d H:i:s',strtotime($post['birthday'])):'0000-00-00';
            $set['id_card'] 		= isset($post['idcard'])?trim($post['idcard']):'';
            $set['internet_account'] = isset($post['internetaccount'])?trim($post['internetaccount']):'';
            $set['gender'] 			= isset($post['sex'])?trim($post['sex']):'';
            $set['phone'] 			= isset($post['mobile'])?preg_replace('/[^0-9]/', '', trim($post['mobile'])):'';
            $set['tel'] 			= isset($post['hometel'])?preg_replace('/[^0-9]/', '', trim($post['hometel'])):'';
            $set['internel_tel'] 	= isset($post['self_tel_in'])?preg_replace('/[^0-9]/', '', trim($post['self_tel_in'])):'';
            $set['email'] 			= isset($post['email'])?trim($post['email']):'';
            $set['address'] 		= isset($post['address'])?trim($post['address']):'';

            // #table personnel promote
            // $set['type']               = true;
            // $set['personnel_code'] 	= isset($post['empcode'])?trim($post['empcode']):'';
            // $set['personnel_type_id']	= isset($post['positionbybigboss_id'])?intval($post['positionbybigboss_id']):0;
            // $set['emp_type_id'] 	= isset($post['pgroupid'])?intval($post['pgroupid']):0;
            // $set['posit_type_id'] 	= isset($post['positiontype_id'])?intval($post['positiontype_id']):0;
            // $set['posit_level_id'] 	= isset($post['positionlevel_id'])?intval($post['positionlevel_id']):0;
            // $set['position_id'] 	= isset($post['positionid'])?intval($post['positionid']):0;
            // $set['smu_sub_id'] 		= explode(' ',$post['subdepart'])[0];
            // $set['data']    = isset($post['empstart'])?date('Y-m-d',strtotime($post['empstart'])):date('Y-m-d');

            $result = $this->Personnel_model->transfer_personnel($set);
            $this->response($result, REST_Controller::HTTP_OK); //200
		}else{
            $this->response([
                'status' => false,
                'message' => 'Invalid Data'
            ], REST_Controller::HTTP_NOT_FOUND); //404
        }
    }

    function transfer_update_personnel_post(){
        $post = $this->post();

        $token = $this->check_token($post);

        if(isset($post['personnel_id']) and intval($post['personnel_id'])!=0){

            $set = [];
            $set['personnel_id'] 	= isset($post['personnel_id'])?intval($post['personnel_id']):0;
            $set['personnel_code'] 	= isset($post['empcode'])?trim($post['empcode']):'';
            $set['title'] 			= isset($post['pname'])?trim($post['pname']):'';
            $set['name_th'] 		= isset($post['fname'])?trim($post['fname']):'';
            $set['surname_th'] 		= isset($post['lname'])?trim($post['lname']):'';
            $set['name_en'] 		= isset($post['engfname'])?trim($post['engfname']):'';
            $set['surname_en'] 		= isset($post['englname'])?trim($post['englname']):'';
            $set['nickname'] 		= isset($post['nickname'])?trim($post['nickname']):'';
            $set['brithdate'] 		= isset($post['birthday'])?date('Y-m-d H:i:s',strtotime($post['birthday'])):'0000-00-00';
            $set['id_card'] 		= isset($post['idcard'])?trim($post['idcard']):'';
            $set['internet_account'] = isset($post['internetaccount'])?trim($post['internetaccount']):'';
            $set['gender'] 			= isset($post['sex'])?trim($post['sex']):'';
            $set['phone'] 			= isset($post['mobile'])?preg_replace('/[^0-9]/', '', trim($post['mobile'])):'';
            $set['tel'] 			= isset($post['hometel'])?preg_replace('/[^0-9]/', '', trim($post['hometel'])):'';
            $set['internel_tel'] 	= isset($post['self_tel_in'])?preg_replace('/[^0-9]/', '', trim($post['self_tel_in'])):'';
            $set['email'] 			= isset($post['email'])?trim($post['email']):'';
            $set['address'] 		= isset($post['address'])?trim($post['address']):'';

            #table personnel promote
            // $set['type']               = true;
            // $set['personnel_code'] 	= isset($post['empcode'])?trim($post['empcode']):'';
            // $set['personnel_type_id']	= isset($post['positionbybigboss_id'])?intval($post['positionbybigboss_id']):0;
            // $set['emp_type_id'] 	= isset($post['pgroupid'])?intval($post['pgroupid']):0;
            // $set['posit_type_id'] 	= isset($post['positiontype_id'])?intval($post['positiontype_id']):0;
            // $set['posit_level_id'] 	= isset($post['positionlevel_id'])?intval($post['positionlevel_id']):0;
            // $set['position_id'] 	= isset($post['positionid'])?intval($post['positionid']):0;
            // $set['smu_sub_id'] 		= explode(' ',$post['subdepart'])[0];
            // $set['data']    = isset($post['empstart'])?date('Y-m-d',strtotime($post['empstart'])):date('Y-m-d');

            $result = $this->Personnel_model->transfer_update_personnel($set);
            $this->response($result, REST_Controller::HTTP_OK); //200
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
