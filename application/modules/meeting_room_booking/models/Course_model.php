<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Course_model extends MY_Model {

	function __construct(){
    	parent::__construct();
      	$this->load->database();
      	$this->tb_default();
	}

	private function tb_default(){
		$this->table = 'idp_course';
	}

	function course($set=[]){
		$this->tb_default();
		$con = [];
		$con['where'] 		= 'status = 0';

		if(isset($set['id']) and !is_array($set['id'])){
			$con['where'] .= ' and course_id = "'.intval($set['id']).'"';
		}
		
		$con['order_by'] 	= 'course_id DESC';
		$con['array_key'] 	= true;
		return $this->to_select($con);
	}

	function course_tag_primary(){
		$this->table = 'idp_tag_group';
		$con = [];
		$con['where'] 		= 'tag_id = "99999" and status = 0';
		$con['order_by'] 	= 'group_id ASC';
		//$con = ['array_key'=>true];
		return $this->to_select($con);
	}

	function course_tag(){
		$this->table = 'idp_tag';
		$con = [];
		$con['order_by'] 	= 'tag_id ASC';
		$con = ['array_key'=>true];
		return $this->to_select($con);
	}

	function course_group_tag($set=[]){

		if(isset($set['course']) and intval($set['course'])!=0){
			$this->table = 'idp_tag_group';
			$con = [];
			$con['where'] 		= 'course_id = "'.intval($set['course']).'"';
			$con['order_by'] 	= 'group_id ASC';
			$con['array_key']  	= true;
			return $this->to_select($con);
		}

		return [];
	}

	function save_course($set=[]){
		$res = false;
		if(count($set)>0){
			$this->tb_default();
			$con = [];
			$con['data']['course_name'] 	= isset($set['course_name'])?$set['course_name']:'';
			$con['data']['course_detail'] 	= isset($set['course_detail'])?$set['course_detail']:'';
			$con['data']['course_type'] 	= isset($set['course_type'])?intval($set['course_type']):1;
			$con['data']['course_link'] 	= isset($set['course_link'])?$set['course_link']:'';
			$con['data']['form_link'] 		= isset($set['form_link'])?$set['form_link']:'';
			$con['data']['sheet_token'] 	= isset($set['sheet_token'])?$set['sheet_token']:'';
			$con['data']['create_date']		= date('Y-m-d H:i:s');
			$con['data']['update_date']		= date('Y-m-d H:i:s');
			$con['data']['status'] 			= 0;
			$course_id = $this->to_insert_last_id($con);

			if(intval($course_id)!=0){
				$this->table = 'idp_tag_group';
				if(isset($set['tag']) and count($set['tag'])>0){

				}else{ //default primary
					$con = [];
					$con['data']['course_id'] 	= $course_id;
					$con['data']['tag_id'] 		= '99999';
					$con['data']['create_date'] = date('Y-m-d H:i:s');;
					$con['data']['status'] 		= 0;
					$this->to_insert($con);

					$res = $course_id;
					return $res;
				}
			}

		}
		return $res;
	}

	function update_course($set=[]){
		$res = false;
		if(count($set)>0 and isset($set['course']) and intval($set['course'])!=0){
			$course_id = intval($set['course']);
			$this->tb_default();
			$con = [];
			$con['data']['course_name'] 	= isset($set['course_name'])?$set['course_name']:'';
			$con['data']['course_detail'] 	= isset($set['course_detail'])?$set['course_detail']:'';
			$con['data']['course_type'] 	= isset($set['course_type'])?intval($set['course_type']):1;
			$con['data']['course_link'] 	= isset($set['course_link'])?$set['course_link']:'';
			$con['data']['form_link'] 		= isset($set['form_link'])?$set['form_link']:'';
			$con['data']['sheet_token'] 	= isset($set['sheet_token'])?$set['sheet_token']:'';
			$con['data']['update_date']		= date('Y-m-d H:i:s');
			$con['where'] = 'course_id = "'.$course_id.'"';
			$result = $this->to_update($con);

			if($result){
				$res = $course_id;
				return $res;
			}

		}
		return $res;
	}

	function get_learning($set=[]){
		$res = [];
		$res['count'] = 0;
		$res['data'] = [];
		if(isset($set['personnel_id']) and isset($set['course_id']) and intval($set['course_id']!=0)){
			$course_id = intval($set['course_id']);
			$this->table = 'idp_course_set';
			$con = [];
			$con['where'] 		= 'course_id = "'.intval($set['course_id']).'" and personnel_id = "'.intval($set['personnel_id']).'"';
			$con['limit']  		= '0,1';
			$res['count'] = $this->to_count($con);

			if($res['count']==1){
				$res['data'] = $this->to_select($con);
			}
		}

		return $res;
	}

	function set_learning($set=[]){

		if(isset($set['personnel_id']) and isset($set['course_id'])){

			$result = $this->get_learning($set);

			if(intval($result['count'])==0){
				//insert
				$con = [];
				$con['data']['personnel_id'] 	= intval($set['personnel_id']);
				$con['data']['boss_personnel_id'] = isset($set['boss_personnel_id'])?intval($set['boss_personnel_id']):99999;
				$con['data']['course_id'] 		= intval($set['course_id']);
				$con['data']['status'] 			= isset($set['status'])?intval($set['status']):1;

				if($con['data']['status'] == 0){
					$con['data']['set_date'] 		= date('Y-m-d H:i:s');
				}elseif($con['data']['status'] == 1){
					$con['data']['start_date'] 		= date('Y-m-d H:i:s');
				}elseif($con['data']['status'] == 2){
					return false;
					$con['data']['end_date'] 		= date('Y-m-d H:i:s');
				}

				$this->to_insert($con);
				return true;

			}elseif(intval($result['count'])==1 and count($result['data'])>0 and isset($set['status']) and intval($set['status'])>0){

				//update
				$con = [];
				$con['data']['status'] 			= isset($set['status'])?intval($set['status']):1;
				$con['where'] = 'set_id = "'.intval($result['data'][0]['set_id']).'"';
				
				if($con['data']['status'] == 1 and $result['data'][0]['status']==0){
					$con['data']['start_date'] 		= date('Y-m-d H:i:s');
					$this->to_update($con);
				}elseif($con['data']['status'] == 2 and $result['data'][0]['status']>=1){
					$con['data']['end_date'] 		= date('Y-m-d H:i:s');
					$con['data']['file_upload']		= isset($set['file_upload'])?$set['file_upload']:'';
					$this->to_update($con);
				}
				

				return true;
			}

			return false;

		}
	}

	function enroll_history($set=[]){
		$res = [];
		if(isset($set['personnel_id']) and intval($set['personnel_id'])!=0){
			$this->table = 'idp_course_set';
			$con = [];
			$con['where'] 		= 'personnel_id = "'.intval($set['personnel_id']).'"';
			$con['array_key']   = 'course_id';
			return $this->to_select($con);

		}
	}	

	

}