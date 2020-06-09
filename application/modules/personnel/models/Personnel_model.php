<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Personnel_model extends MY_Model {

	protected $token_time = 25;
	protected $url_qr;

	function __construct(){
    	parent::__construct();
      	$this->load->database();
		$this->tb_default();
		$this->url_qr = base_url(url_index().'auth?dest=leave/signature/');
	}

	private function tb_default(){
		$this->table = 'hr_personnel';
	}

	function get_personnel($set = []){
		$this->tb_default();
		$res = ['count'=>0,'data'=>[],'process'=>false];
		$con = [];
		$sql_code = '';
		if(isset($set['personnel_list']) and count($set['personnel_list'])>0){
			foreach($set['personnel_list'] as $key=>$val){
				if(intval($val)>0){
					if($sql_code==''){
						$sql_code = 'personnel_id = "'.intval($val).'"';
					}else{
						$sql_code .= ' or personnel_id = "'.intval($val).'"';
					}
				}
			}
		}elseif(isset($set['username']) and trim($set['username'])!=''){
			$sql_code = 'internet_account LIKE "'.trim($set['username']).'"';
		}elseif(isset($set['personnel_id']) and intval($set['personnel_id'])!=0){
			$sql_code = 'personnel_id = "'.intval($set['personnel_id']).'"';
		}elseif(isset($set['personnel_code']) and trim($set['personnel_code'])!=''){
			$sql_code = 'personnel_code = "'.trim($set['personnel_code']).'"';
		}elseif(isset($set['smu_main_id']) and intval($set['smu_main_id'])!=0){
			$sql_code = 'smu_main_id = "'.intval($set['smu_main_id']).'"';
		}elseif(isset($set['url_signature']) and trim($set['url_signature'])!=''){
			$sql_code = 'url_signature = "'.trim($set['url_signature']).'"';
		}elseif(isset($set['term']) and trim($set['term'])!='' and strlen($set['term'])>=4){
			$con['select'] = 'personnel_id,position_boss,title,name_th,surname_th,email';
			$sql_code = '(name_th LIKE "'.trim($set['term']).'%") and email <> ""';
			$con['limit'] = '0,10';
		}elseif(isset($set['all']) and $set['all']){
			$con['select'] = 'personnel_id,position_boss,title,name_th,surname_th,email,smu_main_id,smu_sub_id,personnel_code';
			$sql_code = 'work_end_date is NULL or work_end_date = "0000-00-00 00:00:00"';
		}

		if($sql_code!=''){
			
			$con['where'] = $sql_code;
			$count = $this->to_count($con);
			
			if($count>0){
				//$con['limit']	= '0,1';
				if(isset($set['array_key']) and $set['array_key'] ){
					$con['array_key'] = true;
				}

				$res['data'] = $this->to_select($con);
				$res['count'] = $count;
				$res['process'] = true;
				$res['sql_on'] = true;
			}
		}
		
		return $res;
	}

	function transfer_personnel($set=[]){

		// $this->load->model([
		// 	'Subsmu_model',
		// 	'Position_model',
		// 	'Posit_level_model',
		// 	'Posit_type_model',
		// 	'Emp_type_model',
		// 	'Personnel_type_model',
		// 	'Edu_type_model',
		// 	'Personnel_edu_model',
		// 	'Personnel_contact_model',
		// 	'Personnel_promote_model'
		// ]);
		$this->tb_default();

		$res = ['status'=>false];

		if(isset($set['username']) and trim($set['username'])!=''){
			$result = $this->get_personnel($set['username']);
			if($result['count']!=0){
				return $res;
			}
		}else{
			return $res;
		}

		#table personnel
		$con = [];
		$con['data']['token'] 			= $this->user_token();
		$con['data']['personnel_code'] 	= isset($set['personnel_code'])?trim($set['personnel_code']):'';
		$con['data']['title'] 			= isset($set['title'])?trim($set['title']):'';
		$con['data']['name_th'] 		= isset($set['name_th'])?trim($set['name_th']):'';
		$con['data']['surname_th'] 		= isset($set['surname_th'])?trim($set['surname_th']):'';
		$con['data']['name_en'] 		= isset($set['name_en'])?trim($set['name_en']):'';
		$con['data']['surname_en'] 		= isset($set['surname_en'])?trim($set['surname_en']):'';
		$con['data']['nickname'] 		= isset($set['nickname'])?trim($set['nickname']):'';
		$con['data']['brithdate'] 		= isset($set['brithdate'])?date('Y-m-d H:i:s',strtotime($set['brithdate'])):'0000-00-00';
		$con['data']['id_card'] 		= isset($set['id_card'])?trim($set['id_card']):'';
		$con['data']['internet_account'] = isset($set['internet_account'])?trim($set['internet_account']):'';
		$con['data']['gender'] 			= isset($set['gender'])?trim($set['gender']):'';
		$con['data']['phone'] 			= isset($set['phone'])?trim($set['phone']):'';
		$con['data']['tel'] 			= isset($set['tel'])?trim($set['tel']):'';
		$con['data']['internal_tel'] 	= isset($set['internal_tel'])?trim($set['internal_tel']):'';
		$con['data']['email'] 			= isset($set['email'])?trim($set['email']):'';
		$con['data']['address'] 		= isset($set['address'])?trim($set['address']):'';

		$con['data']['img'] 			= isset($set['img'])?trim($set['img']):'';
		$con['data']['position_boss'] 	= isset($set['img'])?trim($set['position_boss']):'';
		$con['data']['smu_main_id'] 	= isset($set['smu_main_id'])?trim($set['smu_main_id']):'';
		$con['data']['smu_sub_id'] 		= isset($set['smu_sub_id'])?trim($set['smu_sub_id']):'';
		$con['data']['work_start_date'] = isset($set['work_start_date'])?trim($set['work_start_date']):'';
		$con['data']['work_end_date'] 	= isset($set['work_end_date'])?trim($set['work_end_date']):'';

		$con['data']['emp_type_id']		= isset($set['emp_type_id'])?intval($set['emp_type_id']):0;

		$res['personnel_id'] = $this->to_insert_last_id($con);

		if(intval($res['personnel_id'])==0){
			return $res;
		}
		
		// $personnel_type = $this->Personnel_type_model->get_type();
		// $type = true;
		// if(isset($set['type'])){
		// 	$type = 'pre_migrate';
		// }
		// $emp_type = $this->Emp_type_model->get_type($type);
		// $posit_type = $this->Posit_type_model->get_type($type);
		// $level = $this->Posit_level_model->get_level($type);
		// $position = $this->Position_model->get_position($type);
		// $edu_type = $this->Edu_type_model->get_edu();
		// $smu = $this->Subsmu_model->get_smu();

		#table personnel promote
		// $con = [];
		// $con['data']['personnel_id'] 	= $res['personnel_id'];
		// $con['data']['personnel_code'] 	= isset($set['personnel_code'])?trim($set['personnel_code']):'';
		// $con['data']['personnel_type_id']	= isset($set['personnel_type_id']) && isset($personnel_type[$set['personnel_type_id']])?$personnel_type[$set['personnel_type_id']]['personnel_type_id']:0;
		// $con['data']['emp_type_id'] 	= isset($set['emp_type_id']) && isset($emp_type[$set['emp_type_id']])?$emp_type[$set['emp_type_id']]['emp_type_id']:0;
		// $con['data']['posit_type_id'] 	= isset($set['posit_type_id']) && isset($posit_type[$set['posit_type_id']])?$posit_type[$set['posit_type_id']]['posit_type_id']:0;
		// $con['data']['posit_level_id'] 	= isset($set['posit_level_id']) && isset($level[$set['posit_level_id']])?$level[$set['posit_level_id']]['posit_level_id']:0;
		// $con['data']['position_id'] 	= isset($set['position_id']) && isset($position[$set['position_id']])?$position[$set['position_id']]['position_id']:0;
		// $con['data']['smu_group_id'] 	= isset($set['smu_sub_id']) && isset($smu[$set['smu_sub_id']])?$smu[$set['smu_sub_id']]['smu_group_id']:0;
		// $con['data']['smu_main_id'] 	= isset($set['smu_sub_id']) && isset($smu[$set['smu_sub_id']])?$smu[$set['smu_sub_id']]['smu_main_id']:0;
		// $con['data']['smu_sub_id'] 		= isset($set['smu_sub_id']) && isset($smu[$set['smu_sub_id']])?$smu[$set['smu_sub_id']]['smu_sub_id']:0;
		// $con['data']['start'] 			= 1;
		// $con['data']['end'] 			= 0;
		// $con['data']['date'] 			= isset($set['date'])?date('Y-m-d',strtotime($set['date'])):date('Y-m-d');
		// $con['data']['create_date'] 	= date('Y-m-d H:i:s');
		// $con['data']['status'] 			= 1;
		// $this->Personnel_promote_model->to_insert($con);

		#table edu
		// $con = [];
		// $con['data']['personnel_id'] 	= $res['personnel_id'];
		// $con['data']['edu_type_id'] 	= isset($set['edu_type_id']) && isset($edu_type[$set['edu_type_id']])?$edu_type[$set['edu_type_id']]['edu_type_id']:0;
		// $con['data']['edu_name']		= isset($set['edu_name'])?trim($set['edu_name']):'';
		// $con['data']['department'] 		= isset($set['department'])?trim($set['department']):'';
		// $con['data']['institution'] 	= isset($set['institution'])?trim($set['institution']):'';
		// $con['data']['graduation_year'] = isset($set['graduation_year'])?intval($set['graduation_year']):'';
		// $con['data']['create_date'] 	= date('Y-m-d H:i:s');
		// $con['data']['status'] 			= 1;
		//$this->Personnel_edu_model->to_insert($con);

		#table contact
		// $con = [];
		// $con['data']['personnel_id'] 	= $res['personnel_id'];
		// $con['data']['phone'] 			= isset($set['phone'])?trim($set['phone']):'';
		// $con['data']['tel']				= isset($set['tel'])?trim($set['tel']):'';
		// $con['data']['internel_tel'] 	= isset($set['internel_tel'])?trim($set['internel_tel']):'';
		// $con['data']['email'] 			= isset($set['email'])?trim($set['email']):'';
		// $con['data']['address'] 		= isset($set['address'])?trim($set['address']):'';
		// $con['data']['district_id'] 	= 0;
		// $con['data']['amphur_id'] 		= 0;
		// $con['data']['province_id'] 	= 0;
		// $con['data']['zipcode'] 		= 0;
		// $con['data']['create_date'] 	= date('Y-m-d H:i:s');
		// $con['data']['status'] 			= 1;
		// $this->Personnel_contact_model->to_insert($con);

		$res['status'] = true;
		return $res;
	}

	function transfer_update_personnel($set=[]){
		$this->tb_default();
		$res = ['status'=>false];

		if(isset($set['personnel_id']) and intval($set['personnel_id'])!=0){
			$result = $this->get_personnel($set['personnel_id']);
			if($result['count']!=0){
				return $res;
			}
		}else{
			return $res;
		}

		#table personnel
		$con = [];
		$con['data']['personnel_code'] 	= isset($set['personnel_code'])?trim($set['personnel_code']):'';
		$con['data']['title'] 			= isset($set['title'])?trim($set['title']):'';
		$con['data']['name_th'] 		= isset($set['name_th'])?trim($set['name_th']):'';
		$con['data']['surname_th'] 		= isset($set['surname_th'])?trim($set['surname_th']):'';
		$con['data']['name_en'] 		= isset($set['name_en'])?trim($set['name_en']):'';
		$con['data']['surname_en'] 		= isset($set['surname_en'])?trim($set['surname_en']):'';
		$con['data']['nickname'] 		= isset($set['nickname'])?trim($set['nickname']):'';
		$con['data']['brithdate'] 		= isset($set['brithdate'])?date('Y-m-d H:i:s',strtotime($set['brithdate'])):'0000-00-00';
		$con['data']['id_card'] 		= isset($set['id_card'])?trim($set['id_card']):'';
		$con['data']['internet_account'] = isset($set['internet_account'])?trim($set['internet_account']):'';
		$con['data']['gender'] 			= isset($set['gender'])?trim($set['gender']):'';
		$con['data']['phone'] 			= isset($set['phone'])?trim($set['phone']):'';
		$con['data']['tel'] 			= isset($set['tel'])?trim($set['tel']):'';
		$con['data']['internal_tel'] 	= isset($set['internal_tel'])?trim($set['internal_tel']):'';
		$con['data']['email'] 			= isset($set['email'])?trim($set['email']):'';
		$con['data']['address'] 		= isset($set['address'])?trim($set['address']):'';
		$con['data']['img'] 			= isset($set['img'])?trim($set['img']):'';
		$con['data']['position_boss'] 	= isset($set['img'])?trim($set['position_boss']):'';
		$con['data']['smu_main_id'] 	= isset($set['smu_main_id'])?trim($set['smu_main_id']):'';
		$con['data']['smu_sub_id'] 		= isset($set['smu_sub_id'])?trim($set['smu_sub_id']):'';
		$con['data']['work_start_date'] = isset($set['work_start_date'])?trim($set['work_start_date']):'';
		$con['data']['work_end_date'] 	= isset($set['work_end_date'])?trim($set['work_end_date']):'';

		$con['data']['emp_type_id']		= isset($set['emp_type_id'])?intval($set['emp_type_id']):0;

		$con['where'] 					= 'personnel_id = '.intval($set['personnel_id']);
		$result = $this->to_update($con);

		if(!$result){
			return $res;
		}

		$res['status'] = true;
		return $res;
	}

	function transfer_personnel_test($set=[]){

		$this->table = 'hr_personnel_clone';

		// $this->load->model([
		// 	'Subsmu_model',
		// 	'Position_model',
		// 	'Posit_level_model',
		// 	'Posit_type_model',
		// 	'Emp_type_model',
		// 	'Personnel_type_model',
		// 	'Edu_type_model',
		// 	'Personnel_edu_model',
		// 	'Personnel_contact_model',
		// 	'Personnel_promote_model'
		// ]);

		$res = ['status'=>false];

		// if(isset($set['username']) and trim($set['username'])!=''){
		// 	$result = $this->get_personnel($set['username']);
		// 	if($result['count']!=0){
		// 		return $res;
		// 	}
		// }else{
		// 	return $res;
		// }

		#table personnel
		$con = [];
		$con['data']['token'] 			= $this->user_token();
		$con['data']['personnel_code'] 	= isset($set['personnel_code'])?trim($set['personnel_code']):'';
		$con['data']['title'] 			= isset($set['title'])?trim($set['title']):'';
		$con['data']['name_th'] 		= isset($set['name_th'])?trim($set['name_th']):'';
		$con['data']['surname_th'] 		= isset($set['surname_th'])?trim($set['surname_th']):'';
		$con['data']['name_en'] 		= isset($set['name_en'])?trim($set['name_en']):'';
		$con['data']['surname_en'] 		= isset($set['surname_en'])?trim($set['surname_en']):'';
		$con['data']['nickname'] 		= isset($set['nickname'])?trim($set['nickname']):'';
		$con['data']['brithdate'] 		= isset($set['brithdate'])?date('Y-m-d H:i:s',strtotime($set['brithdate'])):'0000-00-00';
		$con['data']['id_card'] 		= isset($set['id_card'])?trim($set['id_card']):'';
		$con['data']['internet_account'] = isset($set['internet_account'])?trim($set['internet_account']):'';
		$con['data']['gender'] 			= isset($set['gender'])?trim($set['gender']):'';
		$con['data']['phone'] 			= isset($set['phone'])?trim($set['phone']):'';
		$con['data']['tel'] 			= isset($set['tel'])?trim($set['tel']):'';
		$con['data']['internal_tel'] 	= isset($set['internal_tel'])?trim($set['internal_tel']):'';
		$con['data']['email'] 			= isset($set['email'])?trim($set['email']):'';
		$con['data']['address'] 		= isset($set['address'])?trim($set['address']):'';
		$con['data']['img'] 			= isset($set['img'])?trim($set['img']):'';
		$con['data']['smu_main_id'] 	= isset($set['smu_main_id'])?substr($set['smu_main_id'],0,6):'';
		$con['data']['smu_sub_id'] 		= isset($set['smu_sub_id'])?substr($set['smu_sub_id'],0,6):'';
		$res['personnel_id'] = $this->to_insert_last_id($con);

		if(intval($res['personnel_id'])==0){
			return $res;
		}
		
		// $personnel_type = $this->Personnel_type_model->get_type();
		// $type = true;
		// if(isset($set['type'])){
		// 	$type = 'pre_migrate';
		// }
		// $emp_type = $this->Emp_type_model->get_type($type);
		// $posit_type = $this->Posit_type_model->get_type($type);
		// $level = $this->Posit_level_model->get_level($type);
		// $position = $this->Position_model->get_position($type);
		// $edu_type = $this->Edu_type_model->get_edu();
		// $smu = $this->Subsmu_model->get_smu();

		#table personnel promote
		// $con = [];
		// $con['data']['personnel_id'] 	= $res['personnel_id'];
		// $con['data']['personnel_code'] 	= isset($set['personnel_code'])?trim($set['personnel_code']):'';
		// $con['data']['personnel_type_id']	= isset($set['personnel_type_id']) && isset($personnel_type[$set['personnel_type_id']])?$personnel_type[$set['personnel_type_id']]['personnel_type_id']:0;
		// $con['data']['emp_type_id'] 	= isset($set['emp_type_id']) && isset($emp_type[$set['emp_type_id']])?$emp_type[$set['emp_type_id']]['emp_type_id']:0;
		// $con['data']['posit_type_id'] 	= isset($set['posit_type_id']) && isset($posit_type[$set['posit_type_id']])?$posit_type[$set['posit_type_id']]['posit_type_id']:0;
		// $con['data']['posit_level_id'] 	= isset($set['posit_level_id']) && isset($level[$set['posit_level_id']])?$level[$set['posit_level_id']]['posit_level_id']:0;
		// $con['data']['position_id'] 	= isset($set['position_id']) && isset($position[$set['position_id']])?$position[$set['position_id']]['position_id']:0;
		// $con['data']['smu_group_id'] 	= isset($set['smu_sub_id']) && isset($smu[$set['smu_sub_id']])?$smu[$set['smu_sub_id']]['smu_group_id']:0;
		// $con['data']['smu_main_id'] 	= isset($set['smu_sub_id']) && isset($smu[$set['smu_sub_id']])?$smu[$set['smu_sub_id']]['smu_main_id']:0;
		// $con['data']['smu_sub_id'] 		= isset($set['smu_sub_id']) && isset($smu[$set['smu_sub_id']])?$smu[$set['smu_sub_id']]['smu_sub_id']:0;
		// $con['data']['start'] 			= 1;
		// $con['data']['end'] 			= 0;
		// $con['data']['date'] 			= isset($set['date'])?date('Y-m-d',strtotime($set['date'])):date('Y-m-d');
		// $con['data']['create_date'] 	= date('Y-m-d H:i:s');
		// $con['data']['status'] 			= 1;
		// $this->Personnel_promote_model->to_insert($con);

		#table edu
		// $con = [];
		// $con['data']['personnel_id'] 	= $res['personnel_id'];
		// $con['data']['edu_type_id'] 	= isset($set['edu_type_id']) && isset($edu_type[$set['edu_type_id']])?$edu_type[$set['edu_type_id']]['edu_type_id']:0;
		// $con['data']['edu_name']		= isset($set['edu_name'])?trim($set['edu_name']):'';
		// $con['data']['department'] 		= isset($set['department'])?trim($set['department']):'';
		// $con['data']['institution'] 	= isset($set['institution'])?trim($set['institution']):'';
		// $con['data']['graduation_year'] = isset($set['graduation_year'])?intval($set['graduation_year']):'';
		// $con['data']['create_date'] 	= date('Y-m-d H:i:s');
		// $con['data']['status'] 			= 1;
		//$this->Personnel_edu_model->to_insert($con);

		#table contact
		// $con = [];
		// $con['data']['personnel_id'] 	= $res['personnel_id'];
		// $con['data']['phone'] 			= isset($set['phone'])?trim($set['phone']):'';
		// $con['data']['tel']				= isset($set['tel'])?trim($set['tel']):'';
		// $con['data']['internel_tel'] 	= isset($set['internel_tel'])?trim($set['internel_tel']):'';
		// $con['data']['email'] 			= isset($set['email'])?trim($set['email']):'';
		// $con['data']['address'] 		= isset($set['address'])?trim($set['address']):'';
		// $con['data']['district_id'] 	= 0;
		// $con['data']['amphur_id'] 		= 0;
		// $con['data']['province_id'] 	= 0;
		// $con['data']['zipcode'] 		= 0;
		// $con['data']['create_date'] 	= date('Y-m-d H:i:s');
		// $con['data']['status'] 			= 1;
		// $this->Personnel_contact_model->to_insert($con);

		$res['status'] = true;
		return $res;
	}

	function transfer_boss_test($set=[]){

		$this->table = 'tarnfer';
		$con = [];
		return $this->to_select($con);

	}

	function get_boss($set=[]){
		$res = ['count'=>0,'data'=>[]];

		if(isset($set['smu_main_id'])){

			$this->table = 'hr_personnel_boss';
			$con = [];
			$con['where'] = 'smu_main_id = "'.intval($set['smu_main_id']).'"';
			$con['array_key'] =	'personnel_id';
			$res['data'] = $this->to_select($con);
			$res['count'] = count($res['data']);

		}

		return $res;
	}

	function save_boss($set=[]){
		$res = 0;

		$this->table = 'hr_personnel_boss';

		if(isset($set['personnel_id']) and isset($set['smu_main_id'])){
			$con = [];
			$con['data']['personnel_id'] 	= intval($set['personnel_id']);
			$con['data']['smu_main_id'] 	= intval($set['smu_main_id']);
			$con['data']['smu_sub_id'] 		= isset($set['smu_sub_id'])?intval($set['smu_sub_id']):0;
			$con['data']['create_date'] 	= date('Y-m-d H:i:s');
			$con['data']['status'] 			= 0;
			$res = $this->to_insert_last_id($con);
			return $res;
		}
	}

	function url_qr_personnel($personnel_id=0,$num = 16){
		$this->load->helper('string');
		$token = random_string('alnum', $num);
		$token = $this->url_qr.$token;

		$con = array();
		$con['where'] = 'url_signature = "'.$token.'"';
		$used = $this->to_select($con);

		if(empty($used)){

			$con = array();
			$con['data']['url_signature'] = $token;
			$con['where'] = 'personnel_id = "'.$personnel_id.'"';
			$this->to_update($con);

			return $token;
		}else{
			return $this->url_qr();
		}
	}

	function save_signature_personnel($set=[]){

		if(count($set)==2 and isset($set['personnel_id']) and isset($set['signature']) and intval($set['personnel_id'])!=0 ){

			$con = [];
			$con['data']['signature'] = isset($set['signature'])?trim($set['signature']):'';
			$con['where'] = 'personnel_id = "'.intval($set['personnel_id']).'"';
			$this->to_update($con);
			
			return true;

		}
		
		return false;

	}

	function update_email($set=[]){
		if(isset($set['personnel_id']) and intval($set['personnel_id'])!=0){
			$con = [];
			$con['data']['email'] = isset($set['email'])?$set['email']:'';
			$con['where'] = 'personnel_id = '.intval($set['personnel_id']);
			$this->to_update($con);
			return true;
		}
		return false;
	}
	
}