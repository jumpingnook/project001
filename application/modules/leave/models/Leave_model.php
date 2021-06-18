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
		$con['where'] = 'url_personnel_1 = "'.$token.'" or url_personnel_2 = "'.$token.'" or url_personnel_2 = "'.$token.'" or url_personnel_3 = "'.$token.'" or url_personnel_4 = "'.$token.'" or url_personnel_5 = "'.$token.'"';
		$used = $this->to_select($con);
		return empty($used)?$token:$this->url_approve();
	}

	function save_leave($set=[],$update=0){

		if(count($set)>0){
            foreach($set as $key=>$val){
                if(trim($val)==''){
					return 0;
                }
            }
		}else{
			return 0;
		}

		$url_p1 = $set['url_personnel_1'];

		if(!isset($set['personnel_id']) || (isset($set['personnel_id']) and $set['personnel_id']==0)){
			unset($set['url_personnel']);
		}

		for($i=1;$i<=5;$i++){
			if(!isset($set['personnel_id_'.$i]) || (isset($set['personnel_id_'.$i]) and $set['personnel_id_'.$i]==0)){
				unset($set['url_personnel_'.$i]);
			}
		}

		$con['data'] = $set;
		$con['data']['create_date'] 	= date('Y-m-d H:i:s');
		$con['data']['leave_no'] 		= $this->leave_no();
		$con['data']['status'] 			= 0;
		$con['data']['emergency_note'] 	= isset($set['emergency_note']) && trim($set['emergency_note'])!=''?trim($set['emergency_note']):'';
		$con['data']['url_personnel_1'] 	= $url_p1;

		if(intval($update)!=0){

			$con2 = [];
			$con2['where'] = 'leave_id = '.intval($update);
			$old = $this->to_select($con2);
			
			
			if($con['data']['leave_type_id'] == 4 || $con['data']['leave_type_id'] == 5){
				$con['data']['assign_history_personnel_6'] = isset($old[0]['assign_history_personnel_6']) && trim($old[0]['assign_history_personnel_6'])!=''?$old[0]['assign_history_personnel_6'].$set['personnel_id_6'].',':$set['personnel_id_6'].',';
			}else{
				$con['data']['assign_history_personnel_5'] = isset($old[0]['assign_history_personnel_5']) && trim($old[0]['assign_history_personnel_5'])!=''?$old[0]['assign_history_personnel_5'].$set['personnel_id_5'].',':$set['personnel_id_5'].',';
			}

			unset($con['data']['edit_leave_id']);
			unset($con['data']['create_date']);
			unset($con['data']['leave_no']);
			unset($con['data']['status']);
			$con['where'] = 'leave_id = '.intval($update);
			$result = $this->to_update($con);
		}else{

			if($con['data']['leave_type_id'] == 4 || $con['data']['leave_type_id'] == 5){
				$con['data']['assign_history_personnel_6'] = $set['personnel_id_6'].',';
			}else{
				$con['data']['assign_history_personnel_5'] = $set['personnel_id_5'].',';
			}

			$result = $this->to_insert_last_id($con);
		}

		return $result;
	}

	function leave_no(){
		$con = [];
		$con['select']		= 'leave_no';
		$con['order_by'] 	= 'leave_id DESC';
		$con['limit']		= '0,1';
		$result = $this->to_select($con);

		if(isset($result[0]['leave_no']) and $result[0]['leave_no']!==''){

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

			

			if(isset($set['leave_year_b']) and $set['leave_year_b'] and isset($set['leave_year']) and intval($set['leave_year'])!=0){
				$sql = '';
				if($sql!=''){
					$sql .= ' and (period_start LIKE "'.intval($set['leave_year']).'%" or period_start LIKE "'.(intval($set['leave_year'])-1).'%" or period_start LIKE "'.(intval($set['leave_year'])+1).'%")';
				}else{
					$sql = '(period_start LIKE "'.intval($set['leave_year']).'%" or period_start LIKE "'.(intval($set['leave_year'])-1).'%" or period_start LIKE "'.(intval($set['leave_year'])+1).'%")';
				}
			}elseif(isset($set['start_date']) and isset($set['end_date'])){
				$start = $set['start_date'];
				$end = $set['end_date'];
				if($set['start_date'] > $set['end_date']){
					$start = $set['end_date']; 
					$end = $set['start_date'];
				}

				if($sql!=''){
					$sql .= ' and ((period_start >= "'.$start.' 00:00:00" and period_start <= "'.$end.' 23:59:59") or (period_end >= "'.$start.' 00:00:00" and period_end <= "'.$end.' 23:59:59") or (period_start <= "'.$start.' 00:00:00" and period_end >= "'.$end.' 23:59:59") or (period_start <= "'.$start.' 00:00:00" and period_end >= "'.$end.' 23:59:59")) ';
				}else{
					$sql = '((period_start >= "'.$start.' 00:00:00" and period_start <= "'.$end.' 23:59:59") or (period_end >= "'.$start.' 00:00:00" and period_end <= "'.$end.' 23:59:59") or (period_start <= "'.$start.' 00:00:00" and period_end >= "'.$end.' 23:59:59"))';
				}
			}elseif(isset($set['leave_year']) and intval($set['leave_year'])!=0){
				if($sql!=''){
					$sql .= ' and (period_start LIKE "'.intval($set['leave_year']).'%") ';
				}else{
					$sql = '(period_start LIKE "'.intval($set['leave_year']).'%")';
				}
			}

			if(isset($set['status'])){
				if($sql!=''){
					$sql .= ' and (status = '.intval($set['status']).')';
				}else{
					$sql = '(status = '.intval($set['status']).')';
				}
			}else{
				if($sql!=''){
					$sql .= ' and (status >= 1)';
				}else{
					$sql = '(status >= 1)';
				}
			}

		}

		$con['where'] 		= $sql;
		$con['order_by']	= 'leave_id DESC';
		$con['array_key']	= isset($set['array_key'])?$set['array_key']:true;
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
			$con['where'] = 'url_personnel_1 = "'.trim($set['signature']).'" or url_personnel_2 = "'.trim($set['signature']).'" or url_personnel_3 = "'.trim($set['signature']).'" or url_personnel_4 = "'.trim($set['signature']).'" or url_personnel_5 = "'.trim($set['signature']).'" or url_personnel_6 = "'.trim($set['signature']).'"';
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
				$sql = ' and ((leave_type_id >=2 and leave_type_id <=4) or leave_type_id = 10)';
			}
			if(isset($set['leave_type']) and intval($set['leave_type'])==1 and $sql==''){
				$sql = ' and (leave_type_id =1 or leave_type_id =7)';
			}
			if(isset($set['leave_type']) and intval($set['leave_type'])==7 and $sql==''){
				$sql = ' and leave_type_id =7';
			}
			if(isset($set['leave_type']) and intval($set['leave_type'])==10 and $sql==''){
				$sql = ' and leave_type_id =10';
			}

			$sql_p = '';
			if(isset($set['personnel_id']) and intval($set['personnel_id'])!=0){
				$sql_p .= 'personnel_id = "'.intval($set['personnel_id']).'" and ';
			}
			
			$con = [];
			$con['where'] = $sql_p.'leave_id <> "'.intval($set['leave_id']).'" and status = 2 '.$sql;
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
				if(intval($set['type'])>=2 and intval($set['type'])<=6){
					$con['data']['signature_cancel_date_personnel_'.intval($set['type'])] = date('Y-m-d H:i:s');
					$con['data']['approve_cancel_personnel_'.intval($set['type'])] = intval($set['approve']);
					$colum = 'personnel_id_'.intval($set['type']).'  = ';
				}else{
					return false;
				}
			}else{
				if(intval($set['type'])>=1 and intval($set['type'])<=6){
					$con['data']['signature_date_personnel_'.intval($set['type'])] = date('Y-m-d H:i:s');
					$con['data']['approve_personnel_'.intval($set['type'])] = intval($set['approve']);
					$con['data']['note_personnel_5'] = isset($set['note_personnel_5'])?$set['note_personnel_5']:'';
					$colum = 'personnel_id_'.intval($set['type']).'  = ';
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

	function approve_hr($set=[]){
		if(isset($set['leave']) and intval($set['leave'])!=0 and isset($set['hr']) and intval($set['hr'])!=0 and isset($set['type']) and intval($set['type'])!=0){
			$con = [];
			//sanan
			//$con['data']['hr_personnel_id'] = intval($set['hr']);
			$con['data']['hr_personnel_id'] = 1692;
			$con['data']['signature_hr_date'] = date('Y-m-d H:i:s');
			$con['data']['hr_approve'] = intval($set['type']);
			$con['where'] = 'leave_id = "'.intval($set['leave']).'"';
			$this->to_update($con);
			
			return $con;
		}
	}

	function list_approve($set=[]){
		$res = ['count'=>0,'data'=>[]];
		if(isset($set['personnel_id']) and intval($set['personnel_id'])!=0){
			$con = [];
			$con['where'] = '(personnel_id_1 = "'.intval($set['personnel_id']).'" or personnel_id_2 = "'.intval($set['personnel_id']).'" or personnel_id_3 = "'.intval($set['personnel_id']).'" or personnel_id_4 = "'.intval($set['personnel_id']).'" or personnel_id_5 = "'.intval($set['personnel_id']).'") and status = 1';
			$res['data'] = $this->to_select($con);
			$res['count'] = count($res['data']);

			return $this->to_select($con);
		}

		return $res;
	}

	function delete_file($id=0){
		$con = [];
		$con['data']['file'] = '';
		$con['data']['file_name'] = '';
		$con['data']['file_type'] = '';
		$con['where'] = 'leave_id = '.intval($id);
		$this->to_update($con);
	}

}