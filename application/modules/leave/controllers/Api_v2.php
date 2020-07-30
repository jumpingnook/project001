<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/REST_Controller.php');

class Api_v2 extends REST_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model(['leave/Calendar_model','auth/Token_model','leave/Leave_model','leave/Leave_spec_model']);
    }

    function leave_spec_alert_post(){
        $post = $this->post();
        $post['count_year'] = 10;

        if(isset($post['leave_type']) and isset($post['emp_type']) and isset($post['personnel']) and isset($post['period_count']) and isset($post['period_count_all']) and intval($post['leave_type'])!=0 and intval($post['emp_type'])!=0 and intval($post['personnel'])!=0 and floatval($post['period_count'])!=0 and floatval($post['period_count_all'])!=0){

            $set = [];
            $set['leave_type_id']   = intval($post['leave_type']);
            $set['emp_type_id']     = intval($post['emp_type']);
            $spec = $this->Leave_spec_model->spec($set);

            if(count($spec)<=0){ // not leave permission
                $this->response([
                    'status' => false,
                    'msg' => 'Invalid Data'
                ], REST_Controller::HTTP_OK); //200 
            }

            $spec = $spec[0];
            $post['period_count_all'] = 10;
            
            $res['before'] = 0;
            if(isset($spec['before_day']) and intval($spec['before_day'])!=0 and floatval($post['period_count'])>intval($spec['before_day'])){
                $res['before'] = intval($spec['before_day']);
            }elseif(isset($spec['before_day_all']) and intval($spec['before_day_all'])!=0 and floatval($post['period_count_all'])>intval($spec['before_day_all'])){
                $res['before'] = intval($spec['before_day_all']);
            }elseif(isset($spec['before_birth']) and intval($spec['before_birth'])!=0 and floatval($post['period_count_all'])>intval($spec['before_birth'])){
                $res['before'] = intval($spec['before_birth']);
            }

            $res['approve'] = 0;
            if(isset($spec['approve_type']) and intval($spec['approve_type'])==0){
                if(isset($spec['approve_1']) and intval($spec['approve_1'])!=0 and floatval($post['period_count'])>intval($spec['approve_1'])){
                    $res['approve'] = 1;
                }elseif(isset($spec['approve_2']) and intval($spec['approve_2'])!=0 and floatval($post['period_count'])>intval($spec['approve_2'])){
                    $res['approve'] = 2;
                }elseif(isset($spec['approve_3']) and intval($spec['approve_3'])!=0 and floatval($post['period_count'])>intval($spec['approve_3'])){
                    $res['approve'] = 3;
                }
            }elseif(isset($spec['approve_type']) and intval($spec['approve_type'])==1){
                $res['approve'] = 3;
            }elseif(isset($spec['approve_type']) and intval($spec['approve_type'])==2){
                if(isset($spec['approve_1']) and intval($spec['approve_1'])==1){
                    $res['approve'] = 1;
                }elseif(isset($spec['approve_2']) and intval($spec['approve_2'])==1){
                    $res['approve'] = 2;
                }elseif(isset($spec['approve_3']) and intval($spec['approve_3'])==1){
                    $res['approve'] = 3;
                }
            }

            $res['limit'] = 0;
            if(isset($spec['limit_year']) and intval($spec['limit_year'])!=0 and floatval($post['count_year'])>intval($spec['limit_year'])){
                $res['limit'] = intval($spec['limit_year']);
            }

            $res['alert'] = 0;
            if(isset($spec['salary_alert']) and intval($spec['salary_alert'])!=0 and floatval($post['count_year'])>intval($spec['salary_alert'])){
                $res['alert'] = intval($spec['salary_alert']);
            }
            if(isset($spec['promotion_alert']) and intval($spec['promotion_alert'])!=0 and floatval($post['count_year'])>intval($spec['promotion_alert'])){
                $res['alert'] = intval($spec['promotion_alert']);
            }

            $this->response([
                'status'    => true,
                'data'      => $res
            ], REST_Controller::HTTP_OK); //200

        }else{
            $this->response([
                'status' => false,
                'msg' => 'Invalid Data'
            ], REST_Controller::HTTP_OK); //200 
        }
    }
}
