<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>รายชื่อผู้ปฎิบัติงานในสังกัด - IDP - med.nu.ac.th</title>


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
            <h1 class="h3 mb-0 text-gray-800">รายชื่อผู้ปฎิบัติงานในสังกัด</h1>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- DataTales Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">รายชื่อผู้ปฎิบัติงาน</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>ชื่อ - นามสกุล</th>
                          <th>ตำแหน่ง</th>
                          <th>สังกัด</th>
                          <th>หน่วย</th>
                          <th>จำนวนบทเรียน</th>
                          <th>การจัดการ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php for($i=1;$i<=100;$i++){?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td>นายสนาน ราตรีพรทิพย์</td>
                          <td>นักวิชาการคอมพิวเตอร์</td>
                          <td>งานพัฒนานวัตกรรม</td>
                          <td>หน่วยบริการสารสนเทศ</td>
                          <td>3</td>
                          <td>
                            <a href="<?php echo base_url('leave/leave/view');?>" class="btn btn-info btn-circle btn-sm">
                              <i class="far fa-eye"></i>
                            </a>&nbsp;
                            <a href="#" class="btn btn-warning btn-circle btn-sm">
                              <i class="fas fa-user-cog"></i>
                            </a>
                          </td>
                        </tr>
                        <?php } ?>
                        

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
