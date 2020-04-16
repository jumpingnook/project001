<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>รายงาน - IDP - med.nu.ac.th</title>


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
            <h1 class="h3 mb-0 text-gray-800">รายงาน</h1>
          </div>

          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">จำนวนผู้เรียน</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo isset($count['personnel'])?number_format(count($count['personnel'])):0;?> คน</div>
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
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">ดำเนินการอยู่</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo isset($count[1])?number_format($count[1]):0;?> บทเรียน</div>
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
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">สำเร็จแล้ว</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo isset($count[2])?number_format($count[2]):0;?> บทเรียน</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                  <div class="row mb-2">
                    <div class="col-lg-12">
                      <h6 class="m-0 font-weight-bold text-primary">รายชื่อผู้เรียน</h6>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th width="70px">#</th>
                          <th>รายละเอียดผู้เรียน</th>
                          <th width="200px">บทเรียน</th>
                          <th width="200px">วันเวลา</th>
                          <th width="130px">สถานะ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(isset($enroll) and count($enroll)>0){ $i = 1; foreach($enroll as $key=>$val){ foreach($val as $key2=>$val2){?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo isset($personnel[$key])?$personnel[$key]['title'].$personnel[$key]['name_th'].' '.$personnel[$key]['surname_th']:' - ';?></td>
                          <td><?php echo isset($course[$key2])?$course[$key2]['course_name']:' - ';?></td>
                          <td>
                            <?php if($val2['status']==0){
                              echo date('Y-m-d H:i:s',strtotime($val2['set_date']));
                            }elseif($val2['status']==1){
                              echo date('Y-m-d H:i:s',strtotime($val2['start_date']));
                            }elseif($val2['status']==2){
                              echo date('Y-m-d H:i:s',strtotime($val2['end_date']));
                            } ?>
                          </td>
                          <td>
                            <?php if($val2['status']==0){
                              echo 'ได้รับการอนุมัติ';
                            }elseif($val2['status']==1){
                              echo 'กำลังดำเนินการ';
                            }elseif($val2['status']==2){ echo 'เสร็จสิ้น';?>
                              <!-- <a href="<?php //echo base_url(url_index().'idp/view_m_course/'.$key.'/?admin=1');?>" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-eye"></i>
                                </span>
                                <span class="text">เสร็จสิ้น</span>
                              </a> -->
                            <?php } ?>
                          </td>
                        </tr>
                        <?php $i++;}}} ?>
                      </tbody>
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

      <?php echo $this->load->view('inc/footer'); ?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php echo $this->load->view('inc/scroll_to'); ?>
  
  <?php echo $this->load->view('inc/logout'); ?>
  
  <?php echo $this->load->view('inc/js'); ?>

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
