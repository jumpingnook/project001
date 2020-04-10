<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Blank</title>


  <?php echo $this->load->view('inc/css'); ?>

  <style>
    .form{
      display:none;
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
                          <option value="">เลือกประเภทการลา</option>
                          <option value="1-ลาพักผ่อน">ลาพักผ่อน</option>
                          <option value="2-ลากิจส่วนตัว">ลากิจส่วนตัว</option>
                          <option value="3-ลาป่วย">ลาป่วย</option>
                          <option value="4-ลาคลอดบุตร">ลาคลอดบุตร</option>
                          <option value="5-ลาไปช่วยเหลือภริยาที่คลอดบุตร">ลาไปช่วยเหลือภริยาที่คลอดบุตร</option>
                          <option value="6-ลากิจส่วนตัวเพื่อเลี้ยงดูบุตร">ลากิจส่วนตัวเพื่อเลี้ยงดูบุตร</option>
                          <option value="7-ลาพักผ่อนไปต่างประเทศ">ลาพักผ่อนไปต่างประเทศ</option>
                          <option value="8-ลาอุปสมบทหรือลาไปประกอบบพิธีการฮัจย์">ลาอุปสมบทหรือลาไปประกอบบพิธีการฮัจย์</option>
                          <option value="9-ลาเข้ารับการตรวจเลือกหรือเข้ารับการเตรียมพล">ลาเข้ารับการตรวจเลือกหรือเข้ารับการเตรียมพล</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">แบบฟอร์ม <span class="leave-text"></span></h1>
                  </div>

                  <form class="form leave">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์">
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select class="form-control">
                          <option>คณะบดีคณะแพทยศาสตร์</option>
                          <option>อธิกาารบดี</option>
                          <option>อธิกาารบดี (คณะบดีคณะแพทยศาสตร์)</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>เรื่อง</label>
                        <input type="text" class="form-control" id="exampleLastName" placeholder="ขอลาป่วย" value="ขอลาป่วย">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>ข้าพขอลา... เนื่องจาก</label>
                        <input type="text" class="form-control" id="exampleLastName" placeholder="ระบุสาเหตุ" value="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-4">
                        <label>ช่วงเวลา</label>
                        <select class="type_leave_date form-control">
                          <option value="c">กำหนดระยะเวลา</option>
                          <option value="a">เช้า</option>
                          <option value="p">บ่าย</option>
                        </select>
                      </div>
                      <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>ตั้งแต่วันที่</label>
                        <input type="date" class="leave_date_s form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-4 mb-3 mb-sm-0">
                        <label>ถึงวันที่</label>
                        <input type="date" class="leave_date_e form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>ช้อมูลติดต่อ</label>
                        <textarea name="" id="" class="form-control" cols="30" rows="3"></textarea>
                      </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-user btn-block">บันทึก</button>

                  </form>

                  <form class="form oversea">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์">
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select class="form-control">
                          <option>คณะบดีคณะแพทยศาสตร์</option>
                          <option>อธิกาารบดี</option>
                          <option>อธิกาารบดี (คณะบดีคณะแพทยศาสตร์)</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>มีความประสงค์จะลา</label>
                        <input type="text" class="form-control" placeholder="ระบุจุดประสงค์" value="">
                      </div>
                      <div class="col-sm-6">
                        <label>ณ ประเทศ</label>
                        <input type="text" class="form-control" placeholder="ระบุประเทศ" value="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>ตั้งแต่วันที่</label>
                        <input type="date" class="oversea_date_s form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-6">
                        <label>ถึงวันที่</label>
                        <input type="date" class="oversea_date_e form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-user btn-block">บันทึก</button>

                  </form>

                  <form class="form ordination">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์">
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select class="form-control">
                          <option>คณะบดีคณะแพทยศาสตร์</option>
                          <option>อธิกาารบดี</option>
                          <option>อธิกาารบดี (คณะบดีคณะแพทยศาสตร์)</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>ท่านเคยอุปสมหรือไม่</label>
                        <select class="form-control">
                          <option>ยังไม่เคย</option>
                          <option>เคย</option>
                        </select>
                      </div>
                      <div class="col-sm-4"></div>
                      <div class="col-sm-2">
                        <label>จำนวนวัน</label>
                        <input type="number" class="form-control" value="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-4">
                        <label>ตั้งแต่วันที่</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-4">
                        <label>ถึงวันที่</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-4">
                        <label>วันที่อุปสมบท</label>
                        <input type="date" class="form-control">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>วัดที่อุปสมบท ณ วัด</label>
                        <input type="text" class="form-control" placeholder="ชื่อวัดที่อุปสมบท" value="">
                      </div>
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>ตั้งอยู่ ณ</label>
                        <input type="text" class="form-control" placeholder="ที่ตั้งวัดที่อุปสมบท" value="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>จำพรรษา ณ วัด</label>
                        <input type="text" class="form-control" placeholder="ชื่อวัดที่จำพรรษา" value="">
                      </div>
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>ตั้งอยู่ ณ</label>
                        <input type="text" class="form-control" placeholder="ที่ตั้งวัดที่จำพรรษา" value="">
                      </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-user btn-block">บันทึก</button>

                  </form>

                  <form class="form help_childcare">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์">
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select class="form-control">
                          <option>คณะบดีคณะแพทยศาสตร์</option>
                          <option>อธิกาารบดี</option>
                          <option>อธิกาารบดี (คณะบดีคณะแพทยศาสตร์)</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>มีความประสงค์จะลาไปช่วยเหลือภริยาโดยชอบด้วยกฏหมาย ชื่อ</label>
                        <input type="text" class="form-control" placeholder="ระบุชื่อภริยา" value="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-4">
                        <label>คลอดบุตรเมื่อวันที่</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-4">
                        <label>ลาตั้งแต่วันที่</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-4">
                        <label>ลาถึงวันที่</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>ช้อมูลติดต่อ</label>
                        <textarea name="" id="" class="form-control" cols="30" rows="3"></textarea>
                      </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-user btn-block">บันทึก</button>

                  </form>

                  <form class="form leave_childcare">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์">
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select class="form-control">
                          <option>คณะบดีคณะแพทยศาสตร์</option>
                          <option>อธิกาารบดี</option>
                          <option>อธิกาารบดี (คณะบดีคณะแพทยศาสตร์)</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>เรื่อง</label>
                        <input type="text" class="form-control" value="ขอลากิจส่วนตัวเพื่อเลี้ยงดูบุตร(โดยไม่ได้รับเงินเดือน)">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>ได้คลอดบุตรตั้งแต่วันที่</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-6">
                        <label>ถึงวันที่</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>ขอลากิจเพื่อเลี้ยงดูบุตรตั้งแต่วันที่</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-6">
                        <label>ถึงวันที่</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-user btn-block">บันทึก</button>

                  </form>

                  <form class="form soldier">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์">
                      </div>
                      <div class="col-sm-6">
                        <label>เรียน</label>
                        <select class="form-control">
                          <option>คณะบดีคณะแพทยศาสตร์</option>
                          <option>อธิกาารบดี</option>
                          <option>อธิกาารบดี (คณะบดีคณะแพทยศาสตร์)</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>ข้าพเจ้าได้รับหมายเรียกของ</label>
                        <input type="text" class="form-control" placeholder="ระบุข้อมูลหมายเรียก" value="">
                      </div>
                      <div class="col-sm-6">
                        <label>ที่</label>
                        <input type="text" class="form-control" placeholder="ระบุที่มาของหมายเรียก" value="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>หมายเรียกลงวันที่</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-6">
                        <label>ให้รับการฝึกที่</label>
                        <input type="text" class="form-control" placeholder="ระบุชื่อสถานที่เข้ารับการฝึก" value="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label>ฝึกตั้งแต่วันที่</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                      <div class="col-sm-6">
                        <label>ถึงวันที่</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
                      </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-user btn-block">บันทึก</button>

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
                      <div class="form-group">
                        <label>ผู้ปฏิบัติงานแทน</label>
                        <select class="form-control">
                          <option>เลือกผู้ปฏิบัติงานแทน</option>
                          <option>นายสนาน ราตรีพรทิพย์</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                          <label>ผู้บังคับบัญชา</label>
                          <select class="form-control">
                            <option>เลือกผู้บังคับบัญชา</option>
                            <option>นายสนาน ราตรีพรทิพย์</option>
                          </select>
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
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php echo $this->load->view('inc/scroll_to'); ?>
  
  <?php echo $this->load->view('inc/logout'); ?>
  
  <?php echo $this->load->view('inc/js'); ?>

  <script src="<?php echo base_url(url_index().'leave/get_weekend/js');?>" ></script>

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
            if(type[0]>=1 && type[0]<=4){
              $('.form.leave').show();
              $('.date-cal button').hide();
              $('.date-cal span').text('1 วัน').show();
            }else if(leave_type==5){
              $('.form.help_childcare').show();
              $('.date-cal span').hide();
              $('.date-cal button').show();
            }else if(leave_type==6){
              $('.form.leave_childcare').show();
              $('.date-cal span').hide();
              $('.date-cal button').show();
            }else if(leave_type==7){
              $('.form.oversea').show();
              $('.date-cal button').hide();
              $('.date-cal span').text('1 วัน').show();
            }else if(leave_type==8){
              $('.form.ordination').show();
              $('.date-cal span').hide();
              $('.date-cal button').show();
            }else if(leave_type==9){
              $('.form.soldier').show();
              $('.date-cal span').hide();
              $('.date-cal button').show();
            }
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

          console.log(date_dis);

          //ajax

          $('.date-cal button').hide();
          $('.date-cal span').text((days_between(date_end,date_start) - date_dis)+' วัน').show();
        }
      });

      $('.oversea_date_s,.oversea_date_e,.type_leave_date').change(function(){
        if(leave_type == 7){
          var date_start = $('.oversea_date_s').val();
          var date_end = $('.oversea_date_e').val();

          //ajax

          $('.date-cal button').hide();
          $('.date-cal span').text(days_between(date_end,date_start)+' วัน').show();
        }
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

    });
  </script>

</body>

</html>
