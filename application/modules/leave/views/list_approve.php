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
            <h1 class="h3 mb-0 text-gray-800">รายการข้อมูลการลาที่ท่านต้องพิจารณา</h1>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- DataTales Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">รายการข้อมูลการลาที่ท่านต้องพิจารณา</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>ข้อมูลการลา</th>
                          <th>ประเภทการลา</th>
                          <th>ช่วงวันที่ลา</th>
                          <th>จำนวนวัน</th>
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
                                echo 'ชื่อ:'.(isset($personnel_list[$val['personnel_id']])?$personnel_list[$val['personnel_id']]['title'].$personnel_list[$val['personnel_id']]['name_th'].' '.$personnel_list[$val['personnel_id']]['surname_th']:' - ').' <br/>';
                                echo 'หน่วยงาน: '.(isset($personnel_list[$val['personnel_id']]) && isset($main_smu[$personnel_list[$val['personnel_id']]['smu_main_id']])?$main_smu[$personnel_list[$val['personnel_id']]['smu_main_id']]['smu_main_name']:'-').'<br/>';
                              ?>
                            </td>
                            <td><?php echo isset($leave_type[$val['leave_type_id']])?$leave_type[$val['leave_type_id']]['leave_name']:' - ';?></td>
                            <td>
                              <?php 
                                echo date_th($val['period_start'],2);
                                if($val['period_start_half']==1){
                                  echo '(เช้า)';
                                }elseif($val['period_start_half']==2){
                                  echo '(บ่าย)';
                                }
                                echo ' - ';
                                echo date_th($val['period_end'],2);
                                if($val['period_end_half']==1){
                                  echo '(เช้า)';
                                }elseif($val['period_end_half']==2){
                                  echo '(บ่าย)';
                                }
                              ?>
                            </td>
                            <td>
                              <?php
                                if(isset($leave_spec[$val['leave_type_id']][$personnel['emp_type_id']]) and intval($leave_spec[$val['leave_type_id']][$personnel['emp_type_id']]['type_count'])){
                                  $sum_day+=$val['period_count']; echo $val['period_count'].' (วัน)';
                                }else{
                                  $sum_day+=$val['period_count_all']; echo $val['period_count_all'].' (วัน)';
                                }
                              ?>
                            </td>
                            <td>
                              <a href="<?php echo $val['approve_data']; ?>" target="_blank" class="btn btn-info btn-circle btn-sm">
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
                          <th>ช่วงวันที่ลา</th>
                          <th></th>
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
  <a href="#" id="add-sig"  data-toggle="modal" data-target="#signature" style="display:none;"></a>
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
