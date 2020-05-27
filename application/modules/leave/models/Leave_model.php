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

		$con = [];
		
		$sql = '';
		if(isset($set['personnel_id']) and intval($set['personnel_id'])!=0){
			if($sql!=''){
				$sql .= ' and (personnel_id = "'.intval($set['personnel_id']).'") ';
			}else{
				$sql = '(personnel_id = "'.intval($set['personnel_id']).'")';
			}
		}
		if(isset($set['leave_type_id']) and intval($set['leave_type_id'])!=0){
			if($sql!=''){
				$sql .= ' and (leave_type_id = "'.intval($set['leave_type_id']).'") ';
			}else{
				$sql = '(leave_type_id = "'.intval($set['leave_type_id']).'")';
			}
		}
		if(isset($set['leave_year']) and intval($set['leave_year'])!=0){
			if($sql!=''){
				$sql .= ' and (period_start LIKE "'.intval($set['leave_year']).'%") ';
			}else{
				$sql = '(period_start LIKE "'.intval($set['leave_year']).'%")';
			}
		}

		if(isset($set['hr']) and $set['hr']){
			if($sql!=''){
				$sql .= ' and (status > 1)';
			}else{
				$sql = '(status > 1)';
			}

			if(isset($set['leave_year_b']) and $set['leave_year_b'] and isset($set['leave_year']) and intval($set['leave_year'])!=0){
				if($sql!=''){
					$sql .= ' and (period_start LIKE "'.intval($set['leave_year']).'%" or period_start LIKE "'.(intval($set['leave_year'])-1).'%") ';
				}else{
					$sql = '(period_start LIKE "'.intval($set['leave_year']).'%" or period_start LIKE "'.(intval($set['leave_year'])-1).'%")';
				}
			}
			
		}

		$con['where'] 		= $sql;
		$con['order_by']	= 'leave_id DESC';
		$con['array_key']	= true;
		$res['data'] = $this->to_select($con);
		$res['count'] = count($res['data']);

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

	function last_leave($set=[]){
		$res = [];

		if(isset($set['leave_id'])){

			$sql = '';
			if(isset($set['leave_type']) and intval($set['leave_type'])>=2 and intval($set['leave_type'])<=4 and $sql==''){
				$sql = ' and (leave_type_id >=2 and leave_type_id <=4)';
			}
			if(isset($set['leave_type']) and intval($set['leave_type'])==1 and $sql==''){
				$sql = ' and (leave_type_id =1 or leave_type_id =7)';
			}
			if(isset($set['leave_type']) and intval($set['leave_type'])==7 and $sql==''){
				$sql = ' and leave_type_id =7';
			}
			

			$con = [];
			$con['where'] = 'leave_id <> "'.intval($set['leave_id']).'" and status = 2 '.$sql;
			$res = $this->to_select($con);

		}elseif(isset($set['last_leave_id'])){
			$con = [];
			$con['where'] = 'leave_id = "'.intval($set['last_leave_id']).'"';
			$res = $this->to_select($con);
		}

		return $res;
	}

	function save_approve($set=[]){

		if(count($set)>=4 and isset($set['personnel_id']) and isset($set['type']) and isset($set['leave_id'])and isset($set['approve']) and intval($set['personnel_id'])!=0 and intval($set['leave_id'])!=0 and intval($set['type'])!=0 and (intval($set['approve']) == 1 or intval($set['approve'])==2)){

			$con = [];
			$colum = '';

			if(isset($set['cancel']) and trim($set['cancel'])=='n29gknk626e3gh'){
				if(intval($set['type'])==2){
					$con['data']['signature_head_unit_cancel_date'] = date('Y-m-d H:i:s');
					$con['data']['head_unit_approve_cancel'] = intval($set['approve']);
					$colum = 'head_unit_personnel_id  = ';
				}elseif(intval($set['type'])==3){
					$con['data']['signature_head_dept_cancel_date'] = date('Y-m-d H:i:s');
					$con['data']['head_dept_approve_cancel'] = intval($set['approve']);
					$colum = 'head_dept_personnel_id  = ';
				}elseif(intval($set['type'])==4){
					$con['data']['signature_supervisor_cancel_date'] = date('Y-m-d H:i:s');
					$con['data']['supervisor_approve_cancel'] = intval($set['approve']);
					$colum = 'supervisor_personnel_id  = ';
				}elseif(intval($set['type'])==5){
					$con['data']['signature_deputy_dean_cancel_date'] = date('Y-m-d H:i:s');
					$con['data']['deputy_dean_approve_cancel'] = intval($set['approve']);
					$colum = 'deputy_dean_personnel_id  = ';
				}else{
					return false;
				}
			}else{
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
			}

			$colum = $colum!=''?' and '.$colum.intval($set['personnel_id']):'';

			$con['where'] = 'leave_id = "'.intval($set['leave_id']).'"'.$colum;

			$this->to_update($con);
			
			return true;

		}
		
		return false;

	}

	function send_approve($leave=0,$cancel=false){
		$con = [];
		$con['where'] = 'leave_id = "'.intval($leave).'"';
		$result = $this->to_select($con);

		if(count($result)>0 and $result[0]['status']==0){
			$con['data']['status'] = 1;
			$con['data']['send_mail_date'] = date('Y-m-d H:i:s');
			$this->to_update($con);
		}elseif(count($result)>0 and $cancel){
			$con['data']['send_mail_cancel_date'] = date('Y-m-d H:i:s');
			$this->to_update($con);
		}
	}

	function cancel($id=0,$type=0,$detail=''){
		if(intval($id)!=0 and intval($type)!=0){
			$con = [];
			$con['data']['status'] = intval($type)==98?98:99;

			if(intval($type)==98){
				$con['data']['cancel_detail'] = trim($detail);
			}

			$con['data']['cancel_date'] = date('Y-m-d H:i:s');
			$con['where'] = 'leave_id = "'.intval($id).'"';
			$this->to_update($con);

			return ['status'=>true];
		}else{
			return ['status'=>false];
		}
	}

	function leave_status($set=[]){
		if(isset($set['leave_id']) and intval($set['leave_id'])!=0 and isset($set['type']) and intval($set['type'])!=0){

			$con = [];
			$con['data']['status'] = intval($set['type']);
			$con['where'] = 'leave_id = "'.intval($set['leave_id']).'"';
			$this->to_update($con);

			return $con;
		}
	}

}