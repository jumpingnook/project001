<?php
require_once(APPPATH.'libraries/REST_Controller.php');
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends REST_Controller {

    public function __construct(){
		parent::__construct();
    }

    public function index_get(){
        #$get = $this->get();

        $this->response([
            'status' => TRUE,
            'message' => '555555'
        ], REST_Controller::HTTP_OK); // status 200

        // $set = [];
        // if(isset($get['select']) and is_array($get['select']) and count($get['select'])){
        //     foreach($get['select'] as $key=>$val){
        //         $set['select'][] = intval($val);
        //     }
        // }
        // if(isset($get['province']) and intval($get['province'])!=0){
        //     $set['province'] = intval($get['province']);
        // }
        // if(isset($get['bkk']) and $get['bkk']){
        //     $set['bkk'] = true;
        // }
        // $result = $this->Amphur_model->list_amphur($set);
        // if(!empty($result)):
        //     $this->response([
        //         'status' => TRUE,
        //         'response' => $result
        //     ], REST_Controller::HTTP_OK); // status 200
        // else:
        //     $this->response([
        //         'status' => FALSE,
        //         'message' => 'Not Found Data'
        //     ], REST_Controller::HTTP_NOT_FOUND); //404
        // endif;
    }
}
