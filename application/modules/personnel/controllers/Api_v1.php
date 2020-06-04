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

        if(isset($post['personnel_list']) and count($post['personnel_list'])>0){
            $result = $this->Personnel_model->get_personnel(['personnel_list'=>$post['personnel_list']]);
            $result['status'] = true;
            $this->response($result, REST_Controller::HTTP_OK); //200
        }elseif(isset($post['username']) and trim($post['username'])!=''){
            $result = $this->Personnel_model->get_personnel(['username'=>trim($post['username'])]);
            $result['status'] = true;
            $this->response($result, REST_Controller::HTTP_OK); //200
        }elseif(isset($post['term']) and trim($post['term'])!='' and strlen($post['term'])>=4){
            $result = $this->Personnel_model->get_personnel(['term'=>trim($post['term'])]);
            $result['status'] = true;
            $this->response($result, REST_Controller::HTTP_OK); //200

        }elseif(isset($post['smu']) and trim($post['smu'])!=''){
            $result['workmate'] = $this->Personnel_model->get_personnel(['smu_main_id'=>$post['smu']]);
            $boss = $this->Personnel_model->get_boss(['smu_main_id'=>$post['smu']]);

            $boss_id = [];
            $result['boss']['data'] = [];
            $result['boss']['count'] = 0;

            if($boss['count']>0){
                foreach($boss['data'] as $key=>$val){
                    $boss_id[] = $val['personnel_id'];
                }
                $result['boss'] = $this->Personnel_model->get_personnel(['personnel_list'=>$boss_id]);
            }

            $this->Personnel_model->get_personnel(['personnel_list'=>$boss_id]);


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

            $set['img'] 	        = isset($post['picture'])?trim($post['picture']):'';
            $set['position_boss'] 	= isset($post['positionmanagement'])?trim($post['positionmanagement']):'';
            $set['smu_main_id'] 	= isset($post['departname'])?substr($post['departname'],0,6):'';
            $set['smu_sub_id'] 		= isset($post['subdepart'])?substr($post['subdepart'],0,6):'';
            $set['work_start_date'] = isset($post['empstart'])?trim($post['empstart']):'';
            $set['work_end_date'] 	= isset($post['empend'])?trim($post['empend']):'';

            $emp_type = 0;
            if(isset($post['pgroupid']) and intval($post['pgroupid'])==1){$emp_type = 1;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==3){$emp_type = 2;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==4){$emp_type = 3;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==9){$emp_type = 4;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==8){$emp_type = 5;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==17){$emp_type = 6;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==5){$emp_type = 7;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==10){$emp_type = 8;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==18){$emp_type = 9;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==2){$emp_type = 10;
            }

            $set['emp_type_id'] 	= $emp_type;

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
            
            $set['img'] 	        = isset($post['picture'])?trim($post['picture']):'';
            $set['position_boss'] 	= isset($post['positionmanagement'])?trim($post['positionmanagement']):'';
            $set['smu_main_id'] 	= isset($post['departname'])?substr($post['departname'],0,6):'';
            $set['smu_sub_id'] 		= isset($post['subdepart'])?substr($post['subdepart'],0,6):'';
            $set['work_start_date'] = isset($post['empstart'])?trim($post['empstart']):'';
            $set['work_end_date'] 	= isset($post['empend'])?trim($post['empend']):'';

            $emp_type = 0;
            if(isset($post['pgroupid']) and intval($post['pgroupid'])==1){$emp_type = 1;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==3){$emp_type = 2;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==4){$emp_type = 3;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==9){$emp_type = 4;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==8){$emp_type = 5;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==17){$emp_type = 6;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==5){$emp_type = 7;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==10){$emp_type = 8;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==18){$emp_type = 9;
            }elseif(isset($post['pgroupid']) and intval($post['pgroupid'])==2){$emp_type = 10;
            }

            $set['emp_type_id'] 	= $emp_type;

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
