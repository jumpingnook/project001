<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/REST_Controller.php');

class Api_v2 extends REST_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model(['leave/Calendar_model','auth/Token_model','leave/Leave_new_model','leave/Leave_spec_model']);
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

        $result = $this->Leave_new_model->save_leave($post['data']);
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

            $result = $this->Leave_new_model->leave_history(['personnel_id'=>intval($post['personnel_id'])]);
            $this->response([
                'status' => true,
                'data' => $result['data'],
                'count' => $result['count']
            ], REST_Controller::HTTP_OK); //200

        }elseif(isset($post['hr']) and $post['hr']){

            $result = $this->Leave_new_model->leave_history($post);
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

            $result = $this->Leave_new_model->view_leave(['leave_id'=>intval($post['leave_id'])]);
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

    function leave_spec_alert_post(){
        $post = $this->post();

        //$token = $this->check_token($post);

        if(isset($post['leave_type']) and isset($post['emp_type']) and isset($post['personnel']) and isset($post['day']) and intval($post['leave_type'])!=0 and intval($post['emp_type'])!=0 and intval($post['personnel'])!=0 and floatval($post['day'])!=0){

            $set = [];
            $set['leave_type_id']   = intval($post['leave_type']);
            $set['emp_type_id']     = intval($post['emp_type']);
            $spec = $this->Leave_spec_model->spec($set);

            $res = [];
            if(count($spec)!=0){
                $spec = $spec[0];
                $day_form = floatval($post['day']);

                if(intval($post['leave_type'])==1 or intval($post['leave_type'])==7){ //พักผ่อน && ตปท.
                    $this->load->model([
                        'personnel/Personnel_model',
                        'leave/Leave_quota_model'
                    ]);

                    $personnel = $this->Personnel_model->get_personnel(['personnel_id'=>intval($post['personnel'])]);
                    
                    if(isset($personnel['data']) and count($personnel['data'])==1){
                        $personnel = $personnel['data'][0];

                        $timeDiff = abs(strtotime($personnel['work_start_date']) - strtotime(date('Y-m-d')));
                        $numberDays = intval($timeDiff/86400)+1;

                        if($numberDays<=$spec['day_permission_unlock']){ //check day_permission_unlock
                            $this->response([
                                'status'    => true,
                                'msg'       => 'ไม่สามารถบันทึกได้เนื่องจากท่านยังมีอายุงานไม่ครบ '.$spec['day_permission_unlock'].' วัน กรุณาติดต่องานบริหารทรัพยากรบุคคล โทร. 7936',
                                'process'   => false,
                                'process_redirect' => '?status=validate_msg'
                            ], REST_Controller::HTTP_OK); //200
                        }

                        if((intval($post['emp_type'])>=1 and intval($post['emp_type'])<=6)){
                            $quota_total = $this->Leave_quota_model->get_last_quote(['personnel_id'=>intval($post['personnel'])]);
                            $quota_total = $quota_total[0]['quota_total'];

                            if($quota_total<$day_form){
                                $this->response([
                                    'status'    => true,
                                    'msg'       => 'ไม่สามารถบันทึกได้เนื่องจากท่านวันลาคงเหลือไม่เพียงพอ กรุณาติดต่องานบริหารทรัพยากรบุคคล โทร. 7936',
                                    'process'   => false,
                                    'process_redirect' => '?status=validate_msg'
                                ], REST_Controller::HTTP_OK); //200 
                            }
                        }
                        $this->response([
                            'status'    => true,
                            'to'        => 2,
                            'process'   => true
                        ], REST_Controller::HTTP_OK); //200
                    }
                }

                if(intval($post['leave_type'])==2 or intval($post['leave_type'])==3){ //ป่าว+กิจ
                    $set = [];
                    $set['personnel_id']    = intval($post['personnel']);
                    $set['leave_year']      = date('Y');
                    $history = $this->Leave_new_model->leave_history($set);

                    $count_day = 0.0;
                    if(count($history['data'])>0){
                        foreach($history['data'] as $key=>$val){
                            if(($val['leave_type_id']==3 or $val['leave_type_id']==4) and $val['status']<98){
                                $count_day += $val['period_count'];
                            }
                        }
                    }

                    $count_day += $day_form;

                    if(intval($post['emp_type'])==5 || intval($post['emp_type'])==6 || intval($post['emp_type'])==8){
                        if($day_form<=$spec['leave_fix_permission'] and $count_day<=$spec['leave_fix_permission']){ //alert
                            $this->response([
                                'status'    => true,
                                'to'        => 1,
                                'process'   => true
                            ], REST_Controller::HTTP_OK); //200
                        }elseif($count_day>$spec['leave_fix_permission']){ //alert+fix
                            $this->response([
                                'status'    => true,
                                'msg'       => 'ไม่สามารถบันทึกได้เนื่องจากเกินจำนวนการลารวมต่อปี ของประเภทลานี้ กรุณาติดต่องานบริหารทรัพยากรบุคคล โทร. 7936',
                                'process'   => false,
                                'process_redirect' => '?status=validate_msg'
                            ], REST_Controller::HTTP_OK); //200
                        }
                    }else{
                        if($day_form<$spec['leave_alert'] or $day_form==$spec['leave_alert']){ //alert
                            $this->response([
                                'status'    => true,
                                'msg'       => 'วันลาของท่านยังอยู่ในช่วง '.$spec['leave_alert'].' วัน การพิจารณาสูงสุดถึง "คณบดี"',
                                'to'        => 1,
                                'process'   => true
                            ], REST_Controller::HTTP_OK); //200
                        }elseif($day_form<=$spec['leave_fix_permission'] and $count_day<=$spec['leave_fix_permission']){ //alert
                            $this->response([
                                'status'    => true,
                                'alert'     => true,
                                'msg'       => 'วันลาของท่านยังอยู่ในช่วง '.$spec['leave_fix_permission'].' วัน การพิจารณาสูงสุดถึง "อธิการบดี"',
                                'to'        => 2,
                                'process'   => true
                            ], REST_Controller::HTTP_OK); //200
                        }elseif($count_day>$spec['leave_fix_permission']){ //alert+fix
                            $this->response([
                                'status'    => true,
                                'msg'       => 'ไม่สามารถบันทึกได้เนื่องจากเกินจำนวนการลารวม '.$spec['leave_fix_permission'].' วัน/ปี ของประเภทลานี้ กรุณาติดต่องานบริหารทรัพยากรบุคคล โทร. 7936',
                                'process'   => false,
                                'process_redirect' => '?status=validate_msg'
                            ], REST_Controller::HTTP_OK); //200
                        }
                    }
                }

                if(intval($post['leave_type'])==6){ //เลี้ยงบุตร
                    $set = [];
                    $set['personnel_id']    = intval($post['personnel']);
                    $set['leave_year']      = date('Y');
                    $history = $this->Leave_new_model->leave_history($set);

                    $count_day = 0.0;
                    if(count($history['data'])>0){
                        foreach($history['data'] as $key=>$val){
                            if($val['leave_type_id']==6 and $val['status']<98){
                                $count_day += $val['period_count'];
                            }
                        }
                    }

                    $count_day += $day_form;

                    if(intval($post['emp_type'])!=8){
                        if($day_form<=$spec['leave_fix_permission'] and $count_day<=$spec['leave_fix_permission']){ //alert
                            $this->response([
                                'status'    => true,
                                'to'        => 2,
                                'process'   => true
                            ], REST_Controller::HTTP_OK); //200
                        }elseif($count_day>$spec['leave_fix_permission']){ //alert+fix
                            $this->response([
                                'status'    => true,
                                'msg'       => 'ไม่สามารถบันทึกได้เนื่องจากเกินจำนวนการลารวม '.$spec['leave_fix_permission'].' วัน/ปี ของประเภทลานี้ กรุณาติดต่องานบริหารทรัพยากรบุคคล โทร. 7936',
                                'process'   => false,
                                'process_redirect' => '?status=validate_msg'
                            ], REST_Controller::HTTP_OK); //200
                        }
                    }

                    
                }

                if(intval($post['leave_type'])==5){ //ไปช่วยเมีที่คลอด

                    if(intval($post['emp_type'])!=5 and intval($post['emp_type'])!=6 and intval($post['emp_type'])!=8){
                        if($day_form>$spec['leave_fix']){ //alert
                            $this->response([
                                'status'    => true,
                                'msg'       => 'ไม่สามารถบันทึกได้เนื่องจากเกินจำนวนการลา '.$spec['leave_fix'].' วัน/ครั้ง ของประเภทลานี้ กรุณาติดต่องานบริหารทรัพยากรบุคคล โทร. 7936',
                                'process'   => false,
                                'process_redirect' => '?status=validate_msg'
                            ], REST_Controller::HTTP_OK); //200
                        }else{
                            $this->response([
                                'status'    => true,
                                'to'        => 1,
                                'process'   => true
                            ], REST_Controller::HTTP_OK); //200
                        }
                    }
                    
                }

                if(intval($post['leave_type'])==8){ //ไปบวช
                    if($day_form>$spec['leave_fix']){ //alert
                        $this->response([
                            'status'    => true,
                            'msg'       => 'ไม่สามารถบันทึกได้เนื่องจากเกินจำนวนการลา '.$spec['leave_fix'].' วัน/ครั้ง ของประเภทลานี้ กรุณาติดต่องานบริหารทรัพยากรบุคคล โทร. 7936',
                            'process'   => false,
                            'process_redirect' => '?status=validate_msg'
                        ], REST_Controller::HTTP_OK); //200
                    }else{
                        $this->response([
                            'status'    => true,
                            'to'        => 2,
                            'process'   => true
                        ], REST_Controller::HTTP_OK); //200
                    }
                }

                if(intval($post['leave_type'])==4){//คลอด

                    if($day_form>$spec['leave_fix']){
                        $this->response([
                            'status'    => true,
                            'msg'       => 'ไม่สามารถบันทึกได้เนื่องจากเกินจำนวนจำกัดในการลา '.$spec['leave_fix'].' วัน/ครั้ง ของประเภทลานี้ กรุณาติดต่องานบริหารทรัพยากรบุคคล โทร. 7936',
                            'process'   => false,
                            'process_redirect' => '?status=validate_msg'
                        ], REST_Controller::HTTP_OK); //200
                    }

                    if(intval($post['emp_type'])==5 || intval($post['emp_type'])==6){
                        $this->response([
                            'status'    => true,
                            'to'        => 2,
                            'process'   => true
                        ], REST_Controller::HTTP_OK); //200
                    }else{
                        $this->response([
                            'status'    => true,
                            'to'        => 1,
                            'process'   => true
                        ], REST_Controller::HTTP_OK); //200
                    }


                }

                if($post['leave_type']==9){//ทหาร
                    $this->response([
                        'status'    => true,
                        'to'        => 2,
                        'process'   => true
                    ], REST_Controller::HTTP_OK); //200
                }

            
            }else{ //not match leav_spec (leave_id & emp_type_id 5,6)
                $this->response([
                    'status'    => true,
                    'msg'       => 'ประเภทพนักงานของท่าน สามารถใช้สิทธิลาประเภทนี้ได้ กรุณาติดต่องานบริหารทรัพยากรบุคคล โทร. 7936',
                    'process'   => false,
                    'process_redirect' => '?status=validate_msg'
                ], REST_Controller::HTTP_OK); //200
            }

        }else{
            $this->response([
                'status' => false,
                'msg' => 'Invalid Data'
            ], REST_Controller::HTTP_OK); //200 
        }



        
    }




    
}
