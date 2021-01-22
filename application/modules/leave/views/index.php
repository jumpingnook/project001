<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>LeaveSystem - med.nu.ac.th</title>

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
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ยินดีต้อนรับ</h1>
          </div>

          <div class="row">
            <div class="col-lg-8">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">ข้อมูลบุคลากร</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4">
                        <img src="<?php echo isset($personnel['img'])&&trim($personnel['img'])!=''?$personnel['img']:'';?>" style="max-width: 200px;width: 100%;display: block;min-height: 200px;background-color: #ccc;"/>
                      </div>
                      <div class="col-lg-8">
                        <div class="row">
                          <div class="col-lg-4 text-md font-weight-bold">รหัสพนักงาน</div>
                          <div class="col-lg-8"><?php echo isset($personnel['personnel_code'])?$personnel['personnel_code']:'-';?></div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4 text-md font-weight-bold">ชื่อ - นามสกุล</div>
                          <div class="col-lg-8">
                            <?php 
                              echo isset($personnel['title'])?$personnel['title']:'-'; 
                              echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                              echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                            ?>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4 text-md font-weight-bold">ตำแหน่ง</div>
                          <div class="col-lg-8"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4 text-md font-weight-bold">หน่วยงาน</div>
                          <div class="col-lg-8"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4 text-md font-weight-bold">ประเภทงานพนักงาน</div>
                          <div class="col-lg-8"><?php echo isset($personnel['emp_type_name'])?$personnel['emp_type_name']:'-';?></div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4 text-md font-weight-bold">อายุงาน</div>
                          <div class="col-lg-8">
                            <?php 
                              if(isset($personnel['work_end_date']) and $personnel['work_end_date']=='0000-00-00' ){

                                $datetime1 = date_create($personnel['work_start_date']); 
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
                                echo date_th($personnel['work_start_date'],2).' - '.date_th($personnel['work_end_date'],2);
                              }
                            ?>
                          
                          </div>
                        </div>
                        <div class="row mb-1">
                          <div class="col-lg-4 text-md font-weight-bold">อีเมล</div>
                          <div class="col-lg-8">
                            <a href="#" id="update-email" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#update-email-form">
                              <span class="icon text-white-50">
                                <i class="far fa-edit"></i>
                              </span>
                              <span class="text"><?php echo isset($personnel['email'])?$personnel['email']:'-';?></span>
                            </a><br/>
                            <span style="font-size:12px;color:red;">**แนะนำให้ท่านอัพเดตเป็นอีเมลที่ใช้อยู่ ณ ปัจจุบันเพื่อลดข้อผิดพลาดในการพิจารณา</span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4 text-md font-weight-bold">ลายเซ็น</div>
                          <div class="col-lg-8">
                            <?php if(isset($personnel['signature']) and trim($personnel['signature'])!=''){ ?>
                              <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#signature">
                                <span class="icon text-white-50">
                                  <i class="fas fa-signature"></i>
                                </span>
                                <span class="text">ลายเซ็นในระบบของท่าน</span>
                              </a>
                            <?php }else{ ?>
                              <a href="#" id="add-sig" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#signature">
                                <span class="icon text-white-50">
                                  <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">เพิ่มลายเซ็นของท่าน</span>
                              </a>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-lg-12 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-md font-weight-bold text-primary text-uppercase mb-1">จำนวนวันลาพักผ่อนคงเหลือ</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo isset($leave_quota) && count($leave_quota)>0?$leave_quota[0]['quota_total']:0;?> วัน<br/>
                            <span class="mb-0 font-weight-bold text-gray-600" style="font-size:0.6em;"><?php echo isset($leave_quota) && count($leave_quota)>0?'ข้อมูลเมื่อวันที่ '.date_th($leave_quota[0]['create_date'],2):'';?></span>
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-lg-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-md font-weight-bold text-warning text-uppercase mb-1">กำลังดำเนินการ</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $leave_history['count_new'];?> รายการ</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-lg-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-md font-weight-bold text-info text-uppercase mb-1">ดำเนินการเสร็จสิ้น</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $leave_history['count_end'];?> รายการ</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- DataTales Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">รายการข้อมูลการลา</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                    <?php /*if(isset($personnel['signature']) and trim($personnel['signature'])!=''){ ?>
                      <a href="<?php echo base_url(url_index().'leave/add');?>" class="btn btn-info btn-icon-split">
                    <?php }else{ ?>
                      <a href="#" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#signature">
                    <?php }*/ ?>
                      <a href="<?php echo base_url(url_index().'leave/add');?>" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                          <i class="fas fa-file-medical"></i>
                        </span>
                        <span class="text">กรอกข้อมูลการลา</span>
                      </a>
                    </div>
                  </div>
                  <hr/>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>เลขที่ใบลา</th>
                          <th>ประเภทการลา</th>
                          <th>วันที่เขียนใบลา</th>
                          <th>ช่วงวันที่ลา</th>
                          <th>จำนวนวัน</th>
                          <th>สถานะ</th>
                          <th>การจัดการ</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        <?php $sum_day = 0; if(isset($leave_history['data']) and count($leave_history['data'])>0){  $i=1;foreach($leave_history['data'] as $key=>$val){?>
                          <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $val['leave_no'];?></td>
                            <td><?php echo isset($leave_type[$val['leave_type_id']])?$leave_type[$val['leave_type_id']]['leave_name']:' - ';?></td>
                            <td><?php echo date_th($val['create_date'],2);?></td>
                            <td>
                              <?php 
                                echo date_th($val['period_start'],2);
                                if($val['period_start_half']==1){
                                  echo '(เช้า)';
                                }elseif($val['period_start_half']==2){
                                  echo '(บ่าย)';
                                }
                                echo ' - ';
                                echo '<br/>'.date_th($val['period_end'],2);
                                if($val['period_end_half']==1){
                                  echo '(เช้า)';
                                }elseif($val['period_end_half']==2){
                                  echo '(บ่าย)';
                                }
                              ?>
                            </td>
                            <td><?php 
                              if(isset($leave_spec[$val['leave_type_id']][$personnel['emp_type_id']]) and intval($leave_spec[$val['leave_type_id']][$personnel['emp_type_id']]['type_count'])){
                                $sum_day+=$val['period_count']; echo $val['period_count'].' (วัน)';
                              }else{
                                $sum_day+=$val['period_count_all']; echo $val['period_count_all'].' (วัน)';
                              }
                            
                            ?></td>
                            <td>
                              <?php
                                if($val['hr_approve']==2){
                                  echo 'ไม่ผ่านการตรวจสอบ';
                                }elseif($val['status']==0){
                                  echo 'รอดำเนินการ';
                                }elseif($val['status']==1){
                                  echo 'กำลังพิจารณา';
                                }elseif($val['status']==2){
                                  echo 'อนุญาตเสร็จสิ้น';
                                }elseif($val['status']==3){
                                  echo 'ไม่อนุญาต';
                                }elseif($val['status']==98 and $val['deputy_dean_approve_cancel']==1){
                                  echo 'ยกเลิกหลังพิจารณาเสร็จสิ้น';
                                }elseif($val['status']>=98){
                                  echo 'ยกเลิก';
                                }
                              ?>

                            </td>
                            <td>
                              <a href="<?php echo base_url(url_index().'leave/view/'.$val['leave_id']);?>" class="btn btn-info btn-circle btn-sm">
                                <i class="far fa-eye"></i>
                              </a>
                            </td>
                          </tr>
                        <?php $i++;}}?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="2">รวมทั้งหมด <?php echo isset($leave_history)?number_format($leave_history['count']):0;?> รายการ</th>
                          <th colspan="3"></th>
                          <th colspan="3"><?php //echo 'รวมทั้งหมด '.number_format($sum_day,1,'.',',').' วัน';?></th>
                        </tr>
                      </tfoot>
                    </table>
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

  <div id="preload" style="position: absolute;width: 100vw;height: 100%;background-color: rgba(0, 0, 0, 0.5);z-index: 1060;top: 0;left: 0;display:none;">
    <img src="<?php echo base_url(load_file('assets/img/loading.gif'));?>" style="position: fixed;left: 0;right: 0;margin: auto;top: 25%;">
  </div>

  <!-- Signature Modal-->
  <div class="modal fade" id="signature" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ลายเซ็นในระบบของท่าน</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <?php if(isset($personnel['signature']) and trim($personnel['signature'])!=''){ ?>
            <div class="row">
               <div class="col-lg-12 mb-4">
               <center><img src="<?php echo $personnel['signature'];?>" alt="" style="max-width:340px;"></center><br/><center><span class="text-lg ">*หากท่านต้องการแก้ไขลายเซ็น กรุณาติดต่อ 7936</span></center>
              </div>
            </div>
          <?php }else{ ?>

            <style>
              #qrcode1 img{
                margin: auto;
              }
              #example-sig:hover img{
                display:block !important;
              }
            </style>

            <div class="row">
               <div class="col-lg-5 mb-4">
                <div id="qrcode1"></div>
               </div>
               <div class="col-lg-7"><br/>
                <center><span class="font-weight-bold" style="color: red;">
                **เนื่องจากท่านยังไม่ไมีลายเซ็นอิเล็กทรอนิกส์ในระบบลานี้<br/>
                กรุณาบันทึกลายเซ็นอิเล็กทรอนิกส์ของท่านเพื่อใช้งานระบบ
                </span></center><br/>
                  <center><-- ใช้โทรศัพท์ของท่านสแกน QR Code เพื่อบันทึกลายเซ็น หรือ</center><br/>
                  <center>
                    <a href="<?php echo $personnel['signature_url'];?>" target="_blank" class="btn btn-primary btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-link"></i>
                      </span>
                      <span class="text">คลิกที่นี่เพื่อเพิ่มลายเซ็นผ่านหน้าเว็บไซต์</span>
                    </a>
                  </center><br/>
                  <center>หรือ<center><br/>
                  <center>
                    <button type="button" class="btn btn-primary btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-file-upload"></i>
                      </span>
                      <label for="file-sig" class="text" style="margin-bottom: 0;">คลิกที่เลือกไฟล์เพื่ออัพโหลดลายเซ็น</label>
                    </button>
                    <input id="file-sig" type="file" name="img" value="" style="display:none;" accept="image/*">
                    <img id="img-sig" src="" style="display:none;">
                    <canvas id="canvas" style="display:none;"></canvas>
                  </center>
                  <center style="color: #e74a3b;font-size: 12px;">* รองรับขนาด 500px*170px และลายเซ็นมีพื้นหลังสีขาว เท่านั้น
                    <span id="example-sig" style="text-decoration: underline;display: block;position: relative;">
                      คลิกที่นี่เพื่อดูตัวอย่างลายเซ็น
                      <img src="<?php echo base_url(load_file('assets/img/ex-sig.jpg'));?>" style="display:none;position: absolute;bottom: 100%;border: 1px dotted #000000;left: 0;right: 0;margin: auto;width:400px;">
                    </span>
                  </center>
               </div>
            </div>

            <script src="<?php echo base_url(load_file('assets/js/qrcodejs/qrcode.min.js'));?>"></script>
            <script>

              var qrcode1 = new QRCode("qrcode1", {
                text: "<?php echo $personnel['signature_url'];?>",
                width: 300,
                height: 300,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
              });

              $(document).ready(function(){

                if(getCookie('modal_sig')==''){
                  setCookie('modal_sig', true, 20);
                  $('#add-sig').click();
                }

                $('#signature .close').click(function(){
                  location.reload();
                });

                function setCookie(cname, cvalue, min) {
                  var d = new Date();
                  d.setTime(d.getTime() + (min*60*1000));
                  var expires = "expires="+ d.toUTCString();
                  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                }

                function getCookie(cname) {
                  var name = cname + "=";
                  var decodedCookie = decodeURIComponent(document.cookie);
                  var ca = decodedCookie.split(';');
                  for(var i = 0; i <ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                      c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                      return c.substring(name.length, c.length);
                    }
                  }
                  return "";
                }

                $('#file-sig').change(function(){

                  if(typeof $(this)[0].files[0] === "undefined"){
                    return false;
                  }

                  $('#preload').show();

                  Main();
                  async function Main() {
                    const file = document.querySelector('#file-sig').files[0];
                    var data_url = await toBase64(file);
                    var img = new Image(data_url);
                    img.onload = function() {

                      if(this.width!=500 && this.height!=170){
                        alert('ระบบไม่สามรถบันทึกลายเซ็นของท่านได้ กรุณาเลือกขนาดไฟล์ให้ถูกต้อง');
                        $('#preload').hide();
                        return false;
                      }

                      $('#img-sig').attr('src',data_url);
                      var canvas = document.getElementById("canvas"),
                      ctx = canvas.getContext("2d"),
                      image = document.getElementById("img-sig");

                      canvas.height = 170;
                      canvas.width = 500;
                      ctx.drawImage(image,0,0);

                      var imgd = ctx.getImageData(0, 0, 500, 170),
                      pix = imgd.data,
                      newColor = {r:0,g:0,b:0, a:0};

                      for (var i = 0, n = pix.length; i <n; i += 4) {
                        var r = pix[i],
                        g = pix[i+1],
                        b = pix[i+2];

                        //if(r == 255&& g == 255 && b == 255){ 
                        if(r >= 160&& g >= 160 && b >= 160){ 
                          // Change the white to the new color.
                          pix[i] = newColor.r;
                          pix[i+1] = newColor.g;
                          pix[i+2] = newColor.b;
                          pix[i+3] = newColor.a;
                        }

                      }
                      ctx.putImageData(imgd, 0, 0);
                      var signature = canvas.toDataURL();

                      $.ajax({
                        type: "POST",
                        data: {signature:signature,personnel_id:<?php echo intval($personnel['personnel_id']);?>,res:1},
                        url: "<?php echo base_url(url_index().'leave/save_signature_personnel');?>",
                        dataType: "json",
                        success: function(data){
                          if(data.status){
                            alert('ระบบบันทึกลายเซ็นของท่านเรียบร้อยแล้ว');
                            location.reload();
                          }else{
                            $('#preload').hide();
                          }
                        }
                      });

                    }
                    img.src = data_url;
                  }

                });
              });


              const toBase64 = file => new Promise((resolve, reject) => {
                  const reader = new FileReader();
                  reader.readAsDataURL(file);
                  reader.onload = () => resolve(reader.result);
                  reader.onerror = error => reject(error);
              });

            </script>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>


  <!-- Update Email Modal-->
  <div class="modal fade" id="update-email-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">อัพเดตอีเมลของท่าน</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-12">
              <label>กรอกอีเมลของท่านที่ใช้อยู่ปัจจุบัน</label>
              <input type="text" class="form-control" id="email-personnel" placeholder="กรอกอีเมลของท่านที่ใช้อยู่ปัจจุบัน" value="<?php echo isset($personnel['email'])?$personnel['email']:'-';?>" required>
            </div>
          </div>

          <script>
            $(document).ready(function(){

              <?php if(isset($personnel['last_login']) and $personnel['last_login']){ ?>
                $('#update-email').click();
              <?php } ?>

              $('#update-email .close').click(function(){
                location.reload();
              });

              $('#update-email-personnel').click(function(){
                var email = $('#email-personnel').val();
                $.ajax({
                  type: "POST",
                  data: {email:email,personnel_id:<?php echo intval($personnel['personnel_id']);?>},
                  url: "<?php echo base_url(url_index().'leave/update_email_personnel');?>",
                  dataType: "json",
                  success: function(data){
                    if(data.status){
                      alert('ระบบบันทึกการอัพเดตอีเมลของท่านเรียบร้อยแล้ว');
                      location.reload();
                    }else{
                      alert('ระบบไม่สามารถผลการอัพเดตอีเมลของท่านได้');
                    }
                  }
                });
              });

            });
          </script>
        </div>
        <div class="modal-footer">
          <button id="update-email-personnel" class="btn btn-primary" data-dismiss="modal" aria-label="Close" type="button">บันทึก</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
        $('#dataTable').DataTable({
          "language": {
            "lengthMenu": "แสดง _MENU_ รายการ/หน้า",
            "zeroRecords": "ไม่มีรายการ",
            "info": "หน้า _PAGE_ จาก _PAGES_",
            "infoEmpty": "ไม่พบผลการค้นหา",
            "infoFiltered": "(ค้นหาพบ _MAX_ รายการ)",
            "paginate": {
                "first":      "หน้าแรก",
                "last":       "หน้าสุดท้าย",
                "next":       "หน้าต่อไป",
                "previous":   "หน้าก่อนหน้านี้"
            },
            "search": "ค้นหา"
          }
          
        });

        var approve = getUrlParam('approve','123');
        if(approve=='ds1df4d51s8af4dsa1'){
          alert('ระบบบันทึกผลการพิจารณาเรียบร้อยแล้ว');
        }
        var signature = getUrlParam('signature','123');
        if(signature=='ds1df4d51s8af4dsa1'){
          alert('ระบบบันทึกลายเซ็นของท่านเรียบร้อยแล้ว');
        }
        var approve = getUrlParam('approve','123');
        if(approve=='assign_complete'){
          alert('ระบบบันทึกผู้พิจารณารักษาการแทนเรียบร้อยแล้ว');
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

    });
  </script>

</body>

</html>
