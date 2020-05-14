<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave_model extends MY_Model {

	protected $url_approve;

	function __construct(){
    	parent::__construct();
      	$this->load->database();
		$this->table = 'hr_leave';
		$this->url_approve = base_url(url_index().'auth?dest=leave/approve/');
	}

	function url_approve($num = 16){
		$this->load->helper('string');
		$token = random_string('alnum', $num);
		$token = $this->url_approve.$token;
		$con = array();
		$con['where'] = 'url_workmate = "'.$token.'" or url_head_unit = "'.$token.'" or url_head_dept = "'.$token.'" or url_supervisor = "'.$token.'" or url_deputy_dean = "'.$token.'" or url_hr = "'.$token.'"';
		$used = $this->to_select($con);
		return empty($used)?$token:$this->url_approve();
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

		if(!isset($set['personnel_id']) || (isset($set['personnel_id']) and $set['personnel_id']==0)){
			unset($set['url_personnel']);
		}
		if(!isset($set['worker_personnel_id']) || (isset($set['worker_personnel_id']) and $set['worker_personnel_id']==0)){
			unset($set['url_workmate']);
		}
		if(!isset($set['head_unit_personnel_id']) || (isset($set['head_unit_personnel_id']) and $set['head_unit_personnel_id']==0)){
			unset($set['url_head_unit']);
		}
		if(!isset($set['head_dept_personnel_id']) || (isset($set['head_dept_personnel_id']) and $set['head_dept_personnel_id']==0)){
			unset($set['url_head_dept']);
		}
		if(!isset($set['supervisor_personnel_id']) || (isset($set['supervisor_personnel_id']) and $set['supervisor_personnel_id']==0)){
			unset($set['url_supervisor']);
		}
		if(!isset($set['deputy_dean_personnel_id']) || (isset($set['deputy_dean_personnel_id']) and $set['deputy_dean_personnel_id']==0)){
			unset($set['url_deputy_dean']);
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
			$con['where'] = 'url_workmate = "'.trim($set['signature']).'" or url_head_unit = "'.trim($set['signature']).'" or url_head_dept = "'.trim($set['signature']).'" or url_supervisor = "'.trim($set['signature']).'" or url_deputy_dean = "'.trim($set['signature']).'"';
			$result = $this->to_select($con);

			if(count($result)==1){
				$res['data'] = $result[0];
			}
		}

		return $res;
	}

	function save_approve($set=[]){

		

		if(count($set)==4 and isset($set['personnel_id']) and isset($set['type']) and isset($set['leave_id'])and isset($set['approve']) and intval($set['personnel_id'])!=0 and intval($set['leave_id'])!=0 and intval($set['type'])!=0 and (intval($set['approve']) == 1 or intval($set['approve'])==2)){

			$con = [];
			$colum = '';
			if(intval($set['type'])==1){
				$con['data']['signature_workmate_date'] = date('Y-m-d H:i:s');
				$con['data']['workmate_approve'] = intval($set['approve']);
				$colum = 'worker_personnel_id  = ';
			}elseif(intval($set['type'])==2){
				$con['data']['signature_head_unit_date'] = date('Y-m-d H:i:s');
				$con['data']['head_unit_approve'] = intval($set['approve']);
				$colum = 'head_unit_personnel_id  = ';
			}elseif(intval($set['type'])==3){
				$con['data']['signature_head_dept_date'] = date('Y-m-d H:i:s');
				$con['data']['head_dept_approve'] = intval($set['approve']);
				$colum = 'head_dept_personnel_id  = ';
			}elseif(intval($set['type'])==4){
				$con['data']['signature_supervisor_date'] = date('Y-m-d H:i:s');
				$con['data']['supervisor_approve'] = intval($set['approve']);
				$colum = 'supervisor_personnel_id  = ';
			}elseif(intval($set['type'])==5){
				$con['data']['signature_deputy_dean_date'] = date('Y-m-d H:i:s');
				$con['data']['deputy_dean_approve'] = intval($set['approve']);
				$colum = 'deputy_dean_personnel_id  = ';
			}else{
				return false;
			}

			$colum = $colum!=''?' and '.$colum.intval($set['personnel_id']):'';

			$con['where'] = 'leave_id = "'.intval($set['leave_id']).'"'.$colum;

			$this->to_update($con);
			
			return true;

		}
		
		return false;

	}
}