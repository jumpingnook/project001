<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personnel extends CI_Controller {

    protected $session_data;

	function __construct(){
        parent::__construct();
        $this->load->library(['restclient']);
    }

    function index(){
        //ini_set('memory_limit', -1);
        // $this->load->model('sql_personnel/Sql_personnel_model');
        $this->load->model('personnel/Personnel_model');
        // $con = [];
        // $con['limit']	= '1,1';
        // $res = $this->Sql_personnel_model->sqlsrv_select($con);

        // echo count($res);exit;

        $res = file_get_contents('./View_HR_Personal_1.json');
        $res = json_decode($res,true);

        if(count($res)>0){
            foreach($res as $key=>$val){

                $set = [];
                $set['username'] 	    = isset($val['internetaccount'])?trim($val['internetaccount']):'';
                $set['personnel_code'] 	= isset($val['empcode'])?trim($val['empcode']):'';
                $set['title'] 			= isset($val['pname'])?trim($val['pname']):'';
                $set['name_th'] 		= isset($val['fname'])?trim($val['fname']):'';
                $set['surname_th'] 		= isset($val['lname'])?trim($val['lname']):'';
                $set['name_en'] 		= isset($val['engfname'])?trim($val['engfname']):'';
                $set['surname_en'] 		= isset($val['englname'])?trim($val['englname']):'';
                $set['nickname'] 		= isset($val['nickname'])?trim($val['nickname']):'';
                $set['brithdate'] 		= isset($val['birthday'])?date('Y-m-d H:i:s',strtotime($val['birthday'])):'0000-00-00';
                $set['id_card'] 		= isset($val['idcard'])?trim($val['idcard']):'';
                $set['internet_account'] = isset($val['internetaccount'])?trim($val['internetaccount']):'';
                $set['gender'] 			= isset($val['sex'])?trim($val['sex']):'';
                $set['phone'] 			= isset($val['mobile'])?preg_replace('/[^0-9]/', '', trim($val['mobile'])):'';
                $set['tel'] 			= isset($val['hometel'])?preg_replace('/[^0-9]/', '', trim($val['hometel'])):'';
                $set['internel_tel'] 	= isset($val['self_tel_in'])?preg_replace('/[^0-9]/', '', trim($val['self_tel_in'])):'';
                $set['email'] 			= isset($val['email'])?trim($val['email']):'';
                $set['address'] 		= isset($val['address'])?trim($val['address']):'';
                $set['img'] = '';
                $set['smu_main_id'] 	= isset($val['departname'])?trim($val['departname']):'';
		        $set['smu_sub_id'] 		= isset($val['subdepart'])?trim($val['subdepart']):'';
                // if(trim($val['picture'])!=''){
                //     $set['img'] = 'data:image/jpeg;base64,'.base64_encode($val['picture']);
                // }else{
                //     $set['img'] = '';
                // }

                echo '<pre>';print_r($this->Personnel_model->transfer_personnel_test($set));
            }
        }
        
    }

    function render_img($img=''){
        header("Content-Type: image/jpeg");
        echo $img;
    }

    function save_boss(){
        $this->load->model('personnel/Personnel_model');
        $this->load->model('personnel/Smu_model');
        $result = $this->Personnel_model->transfer_boss_test();
        $smu = $this->Smu_model->get_sub_smu();


        if(count($result)>0){
            foreach($result as $key=>$val){
                $code = explode('|',$val['code']);

                $personnel = $this->Personnel_model->get_personnel(['personnel_code'=>$val['personnel_code']]);

                if(count($code)>0){
                    foreach($code as $key2=>$val2){
                        if(trim($val2)!=''){
                            $code_smu = substr($val2,4);

                            if(isset($smu[$code_smu])){
                                $set = [];
                                $set['personnel_id']    = $personnel['data'][0]['personnel_id'];
                                $set['smu_main_id']     = $smu[$code_smu]['smu_main_id'];
                                $set['smu_sub_id']      = $smu[$code_smu]['smu_sub_id'];
                            }else{
                                $set = [];
                                $set['personnel_id']    = $personnel['data'][0]['personnel_id'];
                                $set['smu_main_id']     = $code_smu;
                                $set['smu_sub_id']      = 0;
                            }

                            $this->Personnel_model->save_boss($set);


                        }
                    }
                }
            }
        }
    }

}
