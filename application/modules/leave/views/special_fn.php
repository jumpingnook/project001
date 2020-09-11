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

  <style>
    #dataTable tfoot th input{
      width:150px;
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
            <h1 class="h3 mb-0 text-gray-800">การตั้งค่าผู้ใช้เฉพาะ</h1>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- DataTales Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">รายการการตั้งค่าผู้ใช้เฉพาะ</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th width="70px">#</th>
                          <th>SMU</th>
                          <th>ตำแหน่ง</th>
                          <th>ผู้ใช้</th>
                          <th>สถานะ</th>
                          <th width="200px">การจัดการ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>114000<br/>งานโสตทัศนูปกรณ์และเทคโนโลยีการศึกษา</td>
                          <td>-</td>
                          <td>-</td>
                          <td>ใช้งาน</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>-</td>
                          <td>นักเทคโนโลยีหัวใจและทรวงอก</td>
                          <td>-</td>
                          <td>ใช้งาน</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>-</td>
                          <td>-</td>
                          <td>นายสนาน ราตรีพรทิพย์<br/>BM068/108000</td>
                          <td>ไม่ใช้งาน</td>
                          <td>@twitter</td>
                        </tr>
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
               <center><img src="<?php echo $personnel['signature'];?>" alt="" style="max-width:340px;"></center><br/><center><span class="text-lg ">*หากท่านต้องการแก้ไขลายเซ็น กรุณาติดต่อ 7936</span></center>
              </div>
            </div>
          <?php }else{ ?>

            <style>
              #qrcode1 img{
                margin: auto;
              }
            </style>

            <div class="row">
               <div class="col-lg-5 mb-4">
                <div id="qrcode1"></div>
               </div>
               <div class="col-lg-7"><br/><br/>
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

                $('#add-sig').click();

                // $('#signature .close').click(function(){
                //   location.reload();
                // });

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


      });

    });
  </script>

</body>

</html>
