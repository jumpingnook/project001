<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave_quota_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
		$this->table = 'hr_leave_quota';
	}

	function check_seed($set=[]){
		if(isset($set['personnel_id']) and intval($set['personnel_id'])!=0){

			$result = $this->get_last_quote(['personnel_id'=>intval($set['personnel_id'])]);

			if(count($result)==0){
				$this->save_quota(['personnel_id'=>intval($set['personnel_id']),'create_seed'=>true]);
			}else{
				$this->update_max_quota(['personnel_id'=>intval($set['personnel_id'])]);
			}

		}
	}

	function update_max_quota($set=[]){
		if(intval($set['personnel_id'])!=0){

			$this->load->model('personnel/Personnel_model');
			$con = [];
			$con['select']	= 'personnel_code, emp_type_id,work_start_date';
			$con['where'] 	= 'personnel_id = "'.intval($set['personnel_id']).'"';
			$personnel = $this->Personnel_model->to_select($con);

			$max = 0;

			#emp type
			$this->table = 'hr_emp_type';
			$con = [];
			$con['array_key']	= true;
			$emp_type = $this->to_select($con);

			if(isset($emp_type[$personnel[0]['emp_type_id']])){
				$count_job_exp = count_job_exp($personnel[0]['work_start_date']);
				if($count_job_exp['ten_year']){
					$max = $emp_type[$personnel[0]['emp_type_id']]['quota_max_year'];
				}else{
					$max = $emp_type[$personnel[0]['emp_type_id']]['quota_max'];
				}
			}

			$this->table = 'hr_leave_quota';
			$result = $this->get_last_quote(['personnel_id'=>intval($set['personnel_id'])]);

			if(count($result)>0){
				$con = [];
				$con['data']['quota_max'] 		= $max;
				$con['where']					= 'quota_id = "'.$result[0]['quota_id'].'"';

				$this->to_update($con);
			}
		}
	}

	function save_quota($set=[]){

		//create seed quota
		if(isset($set['create_seed']) and $set['create_seed'] and intval($set['personnel_id'])!=0){

			$this->load->model('personnel/Personnel_model');
			$con = [];
			$con['select']	= 'personnel_code, emp_type_id';
			$con['where'] 	= 'personnel_id = "'.intval($set['personnel_id']).'"';
			$personnel = $this->Personnel_model->to_select($con);
			$total = 10;
			$max = 0;

			#emp type
			$this->table = 'hr_emp_type';
			$con = [];
			$con['array_key']	= true;
			$emp_type = $this->to_select($con);

			if(isset($emp_type[$personnel[0]['emp_type_id']])){
				$count_job_exp = count_job_exp($personnel[0]['work_start_date']);
				if($count_job_exp['ten_year']){
					$max = $emp_type[$personnel[0]['emp_type_id']]['quota_max_year'];
				}else{
					$max = $emp_type[$personnel[0]['emp_type_id']]['quota_max'];
				}
			}

			if(count($personnel)>0){
				$this->table = 'tranfer_quota_20200930';
				$con = [];
				$con['where'] = 'personnel_code = "'.$personnel[0]['personnel_code'].'"';
				$result = $this->to_select($con);

				if(count($result)==1){
					$total 	= $result[0]['quota_total'];
					$max 	= $result[0]['quota_max'];
				}
			}

			$this->table = 'hr_leave_quota';
			$con = [];
			$con['data']['personnel_id'] 	= intval($set['personnel_id']);
			$con['data']['personnel_code'] 	= $personnel[0]['personnel_code'];
			$con['data']['quota_total'] 	= $total;
			$con['data']['quota_max'] 		= $max;
			$con['data']['create_date'] 	= date('Y-m-d H:i:s');
			$con['data']['status'] 			= 0;

			$this->to_insert($con);

		}elseif(isset($set['personnel_id']) and isset($set['leave_id']) and isset($set['quota_use']) and intval($set['personnel_id'])!=0 and intval($set['leave_id'])!=0 and floatval($set['quota_use'])!=0){

			$result = $this->get_last_quote(['personnel_id'=>intval($set['personnel_id'])]);

			if(count($result)>0){
				$con = [];
				$con['data']['personnel_id'] 	= intval($set['personnel_id']);
				$con['data']['leave_id'] 		= intval($set['leave_id']);
				$con['data']['quota_use'] 		= floatval($set['quota_use']);
				$con['data']['quota_total'] 	= floatval($result[0]['quota_total'])-floatval($set['quota_use']);
				$con['data']['create_date'] 	= date('Y-m-d H:i:s');
				$this->to_insert($con);
			}

		}

	}

	function get_last_quote($set=[]){
		if(isset($set['personnel_id']) and !isset($set['leave_id']) and intval($set['personnel_id'])!=0){
			$con = [];
			$con['where'] = 'personnel_id = "'.intval($set['personnel_id']).'" and status = 0';
			$con['limit'] = '0,1';
			$con['order_by'] = 'quota_id DESC';
			return $this->to_select($con);
		}
		if(isset($set['personnel_id']) and isset($set['leave_id']) and intval($set['personnel_id'])!=0 and intval($set['leave_id'])!=0){
			$con = [];
			$con['where'] = 'personnel_id = "'.intval($set['personnel_id']).'" and leave_id = "'.intval($set['leave_id']).'"';
			$con['limit'] = '0,1';
			$con['order_by'] = 'quota_id DESC';
			return $this->to_select($con);
		}
	}

	function cancel_quota($set=[]){
		if(isset($set['personnel_id']) and isset($set['leave_id']) and intval($set['personnel_id'])!=0 and intval($set['leave_id'])!=0){

			$con = [];
			$con['data']['status'] = 1;
			$con['data']['cancel_date'] = date('Y-m-d H:i:s');
			$con['data']['cancel_personnel_id'] = intval($set['personnel_id']);
			$con['where'] = 'leave_id = "'.intval($set['leave_id']).'"';
			$this->to_update($con);

			return true;
		}
		return false;
	}


}
