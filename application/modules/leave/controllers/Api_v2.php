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

        if(isset($post['leave_type']) and isset($post['emp_type']) and isset($post['personnel']) and isset($post['period_count']) and isset($post['period_count_all']) and isset($post['period_start']) and intval($post['leave_type'])!=0 and intval($post['emp_type'])!=0 and intval($post['personnel'])!=0 and floatval($post['period_count'])!=0 and floatval($post['period_count_all'])!=0){

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

            $res['approve'] = 0;
            if(isset($spec['approve_type']) and intval($spec['approve_type'])==0){
                /*if(isset($spec['approve_3']) and intval($spec['approve_3'])!=0 and floatval($post['period_count'])>intval($spec['approve_3'])){
                    $res['approve'] = 3;
                }else*/if(isset($spec['approve_2']) and intval($spec['approve_2'])!=0 and floatval($post['period_count'])>intval($spec['approve_2'])){
                    $res['approve'] = 3;
                }elseif(isset($spec['approve_1']) and intval($spec['approve_1'])!=0 and floatval($post['period_count'])>intval($spec['approve_1'])){
                    $res['approve'] = 2;
                }else{
                    $res['approve'] = 1;
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

            $year_budget[0] = date('Y-10-01',strtotime('-1 year'));
            $year_budget[1] = date('Y-09-30');
            if(date('m')>=10 && date('m')<=12){
                $year_budget[0] = date('Y-10-01');
                $year_budget[1] = date('Y-09-30',strtotime('+1 year'));
            }

            $set=[];
            $set['where']   = '((period_start > "'.$year_budget[0].'" and period_start <= "'.$year_budget[1].'") or (period_end >= "'.$year_budget[0].'" and period_end < "'.$year_budget[1].'")) and (status >= 0 and  status <= 2) and personnel_id = "'.intval($post['personnel']).'"';
            $result         = $this->Leave_model->to_select($set);
            $weekend        = $this->get_weekend('php');

            $set = [];
            $spec_result = $this->Leave_spec_model->to_select($set);
            $spec_detail = [];
            foreach($spec_result as $key => $val){
                $spec_detail[$val['leave_type_id']][$val['emp_type_id']] = $val;
            }

            $leave = [];
            if(count($result)>0){
                foreach($result as $key => $val){

                    if(!isset($leave[$val['leave_type_id']])){
                        $leave[$val['leave_type_id']] = 0;
                    }

                    if($val['period_start']>=$year_budget[0] && $val['period_end']<=$year_budget[1]){
                        $day_count = 0;

                        for($i=0;$i<$val['period_count_all'];$i++){
                            $day = date('Y-m-d',strtotime($val['period_start'].' +'.$i.' day'));

                            if(isset($spec_detail[$val['leave_type_id']][intval($post['emp_type'])]) and $spec_detail[$val['leave_type_id']][intval($post['emp_type'])]['type_count']){
                                if(!isset($weekend[$day])){
                                    $day_count++;
                                }
                            }else{
                                $day_count++;
                            }
                        }
                        
                    }elseif($val['period_start']>$year_budget[0] and $val['period_start']<=$year_budget[1] and $val['period_end']>$year_budget[1]){ //วันสิ้นสุดวันลาไม่ต้องกลับช่วงวันที่เลือก
                        $day_count = 0;

                        for($i=0;$i<$val['period_count_all'];$i++){
                            $day = date('Y-m-d',strtotime($val['period_start'].' +'.$i.' day'));
                            if(date('Y-m',strtotime($day)) > date('Y-m',strtotime($year_budget[1]))){
                                break;
                            }else{
                                if(isset($spec_detail[$val['leave_type_id']][intval($post['emp_type'])]) and $spec_detail[$val['leave_type_id']][intval($post['emp_type'])]['type_count']){
                                    if(!isset($weekend[$day])){
                                        $day_count++;
                                    }
                                }else{
                                    $day_count++;
                                }
                            }
                        }
                    }elseif($val['period_end']<$year_budget[1] and $val['period_end']>=$year_budget[0] and $val['period_start']<$year_budget[0]){ //วันเริ่มวันลาไม่ต้องกลับช่วงวันที่เลือก
                        $day_count = 0;
                        for($i=0;$i<$val['period_count_all'];$i++){
                            $day = date('Y-m-d',strtotime($val['period_end'].' -'.$i.' day'));
                            if(date('Y-m',strtotime($day)) < date('Y-m',strtotime($year_budget[0]))){
                                break;
                            }else{
                                if(isset($spec_detail[$val['leave_type_id']][intval($post['emp_type'])]) and $spec_detail[$val['leave_type_id']][intval($post['emp_type'])]['type_count']){
                                    if(!isset($weekend[$day])){
                                        $day_count++;
                                    }
                                }else{
                                    $day_count++;
                                }
                            }
                        }
                    }

                    
                    if($day_count>=1){
                        if($val['period_start_half']==1){
                            $day_count-=0.5;
                        }
                        if($val['period_end_half']==1){
                            $day_count-=0.5;
                        }
                    }

                    $leave[$val['leave_type_id']] += $day_count;
                }
            }

            $count_year['limit'] = 0;
            $count_year['alert'][0] = $count_year['alert'][1] = 0;
            $count_year['rest_limit'][0] = $count_year['rest_limit'][1] = 0;

            if(intval($post['leave_type'])==2 || intval($post['leave_type'])==3 || intval($post['leave_type'])==4 || intval($post['leave_type'])==5 || intval($post['leave_type'])==6 || intval($post['leave_type'])==8 || intval($post['leave_type'])==10){
                if(isset($leave[2])){
                    $count_year['limit'] += $leave[2];
                }elseif(isset($leave[3])){
                    $count_year['limit'] += $leave[3];
                }elseif(isset($leave[4])){
                    $count_year['limit'] += $leave[4];
                }elseif(isset($leave[5])){
                    $count_year['limit'] += $leave[5];
                }elseif(isset($leave[6])){
                    $count_year['limit'] += $leave[6];
                }elseif(isset($leave[8])){
                    $count_year['limit'] += $leave[8];
                }elseif(isset($leave[10])){
                    $count_year['limit'] += $leave[10];
                }
                $count_year['limit'] += floatval($post['period_count']);
            }

            if(intval($post['leave_type'])==2 || intval($post['leave_type'])==10){
                if(isset($leave[2])){
                    $count_year['alert'][0] += $leave[2];
                }elseif(isset($leave[10])){
                    $count_year['alert'][0] += $leave[10];
                }
                $count_year['alert'][0] += floatval($post['period_count']);
            }

            if(intval($post['leave_type'])==2 || intval($post['leave_type'])==3 || intval($post['leave_type'])==6 || intval($post['leave_type'])==10){
                if(isset($leave[2])){
                    $count_year['alert'][1] += $leave[2];
                }elseif(isset($leave[3])){
                    $count_year['alert'][1] += $leave[3];
                }elseif(isset($leave[6])){
                    $count_year['alert'][1] += $leave[6];
                }elseif(isset($leave[10])){
                    $count_year['alert'][1] += $leave[10];
                }
                $count_year['alert'][1] +=floatval($post['period_count']);
            }
            if(intval($post['leave_type'])==1 || intval($post['leave_type'])==7){
                $this->load->model(['Leave_quota_model']);
                $set=[];
                $set['personnel_id']   = intval($post['personnel']);
                $result = $this->Leave_quota_model->get_last_quote($set);
                

                if(isset($result) && count($result)==1){
                    $count = isset($leave[1])?$leave[1]:0;
                    $count += isset($leave[7])?$leave[7]:0;
                    $count_year['rest_limit'][0] = $count+floatval($post['period_count']);
                    $count_year['rest_limit'][1] = $result[0]['quota_total'];
                }else{
                   $this->response([
                        'status' => false,
                        'msg' => 'Not have Quote'
                    ], REST_Controller::HTTP_OK); //200 
                }

            }
            
            $res['limit'] = 0;
            if(isset($spec['limit_year']) and intval($spec['limit_year'])>0 and floatval($count_year['limit'])>intval($spec['limit_year'])){
                $res['limit'] = intval($spec['limit_year']);
            }

            $res['rest_limit'] = 0;
            if($count_year['rest_limit'][0]>$count_year['rest_limit'][1]){
                $res['rest_limit'] = $count_year['rest_limit'][1];
            }

            $res['alert'][0] = 0;
            $res['alert'][1] = 0;
            if(isset($spec['salary_alert']) and intval($spec['salary_alert'])!=0 and floatval($count_year['alert'][0])>intval($spec['salary_alert'])){
                $res['alert'][0] = intval($spec['salary_alert']);
            }
            if(isset($spec['promotion_alert']) and intval($spec['promotion_alert'])!=0 and floatval($count_year['alert'][1])>intval($spec['promotion_alert'])){
                $res['alert'][1] = intval($spec['promotion_alert']);
            }

            $res['before'][0] = $res['before'][1] = 0;
            $startTimeStamp = strtotime(date("Y-m-d"));
            $endTimeStamp = strtotime($post['period_start']);
            $timeDiff = abs($endTimeStamp - $startTimeStamp);
            $numberDays = $timeDiff/86400;
            $numberDays = intval($numberDays);
            $day_before = 0;
            for($i=0;$i<$numberDays;$i++){
                $day = date('Y-m-d',strtotime(date('Y-m-d',$endTimeStamp).' -'.$i.' day'));
                if(!isset($weekend[$day])){
                    $day_before++;
                }
            }

            if(isset($spec['before_day']) and intval($spec['before_day'])!=0 and $day_before>intval($spec['before_day'])){
                $res['before'][0] = intval($spec['before_day']);
            }elseif(isset($spec['before_day_all']) and intval($spec['before_day_all'])!=0 and $numberDays>intval($spec['before_day_all'])){
                $res['before'][1] = intval($spec['before_day_all']);
            }

            $res['friend_approve'] = $spec['friend_approve'];

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


    function get_weekend($type=''){
        if($type==''){
            header('Content-Type: application/json');
        }

        $con = [];
        $con['where'] = 'status = 0';
        $con['array_key'] = true;

        if($type=='php'){
            return $this->Calendar_model->to_select($con);
        }else{
            echo ($type=='js'?'var date_fix = ':'').json_encode($this->Calendar_model->to_select($con));
        }

    }
}
