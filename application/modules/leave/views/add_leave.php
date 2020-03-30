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

            <div class="col-lg-6">

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
                        <select class="form-control">
                          <option>เลือกประเภทการลา</option>
                          <option>ลาพักผ่อน</option>
                          <option>ลากิจส่วนตัว</option>
                          <option>ลาป่วย</option>
                          <option>ลาพักผ่อนไปต่างประเทศ</option>
                          <option>ลาคลอดบุตร</option>
                          <option>ลาไปช่วยเหลือภริยาที่คลอดบุตร</option>
                          <option>ลากิจส่วนตัวเพื่อเลี้ยงดูบุตร</option>
                          <option>ลาอุปสมบทหรือลาไปประกอบบพิธีการฮัจย์</option>
                          <option>ลาเข้ารับการตรวจเลือก หรือเข้ารับการเตรียมพล</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">แบบฟอร์ม ลา....</h1>
                  </div>
                  <form class="user">

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เขียนที่</label>
                        <input type="text" class="form-control" id="exampleFirstName" placeholder="คณะแพทยศาสตร์" value="คณะแพทยศาสตร์">
                      </div>
                      <div class="col-sm-6">
                        <label>เรื่อง</label>
                        <input type="text" class="form-control" id="exampleLastName" placeholder="ขอลาป่วย" value="ขอลาป่วย">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>เรียน</label>
                        <select class="form-control">
                          <option>เลือกผู้ปฏิบัติงานแทน</option>
                          <option>นายสนาน ราตรีพรทิพย์</option>
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <label>เรื่อง</label>
                        <input type="text" class="form-control" id="exampleLastName" placeholder="ขอลาป่วย" value="ขอลาป่วย">
                      </div>
                    </div>

                    <div class="form-group">
                      <input type="email" class="form-control" id="exampleInputEmail" placeholder="Email Address">
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password">
                      </div>
                      <div class="col-sm-6">
                        <input type="password" class="form-control" id="exampleRepeatPassword" placeholder="Repeat Password">
                      </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-user btn-block">Register Account</button>

                  </form>
                </div>
              </div>

            </div>
            <div class="col-lg-6">

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
                      <td>
                        <button  type="button" class="btn btn-warning btn-circle btn-sm" title="กรุณากรอกเลือกวันลาในแบบฟอร์ม">
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
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>ผู้ปฏิบัติงานแทน</label>
                        <select class="form-control">
                          <option>เลือกผู้ปฏิบัติงานแทน</option>
                          <option>นายสนาน ราตรีพรทิพย์</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
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

</body>

</html>
