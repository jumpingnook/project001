<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Personnel_model extends MY_Model {

	protected $token_time = 25;

	function __construct(){
    	parent::__construct();
      	$this->load->database();
      	$this->table = 'hr_personnel';
	}

	function get_personnel($set = []){
		$res = ['count'=>0];

		if(isset($set['username']) and trim($set['username'])!=''){
			$con = [];
			$con['where'] = 'internet_account = "'.trim($set['username']).'"';
			$count = $this->to_count($con);
			
			if($count>0){
				$con['limit']	= '0,1';
				$res['data'] = $this->to_select($con);
				$res['count'] = $count;
			}
		}
		
		return $res;
	}

	function insert_personnel(){
		$res = [];

		#table personnel
		$con = [];
		$con['data']['token'] 			= '';
		$con['data']['personnel_code'] 	= '';
		$con['data']['title'] 			= '';
		$con['data']['name_th'] 		= '';
		$con['data']['surname_th'] 		= '';
		$con['data']['name_en'] 		= '';
		$con['data']['surname_en'] 		= '';
		$con['data']['nickname'] 		= '';
		$con['data']['brithdate'] 		= '';
		$con['data']['id_card'] 		= '';
		$con['data']['internet_account'] = '';
		$con['data']['gender'] 			= '';
		$con['data']['phone'] 			= '';
		$con['data']['tel'] 			= '';
		$con['data']['internal_tel'] 	= '';
		$con['data']['email'] 			= '';
		$con['data']['address'] 		= '';

		#table personnel promote
		$con = [];
		$con['data']['personnel_id'] 	= 0;
		$con['data']['personnel_code'] 	= '';
		$con['data']['personnel_type_id']	= 0;
		$con['data']['emp_type_id'] 	= 0;
		$con['data']['posit_type_id'] 	= 0;
		$con['data']['posit_level_id'] 	= 0;
		$con['data']['position_id'] 	= 0;
		$con['data']['smu_main_id'] 	= 0;
		$con['data']['smu_sub_id'] 		= 0;
		$con['data']['start'] 			= 0;
		$con['data']['end'] 			= 1;
		$con['data']['date'] 			= date('Y-m-d');
		$con['data']['create_date'] 	= date('Y-m-d H:i:s');
		$con['data']['status'] 			= 1;

		#table edu
		$con = [];
		$con['data']['personnel_id'] 	= 0;
		$con['data']['edu_type_id'] 	= 0;
		$con['data']['edu_name']		= '';
		$con['data']['department'] 		= '';
		$con['data']['institution'] 	= '';
		$con['data']['graduation_year'] = 0;
		$con['data']['create_date'] 	= date('Y-m-d H:i:s');
		$con['data']['status'] 			= 1;

		#table contact
		$con = [];
		$con['data']['personnel_id'] 	= 0;
		$con['data']['phone'] 			= '';
		$con['data']['tel']				= '';
		$con['data']['internal_tel'] 	= '';
		$con['data']['email'] 			= '';
		$con['data']['address'] 		= '';
		$con['data']['district_id'] 	= 0;
		$con['data']['amphur_id'] 		= 0;
		$con['data']['province_id'] 	= 0;
		$con['data']['zipcode'] 		= 0;
		$con['data']['create_date'] 	= date('Y-m-d H:i:s');
		$con['data']['status'] 			= 1;


	}

	
	
}