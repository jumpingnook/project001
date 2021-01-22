<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>กรอกรใบลา - LeaveSystem - med.nu.ac.th</title>

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
    .card-default,.friend_approve{
      display:none;
    }
    .date_dis,.date_all{
      background-color: #ffffff !important;
    }
    [class*=period_count]{
      display:none;
    }
    .not_daytime[disabled*=disabled]{
      background-color: #cccccc;
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
            <h1 class="h3 mb-0 text-gray-800">กรอกใบลา</h1>
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

                  <div class="card mb-4 card-note">
                    <div class="card-body">
                      <i class="far fa-hand-point-up h3"></i> <span class=" h3 text-gray-600">กรุณาเลือกประเภทการลา เพื่อเริ่มกรอกข้อมูล</span><br/>
                      <i class="far fa-hand-point-right"></i> หากพบปัญหาในการใช้งานระบบหรือสอบถามข้อสงสัย ติดต่อ 7936
                    </div>
                  </div>

                  <form id="form_leave" class="form_leave" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="card mb-4 border-left-success card-default">
                      <div class="card-body">
                        <h1 class="h4 text-gray-900 mb-4">แบบฟอร์ม <span class="leave-text"></span></h1>
                        <div class="form-group row">
                          <div class="col-sm-6 mb-3 mb-sm-0">
                            <label>เขียนที่</label>
                            <input type="text" name="write_at" class="form-control" id="exampleFirstName" value="<?php echo isset($post_data['write_at'])?$post_data['write_at']:'คณะแพทยศาสตร์';?>" required>
                          </div>
                          <div class="col-sm-6">
                            <label>เรียน</label>
                            <select class="toBoss form-control" disabled>
                              <option value="1">คณบดีคณะแพทยศาสตร์</option>
                              <option value="2" <?php echo isset($post_data['to']) && $post_data['to']==2?'selected':'';?>>อธิการบดี</option>
                            </select>
                            <input type="hidden" name="to" class="toBoss" value="" required/>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label>เรื่อง</label>
                            <input type="text" name="title" class="leave_title form-control" id="title" placeholder="ระบุประเภทการลา" value="<?php echo isset($post_data['title'])?$post_data['title']:'';?>"  required>
                          </div>
                          <div class="col-sm-6">
                            <label>เนื่องจาก</label>
                            <input type="text" name="detail" class="form-control leave-detail" id="detail" placeholder="เนื่องจาก" value="<?php echo isset($post_data['detail'])?$post_data['detail']:'';?>" required disabled>
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
                            <select class="form-control daytime_s" name="period_start_half" required disabled>
                              <option value="0">ตลอดวัน</option>
                              <option class="not_daytime" value="1" <?php echo isset($post_data['period_start_half']) && $post_data['period_start_half']==1?'selected':'';?>>ครึ่งวันเช้า</option>
                              <option value="2" <?php echo isset($post_data['period_start_half']) && $post_data['period_start_half']==2?'selected':'';?>>ครึ่งวันบ่าย</option>
                            </select>
                          </div>
                          <div class="col-3">
                            <label>ถึงวันที่</label>
                            <input type="text" class="leave_date_e form-control" value="<?php echo isset($post_data['period_end'])?date_th(date('Y-m-d',strtotime($post_data['period_end'])),12):date_th(date('Y-m-d'),12);?>" required>
                            <input type="hidden" name="period_end" class="leave_date_e_value form-control" value="<?php echo isset($post_data['period_end'])?$post_data['period_end']:date('Y-m-d');?>">
                          </div>
                          <div class="col-3">
                            <label>ในช่วง</label>
                            <select class="form-control daytime_e" name="period_end_half" required disabled>
                              <option value="0">ตลอดวัน</option>
                              <option value="1" <?php echo isset($post_data['period_end_half']) && $post_data['period_end_half']==1?'selected':'';?>>ครึ่งวันเช้า</option>
                              <option class="not_daytime" value="2" <?php echo isset($post_data['period_end_half']) && $post_data['period_end_half']==2?'selected':'';?>>ครึ่งวันบ่าย</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-12">
                            <div class="input-group">
                              <span class="input-group-addon period_count">จำนวนวันลาเฉพาะวันทำการ</span>
                              <input type="text" name="period_count" class="period_count date_dis form-control" value="<?php echo isset($post_data['period_count'])?$post_data['period_count']:'1';?>" style="max-width: 60px; min-width: 60px;border-top-right-radius: .35rem;border-bottom-right-radius: .35rem;" readonly>&nbsp;
                              <span class="input-group-addon period_count_all">จำนวนวันลารวมวันหยุด</span>
                              <input type="text" name="period_count_all" class="period_count_all date_all form-control" value="<?php echo isset($post_data['period_count_all'])?$post_data['period_count_all']:'1';?>" style="max-width: 60px; min-width: 60px;" readonly>

                              <span id="noti_text" style="color: #E91E63;line-height: 38px;font-size: 14px;display:none;">&nbsp;***ท่านสามารถแก้ไขจำนวนวันลานี้ได้หรือติดต่อสอบถามงานบริหารทรัพยากรบุคคล โทร. 7936</span>
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
                            <input type="text" name="contact" class="form-control" value="<?php echo $contact;?>">
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
                        <h1 class="h4 text-gray-900 mb-4">ข้อมูลลาอุปสมบท</h1>
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

                    <div id="card_approve" class="card mb-4 border-left-danger card-default">
                      <div class="card-body">
                        <h1 class="h4 text-gray-900 mb-4">ลำดับผู้พิจารณา</h1>
                        <div class="row approve_list">
                          <div class="a1 col-lg-6 friend_approve sort_approve">
                            <div class="form-group">
                                <label><span class="no_sort">1.</span><span class="title_sort" >ผู้ปฏิบัติงานแทน</span></label>
                                <input type="text" class="input_hide form-control name_personnel name_personnel_1" auto_type="workmate" placeholder="ระบุชื่อผู้ปฏิบัติงานแทน" name="name_personnel_1" value="<?php echo isset($post_data['name_personnel_1'])?$post_data['name_personnel_1']:'';?>" disabled>
                                <input id="workmate" type="hidden" name="personnel_id_1" class="input_hide personnel_id_1" value="<?php echo isset($post_data['personnel_id_1'])?$post_data['personnel_id_1']:'';?>" disabled>
                              </div>
                          </div>
                          <div class="a2 col-lg-6 sort_approve" >
                            <div class="form-group">
                                <label><span class="no_sort">2.</span><span class="title_sort">หัวหน้าหน่วย/ หัวหน้าหอผู้ป่วย</span></label>
                                <input type="text" class="input_hide form-control name_personnel name_personnel_2 list_approve" auto_type="head_unit" placeholder="ระบุชื่อผู้พิจารณา" name="name_personnel_2" value="<?php echo isset($post_data['name_personnel_2'])?$post_data['name_personnel_2']:'';?>">
                                <input id="head_unit" type="hidden" name="personnel_id_2" class="input_hide personnel_id_2 list_approve" value="<?php echo isset($post_data['personnel_id_2'])?$post_data['personnel_id_2']:'';?>">
                                <input id="head_unit_position" type="text" class="input_hide form-control position_personnel_2 list_approve" name="position_personnel_2"  placeholder="ระบุชื่อตำแหน่งผู้พิจารณา" value="<?php echo isset($post_data['position_personnel_2'])?$post_data['position_personnel_2']:'';?>"/>
                              </div>
                          </div>
                          <div class="a3 col-lg-6 sort_approve" >
                            <div class="form-group">
                                <label><span class="no_sort">3.</span><span class="title_sort">หัวหน้าศูนย์ / หัวหน้าฝ่าย / หัวหน้างาน</span></label>
                                <input type="text" class="input_hide form-control name_personnel name_personnel_3 list_approve" auto_type="head_dept" placeholder="ระบุชื่อผู้พิจารณา" name="name_personnel_3" value="<?php echo isset($post_data['name_personnel_3'])?$post_data['name_personnel_3']:'';?>">
                                <input id="head_dept" type="hidden" name="personnel_id_3" class="input_hide personnel_id_3 list_approve" value="<?php echo isset($post_data['personnel_id_3'])?$post_data['personnel_id_3']:'';?>">
                                <input id="head_dept_position" type="text" class="input_hide form-control position_personnel_3 list_approve" name="position_personnel_3"  placeholder="ระบุชื่อตำแหน่งผู้พิจารณา" value="<?php echo isset($post_data['position_personnel_3'])?$post_data['position_personnel_3']:'';?>"/>
                              </div>
                          </div>
                          <div class="a4 col-lg-6 sort_approve" >
                            <div class="form-group">
                                <label><span class="no_sort">4.</span><span class="title_sort">หัวหน้าผู้ช่วยคณบดี / รองผู้อำนวยการ</span></label>
                                <input type="text" class="input_hide form-control name_personnel name_personnel_4 list_approve" auto_type="supervisor" placeholder="ระบุชื่อผู้พิจารณา" name="name_personnel_4" value="<?php echo isset($post_data['name_personnel_4'])?$post_data['name_personnel_4']:'';?>">
                                <input id="supervisor" type="hidden" name="personnel_id_4" class="input_hide personnel_id_4 list_approve" value="<?php echo isset($post_data['personnel_id_4'])?$post_data['personnel_id_4']:'';?>">
                                <input id="supervisor_position" type="text" class="input_hide form-control position_personnel_4 list_approve" name="position_personnel_4"  placeholder="ระบุชื่อตำแหน่งผู้พิจารณา" value="<?php echo isset($post_data['position_personnel_4'])?$post_data['position_personnel_4']:'';?>"/>
                              </div>
                          </div>

                          <div class="col-lg-6 sort_approve">
                            <div class="form-group">
                              <label><span class="no_sort">5.</span><span class="title_sort">คณบดี / รองคณบดี / หัวหน้าภาค</span></label>
                              <input type="text" class="input_hide form-control name_personnel name_personnel_5 list_approve" auto_type="deputy_dean" placeholder="ระบุชื่อผู้พิจารณา" name="name_personnel_5" value="<?php echo isset($post_data['name_personnel_5'])?$post_data['name_personnel_5']:'';?>"required >
                              <input id="deputy_dean" type="hidden" name="personnel_id_5" class="input_hide personnel_id_5 list_approve" value="<?php echo isset($post_data['personnel_id_5'])?$post_data['personnel_id_5']:'';?>" required />
                              <input id="deputy_dean_position" type="text" class="input_hide form-control position_personnel_5 list_approve" name="position_personnel_5"  placeholder="ระบุชื่อตำแหน่งผู้พิจารณา" value="<?php echo isset($post_data['position_personnel_5'])?$post_data['position_personnel_5']:'';?>" required />
                            </div>
                          </div>

                          <div class="col-lg-6 sort_approve sp">
                            <div class="form-group">
                              <label><span class="no_sort">6.</span><span class="title_sort">คณบดี</span></label>
                              <input type="text" class="input_hide form-control name_personnel name_personnel_6 list_approve" auto_type="dean" placeholder="ระบุชื่อผู้พิจารณา" name="name_personnel_6" value="<?php echo isset($post_data['name_personnel_6'])?$post_data['name_personnel_6']:'';?>"required >
                              <input id="dean" type="hidden" name="personnel_id_6" class="input_hide personnel_id_6 list_approve" value="<?php echo isset($post_data['personnel_id_6'])?$post_data['personnel_id_6']:'';?>" required />
                              <input id="dean_position" type="text" class="input_hide form-control position_personnel_6 list_approve" name="position_personnel_6"  placeholder="ระบุชื่อตำแหน่งผู้พิจารณา" value="<?php echo isset($post_data['position_personnel_6'])?$post_data['position_personnel_6']:'';?>" required />
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <input type="hidden" class="input_hide" name="url_personnel_1" value="<?php echo isset($url_approve['url_personnel_1'])?$url_approve['url_personnel_1']:'';?>" />
                    <input type="hidden" class="input_hide" name="url_personnel_2" value="<?php echo isset($url_approve['url_personnel_2'])?$url_approve['url_personnel_2']:'';?>" />
                    <input type="hidden" class="input_hide" name="url_personnel_3" value="<?php echo isset($url_approve['url_personnel_3'])?$url_approve['url_personnel_3']:'';?>" />
                    <input type="hidden" class="input_hide" name="url_personnel_4" value="<?php echo isset($url_approve['url_personnel_4'])?$url_approve['url_personnel_4']:'';?>" />
                    <input type="hidden" class="input_hide" name="url_personnel_5" value="<?php echo isset($url_approve['url_personnel_5'])?$url_approve['url_personnel_5']:'';?>" />
                    <input type="hidden" class="input_hide" name="url_personnel_6" value="<?php echo isset($url_approve['url_personnel_6'])?$url_approve['url_personnel_6']:'';?>" />
                    
                    <button type="submit" class="btn btn-primary btn-user btn-block card-default submit" s="0">บันทึก</button>

                  </form>

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

  <script src="<?php //echo base_url(load_file('assets/js/qrcodejs/qrcode.min.js'));?>"></script>

  <script src="<?php echo base_url(url_index().'leave/get_weekend/js');?>" ></script>

  <script src="<?php echo base_url(load_file('assets/vendor/jquery-ui/jquery-ui.min.js'));?>" ></script>
  
  <script>
    $(document).ready(function(){
      leave_type_form();

      $('#type_leave').change(function(){
        leave_type_form();

        var s_status = $('.submit').attr('s');
        if(($(this).val() >= 2 && $(this).val() <= 4) || $(this).val() == 9){
          leave_spec_alert(0);
        }else{
          leave_spec_alert(s_status);
        }

        
      });

      function leave_type_form(){
        var type = $('#type_leave').val();
        var type_name = $( "#type_leave option:selected" ).text();

        if(type!=0){
          $('.leave-text').text(type_name);
          $('#title').val(type_name);
          //$('.card-default').show();
          $('.card-note').hide();
        }else{
          $('.leave-text').text('');
          $('#title').val('');
          $('.card-default').hide();
          $('.card-note').show();
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
        count_date();
        if((type>=2 && type<=4) || type==10){
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
          not_daytime();
          var date_start = $('.leave_date_s_value').val();
          var date_end = $('.leave_date_e_value').val();
          var type = $('#type_leave').val();
          if((type>=1 && type<=4) && date_end == date_start){
            $('.daytime_e').attr('disabled','disabled');
          }else if(type>=1 && type<=4){
            $('.daytime_e').removeAttr('disabled');
          }
          leave_spec_alert();

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
          not_daytime();
          var date_start = $('.leave_date_s_value').val();
          var date_end = $('.leave_date_e_value').val();
          var type = $('#type_leave').val();
          if((type>=1 && type<=4) && date_end == date_start){
            $('.daytime_e').attr('disabled','disabled');
          }else if(type>=1 && type<=4){
            $('.daytime_e').removeAttr('disabled');
          }
          leave_spec_alert();

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

        daytime += $('.daytime_s').val() == 1 || $('.daytime_s').val() == 2?0.5:0;
        daytime += $('.daytime_e').val() == 1?0.5:0;

        
        if(date_end == date_start && ($('.daytime_s').val() == 1 || $('.daytime_s').val() == 2)){
          daytime = 0.5;
        }
        if(date_end == date_start){
          $('.daytime_e').attr('disabled','disabled');
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

        var type = $('#type_leave').val();
        if(type==0){
          alert('กรุณาเลือกประเภทการลาก่อนการบันทึกข้อมูลการลา');
          return false;
        }

        if($(".toBoss").val()==1){
          for(var i=1;i<=5;i++){
            if(i==1 && $('.personnel_id_'+i).val()!=0 && $('.name_personnel_'+i).val() == ''){
              alert('กรุณาระบุผู้ปฏิบัติงานแทน');
            }else if($('.personnel_id_'+i).val()!=0 && ($('.name_personnel_'+i).val() == '' || $('.position_personnel_'+i).val()=='')){
              alert('กรุณาระบุผู้พิจารณาให้ครบถ้วน');
            }
          }
        }

        leave_spec_alert();

        var s_status = $('.submit').attr('s');
        if(s_status==0){
          return false;
        }

      });

      function leave_spec_alert(alert=1){

        var type_leave = $('#type_leave').val();
        if(type_leave!=''){
          $('#preload').show();
        }
        
        var data = {
          'APP-KEY':'<?php echo $api['APP-KEY'];?>',
          ip:'<?php echo $api['ip'];?>',
          leave_type:$('#type_leave').val(),
          emp_type:'<?php echo $emp_type;?>',
          personnel:'<?php echo $personnel['personnel_id'];?>',
          period_count:$('.date_dis').val(),
          period_count_all:$('.date_all').val(),
          period_start:$('.leave_date_s_value').val(),
          period_end:$('.leave_date_e_value').val()
        };

        var result = true;
        $.ajax({
          type: "POST",
          data:data,
          url: "<?php echo base_url(url_index().'leave/api_v2/leave_spec_alert');?>",
          dataType: "json",
          success: function(data){

            console.log(data);

            list_approve = data.list_approve;
            if(data.status){
              data = data.data;

              $('.period_count, .period_count_all').hide();
              if(data.type_count == 1){
                $('.period_count').show();
              }else if(data.type_count == 0){
                $('.period_count_all').show();
              }

              var status = true;

              if(data.before[0]!=0 && status){
                if(alert){
                  alert_noti(1,data.before[0]);
                }
                status = false;
              }else if(data.before[1]!=0 && status){
                if(alert){
                  alert_noti(2,data.before[1]);
                }
                status = false;
              }

              if(data.limit!=0 && status){
                if(alert){
                  alert_noti(3,data.limit);
                }
                status = false;
              }

              if(data.rest_limit > 0 && status){
                if(alert){
                  alert_noti(4,data.rest_limit);
                }
                status = false;
              }
              // }else if(data.rest_limit == -1 && status){
              //   if(alert){
              //     alert_noti(4,0);
              //   }
              //   status = false;
              // }

              if(data.duplicate_leave && status){
                if(alert){
                  alert_noti(7);
                }
                status = false;
              }

              if(data.alert[0]!=0 && status){
                let con = confirm('ท่านจะไม่ได้รับเงินเดือนเนื่องวันลาต่อปีงบประมาณของท่านเกิน '+data.alert[0]+' วัน ท่านต้องการบันทึกข้อมูลลานี้หรือไม่');
                if(!con){
                  status = false;
                }
              }else if(data.alert[1]!=0 && status){
                let con = confirm('ท่านจะไม่ได้รับพิจาราณาเลื่อนขั้นเนื่องวันลาต่อปีงบประมาณของท่านเกิน '+data.alert[1]+' วัน ท่านต้องการบันทึกข้อมูลลานี้หรือไม่');
                if(!con){
                  status = false;
                }
              }
              

              if(status){
                $('.submit').attr('s','1');
              }else{
                $('.submit').attr('s','0');
              }

              $('.approve_list .sort_approve').hide();

              if($('#type_leave').val()==4 || $('#type_leave').val()==5){
                $('.name_personnel_5,.personnel_id_5,.position_personnel_5').removeAttr('required');
                $('.name_personnel_6,.personnel_id_6,.position_personnel_6').attr('required','required');
              }else{
                $('.name_personnel_6,.personnel_id_6,.position_personnel_6').removeAttr('required');
                $('.name_personnel_5,.personnel_id_5,.position_personnel_5').attr('required','required');
              }

              $('.list_approve').removeAttr('disabled');
              $('.card-default').show();
              if(data.approve==1 || data.approve==2){
                $(".toBoss option[value=1]").attr("selected","selected");
                $(".toBoss").val(1);

                if(data.special_fn[1]['status']){
                  var result = data.special_fn[1]['data'].split(",");

                  $.each(result,function(key,val){
                    
                    if(val!=''){
                      $('.approve_list .sort_approve').eq(parseInt(val)).show();
                    }
                  });

                  sort_approve();
                }else{
                  $('.approve_list .sort_approve').show();
                  $('.approve_list .sort_approve.sp').hide();
                }
                if(data.special_fn[2]['status']){
                  $('.period_count,period_count_all').removeAttr('readonly');
                  $('#noti_text').show();
                }else{
                  $('.period_count,period_count_all').attr('readonly','true');
                  $('#noti_text').hide();
                }

                if($('#type_leave').val()==4 || $('#type_leave').val()==5){
                  $('.approve_list .sort_approve.sp').show();
                  $('.approve_list .sort_approve').eq(4).find('.title_sort').text('รองคณบดี / หัวหน้าภาค');
                }else{
                  $('.approve_list .sort_approve').eq(4).find('.title_sort').text('คณบดี / รองคณบดี / หัวหน้าภาค');
                }

                if(data.special_fn[3]['status']){

                  var result = data.special_fn[3]['data'].split(",");

                  $.each(result,function(key,val){
                    if(val!=''){
                      $('.approve_list .sort_approve').eq(parseInt(key)+1).find('.title_sort').text(val);
                    }
                  });
                }

              }else if(data.approve==3){
                $(".toBoss option[value=2]").attr("selected","selected");
                $(".toBoss").val(2);

                if($('#type_leave').val()==4 || $('#type_leave').val()==5){
                  $('.name_personnel_5,.personnel_id_5,.position_personnel_5').removeAttr('required');
                  $('.name_personnel_6,.personnel_id_6,.position_personnel_6').attr('required','required');
                }else{
                  $('.name_personnel_6,.personnel_id_6,.position_personnel_6').removeAttr('required');
                  $('.name_personnel_5,.personnel_id_5,.position_personnel_5').attr('required','required');
                }
                
                $('.list_approve').attr('disabled','disabled');
              }
              

              if(data.friend_approve==1){
                $('.friend_approve').show();
                $('.friend_approve').find('input').removeAttr('disabled');
                sort_approve();
              }else{
                $('.friend_approve').hide();
                $('.friend_approve').find('input').attr('disabled','disabled');
                sort_approve();
              }
              $('.card-default').show();

              var i = 2;
              $.each(list_approve, function(key,val){
                $('.name_personnel_'+i).val(val.name);
                $('.personnel_id_'+i).val(val.id);
                $('.position_personnel_'+i).val(val.position);
                i++;
              });
              
            }else{
              $('.submit').attr('s','0');
              return false;
            }
            $('#preload').hide();
          }
        });
      }

      function alert_noti(type=0,data=0){
        if(type==1){
          alert('กรุณาลาล่วงหน้าอย่างน้อย '+data+' วัน (ไม่รวมวันหยุดราชการ) มิฉะนั้นท่านจะไม่สามารถบันทึกการลาได้ หากมีปัญหาติดด่อโทร. 7936');
          return false;
        }else if(type==2){
          alert('กรุณาลาล่วงหน้าอย่างน้อย  '+data+' วัน (รวมวันหยุดราชการ) มิฉะนั้นท่านจะไม่สามารถบันทึกการลาได้ หากมีปัญหาติดด่อโทร. 7936');
          return false;
        }else if(type==3){
          alert('ท่านไม่สามารถบันทึกการลาได้เนื่องจากจำนวนวันเกินสิทธิการลาต่อปีงบประมาณ '+data+' วัน  หากมีปัญหาติดด่อโทร. 7936');
          return false;
        }else if(type==4){
          alert('ท่านไม่สามารถบันทึกการลาได้เนื่องจากเกินจำนวนวันลาพักผ่อนสะสมของท่านคงเหลือ '+data+' วัน  หากมีปัญหาติดด่อโทร. 7936');
          return false;
        }else if(type==5){
          alert('ท่านไม่สามารถบันทึกการลาได้ กรุณาตรวจสอบและกรอกข้อมูลให้ครบถ้วน');
          return false;
        }else if(type==6){
          alert('ท่านไม่สามารถบันทึกการลาได้ กรุณาระบุผู้พิจารณา "คณบดี / รองคณบดี / หัวหน้าภาค"');
          return false;
        }else if(type==7){
          alert('ท่านไม่สามารถบันทึกการลาได้เนื่องจากวันลาซ้ำกับการลาอื่น ๆ ของท่านในระบบ');
          return false;
        }
      }

      var dest = getUrlParam('status','');
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

      $(".name_personnel").autocomplete({
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

      });

      $('#ok_position').click(function(){
        var type_id = $(this).attr('type_id');
        $('#'+type_id+'_position').val($('#boss_position_list .position_bosss:checked').val()).focus();
        $('#close_position').click();
      });

      let url = new URL(window.location.href);
      window.history.pushState("object or string", "Title", url.pathname);

      not_daytime();
      function not_daytime(){
        var start = $('.leave_date_s_value').val();
        var end = $('.leave_date_e_value').val();

        if(start!=end){
          $('.not_daytime').attr('disabled','disabled');
        }else{
          $('.not_daytime').removeAttr('disabled');
        }
        
      }

      function sort_approve(){
        var approve =  $('.approve_list').find('.sort_approve');
        
        var i=1;
        approve.each(function(key,val){
          if($(this).is(":visible")){
            $(this).find('.no_sort').text(i+'. ');
            i++;
          }
        });
      
      }

    });
  </script>

  <?php //echo $this->load->view('inc/alert'); ?>

</body>

</html>
