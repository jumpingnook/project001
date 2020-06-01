<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sql_personnel_model extends SQL_Model {

	function __construct(){
    	parent::__construct();
		$this->db_sql = $this->load->database('sqlsrv',true);
      	$this->table = 'View_HR_Personal';
	}

	function get_personnel($set = []){
		$res = ['count'=>0];

		if(isset($set['username']) and trim($set['username'])!=''){
			$con = [];
			$con['where']	= "internetaccount = '".trim($set['username'])."'";
			$count = $this->sqlsrv_count($con);
			
			if($count>0){
				$con['limit']	= '0,1';
				$res['data'] = $this->sqlsrv_select($con);
				$res['count'] = $count;
			}
		}
		if(isset($set['all']) and $set['all']){
			$con = [];
			$count = $this->sqlsrv_count($con);
			
			if($count>0){

				$con['select'] = isset($set['select'])?$set['select']:'';

				$con['array_key'] = 'empcode';
				$res['data'] = $this->sqlsrv_select($con);
				$res['count'] = $count;
			}
		}
		
		
		return $res;
	}

	
	
}