<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>รายละเอียดการลา - LeaveSystem - med.nu.ac.th</title>

  <?php echo $this->load->view('inc/css'); ?>
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
          <div class="d-sm-flex align-items-center mb-4">
            <?php if(!isset($view_only) or (isset($view_only) and $view_only)){ ?>
              <h1 class="h3 mb-0 text-gray-800">ข้อมูลการลาเลขที่ <?php echo isset($data['leave_no'])?$data['leave_no']:'0';?></h1>
            <?php }elseif(isset($view_only) and !$view_only){ ?>
              <h1 class="h3 mb-0 text-gray-800">ไม่พบบข้อมูลการลา</h1>
            <?php } ?>
          </div>

          <div class="row">
            <div class="col-lg-9">
              
              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">รายละเอียดการลา</h6>
                </div>

                <div class="card-body">
                <?php if(!isset($view_only) or (isset($view_only) and $view_only)){ ?>
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="row mb-2">
                        <div class="col-lg-12 font-weight-bold">
                          <img src="<?php echo isset($personnel['img'])&&trim($personnel['img'])!=''?$personnel['img']:'';?>" style="max-width: 200px;width: 100%;display: block;min-height: 235px;background-color: #ccc;"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <div class="text-s font-weight-bold text-primary text-uppercase mb-1">ข้อมูลผู้ลา</div>
                      <div class="row">
                        <div class="col-lg-3 font-weight-bold">
                          รหัสพนักงาน
                        </div>
                        <div class="col-lg-9">
                          <?php echo isset($personnel['data']['personnel_code'])?$personnel['data']['personnel_code']:'-';?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 font-weight-bold">
                          ชื่อ - นามสกุล
                        </div>
                        <div class="col-lg-9">
                          <?php 
                            echo isset($personnel['data']['title'])?$personnel['data']['title']:'-'; 
                            echo isset($personnel['data']['name_th'])?$personnel['data']['name_th'].' ':'-'; 
                            echo isset($personnel['data']['surname_th'])?$personnel['data']['surname_th']:'-'; 
                          ?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 font-weight-bold">
                          ตำแหน่ง
                        </div>
                        <div class="col-lg-9">
                          <?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 font-weight-bold">
                          ประเภทงานพนักงาน
                        </div>
                        <div class="col-lg-9">
                          <?php echo isset($personnel['emp_type_name'])?$personnel['emp_type_name']:'-';?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 font-weight-bold">
                          เบอร์โทรศัพท์
                        </div>
                        <div class="col-lg-9">
                          <?php echo isset($personnel['data']['phone'])?$personnel['data']['phone']:'-';?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 font-weight-bold">
                          เบอร์โทรศัพท์ภายใน
                        </div>
                        <div class="col-lg-9">
                          <?php echo isset($personnel['data']['internal_tel'])?$personnel['data']['internal_tel']:'-';?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 font-weight-bold">
                          อีเมล
                        </div>
                        <div class="col-lg-9">
                          <?php echo isset($personnel['data']['email'])?$personnel['data']['email']:'-';?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 font-weight-bold">
                          อายุงาน
                        </div>
                        <div class="col-lg-9">
                          <?php 
                            if(isset($personnel['data']['work_end_date']) and $personnel['data']['work_end_date']=='0000-00-00'){

                              $datetime1 = date_create($personnel['data']['work_start_date']); 
                              $datetime2 = date_create(date('Y-m-d')); 
                                
                              $interval = date_diff($datetime1, $datetime2);

                              if($interval->y!=0){
                                echo $interval->y.' ปี ';
                              }
                              if($interval->m!=0){
                                echo $interval->m.' เดือน ';
                              }
                              if($interval->d!=0){
                                echo $interval->d.' วัน ';
                              }

                            }else{
                              echo date_th($personnel['data']['work_start_date'],2).' - '.date_th($personnel['data']['work_end_date'],2);
                            }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <hr/>
                  <?php $this->load->view('document'); ?>

                  
                <?php }elseif(isset($view_only) and !$view_only){ ?>
                  <div class="row">
                    <div class="col-lg-12">
                      <center><h1>ไม่พบบข้อมูลการลา</h1></center>
                    </div>
                  </div>
                <?php } ?>
                </div>
              </div>
              
            </div>
            <div class="col-lg-3">

              <div class="row">
                <div class="col-lg-12">
                  <!-- Basic Card Example -->
                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">การจัดการ</h6>
                    </div>
                    <div class="card-body">

                      <?php if(intval($data['status'])>=98){ ?>
                        <div class="row mb-1">
                          <button class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fas fa-trash"></i>
                            </span>
                            <span class="text">ยกเลิกการลาเมื่อวันที่<br/><?php echo date_th($data['cancel_date'],2);?></span>
                          </button>
                        </div>
                        <hr/>
                      <?php } ?>

                      <?php if(intval($data['hr_approve'])==0){ ?>
                        <div class="row mb-1">
                          <a href="#" class="hr-approve btn btn-primary btn-icon-split" approve_type="1">
                            <span class="icon text-600">
                              <i class="far fa-check-circle"></i>
                            </span>
                            <span class="text">ผ่านการตรวจสอบ</span>
                          </a>
                        </div>
                        <div class="row mb-1">
                          <a href="#" class="hr-approve btn btn-info btn-icon-split" approve_type="2">
                            <span class="icon text-600">
                              <i class="far fa-times-circle"></i>
                            </span>
                            <span class="text">ไม่ผ่านการตรวจสอบ</span>
                          </a>
                        </div>
                        <hr/>
                      <?php }elseif(intval($data['hr_approve'])==1){ ?>
                        <div class="row mb-1">
                          <a href="#" class="btn btn-primary btn-icon-split">
                            <span class="icon text-600">
                              <i class="far fa-check-circle"></i>
                            </span>
                            <span class="text">ผ่านการตรวจสอบ<br/>เมื่อ: <?php echo date_th($data['signature_hr_date'],2);?></span>
                          </a>
                        </div>
                        <hr/>
                      <?php }elseif(intval($data['hr_approve'])==2){ ?>
                        <div class="row mb-1">
                          <a href="#" class="btn btn-info btn-icon-split">
                            <span class="icon text-600">
                              <i class="far fa-times-circle"></i>
                            </span>
                            <span class="text">ไม่ผ่านการตรวจสอบ<br/>เมื่อ: <?php echo date_th($data['signature_hr_date'],2);?></span>
                          </a>
                        </div>
                        <hr/>
                      <?php } ?>
                      
                      <div class="row mb-1">
                        <a href="#" id="print" class="btn btn-light btn-icon-split">
                          <span class="icon text-gray-600">
                            <i class="fas fa-file-alt"></i>
                          </span>
                          <span class="text">ดูหรือพิมพ์ใบลา</span>
                        </a>
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
  
  <div id="preload" style="position: absolute;width: 100vw;height: 100%;background-color: rgba(0, 0, 0, 0.5);z-index: 99;top: 0;left: 0;display:none;">
    <img src="<?php echo base_url(load_file('assets/img/loading.gif'));?>" style="position: fixed;left: 0;right: 0;margin: auto;top: 25%;">
  </div>

  <script>
      $(document).ready(function(){
        var alert_confirm = {type:'',data:{}};

        $('#print').click(function(){

            $.ajax({
              type: "POST",
              data:{leave:'<?php echo intval($leave_id);?>'},
              url: "<?php echo base_url(url_index().'leave/print');?>",
              dataType: "json",
              success: function(data){
                if(data.status){
                  $('#preload').show();

                  $('#qrcode1 img,#qrcode2 img').attr('src','');

                  var qrcode1 = new QRCode("qrcode1", {
                    text: data.data.url,
                    width: 300,
                    height: 300,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H
                  });

                  var element = document.getElementById("qrcode2");
                  if(typeof(element) != 'undefined' && element != null){
                    var qrcode2 = new QRCode("qrcode2", {
                      text: data.data.url,
                      width: 300,
                      height: 300,
                      colorDark : "#000000",
                      colorLight : "#ffffff",
                      correctLevel : QRCode.CorrectLevel.H
                    });
                  }
                  var element = document.getElementById("qrcode3");
                  if(typeof(element) != 'undefined' && element != null){
                    var qrcode3 = new QRCode("qrcode3", {
                      text: data.data.url,
                      width: 300,
                      height: 300,
                      colorDark : "#000000",
                      colorLight : "#ffffff",
                      correctLevel : QRCode.CorrectLevel.H
                    });
                  }

                  setTimeout(function(){
                    $('#qrcode1 img, #qrcode2 img').show();
                    var divContents = document.getElementById("document").innerHTML; 
                    var a = window.open(); 
                    a.document.write("<style>@font-face {font-family: 'th-sarabun';src: url('<?php echo base_url(load_file('assets/font/THSarabun.ttf'));?>');src: url('<?php echo base_url(load_file('assets/font/THSarabun.ttf'));?>')  format('truetype'), /* Safari, Android, iOS */}.document{position:relative;font-family:'th-sarabun';color:#000000;}.document span{position:absolute;font-size:2vw;line-height: 4vw;}.overflow-text{display: block;overflow: hidden;}.img-sig{max-width: 16vw;margin-left: -8%;margin-top: -11%;}#qrcode1 img,#qrcode2 img,#qrcode3 img{max-width: 7vw;}.leave_no{margin-top: -20px;} @media print{.document span{position:absolute;font-size:16px;line-height: 30px;}.document:nth-child(2) span{margin-left:10px;position:absolute;font-size:16px;line-height: 35px;}.overflow-text{display: block;overflow: hidden;}.img-sig{max-width: 16vw;margin-left: -8%;margin-top: -6%;}#qrcode1 img,#qrcode2 img,#qrcode3 img{max-width: 8vw;}.leave_no{margin-top: 0px;}}</style>");
                    a.document.write(divContents);
                    a.print(); 
                    //a.close();
                    $('#preload').hide();
                  }, 2000);


                }else{
                  alert('ระบบไม่สามารถพิมพ์ใบลาได้ กรุณาลองให้ภายหลัง');
                }
              },error:function(e){
                console.log(e);
              }
            });

            
        });

        $('.hr-approve').click(function(){
          alert_confirm.type = 'hr-approve';
          alert_confirm.data.type = $(this).attr('approve_type');
          $('#_confirm .modal-title').text('แจ้งรายละเอียด');
          $('#_confirm .modal-body').text('ต้องการบันทึกการตรวจสอบการลานี้ใช่หรือไม่');
          $('#modal-confirm').click();
        });

        $('#_confirm .answer-btn').click(function(){
          $('#_confirm .close').click();
          var answer = $(this).attr('answer');
          
          if(alert_confirm.type == 'hr-approve'){
            if(parseInt(answer)){
              $.ajax({
                type: "POST",
                data:{leave:'<?php echo intval($leave_id);?>',type:alert_confirm.data.type,hr:<?php echo $personnel['personnel_id'];?>},
                url: "<?php echo base_url(url_index().'leave/approve_hr');?>",
                dataType: "json",
                success: function(data){
                  if(data.status){
                    $('#_alert .modal-title').text('แจ้งรายละเอียด');
                    $('#_alert .modal-body').text('ระบบได้ทำการบันทึกผลการตรวจสอบเรียบร้อยแล้ว');
                    $('#modal-alert').click();
                    $('#_alert button').click(function(){
                      location.reload();
                    });
                  }
                }
              });
            }
          }

          alert_confirm.type = '';
          alert_confirm.data = {};
          return false;
        });
      });

  </script>

  <?php echo $this->load->view('inc/alert'); ?>

</body>

</html>
