<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>IDP - med.nu.ac.th</title>


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
                      <div class="col-lg-2 text-md font-weight-bold">รหัสพนักงาน</div>
                      <div class="col-lg-4">BM068</div>
                      <div class="col-lg-2 text-md font-weight-bold">ประเภทงาน</div>
                      <div class="col-lg-4">พนักงานมหาวิทยาลัย สายสนับสนุน (เงินรายได้)</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-2 text-md font-weight-bold">ชื่อ - นามสกุล</div>
                      <div class="col-lg-4">นายสนาน ราตรีพรทิพย์</div>
                      <div class="col-lg-2 text-md font-weight-bold">ตำแหน่ง</div>
                      <div class="col-lg-4">นักวิชาการคอมพิวเตอร์?</div>
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
                      <a href="<?php echo base_url(url_index().'leave/leave/add');?>" class="btn btn-info btn-icon-split">
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
                      <tfoot>
                        <tr>
                          <th colspan="2">รวม 3 รายการ</th>
                          <th colspan="3"></th>
                          <th colspan="3">รวม 1.5 วัน</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>2020030955</td>
                          <td>ลาพักผ่อน</td>
                          <td>25 มี.ค. 2563</td>
                          <td>26 มี.ค. 2563 - 26 มี.ค. 2563</td>
                          <td>0.5(AM)</td>
                          <td>ดำเนินการ</td>
                          <td>
                            <a href="<?php echo base_url('leave/leave/view');?>" class="btn btn-info btn-circle btn-sm">
                              <i class="far fa-eye"></i>
                            </a>&nbsp;
                            <a href="#" class="btn btn-danger btn-circle btn-sm">
                              <i class="far fa-trash-alt"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>2020030955</td>
                          <td>ลาพักผ่อน</td>
                          <td>25 มี.ค. 2563</td>
                          <td>26 มี.ค. 2563 - 26 มี.ค. 2563</td>
                          <td>0.5(AM)</td>
                          <td>ดำเนินการ</td>
                          <td>
                            <a href="<?php echo base_url('leave/leave/view');?>" class="btn btn-info btn-circle btn-sm">
                              <i class="far fa-eye"></i>
                            </a>&nbsp;
                            <a href="#" class="btn btn-danger btn-circle btn-sm">
                              <i class="far fa-trash-alt"></i>
                            </a>
                          </td>
                        </tr>
                        <?php for($i=0;$i<=100;$i++){?>
                          <tr>
                            <td>3</td>
                            <td>2020030955</td>
                            <td>ลาพักผ่อน</td>
                            <td>25 มี.ค. 2563</td>
                            <td>26 มี.ค. 2563 - 26 มี.ค. 2563</td>
                            <td>0.5(AM)</td>
                            <td>ดำเนินการ</td>
                            <td>
                              <a href="<?php echo base_url('leave/leave/view');?>" class="btn btn-info btn-circle btn-sm">
                                <i class="far fa-eye"></i>
                              </a>&nbsp;
                              <a href="#" class="btn btn-danger btn-circle btn-sm">
                                <i class="far fa-trash-alt"></i>
                              </a>
                            </td>
                          </tr>
                        <?php }?>
                        

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
