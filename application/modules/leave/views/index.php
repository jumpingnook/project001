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

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">วันลาสะสมปีงบ 2563</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">20 วัน</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">ใช้วันลาไปแล้ว</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">2.5(+0.5) วัน</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">คงเหลือวันลา</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">17.5(-0.5) วัน</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-warning text-uppercase mb-1">คำขอที่ดำเนินการอยู่</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <?php /*
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-lg-12 mb-4">
              <div class="card bg-danger text-white shadow">
                <div class="card-body">

                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg font-weight-bold text-uppercase mb-1">ข้อความแจ้ง</div>
                      <div class="text-md mb-0 font-weight-bold text-white-100">ท่านยังไม่สามารถใช่สิทธิลาผักผ่อนได้</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-white-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          */?>

          <div class="row">
            <div class="col-lg-12">
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
                      <div class="col-lg-2">
                        <img src="<?php echo isset($personnel['img'])&&trim($personnel['img'])!=''?$personnel['img']:'';?>" style="max-width: 200px;width: 100%;display: block;min-height: 200px;background-color: #ccc;"/>
                      </div>
                      <div class="col-lg-10">
                        <div class="row">
                          <div class="col-lg-2 text-md font-weight-bold">รหัสพนักงาน</div>
                          <div class="col-lg-10"><?php echo isset($personnel['personnel_code'])?$personnel['personnel_code']:'-';?></div>
                        </div>
                        <div class="row">
                          <div class="col-lg-2 text-md font-weight-bold">ชื่อ - นามสกุล</div>
                          <div class="col-lg-10">
                            <?php 
                              echo isset($personnel['title'])?$personnel['title']:'-'; 
                              echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                              echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                            ?>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-2 text-md font-weight-bold">ตำแหน่ง</div>
                          <div class="col-lg-10"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></div>
                        </div>
                        <div class="row">
                          <div class="col-lg-2 text-md font-weight-bold">หน่วยงาน</div>
                          <div class="col-lg-10"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></div>
                        </div>
                        <div class="row">
                          <div class="col-lg-2 text-md font-weight-bold">ประเภทงานพนักงาน</div>
                          <div class="col-lg-10"><?php echo isset($personnel['emp_type_name'])?$personnel['emp_type_name']:'-';?></div>
                        </div>
                        <div class="row">
                          <div class="col-lg-2 text-md font-weight-bold">อีเมล</div>
                          <div class="col-lg-10"><?php echo isset($personnel['email'])?$personnel['email']:'-';?></div>
                        </div>
                        <div class="row">
                          <div class="col-lg-2 text-md font-weight-bold">อายุงาน</div>
                          <div class="col-lg-10">
                            <?php 
                              if(!isset($personnel['work_end_date'])){

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
                        <div class="row">
                          <div class="col-lg-2 text-md font-weight-bold">ลายเซ็น</div>
                          <div class="col-lg-10">
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
                            <td><?php echo date('Y/m/d',strtotime($val['create_date']));?></td>
                            <td><?php echo date('Y/m/d',strtotime($val['period_start'])).($val['period_end']!=''?' - '.date('Y/m/d',strtotime($val['period_end'])):'');?></td>
                            <td><?php $sum_day+=$val['period_count']; echo $val['period_count'].($val['period_type']!='a'?$val['period_type']=='p'?' (บ่าย)':' (วัน)':' (เช้า)');?></td>
                            <td>
                              <?php //check?>
                              ดำเนินการ

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
                          <th colspan="3">รวมทั้งหมด <?php echo number_format($sum_day,1,'.',',').' วัน';?></th>
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

  <!-- Logout Modal-->
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
               <center><img src="<?php echo $personnel['signature'];?>" alt="" style="max-width:340px;"></center><br/><center><span class="text-lg ">*หากท่านต้องการแก้ไขลายเซ็น กรุณาติดต่อ</span></center>
              </div>
            </div>
          <?php }else{ ?>

            <style>
              #qrcode1 img{
                margin: auto;
              }
            </style>

            <div class="row">
               <div class="col-lg-6 mb-4">
                <div id="qrcode1"></div>
               </div>
               <div class="col-lg-6"><br/><br/>
                <center><span class="text-lg font-weight-bold">สแกนด้วยโทรศัพท์ของท่านเพื่อเพิ่มลายเซ็น</span></center><br/><br/>
                  <center>------ หรือ ------</center><br/><br/>
                  <center>
                    <a href="<?php echo $personnel['signature_url'];?>" target="_blank" class="btn btn-primary btn-icon-split">
                      <span class="icon text-white-50">
                        <i class="fas fa-link"></i>
                      </span>
                      <span class="text">คลิกที่นี่เพื่อเพิ่มลายเซ็น</span>
                    </a>
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

              });

            </script>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
      // Call the dataTables jQuery plugin
      $(document).ready(function() {
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

        

      });

    });
  </script>

</body>

</html>
