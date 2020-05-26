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
            <h1 class="h3 mb-0 text-gray-800">ยินดีต้อนรับ</h1>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                <!-- Pending Requests Card Example -->
                <div class="col-lg-2 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-md font-weight-bold text-info text-uppercase mb-1">ทั้งหมด</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $leave_history['count'];?> รายการ</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Pending Requests Card Example -->
                <div class="col-lg-2 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-md font-weight-bold text-warning text-uppercase mb-1">รอพิจารณา</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $leave_history['count_new'];?> รายการ</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Pending Requests Card Example -->
                <div class="col-lg-2 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-md font-weight-bold text-info text-uppercase mb-1">อนุมัติเสร็จสิ้น</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $leave_history['count_complete'];?> รายการ</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-lg-2 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-md font-weight-bold text-info text-uppercase mb-1">ไม่อนุมัติ</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $leave_history['count_unapprove'];?> รายการ</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Pending Requests Card Example -->
                <div class="col-lg-2 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-md font-weight-bold text-info text-uppercase mb-1">ยกเลิกก่อนพิจารณา</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $leave_history['count_cancel_b'];?> รายการ</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Pending Requests Card Example -->
                <div class="col-lg-2 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-md font-weight-bold text-info text-uppercase mb-1">ยกเลิกหลังพิจารณา</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $leave_history['count_cancel_a'];?> รายการ</div>
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
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>ข้อมูลการลา</th>
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
                            <td>
                              <?php 
                                echo 'เลขที่:'.$val['leave_no'].'<br/>';
                                echo 'ชื่อ: สนาน <br/>';
                                echo 'หน่วยงาน: งานพัฒนานวัตกรรม<br/>';
                              ?>
                            </td>
                            <td><?php echo isset($leave_type[$val['leave_type_id']])?$leave_type[$val['leave_type_id']]['leave_name']:' - ';?></td>
                            <td><?php echo date_th($val['create_date'],2);?></td>
                            <td><?php echo date_th($val['period_start'],2).($val['period_end']!=''?' - '.date_th($val['period_end'],2):'');?></td>
                            <td><?php $sum_day+=$val['period_count']; echo $val['period_count'].($val['period_type']!='a'?$val['period_type']=='p'?' (บ่าย)':' (วัน)':' (เช้า)');?></td>
                            <td>
                              <?php 
                                if($val['status']==0){
                                  echo 'รอดำเนินการ';
                                }elseif($val['status']==1){
                                  echo 'กำลังพิจารณา';
                                }elseif($val['status']==2){
                                  echo 'อณุญาติ';
                                }elseif($val['status']==3){
                                  echo 'ไม่อณุญาติ';
                                }elseif($val['status']==98){
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
                          <th></th>
                          <th>ข้อมูลการลา</th>
                          <th>ประเภทการลา</th>
                          <th>วันที่เขียนใบลา</th>
                          <th>ช่วงวันที่ลา</th>
                          <th></th>
                          <th>สถานะ</th>
                          <th></th>
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

        $('#dataTable tfoot th').each( function () {
            var title = $(this).text();
            if(title!=''){
              $(this).html( '<input type="text" placeholder="ค้นหา'+title+'" />' );
            }
            
        } );

        var table = $('#dataTable').DataTable({
          "dom": '<"row"<"col-10"l><"col-2"B>> <"row"t> <"row"<"col-8"i><"col-4"p>>',
          "buttons": [
              'excelHtml5',
              'print'
          ],
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
            "search": "ค้นหา",
          }
        });

        var data = table.buttons.exportData( {
            columns: ':visible'
        } );

        table.columns().every( function () {
          var that = this;
          $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that.search( this.value ).draw();
            }
          } );
        } );

      });

    });
  </script>

</body>

</html>
