<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>แบบฟอร์มข้อมูลการลา - LeaveSystem - med.nu.ac.th</title>

  <?php echo $this->load->view('inc/css'); ?>

  <link rel="stylesheet" href="<?php echo base_url(load_file('assets/vendor/jquery-ui/jquery-ui.css'));?>">

  <style>
    .form{
      /*display:none;*/
    }
    .qrcode img{
      width: 150px;
      margin: auto;
      margin-top: 10px;
    }
    .input-group-addon{
      color: #6e707e;
      background-color: #d1d3e2;
      background-clip: padding-box;
      border: 1px solid #d1d3e2;
      border-radius: .35rem;
      border-right: none;
      border-top-right-radius: 0;
      border-bottom-right-radius: 0;
      line-height: 34px;
      padding-left: 5px;
      padding-right: 5px;
    }
    div.card-type{
      display:none;
    }
  </style>

</head>

<body deputy_deanpage-top">
  <!-- Page Wrapper -->
  <div id="wrapper">


    <?php echo $this->load->view('inc/header_menu'); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      <?php echo $this->load->view('inc/top_bar'); ?>
        
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">แบบฟอร์มข้อมูลการลา</h1>
          </div>

          <div class="row">
            <div class="col-lg-12">

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  
                  <div class="row">
                    <div class="col-lg-3">
                      <div>
                        <select id="type_leave" class="form-control" name="leave_type_id" form="form_leave">
                          <option value="" >เลือกประเภทการลา</option>
                          <?php if(isset($leave_type) and count($leave_type)>0){foreach($leave_type as $key=>$val){?>
                            <option value="<?php echo $key;?>" <?php echo isset($post_data['leave_type_id']) && $post_data['leave_type_id']==$key?'selected':'';?> ><?php echo $val['leave_name'];?></option>
                          <?php }} ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <form id="form_leave" class="form_leave" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="card mb-4 border-left-success">
                      <div class="card-body">
                        <h1 class="h4 text-gray-900 mb-4">แบบฟอร์ม <span class="leave-text"></span></h1>
                        <div class="form-group row">
                          <div class="col-sm-6 mb-3 mb-sm-0">
                            <label>เขียนที่</label>
                            <input type="text" name="write_at" class="form-control" id="exampleFirstName" value="<?php echo isset($post_data['write_at'])?$post_data['write_at']:'คณะแพทยศาสตร์';?>" required>
                          </div>
                          <div class="col-sm-6">
                            <label>เรียน</label>
                            <select name="to" class="toBoss form-control" required>
                              <option value="1">คณบดีคณะแพทยศาสตร์</option>
                              <option value="2" <?php echo isset($post_data['to']) && $post_data['to']==2?'selected':'';?>>อธิกาารบดี</option>
                              <!-- <option value="3">อธิกาารบดี (คณบดีคณะแพทยศาสตร์)</option> -->
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label>เรื่อง</label>
                            <input type="text" name="title" class="leave_title form-control" id="title" placeholder="ระบุประเภทการลา" value="<?php echo isset($post_data['title'])?$post_data['title']:'';?>"  required>
                          </div>
                          <div class="col-sm-6">
                            <label>รายละเอียดการลา</label>
                            <input type="text" name="detail" class="form-control leave-detail" id="detail" placeholder="รายละเอียดการลา" value="<?php echo isset($post_data['detail'])?$post_data['detail']:'';?>" required disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-3">
                            <label>ตั้งแต่วันที่</label>
                            <input type="text" class="leave_date_s form-control" value="<?php echo isset($post_data['period_start'])?date_th(date('Y-m-d',strtotime($post_data['period_start'])),12):date_th(date('Y-m-d'),12);?>" required>
                            <input type="hidden" name="period_start" class="leave_date_s_value form-control" value="<?php echo isset($post_data['period_start'])?$post_data['period_start']:date('Y-m-d');?>">
                          </div>
                          <div class="col-3">
                            <label>ในช่วง</label>
                            <select id="type_leave" class="form-control daytime_s" name="period_start_half" required disabled>
                              <option value="0">ตลอดวัน</option>
                              <option value="1" <?php echo isset($post_data['period_start_half']) && $post_data['period_start_half']==1?'selected':'';?>>ครึ่งวัน</option>
                            </select>
                          </div>
                          <div class="col-3">
                            <label>ถึงวันที่</label>
                            <input type="text" class="leave_date_e form-control" value="<?php echo isset($post_data['period_end'])?date_th(date('Y-m-d',strtotime($post_data['period_end'])),12):date_th(date('Y-m-d'),12);?>" required>
                            <input type="hidden" name="period_end" class="leave_date_e_value form-control" value="<?php echo isset($post_data['period_end'])?$post_data['period_end']:date('Y-m-d');?>">
                          </div>
                          <div class="col-3">
                            <label>ในช่วง</label>
                            <select id="type_leave" class="form-control daytime_e" name="period_end_half" required disabled>
                              <option value="0">ตลอดวัน</option>
                              <option value="1" <?php echo isset($post_data['period_end_half']) && $post_data['period_end_half']==1?'selected':'';?>>ครึ่งวัน</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-12">
                            <div class="input-group">
                              <span class="input-group-addon">จำนวนวันลาเฉพาะวันทำการ</span>
                              <input type="text" name="period_count" class="date_dis form-control" value="<?php echo isset($post_data['period_count'])?$post_data['period_count']:'1';?>" style="max-width: 60px; min-width: 60px;border-top-right-radius: .35rem;border-bottom-right-radius: .35rem;">&nbsp;
                              <span class="input-group-addon">จำนวนวันลารวมวันหยุด</span>
                              <input type="text" name="period_count_all" class="date_all form-control" value="<?php echo isset($post_data['period_count_all'])?$post_data['period_count_all']:'1';?>" style="max-width: 60px; min-width: 60px;">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label>ข้อมูลติดต่อ</label>
                            <?php 
                              $contact = '';
                              if(isset($post_data['contact'])){ 
                                $contact = $post_data['contact']; 
                              }elseif(isset($personnel['phone']) && trim($personnel['phone'])!=''){ 
                                $contact = 'โทร.'.$personnel['phone']; 
                              }
                            ?>
                            <input type="text" name="contact" class="date_dis form-control" value="<?php echo $contact;?>">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card mb-4 border-left-warning card-type card-type-7 card-type-10">
                      <div class="card-body">
                        <h1 class="h4 text-gray-900 mb-4">ข้อมูลไปต่างประเทศ</h1>
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label>ณ ประเทศ</label>
                            <input name="county_name" type="text" class="form-control" placeholder="ระบุชื่อประเทศ" value="<?php echo isset($post_data['county_name'])?$post_data['county_name']:'';?>" required disabled>
                          </div>
                        </div>
                      </div> 
                    </div>

                    <div class="card mb-4 border-left-warning card-type card-type-5">
                      <div class="card-body">
                        <h1 class="h4 text-gray-900 mb-4">ข้อมูลลาไปช่วยภริยาที่คลอดบุตร</h1>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label>ชื่อภริยาโดยชอบด้วยกฏหมาย</label>
                            <input name="wife_name" type="text" class="form-control" placeholder="ระบุชื่อภริยา" value="<?php echo isset($post_data['wife_name'])?$post_data['wife_name']:'';?>" required disabled>
                          </div>
                          <div class="col-sm-6">
                            <label>คลอดบุตรเมื่อวันที่</label>
                            <input type="text" class="date_n form-control" value="<?php echo isset($post_data['child_birthdate'])?date_th(date('Y-m-d',strtotime($post_data['child_birthdate'])),12):date_th(date('Y-m-d'),12);?>" required disabled>
                            <input name="child_birthdate" type="hidden" class="form-control" value="<?php echo isset($post_data['child_birthdate'])?$post_data['child_birthdate']:date('Y-m-d');?>">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card mb-4 border-left-warning card-type card-type-6">
                      <div class="card-body">
                        <h1 class="h4 text-gray-900 mb-4">ข้อมูลลากิจส่วนตัวเพื่อเลี้ยงดูบุตร</h1>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label>ได้คลอดบุตรตั้งแต่วันที่</label>
                            <input type="text" class="date_n form-control" date_type="child_birthdate_s" value="<?php echo isset($post_data['child_birthdate_start'])?date_th(date('Y-m-d',strtotime($post_data['child_birthdate_start'])),12):date_th(date('Y-m-d'),12);?>" required disabled>
                            <input name="child_birthdate_start" type="hidden" class="child_birthdate_s_value form-control" value="<?php echo isset($post_data['child_birthdate_start'])?$post_data['child_birthdate_start']:date('Y-m-d');?>" disabled>
                          </div>
                          <div class="col-sm-6">
                            <label>ถึงวันที่</label>
                            <input  type="text" class="date_n form-control" date_type="child_birthdate_e" value="<?php echo isset($post_data['child_birthdate_end'])?date_th(date('Y-m-d',strtotime($post_data['child_birthdate_end'])),12):date_th(date('Y-m-d'),12);?>" required disabled>
                            <input name="child_birthdate_end" type="hidden" class="child_birthdate_e_value form-control" value="<?php echo isset($post_data['child_birthdate_end'])?$post_data['child_birthdate_end']:date('Y-m-d');?>" disabled>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="card mb-4 border-left-warning card-type card-type-8">
                      <div class="card-body">
                        <h1 class="h4 text-gray-900 mb-4">ข้อมูลลาอุปสมบทหรือลาไปประกอบบพิธีการฮัจย์</h1>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label>ท่านเคยอุปสมหรือไม่</label>
                            <select name="ordination_status" class="form-control" required disabled>
                              <option value="0">ยังไม่เคย</option>
                              <option value="1">เคย</option>
                            </select>
                          </div>
                          <div class="col-sm-6">
                            <label>วันที่อุปสมบท</label>
                            <input type="text" class="date_n form-control" date_type="ordination_date" value="<?php echo isset($post_data['ordination_date'])?date_th(date('Y-m-d',strtotime($post_data['ordination_date'])),12):'';?>" required disabled>
                            <input name="ordination_date" type="hidden" class="form-control" value="<?php echo isset($post_data['ordination_date'])?$post_data['ordination_date']:'';?>" disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label>วัดที่อุปสมบท ณ วัด</label>
                            <input name="temple_name" type="text" class="temple_name form-control" placeholder="ชื่อวัดที่อุปสมบท" value="<?php echo isset($post_data['temple_name'])?$post_data['temple_name']:'';?>" required disabled>
                          </div>
                          <div class="col-sm-6 mb-3 mb-sm-0">
                            <label>ตั้งอยู่ ณ</label>
                            <input name="temple_address" type="text" class="temple_address form-control" placeholder="ที่ตั้งวัดที่อุปสมบท" value="<?php echo isset($post_data['temple_address'])?$post_data['temple_address']:'';?>" required disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label>จำพรรษา ณ วัด</label>
                            <input name="temple_name2" type="text" class="temple_name_2 form-control" placeholder="ชื่อวัดที่จำพรรษา" value="<?php echo isset($post_data['temple_name2'])?$post_data['temple_name2']:'';?>" required disabled>
                          </div>
                          <div class="col-sm-6 mb-3 mb-sm-0">
                            <label>ตั้งอยู่ ณ</label>
                            <input name="temple_address2" type="text" class="temple_address_2 form-control" placeholder="ที่ตั้งวัดที่จำพรรษา" value="<?php echo isset($post_data['temple_address2'])?$post_data['temple_address2']:'';?>" required disabled>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card mb-4 border-left-warning card-type card-type-9">
                      <div class="card-body">
                        <h1 class="h4 text-gray-900 mb-4">ข้อมูลลาเข้ารับการตรวจเลือก หรือเข้ารับการเตรียมพล</h1>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label>ข้าพเจ้าได้รับหมายเรียกของ</label>
                            <input name="call_soldier" type="text" class="form-control" placeholder="ระบุข้อมูลหมายเรียก" value="<?php echo isset($post_data['call_soldier'])?$post_data['call_soldier']:'';?>" required disabled>
                          </div>
                          <div class="col-sm-6">
                            <label>ที่มา</label>
                            <input name="call_soldier_form" type="text" class="form-control" placeholder="ระบุที่มาของหมายเรียก" value="<?php echo isset($post_data['call_soldier_form'])?$post_data['call_soldier_form']:'';?>" required disabled>
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label>ให้เข้ารับการ</label>
                            <input name="call_soldier_detail" type="text" class="form-control" placeholder="ระบุรายละเอียด" value="<?php echo isset($post_data['call_soldier_detail'])?$post_data['call_soldier_detail']:'';?>" required disabled>
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label>หมายเรียกลงวันที่</label>
                            <input type="text" class="date_n form-control" value="<?php echo isset($post_data['call_date'])?date_th(date('Y-m-d',strtotime($post_data['call_date'])),12):date_th(date('Y-m-d'),12);?>" required disabled>
                            <input name="call_date" type="hidden" class="form-control" value="<?php echo isset($post_data['call_date'])?$post_data['call_date']:date('Y-m-d');?>" disabled>
                          </div>
                          <div class="col-sm-6">
                            <label>ให้รับการฝึกที่</label>
                            <input name="train_address" type="text" class="form-control" placeholder="ระบุชื่อสถานที่เข้ารับการฝึก" value="<?php echo isset($post_data['train_address'])?$post_data['train_address']:'';?>" required disabled>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card mb-4 border-left-warning">
                      <div class="card-body">
                        <div class="row approve_list">
                          <div class="a1 col-lg-6" id="workmate-box">
                            <div class="form-group">
                                <label>ผู้ปกิบัติงานแทน</label>
                                <input type="text" class="input_hide form-control auto-workmate" auto_type="workmate" placeholder="เลือกผู้ปฏิบัติงานแทน">
                                <input id="workmate" type="hidden" name="personnel_id_1" class="input_hide" form="">
                              </div>
                          </div>
                          <div class="a2 col-lg-6" >
                            <div class="form-group">
                                <label>หัวหน้าหน่วย/ หัวหน้าหอผู้ป่วย</label>
                                <input type="text" class="input_hide form-control auto-head_unit" auto_type="head_unit" placeholder="เลือกหัวหน้าหน่วย">
                                <input id="head_unit" type="hidden" name="personnel_id_2" class="input_hide" form="">
                                <input id="head_unit_position" type="text" class="input_hide form-control" name="position_personnel_2" form="" placeholder="ระบุชื่อตำแหน่ง"/>
                              </div>
                          </div>
                          <div class="a3 col-lg-6" >
                            <div class="form-group">
                                <label>หัวหน้าศูนย์ / หัวหน้าฝ่าย / หัวหน้างาน</label>
                                <input type="text" class="input_hide form-control auto-head_dept" auto_type="head_dept" placeholder="เลือกหัวหน้างาน">
                                <input id="head_dept" type="hidden" name="personnel_id_3" class="input_hide" form="">
                                <input id="head_dept_position" type="text" class="input_hide form-control" name="position_personnel_2" form="" placeholder="ระบุชื่อตำแหน่ง"/>
                              </div>
                          </div>
                          <div class="a4 col-lg-6" >
                            <div class="form-group">
                                <label>หัวหน้าผู้ช่วยคณบดี / รองผู้อำนวยการ</label>
                                <input type="text" class="input_hide form-control auto-supervisor" auto_type="supervisor" placeholder="เลือกหัวหน้าฝ่าย">
                                <input id="supervisor" type="hidden" name="personnel_id_4" class="input_hide" form="">
                                <input id="supervisor_position" type="text" class="input_hide form-control" name="position_personnel_3" form="" placeholder="ระบุชื่อตำแหน่ง"/>
                              </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label>คณบดี / รองคณบดี / หัวหน้าภาค</label>
                              <input type="text" class="input_hide form-control auto-deputy_dean" auto_type="deputy_dean" placeholder="รองคณบดี หรือหัวหน้าภาควิชา">
                              <input id="deputy_dean" type="hidden" name="personnel_id_5" class="input_hide" form="">
                              <input id="deputy_dean_position" type="text" class="input_hide form-control" name="position_personnel_5" form="" placeholder="ระบุชื่อตำแหน่ง"/>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <input type="hidden" class="input_hide" name="url_personnel_1" value="<?php echo isset($url_approve['url_personnel_1'])?$url_approve['url_personnel_1']:'';?>" form=""/>
                    <input type="hidden" class="input_hide" name="url_personnel_2" value="<?php echo isset($url_approve['url_personnel_1'])?$url_approve['url_personnel_1']:'';?>" form=""/>
                    <input type="hidden" class="input_hide" name="url_personnel_3" value="<?php echo isset($url_approve['url_personnel_1'])?$url_approve['url_personnel_1']:'';?>" form=""/>
                    <input type="hidden" class="input_hide" name="url_personnel_4" value="<?php echo isset($url_approve['url_personnel_1'])?$url_approve['url_personnel_1']:'';?>" form=""/>
                    <input type="hidden" class="input_hide" name="url_personnel_5" value="<?php echo isset($url_approve['url_personnel_1'])?$url_approve['url_personnel_1']:'';?>" form=""/>
                    
                    <button type="submit" class="btn btn-primary btn-user btn-block">บันทึก</button>

                  </form>

                  <!--
                  <?php if(isset($leave_type[1])){ ?>
                  <form id="form_sleep" class="form sleep" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input type="text" name="write_at" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์" required>
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select name="to" class="toBoss form-control" required>
                          <option value="1">คณบดีคณะแพทยศาสตร์</option>
                          <option value="2">อธิกาารบดี</option>
                          <option value="3">อธิกาารบดี (คณบดีคณะแพทยศาสตร์)</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>เรื่อง</label>
                        <input type="text" name="title" class="leave_title form-control" id="exampleLastName" placeholder="ระบุการลา" value=""  required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-4">
                        <label>ช่วงเวลา</label>
                        <select name="period_type" class="type_leave_date form-control" form_no="1" required>
                          <option value="c">กำหนดระยะเวลา</option>
                          <option value="a">เช้า</option>
                          <option value="p">บ่าย</option>
                        </select>
                      </div>
                      <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>ตั้งแต่วันที่</label>
                        <input type="text" class="leave_date_s form-control" form_no="1" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_start" class="leave_date_s_value form-control" form_no="1" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>ถึงวันที่</label>
                        <input type="text" class="leave_date_e form-control" form_no="1" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_end" class="leave_date_e_value form-control" form_no="1" value="<?php echo date('Y-m-d');?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>ช้อมูลติดต่อ</label>
                        <textarea name="contact" id="" class="form-control" cols="30" rows="3" required></textarea>
                      </div>
                    </div>

                  </form>
                  <?php } ?>

                  <form id="form_leave" class="form leave" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input type="text" name="write_at" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์" required>
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select name="to" class="toBoss form-control" required>
                          <option value="1">คณบดีคณะแพทยศาสตร์</option>
                          <option value="2">อธิกาารบดี</option>
                          <option value="3">อธิกาารบดี (คณบดีคณะแพทยศาสตร์)</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>เรื่อง</label>
                        <input type="text" name="title" class="leave_title form-control" id="exampleLastName" placeholder="ระบุการลา" value=""  required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>ข้าพขอลา... เนื่องจาก</label>
                        <input type="text" name="detail" class="form-control" id="exampleLastName" placeholder="ระบุสาเหตุ" value=""  required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-4">
                        <label>ช่วงเวลา</label>
                        <select name="period_type" class="type_leave_date form-control" form_no="2" required>
                          <option value="c">กำหนดระยะเวลา</option>
                          <option value="a">เช้า</option>
                          <option value="p">บ่าย</option>
                        </select>
                      </div>
                      <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>ตั้งแต่วันที่</label>
                        <input type="text" class="leave_date_s form-control" form_no="2" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_start" class="leave_date_s_value form-control" form_no="2" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>ถึงวันที่</label>
                        <input type="text" class="leave_date_e form-control" form_no="2" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_end" class="leave_date_e_value form-control" form_no="2" value="<?php echo date('Y-m-d');?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>ช้อมูลติดต่อ</label>
                        <textarea name="contact" id="" class="form-control" cols="30" rows="3" required></textarea>
                      </div>
                    </div>

                  </form>

                  <form id="form_brith" class="form brith" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input type="text" name="write_at" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์" required>
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select name="to" class="toBoss form-control" required>
                          <option value="1">คณบดีคณะแพทยศาสตร์</option>
                          <option value="2">อธิกาารบดี</option>
                          <option value="3">อธิกาารบดี (คณบดีคณะแพทยศาสตร์)</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>เรื่อง</label>
                        <input type="text" name="title" class="leave_title form-control" id="exampleLastName" placeholder="ระบุการลา" value=""  required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>ข้าพขอลา... เนื่องจาก</label>
                        <input type="text" name="detail" class="form-control" id="exampleLastName" placeholder="ระบุสาเหตุ" value=""  required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-4">
                        <label>ช่วงเวลา</label>
                        <select name="period_type" class="type_leave_date form-control" form_no="3" required>
                          <option value="c">กำหนดระยะเวลา</option>
                          <option value="a">เช้า</option>
                          <option value="p">บ่าย</option>
                        </select>
                      </div>
                      <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>ตั้งแต่วันที่</label>
                        <input type="text" class="leave_date_s form-control" form_no="3" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_start" class="leave_date_s_value form-control" form_no="3" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>ถึงวันที่</label>
                        <input type="text" class="leave_date_e form-control" form_no="3" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_end" class="leave_date_e_value form-control" form_no="3" value="<?php echo date('Y-m-d');?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>คลอดบุตรตั้งแต่วันที่</label>
                        <input type="text" class="date_n form-control" date_type="child_birthdate_s" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input name="child_birthdate_start" type="hidden" class="child_birthdate_s_value form-control" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>ถึงวันที่</label>
                        <input  type="text" class="date_n form-control" date_type="child_birthdate_e" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input name="child_birthdate_end" type="hidden" class="child_birthdate_e_value form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>ช้อมูลติดต่อ</label>
                        <textarea name="contact" id="" class="form-control" cols="30" rows="3" required></textarea>
                      </div>
                    </div>

                  </form>

                  <form id="form_oversea" class="form oversea" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input name="write_at" type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์" required>
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select name="to" class="toBoss form-control" required>
                          <option value="1">คณบดีคณะแพทยศาสตร์</option>
                          <option value="2">อธิกาารบดี</option>
                          <option value="3">อธิกาารบดี (คณบดีคณะแพทยศาสตร์)</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>มีความประสงค์จะลา</label>
                        <input name="title" type="text" class="form-control" placeholder="ระบุจุดประสงค์" value="" required>
                      </div>
                      <div class="col-sm-6">
                        <label>ณ ประเทศ</label>
                        <input name="county_name" type="text" class="form-control" placeholder="ระบุประเทศ" value="" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <input type="hidden" class="type_leave_date form-control" form_no="4" value="c">
                      <div class="col-sm-6">
                        <label>ตั้งแต่วันที่</label>
                        <input type="text" class="leave_date_s form-control" form_no="4" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_start" class="leave_date_s_value form-control" form_no="4" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-6">
                        <label>ถึงวันที่</label>
                        <input type="text" class="leave_date_e form-control" form_no="4" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_end" class="leave_date_e_value form-control" form_no="4" value="<?php echo date('Y-m-d');?>">
                        <input type="hidden" name="period_type" value="c">
                      </div>
                    </div>
                  </form>

                  <form id="form_ordination" class="form ordination" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input name="write_at" type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์" required>
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select name="to" class="toBoss form-control" required>
                          <option value="1">คณบดีคณะแพทยศาสตร์</option>
                          <option value="2">อธิกาารบดี</option>
                          <option value="3">อธิกาารบดี (คณบดีคณะแพทยศาสตร์)</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>ท่านเคยอุปสมหรือไม่</label>
                        <select name="ordination_status" class="form-control" required>
                          <option value="0">ยังไม่เคย</option>
                          <option value="1">เคย</option>
                        </select>
                      </div>
                      <div class="col-sm-4"></div>
                      <div class="col-sm-2">
                        <label>จำนวนวัน</label>
                        <input type="number" class="period_count form-control" value="1">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-4">
                        <label>ตั้งแต่วันที่</label>
                        <input type="text" class="date_s form-control" form_no="5" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_start" class="date_s_value form-control" form_no="5" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-4">
                        <label>ถึงวันที่</label>
                        <input type="text" class="date_e form-control" form_no="5" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_end" class="date_e_value form-control" form_no="5" value="<?php echo date('Y-m-d');?>">
                        <input type="hidden" name="period_type" value="c">
                      </div>
                      <div class="col-sm-4">
                        <label>วันที่อุปสมบท</label>
                        <input type="text" class="date_n form-control" date_type="ordination_date" required>
                        <input name="ordination_date" type="hidden" class="form-control">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>วัดที่อุปสมบท ณ วัด</label>
                        <input name="temple_name" type="text" class="temple_name form-control" placeholder="ชื่อวัดที่อุปสมบท" value="" required>
                      </div>
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>ตั้งอยู่ ณ</label>
                        <input name="temple_address" type="text" class="temple_address form-control" placeholder="ที่ตั้งวัดที่อุปสมบท" value="" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>จำพรรษา ณ วัด</label>
                        <input name="temple_name2" type="text" class="temple_name_2 form-control" placeholder="ชื่อวัดที่จำพรรษา" value="" required>
                      </div>
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>ตั้งอยู่ ณ</label>
                        <input name="temple_address2" type="text" class="temple_address_2 form-control" placeholder="ที่ตั้งวัดที่จำพรรษา" value="" required>
                      </div>
                    </div>
                  </form>

                  <form id="form_help_childcare" class="form help_childcare" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input name="write_at" type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์" required>
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select name="to" class="toBoss form-control" required>
                          <option value="1">คณบดีคณะแพทยศาสตร์</option>
                          <option value="2">อธิกาารบดี</option>
                          <option value="3">อธิกาารบดี (คณบดีคณะแพทยศาสตร์)</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>มีความประสงค์จะลาไปช่วยเหลือภริยาโดยชอบด้วยกฏหมาย ชื่อ</label>
                        <input name="wife_name" type="text" class="form-control" placeholder="ระบุชื่อภริยา" value="" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-4">
                        <label>คลอดบุตรเมื่อวันที่</label>
                        <input type="text" class="date_n form-control" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input name="child_birthdate" type="hidden" class="form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-4">
                        <label>ลาตั้งแต่วันที่</label>
                        <input type="text" class="date_s form-control" form_no="6" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_start" class="date_s_value form-control" form_no="6" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-4">
                        <label>ลาถึงวันที่</label>
                        <input type="text" class="date_e form-control" form_no="6" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_end" class="date_e_value form-control" form_no="6" value="<?php echo date('Y-m-d');?>">
                        <input type="hidden" name="period_type" value="c">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>ช้อมูลติดต่อ</label>
                        <textarea name="contact" id="" class="form-control" cols="30" rows="3" required></textarea>
                      </div>
                    </div>
                  </form>

                  <form id="form_leave_childcare" class="form leave_childcare" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input name="write_at" type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์" required>
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select name="to" class="toBoss form-control" required>
                          <option value="1">คณบดีคณะแพทยศาสตร์</option>
                          <option value="2">อธิกาารบดี</option>
                          <option value="3">อธิกาารบดี (คณบดีคณะแพทยศาสตร์)</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>เรื่อง</label>
                        <input type="text" name="title" class="leave_title form-control" id="exampleLastName" placeholder="ระบุการลา" value=""  required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>ได้คลอดบุตรตั้งแต่วันที่</label>
                        <input type="text" class="date_n form-control" date_type="child_birthdate_s" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input name="child_birthdate_start" type="hidden" class="child_birthdate_s_value form-control" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                      <div class="col-sm-6">
                        <label>ถึงวันที่</label>
                        <input  type="text" class="date_n form-control" date_type="child_birthdate_e" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input name="child_birthdate_end" type="hidden" class="child_birthdate_e_value form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>ขอลากิจเพื่อเลี้ยงดูบุตรตั้งแต่วันที่</label>
                        <input type="text" class="date_s form-control" form_no="7" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_start" class="date_s_value form-control" form_no="7" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-6">
                        <label>ถึงวันที่</label>
                        <input type="text" class="date_e form-control" form_no="7" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_end" class="date_e_value form-control" form_no="7" value="<?php echo date('Y-m-d');?>">
                        <input type="hidden" name="period_type" value="c">
                      </div>
                    </div>
                  </form>

                  <form id="form_soldier" class="form soldier" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input name="write_at" type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์" required>
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select name="to" class="toBoss form-control" required>
                          <option value="1">คณบดีคณะแพทยศาสตร์</option>
                          <option value="2">อธิกาารบดี</option>
                          <option value="3">อธิกาารบดี (คณบดีคณะแพทยศาสตร์)</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>ข้าพเจ้าได้รับหมายเรียกของ</label>
                        <input name="call_soldier" type="text" class="form-control" placeholder="ระบุข้อมูลหมายเรียก" value="" required>
                      </div>
                      <div class="col-sm-6">
                        <label>ที่</label>
                        <input name="call_soldier_form" type="text" class="form-control" placeholder="ระบุที่มาของหมายเรียก" value="" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>ให้เข้ารับการ</label>
                        <input name="call_soldier_detail" type="text" class="form-control" placeholder="ระบุรายละเอียด" value="" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>หมายเรียกลงวันที่</label>
                        <input type="text" class="date_n form-control" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input name="call_date" type="hidden" class="form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-6">
                        <label>ให้รับการฝึกที่</label>
                        <input name="train_address" type="text" class="form-control" placeholder="ระบุชื่อสถานที่เข้ารับการฝึก" value="" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>ฝึกตั้งแต่วันที่</label>
                        <input type="text" class="date_s form-control" form_no="8" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_start" class="date_s_value form-control" form_no="8" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-6">
                        <label>ถึงวันที่</label>
                        <input type="text" class="date_e form-control" form_no="8" value="<?php echo date_th(date('Y-m-d'),12);?>" required>
                        <input type="hidden" name="period_end" class="date_e_value form-control" form_no="8" value="<?php echo date('Y-m-d');?>">
                        <input type="hidden" name="period_type" value="c">
                      </div>
                    </div>
                  </form>
                  
                  <input class="input_hide period_count" type="hidden" name="period_count" value="1" form=""/>
                  <input class="input_hide period_count_all" type="hidden" name="period_count_all" value="1" form=""/>
                  <input class="input_hide type" type="hidden" name="leave_type_id" form=""/>

                  <input type="hidden" class="input_hide url_workmate" name="url_workmate" value="<?php echo isset($url_approve['workmate'])?$url_approve['workmate']:'';?>" form=""/>
                  <input type="hidden" class="input_hide url_head_unit" name="url_head_unit" value="<?php echo isset($url_approve['head_unit'])?$url_approve['head_unit']:'';?>" form=""/>
                  <input type="hidden" class="input_hide url_head_dept" name="url_head_dept" value="<?php echo isset($url_approve['head_dept'])?$url_approve['head_dept']:'';?>" form=""/>
                  <input type="hidden" class="input_hide url_supervisor" name="url_supervisor" value="<?php echo isset($url_approve['supervisor'])?$url_approve['supervisor']:'';?>" form=""/>
                  <input type="hidden" class="input_hide url_deputy_dean" name="url_deputy_dean" value="<?php echo isset($url_approve['deputy_dean'])?$url_approve['deputy_dean']:'';?>" form=""/>
                  <input type="hidden" class="input_hide url_deputy_dean" name="url_hr" value="<?php echo isset($url_approve['hr'])?$url_approve['hr']:'';?>" form=""/>

                  <hr/>-->

                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php echo $this->load->view('inc/footer'); ?>
      <!-- End of Footer -->

      <!-- Boss Modal-->
      <a id="modal-boss" class="dropdown-item" href="#" data-toggle="modal" data-target="#_boss" style="display:none;"></a>
      <div class="modal fade" id="_boss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">เลือกชื่อตำแหน่ง</h5>
                  <button id="close_position" class="close" type="button" data-dismiss="modal" aria-label="Close" style="display:none;">
                  <span aria-hidden="true">×</span>
                  </button>
              </div>

              <div class="modal-body">
                  <div class="form-group">
                    <div id="boss_position_list">
                    </div>
                  </div>
              </div>

              <div class="modal-footer">
                  <button id="ok_position" type_id="" class="btn btn-secondary" type="button">ตกลง</button>
              </div>
              </div>
          </div>
      </div>

      <div id="preload" style="position: absolute;width: 100vw;height: 100%;background-color: rgba(0, 0, 0, 0.5);z-index: 99;top: 0;left: 0;display:none;">
        <img src="<?php echo base_url(load_file('assets/img/loading.gif'));?>" style="position: fixed;left: 0;right: 0;margin: auto;top: 25%;">
      </div>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php echo $this->load->view('inc/scroll_to'); ?>
  
  <?php echo $this->load->view('inc/logout'); ?>
  
  <?php echo $this->load->view('inc/js'); ?>

  <script src="<?php echo base_url(load_file('assets/js/qrcodejs/qrcode.min.js'));?>"></script>

  <script src="<?php echo base_url(url_index().'leave/get_weekend/js');?>" ></script>

  <script src="<?php echo base_url(load_file('assets/vendor/jquery-ui/jquery-ui.min.js'));?>" ></script>
  
  <script>
    $(document).ready(function(){
      leave_type_form();

      $('#type_leave').change(function(){
        leave_type_form();
      });

      function leave_type_form(){
        var type = $('#type_leave').val();
        var type_name = $( "#type_leave option:selected" ).text();

        if(type!=0){
          $('.leave-text').text(type_name);
          $('#title').val(type_name);
        }else{
          $('.leave-text').text('');
          $('#title').val('');
        }
        
        $('.card-type').hide();
        $('.card-type input, .card-type select').attr('disabled','disabled');
        $('.card-type-'+type).show();
        $('.card-type-'+type+' input, .card-type-'+type+' select').removeAttr('disabled');

        if(type>=1 && type<=4){
          $('.daytime_s,.daytime_e').removeAttr('disabled');
        }else{
          $('.daytime_s,.daytime_e').attr('disabled','disabled');
        }
        if(type>=2 && type<=4){
          $('.leave-detail').removeAttr('disabled');
        }else{
          $('.leave-detail').attr('disabled','disabled');
        }
      }

      $( ".date_n" ).datepicker({
        onSelect: function(){
          var dateObject = $(this).datepicker('getDate');
          var date = new Date(dateObject);
          date.setDate(date.getDate() + 1);
          var get_date = date.toISOString().substring(0, 10);
          $(this).next().val(get_date);
          count_date();
        }
      });
      $( ".leave_date_s" ).datepicker({
        onSelect: function(){
          var dateObject = $(this).datepicker('getDate');
          var date = new Date(dateObject);
          date.setDate(date.getDate() + 1);
          var get_date = date.toISOString().substring(0, 10);
          $(this).next().val(get_date);
          count_date();
        }
      });
      $( ".leave_date_e" ).datepicker({
        onSelect: function(){
          var dateObject = $(this).datepicker('getDate');
          var date = new Date(dateObject);
          date.setDate(date.getDate() + 1);
          var get_date = date.toISOString().substring(0, 10);
          $(this).next().val(get_date);
          count_date();
        }
      });

      $('.daytime_s,.daytime_e').change(function(){
        count_date();
      });

      function count_date(){
        var date_start = $('.leave_date_s_value').val();
        var date_end = $('.leave_date_e_value').val();
        var daytime = 0;

        if(date_start>date_end){
          $('.leave_date_e_value').val(date_start);
          var strMonthFull = ["","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"];
          var date_split = date_start.split('-');
          $('.leave_date_e').val(date_split[2]+' '+strMonthFull[parseInt(date_split[1])]+' '+date_split[0]);

          date_start = $('.leave_date_s_value').val();
          date_end = $('.leave_date_e_value').val();
        }

        var date_dis = dis_date(date_end,date_start);
        var date_count = days_between(date_end, date_start);

        daytime += $('.daytime_s').val() == 1?0.5:0;
        daytime += $('.daytime_e').val() == 1?0.5:0;

        if(date_end == date_start && ($('.daytime_s').val() == 1 || $('.daytime_e').val() == 1)){
          daytime = 0.5;
        }

        $('.date_all').val(date_count);
        $('.date_dis').val(parseFloat(date_count)-parseFloat(date_dis)-parseFloat(daytime));

      }

      function days_between(date1, date2) {
        date1 = new Date(date1);
        date2 = new Date(date2);

        if(date1>=date2){
          // The number of milliseconds in one day
          const ONE_DAY = 1000 * 60 * 60 * 24;

          // Calculate the difference in milliseconds
          const differenceMs = Math.abs(date1 - date2);

          // Convert back to days and return
          const res = Math.round(differenceMs / ONE_DAY)

          return res+1;
        }else{
          return 0;
        }
      }

      function dis_date(date1, date2){
        var count_dis = 0;
        const count = days_between(date1, date2);
        
        if(count>0){
          for(var i = 0;i<count;i++){
            var date = new Date(date2);
            date.setDate(date.getDate() + i);
            var get_date = date.toISOString().substring(0, 10);
            if(typeof date_fix[get_date] !== 'undefined'){
              count_dis++;
            }
          }
        }

        return count_dis;
      }

      $('.temple_name').change(function(){
        if($('.temple_name_2').val()==''){
          $('.temple_name_2').val($('.temple_name').val());
        }
      });
      $('.temple_address').change(function(){
        if($('.temple_address_2').val()==''){
          $('.temple_address_2').val($('.temple_address').val());
        }
      });

      $('#form_leave').submit(function(){

        return true;

        var type = $('#type_leave').val();
        if(type==0){
          alert('กรุณาเลือกประเภทการลาก่อนการบันทึกข้อมูลการลา');
          return false;
        }

        var data = {
          'APP-KEY':'<?php echo $api['APP-KEY'];?>',
          ip:'<?php echo $api['ip'];?>',
          leave_type:$('#type_leave').val(),
          emp_type:'<?php echo $emp_type;?>',
          personnel:'<?php echo $personnel['personnel_id'];?>',
          period_count:$('.date_dis').val(),
          period_count_all:$('.date_all').val(),
          period_start:$('.leave_date_s_value').val()
        };

        $.ajax({
          type: "POST",
          data:data,
          url: "<?php echo base_url(url_index().'leave/api_v2/leave_spec_alert');?>",
          dataType: "json",
          success: function(data){

            if(data.status){
              data = data.data;

              if(data.approve==1 || data.approve==2){
                $(".toBoss option[value=1]").attr("selected","selected");
              }else if(data.approve==3){
                $(".toBoss option[value=2]").attr("selected","selected");
              }

              if(data.before[0]!=0){
                alert_noti(1,data.before[0]);
              }else if(data.before[1]!=0){
                alert_noti(2,data.before[1]);
              }

              if(data.limit!=0){
                alert_noti(3,data.limit);
              }

              if(data.rest_limit!=0){
                alert_noti(4,data.rest_limit);
              }

              if(data.alert[0]!=0){
                let con = confrim('ท่านจะไม่ได้รับเงินเดือนเนื่องวันลาต่อปีงบประมาณของท่านเกิน '+data.alert[0]+' วัน ท่านต้องการบันทึกข้อมูลลานี้หรือไม่');
                if(!con){
                  return false;
                }
              }else if(data.alert[1]!=0){
                let con = confrim('ท่านจะไม่ได้รับพิจาราณาเลื่อนขั้นเนื่องวันลาต่อปีงบประมาณของท่านเกิน '+data.alert[0]+' วัน ท่านต้องการบันทึกข้อมูลลานี้หรือไม่');
                if(!con){
                  return false;
                }
              }
            }else{
              return false;
            }
          }
        });
      });

      function alert_noti(type=0,data=0){
        if(type==1){
          alert('ไม่สามารถบันทึกการลานี้ได้เนื่องจากต้องลงข้อมูลการลานี้ล่วงหน้าอย่างน้อย '+data+' วัน (ไม่รวมวันหยุดราชการ)');
          return false;
        }else if(type==2){
          alert('ไม่สามารถบันทึกการลานี้ได้เนื่องจากต้องลงข้อมูลการลานี้ล่วงหน้าอย่างน้อย '+data+' วัน (รวมวันหยุดราชการ)');
          return false;
        }else if(type==3){
          alert('ไม่สามารถบันทึกได้เนื่องจากเกินจำนวนวันลาต่อปีงบที่จำกัดไว้ '+data+' วัน');
          return false;
        }else if(type==4){
          alert('ไม่สามารถบันทึกได้เนื่องจากเกินจำนวนวันลาสะสมของท่านที่คงเหลือไว้ '+data+' วัน');
          return false;
        }
      }

      var dest = getUrlParam('validate','');

      if(dest!=''){
        dest = dest.split("-");
        alert_noti(dest[0],dest[1]);
      }

      function getUrlParam(parameter, defaultvalue){
        var urlparameter = defaultvalue;
        if(window.location.href.indexOf(parameter) > -1){
            urlparameter = getUrlVars()[parameter];
            }
        return urlparameter;
      }
      function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
      }


      var data = {
          'APP-KEY':'<?php echo $api['APP-KEY'];?>',
          token:'<?php echo $api['token'];?>',
          ip:'<?php echo $api['ip'];?>',
          term:''
      };

      $(".auto-deputy_dean,.auto-workmate,.auto-supervisor,.auto-head_dept,.auto-head_unit").autocomplete({
        source: function(request,response) {

          data.term = request.term;
          $.ajax( {
            type: "POST",
            url: "<?php echo base_url(url_index().'personnel/api_v1/personnel'); ?>",
            dataType: "jsonp",
            data: data,
            success: function(data) {

              let res = [];

              if(!data.status){
                location.reload();
                return false;
              }

              if(data.count>0){

                $.each( data.data, function( key, value ) {
                  res[key] = {'value':'','label':'','id':''};
                  res[key].value = value.title+value.name_th+' '+value.surname_th+', '+value.email;
                  res[key].label = value.title+value.name_th+' '+value.surname_th+', '+value.email;
                  res[key].boss  = value.position_boss;
                  res[key].id    = value.personnel_id;
                });
                response(res);
              }else{
                return false;
              }
              
            }
          } );
        },
        minLength: 2,
        select: function( event, ui ) {
          var id = $(this).attr('auto_type');
          var position = ui.item.boss;
          if(position!=null && position!==''){
            var res = position.split(",");
            if(res.length>0){
              var html = '';
              $('#boss_position_list').empty();
              $.each(res,function(key,val){
                console.log(key,val);
                html += '<div class="radio"><label><input type="radio" class="position_bosss" name="position_bosss" value="'+(val.trim())+'" '+(key==0?'checked="checked"':'')+'> '+(val.trim())+'</label></div>';
              });
              html += '<div class="radio"><label><input type="radio" class="position_bosss" name="position_bosss" value="" '+(html==''?'checked="checked"':'')+'> เลือกกรอกตำแหน่งอื่นๆ</label></div>';
              $('#boss_position_list').append(html);
              $('#ok_position').attr('type_id',id);
              $('#modal-boss').click();
            }

          }else{
            $(this).next().next().focus();
          }

          $(this).next().val(ui.item.id);
        },
        change: function (event, ui) {
          if (ui.item === null) {
            $(this).val('');
            $(this).next().val('');
            $(this).next().next().val('');
          }
       }

      })/*.focus(function(){
          $(this).data("uiAutocomplete").search($(this).val());
      })*/;

      $('#ok_position').click(function(){
        var type_id = $(this).attr('type_id');
        $('#'+type_id+'_position').val($('#boss_position_list .position_bosss:checked').val()).focus();
        $('#close_position').click();
      });

    });
  </script>

  <!--<script>
    $(document).ready(function(){

      var leave_type;
      $('#type_leave').change(function(){
        var type = $(this).val();
        if(type!=''){
          type = type.split("-");
          if(type.length == 2){
            leave_type = type[0];
            $('.leave-text').text(type[1]);
            $('.form').hide();
            if(type[0]==1){
              $('.form.sleep').show();
              $('#submit-form').attr('form','form_sleep');
              $('.input_hide').attr('form','form_sleep');
              $('.date-cal button').hide();
              $('.date-cal span').text('1 วัน').show();
              $('#workmate-box input').removeAttr('disabled');
              $('#workmate-box').show();
              $('.leave_title').val(type[1]);
            }else if(type[0]>=2 && type[0]<=3){
              $('.form.leave').show();
              $('#submit-form').attr('form','form_leave');
              $('.input_hide').attr('form','form_leave');
              $('#workmate-box input').removeAttr('disabled');
              $('#workmate-box').show();
              $('.leave_title').val(type[1]);
            }else if(type[0]==4){
              $('.form.brith').show();
              $('#submit-form').attr('form','form_brith');
              $('.input_hide').attr('form','form_brith');
              $('#workmate-box input').removeAttr('disabled');
              $('#workmate-box').show();
              $('.leave_title').val(type[1]);
            }else if(leave_type==5){
              $('.form.help_childcare').show();
              $('#submit-form').attr('form','form_help_childcare');
              $('.input_hide').attr('form','form_help_childcare');
              $('#workmate-box input').attr('disabled','disabled');
              $('#workmate-box').hide();
            }else if(leave_type==6){
              $('.form.leave_childcare').show();
              $('#submit-form').attr('form','form_leave_childcare');
              $('.input_hide').attr('form','form_leave_childcare');
              $('#workmate-box input').attr('disabled','disabled');
              $('#workmate-box').hide();
              $('.leave_title').val(type[1]);
            }else if(leave_type==7){
              $('.form.oversea').show();
              $('#submit-form').attr('form','form_oversea');
              $('.input_hide').attr('form','form_oversea');
              $('.date-cal button').hide();
              $('.date-cal span').text('1 วัน').show();
              $('#workmate-box input').removeAttr('disabled');
              $('#workmate-box').show();
            }else if(leave_type==8){
              $('.form.ordination').show();
              $('#submit-form').attr('form','form_ordination');
              $('.input_hide').attr('form','form_ordination');
              $('#workmate-box input').attr('disabled','disabled');
              $('#workmate-box').hide();
            }else if(leave_type==9){
              $('.form.soldier').show();
              $('#submit-form').attr('form','form_soldier');
              $('.input_hide').attr('form','form_soldier');
              $('#workmate-box input').attr('disabled','disabled');
              $('#workmate-box').hide();
            }
            check_spec(false);
            $('.type').val(leave_type);
            $('#submit-form, .approve_list').show();
          }
        }else{
          $('.leave-text').text('');
          $('.form').hide();
          $('.date-cal span').hide();
          $('.date-cal button').show();
          $('#submit-form, .approve_list').hide();
        }
      });

      var type_leave_date = 'c';
      var old_end_date = '';
      $('.type_leave_date').change(function(){
        type_leave_date = $(this).val();
        if(type_leave_date != 'c'){
          old_end_date = (old_end_date==''?$('.leave_date_e').val():old_end_date);
          $('.leave_date_e').val('');
          $('.leave_date_e').attr('disabled','disabled');
          $('.date-cal button').hide();
          //$('.date-cal span').text('0.5 วัน'+(type_leave_date=='a'?'(เช้า)':'(บ่าย)')).show();
        }else{
          $('.leave_date_e').val(old_end_date);
          old_end_date = '';
          $('.leave_date_e').removeAttr('disabled');
        }
      });

      $('.form').submit(function(){

        var spec_status =$('#submit-form').attr('status_sub');
        if(spec_status=='false'){
            $('#_alert .modal-title').text('แจ้งรายละเอียด');
            $('#_alert .modal-body').text('ข้อมูลการลาของท่านยังไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง');
            $('#modal-alert').click();
            return false;
        }

        var con = confirm('กรุณาตรวจสอบความถูกต้องในการลาของท่านก่อนบันทึกข้อมูล ท่านต้องการลงข้อมูลการลานี้ใช่หรือไม่');
        if(!con){
          return false;
        }

        var workmate = $('#workmate').val();
        var head_unit = $('#head_unit').val();
        var head_unit_position = $('#head_unit_position').val();
        var head_dept = $('#head_dept').val();
        var head_dept_position = $('#head_dept_position').val();
        var supervisor = $('#supervisor').val();
        var supervisor_position = $('#supervisor_position').val();
        var deputy_dean = $('#deputy_dean').val();
        var deputy_dean_position = $('#deputy_dean_position').val();

        if((leave_type>=1 && leave_type<=4) || leave_type==7){
          if(workmate==0){
            $('#_alert .modal-title').text('แจ้งรายละเอียด');
            $('#_alert .modal-body').text('กรุณาเลือกผู้ปฏิบัติงานแทนให้ถูกต้อง');
            $('#modal-alert').click();
            return false;
          }
        }

        <?php if(!(isset($personnel['smu_main_id']) and intval($personnel['smu_main_id'])!=0 and substr($personnel['smu_main_id'],0,1) == 2)){?>

          if(head_unit=='' || head_dept=='' || deputy_dean==''){
            $('#_alert .modal-title').text('แจ้งรายละเอียด');
            $('#_alert .modal-body').text('กรุณาเลือกผู้บังคับบัญชาให้ถูกต้อง');
            $('#modal-alert').click();
            return false;
          }

          // if(isNaN(head_unit) || isNaN(head_dept) || isNaN(deputy_dean)){
          //   alert('กรุณาเลือกผู้บังคับบัญชาให้ถูกต้อง');
          //   return false;
          // }

          if(head_unit_position==''){
            $('#_alert .modal-title').text('แจ้งรายละเอียด');
            $('#_alert .modal-body').text('กรุณากรอกชื่อตำแหน่งหัวหน้าหน่วย / หัวหน้าหอผู้ป่วย');
            $('#modal-alert').click();
            return false;
          }
          if(head_dept_position==''){
            $('#_alert .modal-title').text('แจ้งรายละเอียด');
            $('#_alert .modal-body').text('กรุณากรอกชื่อตำแหน่งหัวหน้าศูนย์ / หัวหน้าฝ่าย / หัวหน้างาน');
            $('#modal-alert').click();
            return false;
          }
          if(supervisor_position==''){
            $('#_alert .modal-title').text('แจ้งรายละเอียด');
            $('#_alert .modal-body').text('กรุณากรอกชื่อตำแหน่งหัวหน้าผู้ช่วยคณบดี / รองผู้อำนวยการ');
            $('#modal-alert').click();
            return false;
          }

        <?php } ?>

        if(deputy_dean_position==''){
          $('#_alert .modal-title').text('แจ้งรายละเอียด');
          $('#_alert .modal-body').text('กรุณากรอกชื่อตำแหน่งคณบดี / รองคณบดี / หัวหน้าภาค');
          $('#modal-alert').click();
          return false;
        }

        // $('.workmate').val(workmate);
        // $('.head_unit').val(head_unit);
        // $('.head_dept').val(head_dept);
        // $('.supervisor').val(supervisor);
        // $('.deputy_dean').val(deputy_dean);

        return true;

      });      

      $('.temple_name').change(function(){
        if($('.temple_name_2').val()==''){
          $('.temple_name_2').val($('.temple_name').val());
        }
      });
      $('.temple_address').change(function(){
        if($('.temple_address_2').val()==''){
          $('.temple_address_2').val($('.temple_address').val());
        }
      });

      $('.select_app').change(function(){
        var select = $(this).val();
        select = parseInt(select);
        if(isNaN(select) || select==0){
          $(this).next().val('');
          $(this).next().attr('disabled','disabled');
        }else{
          $(this).next().removeAttr('disabled');
        }
      });
      
    });


    $(function(){
      $( ".date_n" ).datepicker({
        onSelect: function(){
          var dateObject = $(this).datepicker('getDate');
          var date = new Date(dateObject);
          date.setDate(date.getDate() + 1);
          var get_date = date.toISOString().substring(0, 10);
          $(this).next().val(get_date);

          if($(this).attr('date_type') == 'ordination_date'){
            var date_start = $('.date_s_value[form_no=5]').val();
            var date_end = $('.date_e_value[form_no=5]').val();
            if(get_date<date_start || get_date>date_end){
              alert('กรุณาเลือกวันอุปสมบทให้ถูกต้อง');
              $(this).val('');
              return false;
            }
          }

          if($(this).attr('date_type') == 'child_birthdate_s' || $(this).attr('date_type') == 'child_birthdate_e'){
            var date_start = $('.child_birthdate_s_value').val();
            var date_end = $('.child_birthdate_e_value').val();
            if(date_start>date_end){
              alert('กรุณาเลือกวันคลอดบุตรให้ถูกต้อง');
              var type = $(this).attr('date_type');
              $('.'+type+'_value').val('');
              $(this).val('');
              return false;
            }
          }

        }
      });
      $( ".leave_date_s" ).datepicker({
        onSelect: function(){
          var dateObject = $(this).datepicker('getDate');
          var date = new Date(dateObject);
          date.setDate(date.getDate() + 1);
          var get_date = date.toISOString().substring(0, 10);
          $(this).next().val(get_date);
          var form = $(this).attr('form_no');
          var type_leave_date = $('.type_leave_date[form_no='+form+']').val();
          leave_date(type_leave_date,form);
        }
      });
      $( ".leave_date_e" ).datepicker({
        onSelect: function(){
          var dateObject = $(this).datepicker('getDate');
          var date = new Date(dateObject);
          date.setDate(date.getDate() + 1);
          var get_date = date.toISOString().substring(0, 10);
          $(this).next().val(get_date);
          var form = $(this).attr('form_no');
          var type_leave_date = $('.type_leave_date[form_no='+form+']').val();
          leave_date(type_leave_date,form);
          check_spec();
        }
      });
    });

    $('.leave_date_s,.leave_date_e,.type_leave_date').change(function(){
      var form = $(this).attr('form_no');
      leave_date(type_leave_date,form);
    });

    function leave_date(type_leave_date,form){
      if(type_leave_date == 'c'){
        var date_start = $('.leave_date_s_value[form_no='+form+']').val();
        var date_end = $('.leave_date_e_value[form_no='+form+']').val();

        if(date_start>date_end){
          $('.leave_date_e_value[form_no='+form+']').val(date_start);
          var strMonthFull = ["","มกราคม","กุมภาพันธ์","มีนาคม",te_start);
          var st"เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"];
          var date_split = date_start.split('-');
          $('.leave_date_e[form_no='+form+']').val(date_split[2]+' '+strMonthFull[parseInt(date_split[1])]+' '+date_split[0]);

          date_start = $('.leave_date_s_value[form_no='+form+']').val();
          date_end = $('.leave_date_e_value[form_no='+form+']').val();
        }

        var date_dis = dis_date(date_end,date_start);

        
        var count_date = (days_between(date_end,date_start) - date_dis);

        if(form==1 || form==4){
          $('.date-cal button').hide();
          $('.date-cal span').text(count_date+' วัน').show();
          var total = $('.date-cal').attr('total');
          $('.date-cal-total').text((total-count_date)+' วัน');
        }

        $('.period_count').val(count_date);
        $('.period_count_all').val(days_between(date_end,date_start));
      }
    }

    $(function(){
      $( ".date_s" ).datepicker({
        onSelect: function(){
          var dateObject = $(this).datepicker('getDate');
          var date = new Date(dateObject);
          date.setDate(date.getDate() + 1);
          var get_date = date.toISOString().substring(0, 10);
          $(this).next().val(get_date);
          var form = $(this).attr('form_no');
          leave_date_n(form);
        }
      });
      $( ".date_e" ).datepicker({
        onSelect: function(){
          var dateObject = $(this).datepicker('getDate');
          var date = new Date(dateObject);
          date.setDate(date.getDate() + 1);
          var get_date = date.toISOString().substring(0, 10);
          $(this).next().val(get_date);
          var form = $(this).attr('form_no');
          leave_date_n(form);
          check_spec();
        }
      });
    });

    $('.date_s,.date_e,.type_leave_date').change(function(){
        var form = $(this).attr('form_no');
        leave_date_n(form);
    });

    function leave_date_n(form){
      var date_start = $('.date_s_value[form_no='+form+']').val();
      var date_end = $('.date_e_value[form_no='+form+']').val();

      if(date_start>date_end){
        $('.date_e_value[form_no='+form+']').val(date_start);
        var strMonthFull = ["","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"];
        var date_split = date_start.split('-');
        $('.date_e[form_no='+form+']').val(date_split[2]+' '+strMonthFull[parseInt(date_split[1])]+' '+date_split[0]);

        date_start = $('.date_s_value[form_no='+form+']').val();
        date_end = $('.date_e_value[form_no='+form+']').val();
      }

      $('.date-cal button').hide();
      var count_date = days_between(date_end,date_start);


      $('.date-cal span').text(count_date+' วัน').show();
      $('.period_count').val(count_date);
      $('.period_count_all').val(count_date);
    }

    function check_spec(alert=true){
      var type = $('#type_leave').val();
      if(type!=''){
        $('#preload').show();
        type = type.split('-')[0];

        var data = {
            'APP-KEY':'<?php echo $api['APP-KEY'];?>',
            ip:'<?php echo $api['ip'];?>',
            leave_type:type,
            emp_type:'<?php echo $emp_type;?>',
            personnel:'<?php echo $personnel['personnel_id'];?>',
            day:$('.period_count').val()
        };

        $.ajax({
            type: "POST",
            data:data,
            url: "<?php echo base_url(url_index().'leave/api_v1/leave_spec_alert');?>",
            dataType: "json",
            success: function(data){
                if(data.process){
                    if(typeof data.msg !== "undefined" && data.msg!=null && data.msg!='' && alert){
                        $('#preload').hide();
                        $('#_alert .modal-title').text('แจ้งรายละเอียด');
                        $('#_alert .modal-body').text(data.msg);
                        $('#modal-alert').click();
                    }else{
                      $('#preload').hide();
                    }
                    $('.toBoss').val(data.to);
                    $('#submit-form').attr('status_sub','true');
                }else{
                    if(typeof data.msg !== "undefined" && data.msg!=null && data.msg!='' && alert){
                        $('#preload').hide();
                        $('#_alert .modal-title').text('ผิดพลาด');
                        $('#_alert .modal-body').text(data.msg);
                        $('#modal-alert').click();
                    }else{
                      $('#preload').hide();
                    }
                    $('#submit-form').attr('status_sub','false');
                }
            }
        });
        return false;
      }
      return false;
    }

    function days_between(date1, date2) {
      date1 = new Date(date1);
      date2 = new Date(date2);

      if(date1>=date2){
        // The number of milliseconds in one day
        const ONE_DAY = 1000 * 60 * 60 * 24;

        // Calculate the difference in milliseconds
        const differenceMs = Math.abs(date1 - date2);

        // Convert back to days and return
        const res = Math.round(differenceMs / ONE_DAY)

        return res+1;
      }else{
        return 0;
      }
    }

    function dis_date(date1, date2){
      var count_dis = 0;
      const count = days_between(date1, date2);
      
      if(count>0){
        for(var i = 0;i<count;i++){
          var date = new Date(date2);
          date.setDate(date.getDate() + i);
          var get_date = date.toISOString().substring(0, 10);
          if(typeof date_fix[get_date] !== 'undefined'){
            count_dis++;
          }
        }
      }

      return count_dis;
    }

    $( function() {

      function split( val ) {
        return val.split( /,\s*/ );
      }
      function extractLast( term ) {
        return split( term ).pop();
      }

      var data = {
          'APP-KEY':'<?php echo $api['APP-KEY'];?>',
          token:'<?php echo $api['token'];?>',
          ip:'<?php echo $api['ip'];?>',
          term:''
      };

      $(".auto-deputy_dean,.auto-workmate,.auto-supervisor,.auto-head_dept,.auto-head_unit").autocomplete({
        source: function(request,response) {

          //var auto_type = $(this).attr('auto_type');

          data.term = request.term;
          $.ajax( {
            type: "POST",
            url: "<?php echo base_url(url_index().'personnel/api_v1/personnel'); ?>",
            dataType: "jsonp",
            data: data,
            success: function(data) {

              let res = [];

              if(!data.status){
                location.reload();
                return false;
              }

              if(data.count>0){

                $.each( data.data, function( key, value ) {
                  res[key] = {'value':'','label':'','id':''};
                  res[key].value = value.title+value.name_th+' '+value.surname_th+', '+value.email;
                  res[key].label = value.title+value.name_th+' '+value.surname_th+', '+value.email;
                  res[key].boss  = value.position_boss;
                  res[key].id    = value.personnel_id;
                });
                response(res);
              }else{
                return false;
              }
              
            }
          } );
        },
        minLength: 2,
        select: function( event, ui ) {
          var id = $(this).attr('auto_type');
          var position = ui.item.boss;
          if(position!=null){
            var res = position.split(",");
            if(res.length>0){
              var html = '';
              $('#boss_position_list').empty();
              $.each(res,function(key,val){
                console.log(key,val);
                html += '<div class="radio"><label><input type="radio" class="position_bosss" name="position_bosss" value="'+(val.trim())+'" '+(key==0?'checked="checked"':'')+'> '+(val.trim())+'</label></div>';
              });
              html += '<div class="radio"><label><input type="radio" class="position_bosss" name="position_bosss" value="" '+(html==''?'checked="checked"':'')+'> เลือกกรอกตำแหน่งอื่นๆ</label></div>';
              $('#boss_position_list').append(html);
              $('#ok_position').attr('type_id',id);
              $('#modal-boss').click();
            }

          }else{
            $(this).next().next().focus();
          }

          $(this).next().val(ui.item.id);

          //$(this).next().next().val();
        },
        change: function (event, ui) {
          if (ui.item === null) {
            $(this).val('');
            $(this).next().val('');
            $(this).next().next().val('');
          }
       }

      })/*.focus(function(){
          $(this).data("uiAutocomplete").search($(this).val());
      })*/;

      $('#ok_position').click(function(){
        var type_id = $(this).attr('type_id');
        $('#'+type_id+'_position').val($('#boss_position_list .position_bosss:checked').val()).focus();
        $('#close_position').click();
      });

    });
    
  </script>-->

  <?php //echo $this->load->view('inc/alert'); ?>

</body>

</html>
