<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>จัดการบทเรียน - IDP - med.nu.ac.th</title>


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
            <h1 class="h3 mb-0 text-gray-800">จัดการบทเรียน</h1>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- DataTales Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <div class="row mb-2">
                    <div class="col-lg-12">
                      <h6 class="m-0 font-weight-bold text-primary">รายชื่อบทเรียน</h6>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <a href="<?php echo base_url(url_index().'idp/add_m_course/?admin=1');?>" type="button" class="btn btn-primary btn-icon-split mb-1">
                        <span class="icon text-white-50">
                        <i class="fas fa-plus-square"></i>
                        </span>
                        <span class="text">เพิ่มบทเรียน</span>
                      </a>
                    </div>
                  </div>
                  

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th width="70px">#</th>
                          <th>บทเรียน</th>
                          <th width="70px">การจัดการ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(isset($course) and count($course)>0){ $i = 1; foreach($course as $key=>$val){?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo htmlspecialchars_decode($val['course_name']); ?></td>
                          <td>
                            <a href="<?php echo base_url(url_index().'idp/view_m_course/'.$key.'/?admin=1');?>" class="btn btn-info btn-circle btn-sm">
                              <i class="fas fa-eye"></i>
                            </a>
                          </td>
                        </tr>
                        <?php $i++;}} ?>
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
