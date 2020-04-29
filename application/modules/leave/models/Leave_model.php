<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave_model extends MY_Model {

	protected $url_qr;

	function __construct(){
    	parent::__construct();
      	$this->load->database();
		$this->table = 'hr_leave';
		$this->url_qr = base_url(url_index().'auth?dest=leave/signature/');
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

	function leave_history($set=[]){
		
		$res = [];
		$res['count'] 	= 0;
		$res['data'] 	= [];

		if(isset($set['personnel_id']) and intval($set['personnel_id'])!=0){
			$con = [];
			$con['where'] 		= 'personnel_id = "'.intval($set['personnel_id']).'"';
			$con['order_by']	= 'leave_id DESC';
			$con['array_key']	= true;
			$res['data'] = $this->to_select($con);
			$res['count'] = count($res['data']);
		}

		return $res;
	}

	function view_leave($set=[]){
		$res['data'] = [];

		if(isset($set['leave_id']) and intval($set['leave_id'])>0){
			$con = [];
			$con['where'] = 'leave_id = "'.intval($set['leave_id']).'"';
			$result = $this->to_select($con);

			if(count($result)==1){
				$res['data'] = $result[0];
			}
		}elseif(isset($set['signature']) and trim($set['signature'])!=''){
			$con = [];
			$con['where'] = 'url_personnel = "'.trim($set['signature']).'" or url_workmate = "'.trim($set['signature']).'" or url_boss = "'.trim($set['signature']).'"';
			$result = $this->to_select($con);

			if(count($result)==1){
				$res['data'] = $result[0];
			}
		}

		return $res;
	}

	function save_signature($set=[]){

		if(count($set)==4 and isset($set['personnel_id']) and isset($set['type']) and isset($set['leave_id']) and isset($set['signature']) and intval($set['personnel_id'])!=0 and intval($set['leave_id'])!=0 and intval($set['type'])!=0){

			$con = [];
			if(intval($set['type'])==1){
				$con['data']['signature_personnel'] = isset($set['signature'])?trim($set['signature']):'';
				$con['data']['signature_personnel_date'] = date('Y-m-d H:i:s');
			}elseif(intval($set['type'])==2){
				$con['data']['signature_workmate'] = isset($set['signature'])?trim($set['signature']):'';
				$con['data']['signature_workmate_date'] = date('Y-m-d H:i:s');
			}elseif(intval($set['type'])==3){
				$con['data']['signature_boss'] = isset($set['signature'])?trim($set['signature']):'';
				$con['data']['signature_boss_date'] = date('Y-m-d H:i:s');
			}else{
				return false;
			}
			$con['where'] = 'leave_id = "'.intval($set['leave_id']).'"';
			$this->to_update($con);
			
			return true;

		}
		
		return false;

	}
}