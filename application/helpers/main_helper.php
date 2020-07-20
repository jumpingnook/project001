<?php

    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    function dmytoymd($date) {
        if($date == '') return "";
        $arr = explode("/",$date);
        list($d,$m,$y)= $arr;
        $y = intval($y-543);
        $new=$y."-".$m."-".$d;
        return $new;
    }

    function hoteljob_url($param = '') {
        return 'https://www.hoteljob.in.th/'.$param;
    }

    function path_file($local = false){
        if($local){
            return base_url();
        }elseif(strpos(base_url(),'https://www.hoteljob.in.th')!==false){
            return '/home/admin/web/hoteljob.in.th/public_html/';
        }else{
            return 'https://www.hoteljob.in.th/';
        }
    }

    function other_curl($url='',$data=[],$method='POST'){
        $res = [];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
              "content-type: application/json; charset=UTF-8"
            )
        ));
  
        $res['response']    = curl_exec($curl);
        $res['code_status'] = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $res['status']      = curl_error($curl);
        curl_close($curl);
  
        return $res;
    }

    function is_email($text)
    {
        $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
        return preg_match($pattern, $text);
    }

    function is_thai_card($id)
    {
        $sum = 0;
        $digitId = 13;
        $digit13 = substr($id, 12, 1);
        for ($i=0; $i < 12; $i++) {
            $digitValue = substr($id, $i, 1);
            $sum += (int)($digitValue) * ($digitId);
            $digitId--;
        }
        return ((11-($sum%11))%10 == (int)($digit13));
    }

    function date_th($strDate,$use=0)
   {
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
        $strDays= date("w",strtotime($strDate));
        $strHour= date("H",strtotime($strDate));
        $strMinute= date("i",strtotime($strDate));
        $strSeconds= date("s",strtotime($strDate));
        $strMonthCut = array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthFull = array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strDayTH = array('อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัส','ศุกร์','เสาร์');
        $strDayTHmini = array('อา','จ','อ','พ','พฤ','ศ','ส');
        $strMonthThai=$strMonthCut[$strMonth];
        if($use == 1):
            return "$strDay $strMonthThai $strYear $strHour:$strMinute";
        elseif($use == 2):
            return "$strDay $strMonthThai $strYear";
        elseif($use == 3):
            return "$strMonthThai $strYear";
        elseif($use == 4):
                return $strDayTH[$strDays];
        elseif($use == 5):
            return $strMonthFull[$strMonth].' '.$strYear;
        elseif($use == 6):
            return "$strHour:$strMinute:$strSeconds";
        elseif($use == 7):
            return "$strDay";
        elseif($use == 8):
            return $strMonthCut[$strMonth];
        elseif($use == 9):
            return $strMonthFull[$strMonth];
        elseif($use == 10):
            return $strYear;
        elseif($use == 11):
            return "$strDay $strMonthFull[$strMonth] $strYear";
        elseif($use == 12):
            return "$strDay $strMonthFull[$strMonth] ".$strYear-=543;
        else:
            return "$strDay $strMonthThai $strYear $strHour:$strMinute:$strSeconds";
        endif;
    }

    function get_ip(){
        $res = '';
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $res=$_SERVER['HTTP_CLIENT_IP'];
        }else{
            $res=$_SERVER['REMOTE_ADDR'];
        }

        return $res;
    }

    function upload_img($file='',$config_upload = []){

        $CI =& get_instance();
        $return = array('code' => 1);
		// อัพโหลด รูปภาพ
		$config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            // 'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'encrypt_name' => TRUE,
        );

        if(isset($config_upload['file_name']) and trim($config_upload['file_name'])!=''){
            $config['file_name'] = $config_upload['file_name'];
        }

        $CI->load->library('upload', $config, 'photo_upload');
		$CI->photo_upload->initialize($config);

        if(!$CI->photo_upload->do_upload($file)):
            $return['status'] = false;
			$return['msg'] = $CI->photo_upload->display_errors();
        else:
            $data = $CI->photo_upload->data();
            $file_path = "./uploads/".$data['file_name'];

            if(isset($config_upload['auto_rotate']) and $config_upload['auto_rotate']){
                $CI->load->library('image_autorotate', array('filepath' => $file_path));
            }

            if(isset($config_upload['resize']) and count($config_upload['resize'])==2):

                $w = $data['image_width']; // original image's width
                $h = $data['image_height']; // original images's height

                $max_w = $config_upload['resize']['width']; // destination image's width
                $max_h = $config_upload['resize']['height']; // destination image's height

                $new_w = $w;
                $new_h = $h;

                if($w>$max_w or $h>$max_h){
                    if($w > $h){
                        $new_w = $max_w;
                        $new_h = $h/($w/$max_w); 
                    }elseif($w < $h){
                        $new_w = $w/($h/$max_h);
                        $new_h = $max_h;
                    }else{
                        $new_w = $max_w;
                        $new_h = $max_h; 
                    }
                }

        		$config = array(
        			'image_library'=>'gd2',
        			'source_image' => $file_path,
                    'create_thumb' => FALSE,
                    'maintain_ratio' => TRUE,
        			'quality'=>'90%',
        			'width' => intval($new_w),
        			'height' => intval($new_h)
        		);
                $CI->load->library('image_lib');
                $CI->image_lib->clear();
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
            endif;

			$return['status'] = true;
            $return['path'] = str_replace('.','',$file_path);
            $return['detail'] = $data;

		endif;
        return $return;
    }

    function load_file($filepath){
        $filemtime = @filemtime($filepath);
        return $filepath.'?v='.$filemtime;
    }

    function url_index(){
        return 'index.php/';
    }

    function genTOKEN($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function set_auth_session($result=[]){

        $CI =& get_instance();
        $CI->load->library('session');

        $set['authentication'] = [
            'status'    =>  (isset($result['status'])?$result['status']:false),
            'token'     =>  (isset($result['token'])?$result['token']:''),
            'username'  =>  (isset($result['username'])?$result['username']:'')
        ];
        
        $CI->session->set_userdata($set);
        return $CI->session->userdata('authentication');
    }

    function set_personnel_session($result=[]){

        $CI =& get_instance();
        $CI->load->library('session');

        $set['personnel'] = [
            'token'         =>  (isset($result['token'])?$result['token']:''),
            'personnel_id'  =>  (isset($result['personnel_id'])?$result['personnel_id']:''),
            'username'      =>  (isset($result['username'])?$result['username']:''),
            'personnel_code'=>  (isset($result['personnel_code'])?$result['personnel_code']:''),
            'title'         =>  (isset($result['title'])?$result['title']:''),
            'name_th'       =>  (isset($result['name_th'])?$result['name_th']:''),
            'surname_th'    =>  (isset($result['surname_th'])?$result['surname_th']:''),
            'name_en'       =>  (isset($result['name_en'])?$result['name_en']:''),
            'surname_en'    =>  (isset($result['surname_en'])?$result['surname_en']:''),
            'smu_main_id'   =>  (isset($result['smu_main_id'])?$result['smu_main_id']:''),
            'smu_sub_id'    =>  (isset($result['smu_sub_id'])?$result['smu_sub_id']:''),
            'work_start_date'   =>  (isset($result['work_start_date'])?$result['work_start_date']:''),
            'work_end_date'     =>  (isset($result['work_end_date'])?$result['work_end_date']:''),
        ];
        
        $CI->session->set_userdata($set);
        return $CI->session->userdata('personnel');
    }

    function sheet_token($url=''){

        $result = explode('/',$url);

        if(count($result)>=5){
            return $result[5];
        }
        
        return '';
    }

    function check_leave_type($date=''){
        if(trim($date)!=''){
            $d1 = new DateTime(date('Y-m-d',strtotime($date)));
            $d2 = new DateTime(date('Y-m-d'));

            $month = $d1->diff($d2)->m; // month == 6
            $day =$d1->diff($d2)->d; // day == 1

            if(intval($month)>6 or (intval($month)==6 and intval($day)>=1)){
                return ['status'=>true, 'month'=>intval($month), 'day'=>intval($day)];
            }else{
                return ['status'=>false, 'month'=>intval($month), 'day'=>intval($day)];
            }
        }

        return ['status'=>false];
    }



