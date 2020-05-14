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
            <h1 class="h3 mb-0 text-gray-800">ข้อมูลการลาเลขที่ <?php echo isset($data['leave_no'])?$data['leave_no']:'0';?></h1>
          </div>

          <div class="row">
            <div class="col-lg-9">
              
              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">รายละเอียดการลา</h6>
                </div>
                <div class="card-body">
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
                          <?php echo isset($personnel['personnel_code'])?$personnel['personnel_code']:'-';?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 font-weight-bold">
                          ชื่อ - นามสกุล
                        </div>
                        <div class="col-lg-9">
                          <?php 
                            echo isset($personnel['title'])?$personnel['title']:'-'; 
                            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
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
                    </div>
                  </div>

                  <hr/>
                  <?php $this->load->view('document'); ?>
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

                      <div class="row">
                        <div class="text-s font-weight-bold text-danger text-uppercase mb-1">การจัดการ</div>
                      </div>
                      <div class="row mb-1">
                        <a href="#" class="btn btn-primary btn-icon-split">
                          <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                          </span>
                          <span class="text">ยกเลิกการลานี้</span>
                        </a>
                      </div>

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

  <script>
      
      function open_qr(data){
        var image = new Image();
        image.src = data;

        var w = window.open(data);
        w.document.write(image.outerHTML);
      }

      function copy_url(str=''){
        const el = document.createElement('textarea');
        el.value = str;
        el.setAttribute('readonly', '');
        el.style.position = 'absolute';
        el.style.width = '0px';
        el.style.height = '0px';
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        alert('คัดลอก URL แล้ว');
      }

      $(document).ready(function(){
        $('#print').click(function(){
            var divContents = document.getElementById("document").innerHTML; 
            var a = window.open(); 
            a.document.write("<style>@font-face {font-family: 'th-sarabun';src: url('<?php echo base_url(load_file('assets/font/THSarabun.ttf'));?>');src: url('<?php echo base_url(load_file('assets/font/THSarabun.ttf'));?>')  format('truetype'), /* Safari, Android, iOS */}.document{position:relative;font-family:'th-sarabun';color:#000000;}.document span{position:absolute;font-size:2vw;line-height: 60px;}.overflow-text{display: block;overflow: hidden;}.img-sig{max-width: 16vw;margin-left: -8%;margin-top: -11%;} @media print{.document span{position:absolute;font-size:16px;line-height: 30px;}.document:nth-child(2) span{margin-left:10px;position:absolute;font-size:16px;line-height: 35px;}.overflow-text{display: block;overflow: hidden;}.img-sig{max-width: 16vw;margin-left: -8%;margin-top: -6%;}}</style>");
            a.document.write(divContents);
            a.print(); 
            //a.close();
        });
        
      });

  </script>

</body>

</html>
