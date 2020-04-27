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

<body id="page-top">
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

                  <form class="form leave" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input type="text" name="write_at" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์" required>
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select name="to" class="form-control" required>
                          <option value="1">คณะบดีคณะแพทยศาสตร์</option>
                          <option value="2">อธิกาารบดี</option>
                          <option value="3">อธิกาารบดี (คณะบดีคณะแพทยศาสตร์)</option>
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
                        <select name="period_type" class="type_leave_date form-control" required>
                          <option value="c">กำหนดระยะเวลา</option>
                          <option value="a">เช้า</option>
                          <option value="p">บ่าย</option>
                        </select>
                      </div>
                      <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>ตั้งแต่วันที่</label>
                        <input type="date" name="period_start" class="leave_date_s form-control" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                      <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>ถึงวันที่</label>
                        <input type="date" name="period_end" class="leave_date_e form-control" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>ช้อมูลติดต่อ</label>
                        <textarea name="contact" id="" class="form-control" cols="30" rows="3" required></textarea>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">บันทึก</button>
                    <input class="workmate" type="hidden" name="worker_personnel_id"/>
                    <input class="boss" type="hidden" name="boss_personnel_id"/>
                    <input class="period_count" type="hidden" name="period_count" value="1"/>
                    <input class="type" type="hidden" name="leave_type_id"/>
                    <input type="hidden" class="qr_personnel" name="qr_personnel">
                    <input type="hidden" class="url_personnel" name="url_personnel" value="<?php echo isset($url_qr['personnel'])?$url_qr['personnel']:'';?>">
                    <input type="hidden" class="qr_workmate" name="qr_workmate">
                    <input type="hidden" class="url_workmate" name="url_workmate" value="<?php echo isset($url_qr['workmate'])?$url_qr['workmate']:'';?>">
                    <input type="hidden" class="qr_boss" name="qr_boss">
                    <input type="hidden" class="url_boss" name="url_boss" value="<?php echo isset($url_qr['boss'])?$url_qr['boss']:'';?>">

                  </form>

                  <form class="form oversea" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input name="write_at" type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์" required>
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select name="to" class="form-control" required>
                          <option value="1">คณะบดีคณะแพทยศาสตร์</option>
                          <option value="2">อธิกาารบดี</option>
                          <option value="3">อธิกาารบดี (คณะบดีคณะแพทยศาสตร์)</option>
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
                      <div class="col-sm-6">
                        <label>ตั้งแต่วันที่</label>
                        <input name="period_start" type="date" class="date_s form-control" form_no="1" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                      <div class="col-sm-6">
                        <label>ถึงวันที่</label>
                        <input name="period_end" type="date" class="date_e form-control" form_no="1" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">บันทึก</button>
                    <input class="workmate" type="hidden" name="worker_personnel_id"/>
                    <input class="boss" type="hidden" name="boss_personnel_id"/>
                    <input class="period_count" type="hidden" name="period_count" value="1"/>
                    <input class="type" type="hidden" name="leave_type_id"/>
                    <input type="hidden" class="qr_personnel" name="qr_personnel">
                    <input type="hidden" class="url_personnel" name="url_personnel" value="<?php echo isset($url_qr['personnel'])?$url_qr['personnel']:'';?>">
                    <input type="hidden" class="qr_workmate" name="qr_workmate">
                    <input type="hidden" class="url_workmate" name="url_workmate" value="<?php echo isset($url_qr['workmate'])?$url_qr['workmate']:'';?>">
                    <input type="hidden" class="qr_boss" name="qr_boss">
                    <input type="hidden" class="url_boss" name="url_boss" value="<?php echo isset($url_qr['boss'])?$url_qr['boss']:'';?>">
                  </form>

                  <form class="form ordination" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input name="write_at" type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์" required>
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select name="to" class="form-control" required>
                          <option value="1">คณะบดีคณะแพทยศาสตร์</option>
                          <option value="2">อธิกาารบดี</option>
                          <option value="3">อธิกาารบดี (คณะบดีคณะแพทยศาสตร์)</option>
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
                        <input name="period_start" type="date" class="date_s form-control" form_no="2" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                      <div class="col-sm-4">
                        <label>ถึงวันที่</label>
                        <input name="period_end" type="date" class="date_e form-control" form_no="2" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                      <div class="col-sm-4">
                        <label>วันที่อุปสมบท</label>
                        <input name="ordination_date" type="date" class="form-control" required>
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

                    <button type="submit" class="btn btn-primary btn-user btn-block">บันทึก</button>
                    <input class="boss" type="hidden" name="boss_personnel_id"/>
                    <input class="period_count" type="hidden" name="period_count" value="1"/>
                    <input class="type" type="hidden" name="leave_type_id"/>
                    <input type="hidden" class="qr_personnel" name="qr_personnel">
                    <input type="hidden" class="url_personnel" name="url_personnel" value="<?php echo isset($url_qr['personnel'])?$url_qr['personnel']:'';?>">
                    <input type="hidden" class="qr_boss" name="qr_boss">
                    <input type="hidden" class="url_boss" name="url_boss" value="<?php echo isset($url_qr['boss'])?$url_qr['boss']:'';?>">
                  </form>

                  <form class="form help_childcare" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input name="write_at" type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์" required>
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select name="to" class="form-control" required>
                          <option value="1">คณะบดีคณะแพทยศาสตร์</option>
                          <option value="2">อธิกาารบดี</option>
                          <option value="3">อธิกาารบดี (คณะบดีคณะแพทยศาสตร์)</option>
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
                        <input name="child_birthdate" type="date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                      <div class="col-sm-4">
                        <label>ลาตั้งแต่วันที่</label>
                        <input name="period_start" type="date" class="date_s form-control" form_no="3" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                      <div class="col-sm-4">
                        <label>ลาถึงวันที่</label>
                        <input name="period_end" type="date" class="date_e form-control" form_no="3" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>ช้อมูลติดต่อ</label>
                        <textarea name="contact" id="" class="form-control" cols="30" rows="3" required></textarea>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">บันทึก</button>
                    <input class="boss" type="hidden" name="boss_personnel_id"/>
                    <input class="period_count" type="hidden" name="period_count" value="1"/>
                    <input class="type" type="hidden" name="leave_type_id"/>
                    <input type="hidden" class="qr_personnel" name="qr_personnel">
                    <input type="hidden" class="url_personnel" name="url_personnel" value="<?php echo isset($url_qr['personnel'])?$url_qr['personnel']:'';?>">
                    <input type="hidden" class="qr_boss" name="qr_boss">
                    <input type="hidden" class="url_boss" name="url_boss" value="<?php echo isset($url_qr['boss'])?$url_qr['boss']:'';?>">
                  </form>

                  <form class="form leave_childcare" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input name="write_at" type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์" required>
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select name="to" class="form-control" required>
                          <option value="1">คณะบดีคณะแพทยศาสตร์</option>
                          <option value="2">อธิกาารบดี</option>
                          <option value="3">อธิกาารบดี (คณะบดีคณะแพทยศาสตร์)</option>
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
                        <input name="child_birthdate_start" type="date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                      <div class="col-sm-6">
                        <label>ถึงวันที่</label>
                        <input name="child_birthdate_end" type="date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>ขอลากิจเพื่อเลี้ยงดูบุตรตั้งแต่วันที่</label>
                        <input name="period_start" type="date" class="date_s form-control" form_no="4" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                      <div class="col-sm-6">
                        <label>ถึงวันที่</label>
                        <input name="period_end" type="date" class="date_e form-control" form_no="4" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">บันทึก</button>
                    <input class="boss" type="hidden" name="boss_personnel_id"/>
                    <input class="period_count" type="hidden" name="period_count" value="1"/>
                    <input class="type" type="hidden" name="leave_type_id"/>
                    <input type="hidden" class="qr_personnel" name="qr_personnel">
                    <input type="hidden" class="url_personnel" name="url_personnel" value="<?php echo isset($url_qr['personnel'])?$url_qr['personnel']:'';?>">
                    <input type="hidden" class="qr_boss" name="qr_boss">
                    <input type="hidden" class="url_boss" name="url_boss" value="<?php echo isset($url_qr['boss'])?$url_qr['boss']:'';?>">
                  </form>

                  <form class="form soldier" action="<?php echo base_url(url_index().'leave/save_leave');?>" method="post">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input name="write_at" type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์" required>
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select name="to" class="form-control" required>
                          <option value="1">คณะบดีคณะแพทยศาสตร์</option>
                          <option value="2">อธิกาารบดี</option>
                          <option value="3">อธิกาารบดี (คณะบดีคณะแพทยศาสตร์)</option>
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
                      <div class="col-sm-6">
                        <label>หมายเรียกลงวันที่</label>
                        <input name="call_date" type="date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                      <div class="col-sm-6">
                        <label>ให้รับการฝึกที่</label>
                        <input name="train_address" type="text" class="form-control" placeholder="ระบุชื่อสถานที่เข้ารับการฝึก" value="" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>ฝึกตั้งแต่วันที่</label>
                        <input name="period_start" type="date" class="date_s form-control" form_no="5" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                      <div class="col-sm-6">
                        <label>ถึงวันที่</label>
                        <input name="period_end" type="date" class="date_e form-control" form_no="5" value="<?php echo date('Y-m-d');?>" required>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">บันทึก</button>
                    <input class="boss" type="hidden" name="boss_personnel_id"/>
                    <input class="period_count" type="hidden" name="period_count" value="1"/>
                    <input class="type" type="hidden" name="leave_type_id"/>
                    <input type="hidden" class="qr_personnel" name="qr_personnel">
                    <input type="hidden" class="url_personnel" name="url_personnel" value="<?php echo isset($url_qr['personnel'])?$url_qr['personnel']:'';?>">
                    <input type="hidden" class="qr_boss" name="qr_boss">
                    <input type="hidden" class="url_boss" name="url_boss" value="<?php echo isset($url_qr['boss'])?$url_qr['boss']:'';?>">
                    
                  </form>

                </div>
              </div>

            </div>
            <div class="col-lg-4">

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">คำนวณวันลา</h6>
                </div>
                <div class="card-body">
                  <table width="100%">
                    <tr>
                      <td width="120px" height="35px">วันลาที่ใช้ไปแล้ว</td>
                      <td>2.5 วัน</td>
                    </tr>
                    <tr>
                      <td height="35px">วันลาที่คงเหลือ</td>
                      <td>17.5 วัน</td>
                    </tr>
                    <tr>
                      <td height="35px">ใช้วันลาไป</td>
                      <td class="date-cal">
                        <span style="display:none;">-</span>
                        <button type="button" class=" btn btn-warning btn-circle btn-sm" title="กรุณากรอกเลือกวันลาในแบบฟอร์ม">
                          <i class="fas fa-exclamation-triangle"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td height="35px">คงเหลือวันลา</td>
                      <td>17 วัน</td>
                    </tr>
                  </table>
                </div>
              </div>

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">ตัวเลือกเพื่อการอนุมัติ</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div id="workmate-box" class="form-group" style="display:none;">
                        <label>ผู้ปฏิบัติงานแทน</label>
                        <select id="workmate" class="form-control">
                          <option value="0">เลือกผู้ปฏิบัติงานแทน</option>
                          <?php if(isset($friend) and count($friend['data'])>0){ foreach($friend['data'] as $key=>$val){ if($val['personnel_id']!=$personnel['personnel_id']){?>
                            <option value="<?php echo $val['personnel_id'];?>"><?php echo $val['title'].$val['name_th'].' '.$val['surname_th'];?></option>
                            <?php }}} ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                          <label>ผู้บังคับบัญชา</label>
                          <select id="boss" class="form-control">
                            <option value="0">เลือกผู้บังคับบัญชา</option>
                            <?php if(isset($boss) and count($boss['data'])>0){ foreach($boss['data'] as $key=>$val){ ?>
                            <option value="<?php echo $val['personnel_id'];?>"><?php echo $val['title'].$val['name_th'].' '.$val['surname_th'];?></option>
                            <?php }} ?>
                          </select>
                        </div>
                    </div>
                  </div>
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
                        <label>ลงลายเช็นผู้ลา</label>
                        <div class="qrcode" id="qrcode1"></div>
                      </div>
                    </div>
                  </div>
                  <hr/>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label>ลงลายเช็นผู้ทำงานแทน</label>
                        <div class="qrcode" id="qrcode2"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label>ลงลายเช็นผู้บังคับบัญชา</label>
                        <div class="qrcode" id="qrcode3"></div>
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

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php echo $this->load->view('inc/scroll_to'); ?>
  
  <?php echo $this->load->view('inc/logout'); ?>
  
  <?php echo $this->load->view('inc/js'); ?>

  <script src="<?php echo base_url(load_file('assets/js/qrcodejs/qrcode.min.js'));?>"></script>

  <script src="<?php echo base_url(url_index().'leave/get_weekend/js');?>" ></script>

  <script>
    $(document).ready(function(){

      var qrcode1 = new QRCode("qrcode1", {
        text: "<?php echo isset($url_qr['personnel'])?$url_qr['personnel']:'';?>",
        width: 300,
        height: 300,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
      });
      var qrcode2 = new QRCode("qrcode2", {
        text: "<?php echo isset($url_qr['workmate'])?$url_qr['workmate']:'';?>",
        width: 300,
        height: 300,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
      });
      var qrcode3 = new QRCode("qrcode3", {
        text: "<?php echo isset($url_qr['boss'])?$url_qr['boss']:'';?>",
        width: 300,
        height: 300,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
      });

      var leave_type;
      $('#type_leave').change(function(){
        var type = $(this).val();
        if(type!=''){
          type = type.split("-");
          if(type.length == 2){
            leave_type = type[0];
            $('.leave-text').text(type[1]);
            $('.form').hide();
            if(type[0]>=1 && type[0]<=4){
              $('.form.leave').show();
              $('.date-cal button').hide();
              $('.date-cal span').text('1 วัน').show();
              $('#workmate-box').show();
              $('.leave_title').val(type[1]);
            }else if(leave_type==5){
              $('.form.help_childcare').show();
              $('.date-cal span').hide();
              $('.date-cal button').show();
              $('#workmate-box').hide();
            }else if(leave_type==6){
              $('.form.leave_childcare').show();
              $('.date-cal span').hide();
              $('.date-cal button').show();
              $('#workmate-box').hide();
              $('.leave_title').val(type[1]);
            }else if(leave_type==7){
              $('.form.oversea').show();
              $('.date-cal button').hide();
              $('.date-cal span').text('1 วัน').show();
              $('#workmate-box').hide();
            }else if(leave_type==8){
              $('.form.ordination').show();
              $('.date-cal span').hide();
              $('.date-cal button').show();
              $('#workmate-box').hide();
            }else if(leave_type==9){
              $('.form.soldier').show();
              $('.date-cal span').hide();
              $('.date-cal button').show();
              $('#workmate-box').hide();
            }
            $('.type').val(leave_type);
          }
        }else{
          $('.leave-text').text('');
          $('.form').hide();
          $('.date-cal span').hide();
          $('.date-cal button').show();
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
          $('.date-cal span').text('0.5 วัน'+(type_leave_date=='a'?'(เช้า)':'(บ่าย)')).show();
        }else{
          $('.leave_date_e').val(old_end_date);
          old_end_date = '';
          $('.leave_date_e').removeAttr('disabled');
        }
      });

      $('.leave_date_s,.leave_date_e,.type_leave_date').change(function(){
        if(type_leave_date == 'c'){
          var date_start = $('.leave_date_s').val();
          var date_end = $('.leave_date_e').val();
          var date_dis = dis_date(date_end,date_start);

          $('.date-cal button').hide();
          var count_date = (days_between(date_end,date_start) - date_dis);
          $('.date-cal span').text(count_date+' วัน').show();
          $('.period_count').val(count_date);
        }
      });

      $('.date_s,.date_e,.type_leave_date').change(function(){
          var form = $(this).attr('form_no');

          var date_start = $('.date_s[form='+form+']').val();
          var date_end = $('.date_e[form='+form+']').val();

          $('.date-cal button').hide();
          var count_date = days_between(date_end,date_start);
          $('.date-cal span').text(days_between(date_end,date_start)+' วัน').show();
          $('.period_count').val(count_date);
      });

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

      $('.form').submit(function(){

        var workmate = $('#workmate').val();
        var boss = $('#boss').val();

        if(leave_type>4){
          if(boss==0){
            alert('กรุณาเลือกผู้ปฏิบัติงานแทนและผู้บังคับบัญชาให้ถูกต้อง');
            return false;
          }
        }else{
          if(boss==0 || workmate==0){
          alert('กรุณาเลือกผู้ปฏิบัติงานแทนและผู้บังคับบัญชาให้ถูกต้อง');
          return false;
        }
        }

        $('.qr_personnel').val($('#qrcode1 img').attr('src'));
        $('.qr_workmate').val($('#qrcode2 img').attr('src'));
        $('.qr_boss').val($('#qrcode3 img').attr('src'));
        $('.workmate').val(workmate);
        $('.boss').val(boss);
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
      
    });
  </script>

</body>

</html>
