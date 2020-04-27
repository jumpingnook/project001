<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave_model extends MY_Model {

	protected $url_qr;

	function __construct(){
    	parent::__construct();
      	$this->load->database();
		$this->table = 'hr_leave';
		$this->url_qr = base_url(url_index().'option/signature/');
	}

	function url_qr($num = 16){
		$this->load->helper('string');
		$token = random_string('alnum', $num);
		$token = $this->url_qr.$token;
		$con = array();
		$con['where'] = 'url_personnel = "'.$token.'" or url_workmate = "'.$token.'" or url_boss = "'.$token.'"';
		$used = $this->to_select($con);
		return empty($used)?$token:$this->url_qr();
	}

	function save_leave($set=[]){
		if(count($set)>0){
            foreach($set as $key=>$val){
                if(trim($val)==''){
					return 0;
                }
            }
		}else{
			return 0;
		}

		$con['data'] = $set;
		$con['data']['create_date'] = date('Y-m-d H:i:s');
		$con['data']['status'] 		= 0;
		$con['data']['leave_no'] 	= $this->leave_no();
		$result = $this->to_insert_last_id($con);

		return $result;
		
	}

	function leave_no(){
		$con = [];
		$con['select']		= 'leave_no';
		$con['order_by'] 	= 'leave_id DESC';
		$con['limit']		= '0,1';
		$result = $this->to_select($con);

		if($result[0]['leave_no']!==''){

			$leave_no 	= $result[0]['leave_no'];
			$date_leave = substr($leave_no,0,6);
			$leave_no 	= substr($leave_no,6,4);

			if($date_leave!=date('ymd')){
				return date('ymd').'1001';
			}else{
				return date('ymd').(intval($leave_no)+1);
			}

		}else{
			return date('ymd').'1001';
		}
	}
}