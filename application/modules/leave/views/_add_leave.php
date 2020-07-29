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
      display:none;
    }
    .qrcode img{
      width: 150px;
      margin: auto;
      margin-top: 10px;
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
            <div class="col-lg-8">

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  
                  <div class="row">
                    <div class="col-lg-4">
                      <h6 class="m-0 font-weight-bold text-primary">แบบฟอร์ม</h6>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <select id="type_leave" class="form-control">
                          <option value="" >เลือกประเภทการลา</option>
                          <?php if(isset($leave_type) and count($leave_type)>0){foreach($leave_type as $key=>$val){?>
                            <option value="<?php echo $key.'-'.$val['leave_name'];?>"><?php echo $val['leave_name'];?></option>
                          <?php }} ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">แบบฟอร์ม <span class="leave-text"></span></h1>
                  </div>

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

                  <hr/>

                  <div class="row approve_list" style="display:none;">

                    <div class="a1 col-lg-6" id="workmate-box" style="display:none;">
                      <div class="form-group">
                          <label>ผู้ปกิบัติงานแทน *</label>
                          <!-- <select id="workmate" class="input_hide form-control" name="worker_personnel_id" form="" require disabled>
                            <option value="0">เลือกผู้ปฏิบัติงานแทน</option>
                            <?php //if(isset($friend) and count($friend['data'])>0){ foreach($friend['data'] as $key=>$val){ if($val['personnel_id']!=$personnel['personnel_id']){?>
                              <option value="<?php /*echo $val['personnel_id'];?>"><?php echo $val['title'].$val['name_th'].' '.$val['surname_th'];?></option>
                              <?php }}}*/ ?>
                          </select> -->

                          <input type="text" class="input_hide form-control auto-workmate" auto_type="workmate" placeholder="เลือกผู้ปฏิบัติงานแทน" require>
                          <input id="workmate" type="hidden" name="worker_personnel_id" class="input_hide" form="">
                        </div>
                    </div>

                    <?php if(!(isset($personnel['smu_main_id']) and intval($personnel['smu_main_id'])!=0 and substr($personnel['smu_main_id'],0,1) == 2)){?>
                      <div class="a2 col-lg-6" >
                        <div class="form-group">
                            <label>หัวหน้าหน่วย/ หัวหน้าหอผู้ป่วย *</label>
                            <!-- <select id="head_unit" class="select_app input_hide form-control" name="head_unit_personnel_id" form="" require>
                              <option value="">เลือกหัวหน้าหน่วย</option>
                              <option value="0">ไม่มีหัวหน้าหน่วย</option>
                              <?php /*if(isset($boss) and count($boss['data'])>0){ foreach($boss['data'] as $key=>$val){ ?>
                                <option value="<?php echo $val['personnel_id'];?>">
                                  <?php echo $val['title'].$val['name_th'].' '.$val['surname_th'].(trim($val['position_boss'])!=''?' ('.$val['position_boss'].')':'');?>
                                </option>
                              <?php }}*/ ?>
                            </select> -->

                            <input type="text" class="input_hide form-control auto-head_unit" auto_type="head_unit" placeholder="เลือกหัวหน้าหน่วย" require>
                            <input id="head_unit" type="hidden" name="head_unit_personnel_id" class="input_hide" form="">
                            <input id="head_unit_position" type="text" class="input_hide form-control" name="head_unit_position" form="" placeholder="ระบุชื่อตำแหน่ง" require/>
                          </div>
                      </div>
                      <div class="a3 col-lg-6" >
                        <div class="form-group">
                            <label>หัวหน้าศูนย์ / หัวหน้าฝ่าย / หัวหน้างาน *</label>
                            <!-- <select id="head_dept" class="select_app input_hide form-control" name="head_dept_personnel_id" form="" require>
                              <option value="">เลือกหัวหน้างาน</option>
                              <?php /*if(isset($boss) and count($boss['data'])>0){ foreach($boss['data'] as $key=>$val){ ?>
                                <option value="<?php echo $val['personnel_id'];?>">
                                  <?php echo $val['title'].$val['name_th'].' '.$val['surname_th'].(trim($val['position_boss'])!=''?' ('.$val['position_boss'].')':'');?>
                                </option>
                              <?php }}*/ ?>
                            </select> -->

                            <input type="text" class="input_hide form-control auto-head_dept" auto_type="head_dept" placeholder="เลือกหัวหน้างาน" require>
                            <input id="head_dept" type="hidden" name="head_dept_personnel_id" class="input_hide" form="">
                            <input id="head_dept_position" type="text" class="input_hide form-control" name="head_dept_position" form="" placeholder="ระบุชื่อตำแหน่ง" require/>
                          </div>
                      </div>
                      <div class="a4 col-lg-6" >
                        <div class="form-group">
                            <label>หัวหน้าผู้ช่วยคณบดี / รองผู้อำนวยการ *</label>
                            <!-- <select id="supervisor" class="select_app input_hide form-control" name="supervisor_personnel_id" form="" require>
                              <option value="">เลือกหัวหน้าฝ่าย</option>
                              <option value="0">ไม่มีหัวหน้าฝ่าย</option>
                              <?php /*if(isset($boss) and count($boss['data'])>0){ foreach($boss['data'] as $key=>$val){ ?>
                                <option value="<?php echo $val['personnel_id'];?>">
                                  <?php echo $val['title'].$val['name_th'].' '.$val['surname_th'].(trim($val['position_boss'])!=''?' ('.$val['position_boss'].')':'');?>
                                </option>
                              <?php }}*/ ?>
                            </select> -->
                            <input type="text" class="input_hide form-control auto-supervisor" auto_type="supervisor" placeholder="เลือกหัวหน้าฝ่าย" require>
                            <input id="supervisor" type="hidden" name="supervisor_personnel_id" class="input_hide" form="">
                            <input id="supervisor_position" type="text" class="input_hide form-control" name="supervisor_position" form="" placeholder="ระบุชื่อตำแหน่ง" require/>
                          </div>
                      </div>
                    <?php } ?>
                    
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>คณบดี / รองคณบดี / หัวหน้าภาค *</label>
                        <!-- <select id="deputy_dean" class="input_hide form-control" name="deputy_dean_personnel_id" form="" require>
                          <option value="0">เลือกรองคณบดี หรือหัวหน้าภาควิชา</option>
                          <?php /*if(isset($boss) and count($boss['data'])>0){ foreach($boss['data'] as $key=>$val){ ?>
                            <option value="<?php echo $val['personnel_id'];?>">
                              <?php echo $val['title'].$val['name_th'].' '.$val['surname_th'].(trim($val['position_boss'])!=''?' ('.$val['position_boss'].')':'');?>
                            </option>
                          <?php }}*/ ?>
                        </select> -->
                        <input type="text" class="input_hide form-control auto-deputy_dean" auto_type="deputy_dean" placeholder="รองคณบดี หรือหัวหน้าภาควิชา" require>
                        <input id="deputy_dean" type="hidden" name="deputy_dean_personnel_id" class="input_hide" form="">
                        <input id="deputy_dean_position" type="text" class="input_hide form-control" name="deputy_dean_position" form="" placeholder="ระบุชื่อตำแหน่ง" require/>
                      </div>
                    </div>
                  </div>

                  <button type="submit" id="submit-form" status_sub="false" form="" class="btn btn-primary btn-user btn-block" style="display:none;">บันทึก</button>

                </div>
              </div>

            </div>
            <div class="col-lg-4">

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">คำนวณวันลา(เฉพาะการลาผักผ่อน)</h6>
                </div>
                <div class="card-body">
                  <table width="100%">
                    <tr>
                      <td height="35px">วันลาที่คงเหลือ</td>
                      <td><?php echo isset($leave_quota)?$leave_quota[0]['quota_total']:0;?> วัน</td>
                    </tr>
                    <tr>
                      <td height="35px">ใช้วันลาไป</td>
                      <td class="date-cal" total="<?php echo isset($leave_quota)?$leave_quota[0]['quota_total']:0;?>">
                        <span style="display:none;">-</span>
                        <button type="button" class=" btn btn-warning btn-circle btn-sm" title="กรุณากรอกเลือกวันลาในแบบฟอร์ม">
                          <i class="fas fa-exclamation-triangle"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td height="35px">คงเหลือวันลา</td>
                      <td class="date-cal-total"><?php echo isset($leave_quota)?$leave_quota[0]['quota_total']:0;?> วัน</td>
                    </tr>
                  </table>
                </div>
              </div>

              <!-- Basic Card Example -->
              <div class="card shadow mb-4" style="display:none;">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">ลงลายเซ็น</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <div class="qrcode" id="qrcode1"></div>
                      </div>
                    </div>
                  </div>
                  <hr/>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <div class="qrcode" id="qrcode2"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <div class="qrcode" id="qrcode3"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <div class="qrcode" id="qrcode4"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <div class="qrcode" id="qrcode5"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <div class="qrcode" id="qrcode6"></div>
                      </div>
                    </div>
                  </div>
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
          var strMonthFull = ["","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"];
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
    
  </script>

  <?php echo $this->load->view('inc/alert'); ?>

</body>

</html>
