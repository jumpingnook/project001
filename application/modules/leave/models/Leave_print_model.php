<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave_print_model extends MY_Model {

	protected $url_print;

	function __construct(){
    	parent::__construct();
      	$this->load->database();
		$this->table = 'hr_leave_print';
		$this->url_print = base_url(url_index().'auth?dest=leave/check_print/');
	}

	function gen_token($set=[]){
		if(intval($set['leave_id'])!=0 and count($set['personnel'])!=0 and count($set['leave'])!=0){

			$token = $this->create_token_print();

			$con = [];
			$con['data']['personnel_print_id'] 	= $set['personnel']['personnel_id'];
			$con['data']['leave_id'] 			= intval($set['leave_id']);
			$con['data']['leave_no'] 			= $set['leave']['data']['leave_no'];
			$con['data']['personnel_id'] 		= $set['leave']['data']['personnel_id'];
			$con['data']['token'] 				= $token;
			$con['data']['url_qr'] 				= $this->url_print.$token;
			$con['data']['create_date'] 		= date('Y-m-d H:i:s');
			$this->to_insert($con);

			return ['token'=>$token, 'url'=>$con['data']['url_qr']];

		}

		return false;
	}

	function create_token_print($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		$con = [];
		$con['where'] = 'token = "'.$randomString.'"';
		$result = $this->to_select($con);

        return empty($result)?$randomString:$this->create_token_print();
	}
	
	function check_print($token = ''){

		if(trim($token)!=''){
			$con = [];
			$con['where'] = 'token = "'.$token.'"';
			$result = $this->to_select($con);
			
			if(count($result)!=0){
				return ['status'=>true, 'data'=>$result];
			}else{
				return ['status'=>false];
			}
		}

		return ['status'=>123];
	}

}