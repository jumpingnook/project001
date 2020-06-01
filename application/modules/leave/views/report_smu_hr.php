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
            <h1 class="h3 mb-0 text-gray-800">รายงานสรุปการลา</h1>
          </div>


          
          <div class="row">
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">รายการข้อมูลการลา</h6>
                </div>
                <div class="card-body">
                  <div class="row mb-2">
                    <div class="col-3">
                      <div class="form-group">
                        <select name="year" class="form-control" form="search">
                          <?php for($i=2020;$i<=date('Y');$i++){ ?>
                            <option value="<?php echo $i;?>" <?php
                            if(isset($_POST['year']) && $_POST['year']==$i){
                              echo 'selected';
                            }elseif(!isset($_POST['year']) and intval(date('Y'))== $i){
                              echo 'selected';
                            }
                          ?>><?php echo 'ปี '.($i+543);?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                        <select name="month" class="form-control" form="search">
                            <option value="">ทุกเดือน</option>
                          <?php for($i=1;$i<=12;$i++){ ?>
                            <option value="<?php echo $i;?>" <?php
                            if(isset($_POST['month']) && $_POST['month']==$i){
                              echo 'selected';
                            }elseif(!isset($_POST['month']) and intval(date('m'))== $i){
                              echo 'selected';
                            }
                          ?>><?php echo 'เดือน '.date_th(date('Y-'.$i),9);?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-3">
                      <button type="submit" class="btn btn-info btn-icon-split" form="search">
                        <span class="icon text-white-50">
                          <i class="fas fa-search"></i>
                        </span>
                        <span class="text">ค้นหา</span>
                      </button>
                    </div>
                    <form id="search" action="<?php echo base_url(url_index().'leave/report_smu_hr');?>" method="post"></form>

                    

                    <div class="col-3">
                      <button class="btn btn-primary btn-icon-split" onclick="exportTableToExcel()">
                        <span class="icon text-white-50">
                          <i class="far fa-file-excel"></i>
                        </span>
                        <span class="text">บันทึกเป็น Excel</span>
                      </button>
                    </div>
                  </div>
                  <table id="tblData" class="table table-bordered" width="100%" cellspacing="0">
                    <tbody>
                        <?php $sum_colum=[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0]; foreach($main_smu as $key=>$val){ ?>
                          <tr>
                            <th colspan="11" data-f-color="ffffff" data-f-bold="true" data-fill-color="863920">ข้อมูลการลา <?php echo $val['smu_main_id'].' '.$val['smu_main_name']; ?></th>
                          </tr>
                          <tr>
                            <th data-f-color="ffffff" data-f-bold="true" data-fill-color="c36f54">ข้อมูลผู้ลา</th>
                            <th data-f-color="ffffff" data-f-bold="true" data-fill-color="c36f54">ประเภทที่ 1</th>
                            <th data-f-color="ffffff" data-f-bold="true" data-fill-color="c36f54">ประเภทที่ 2</th>
                            <th data-f-color="ffffff" data-f-bold="true" data-fill-color="c36f54">ประเภทที่ 3</th>
                            <th data-f-color="ffffff" data-f-bold="true" data-fill-color="c36f54">ประเภทที่ 4</th>
                            <th data-f-color="ffffff" data-f-bold="true" data-fill-color="c36f54">ประเภทที่ 5</th>
                            <th data-f-color="ffffff" data-f-bold="true" data-fill-color="c36f54">ประเภทที่ 6</th>
                            <th data-f-color="ffffff" data-f-bold="true" data-fill-color="c36f54">ประเภทที่ 7</th>
                            <th data-f-color="ffffff" data-f-bold="true" data-fill-color="c36f54">ประเภทที่ 8</th>
                            <th data-f-color="ffffff" data-f-bold="true" data-fill-color="c36f54">ประเภทที่ 9</th>
                            <th data-f-color="ffffff" data-f-bold="true" data-fill-color="c36f54">รวม</th>
                          </tr>
                        <?php if(isset($smu_personnel[$key])){ $sum_colum_row = [1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0]; foreach($smu_personnel[$key] as $key1=>$val1){ $sum_row = 0;?>
                        <tr>
                          <td>
                            ชื่อ: <?php echo $val1['title'].$val1['name_th'].' '.$val1['surname_th']; ?><br/>
                            รหัส: <?php echo $val1['personnel_code']; ?><br/>
                            ตำแหน่ง: <?php echo isset($sql_personnel['data'][$val1['personnel_code']])?$sql_personnel['data'][$val1['personnel_code']]['positionname']:'-';; ?>
                          </td>
                          <td>
                            <?php echo isset($leave[$val1['personnel_id']][1])?$leave[$val1['personnel_id']][1]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][1])?$sum_row+=$leave[$val1['personnel_id']][1]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][2])?$sum_colum[1]+=$leave[$val1['personnel_id']][1]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][2])?$sum_colum_row[1]+=$leave[$val1['personnel_id']][1]:''; ?>
                          </td>
                          <td>
                            <?php echo isset($leave[$val1['personnel_id']][2])?$leave[$val1['personnel_id']][2]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][2])?$sum_row+=$leave[$val1['personnel_id']][2]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][2])?$sum_colum[2]+=$leave[$val1['personnel_id']][2]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][2])?$sum_colum_row[2]+=$leave[$val1['personnel_id']][2]:''; ?>
                          </td>
                          <td>
                            <?php echo isset($leave[$val1['personnel_id']][3])?$leave[$val1['personnel_id']][3]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][3])?$sum_row+=$leave[$val1['personnel_id']][3]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][3])?$sum_colum[3]+=$leave[$val1['personnel_id']][3]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][3])?$sum_colum_row[3]+=$leave[$val1['personnel_id']][3]:''; ?>
                          </td>
                          <td>
                            <?php echo isset($leave[$val1['personnel_id']][4])?$leave[$val1['personnel_id']][4]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][4])?$sum_row+=$leave[$val1['personnel_id']][4]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][4])?$sum_colum[4]+=$leave[$val1['personnel_id']][4]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][4])?$sum_colum_row[4]+=$leave[$val1['personnel_id']][4]:''; ?>
                          </td>
                          <td>
                            <?php echo isset($leave[$val1['personnel_id']][5])?$leave[$val1['personnel_id']][5]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][5])?$sum_row+=$leave[$val1['personnel_id']][5]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][5])?$sum_colum[5]+=$leave[$val1['personnel_id']][5]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][5])?$sum_colum_row[5]+=$leave[$val1['personnel_id']][5]:''; ?>
                          </td>
                          <td>
                            <?php echo isset($leave[$val1['personnel_id']][6])?$leave[$val1['personnel_id']][6]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][6])?$sum_row+=$leave[$val1['personnel_id']][6]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][6])?$sum_colum[6]+=$leave[$val1['personnel_id']][6]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][6])?$sum_colum_row[6]+=$leave[$val1['personnel_id']][6]:''; ?>
                          </td>
                          <td>
                            <?php echo isset($leave[$val1['personnel_id']][7])?$leave[$val1['personnel_id']][7]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][7])?$sum_row+=$leave[$val1['personnel_id']][7]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][7])?$sum_colum[7]+=$leave[$val1['personnel_id']][7]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][7])?$sum_colum_row[7]+=$leave[$val1['personnel_id']][7]:''; ?>
                          </td>
                          <td>
                            <?php echo isset($leave[$val1['personnel_id']][8])?$leave[$val1['personnel_id']][8]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][8])?$sum_row+=$leave[$val1['personnel_id']][8]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][8])?$sum_colum[8]+=$leave[$val1['personnel_id']][8]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][8])?$sum_colum_row[8]+=$leave[$val1['personnel_id']][8]:''; ?>
                          </td>
                          <td>
                            <?php echo isset($leave[$val1['personnel_id']][9])?$leave[$val1['personnel_id']][9]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][9])?$sum_row+=$leave[$val1['personnel_id']][9]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][9])?$sum_colum[9]+=$leave[$val1['personnel_id']][9]:''; ?>
                            <?php isset($leave[$val1['personnel_id']][9])?$sum_colum_row[9]+=$leave[$val1['personnel_id']][9]:''; ?>
                          </td>
                          <td><?php echo $sum_row; $sum_colum_row[10]+=$sum_row; ?></td>
                        </tr>
                        <?php } ?>
                          <tr>
                            <th data-f-bold="true" data-fill-color="d2e3fc">รวม</th>
                            <?php for($i=1;$i<=9;$i++){ ?>
                            <th data-f-bold="true" data-fill-color="d2e3fc"><?php echo $sum_colum_row[$i];?></th>
                            <?php } ?>
                            <th data-f-bold="true" data-fill-color="d2e3fc"><?php echo $sum_colum_row[10];?></th>
                          </tr>
                        <?php }} ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
                      
          



          <?php /*$sum_colum=[1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0]; foreach($main_smu as $key=>$val){ ?>
          <div class="row">
            <div class="col-lg-12">
              <!-- DataTales Example -->
              <div class="card shadow mb-4">
                <a href="#<?php echo '_'.$key;?>" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="<?php echo '_'.$key;?>">
                  <h6 class="m-0 font-weight-bold text-primary">รายการข้อมูลการลา <?php echo $val['smu_main_id'].' '.$val['smu_main_name'];?></h6>
                </a>
                <div class="collapse" id="<?php echo '_'.$key;?>" style="">
                  <div class="card-body">
                    <div class="export-table table-responsive">
                      <table id="<?php echo 't_'.$key;?>" class="dataTable table table-bordered" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>ข้อมูลผู้ลา</th>
                            <th><i style="color:#27213C;">ประเภทที่ 1</i></th>
                            <th><i style="color:#5A352A;">ประเภทที่ 2</i></th>
                            <th><i style="color:#A33B20;">ประเภทที่ 3</i></th>
                            <th><i style="color:#A47963;">ประเภทที่ 4</i></th>
                            <th><i style="color:#A6A57A;">ประเภทที่ 5</i></th>
                            <th><i style="color:#D1CCDC;">ประเภทที่ 6</i></th>
                            <th><i style="color:#424C55;">ประเภทที่ 7</i></th>
                            <th><i style="color:#886F68;">ประเภทที่ 8</i></th>
                            <th><i style="color:#3D2C2E;">ประเภทที่ 9</i></th>
                            <th>รวม</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                            <?php $sum_colum_row = [1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0]; foreach($smu_personnel[$key] as $key1=>$val1){ $sum_row = 0;?>
                            <tr>
                              <td>
                                ชื่อ: <?php echo $val1['title'].$val1['name_th'].' '.$val1['surname_th']; ?><br/>
                                รหัส: <?php echo $val1['personnel_code']; ?><br/>
                                ตำแหน่ง: <?php echo $sql_personnel['data'][$val1['personnel_code']]['positionname']; ?>
                              </td>
                              <td>
                                <?php echo isset($leave[$val1['personnel_id']][1])?$leave[$val1['personnel_id']][1]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][1])?$sum_row+=$leave[$val1['personnel_id']][1]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][2])?$sum_colum[1]+=$leave[$val1['personnel_id']][1]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][2])?$sum_colum_row[1]+=$leave[$val1['personnel_id']][1]:''; ?>
                              </td>
                              <td>
                                <?php echo isset($leave[$val1['personnel_id']][2])?$leave[$val1['personnel_id']][2]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][2])?$sum_row+=$leave[$val1['personnel_id']][2]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][2])?$sum_colum[2]+=$leave[$val1['personnel_id']][2]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][2])?$sum_colum_row[2]+=$leave[$val1['personnel_id']][2]:''; ?>
                              </td>
                              <td>
                                <?php echo isset($leave[$val1['personnel_id']][3])?$leave[$val1['personnel_id']][3]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][3])?$sum_row+=$leave[$val1['personnel_id']][3]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][3])?$sum_colum[3]+=$leave[$val1['personnel_id']][3]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][3])?$sum_colum_row[3]+=$leave[$val1['personnel_id']][3]:''; ?>
                              </td>
                              <td>
                                <?php echo isset($leave[$val1['personnel_id']][4])?$leave[$val1['personnel_id']][4]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][4])?$sum_row+=$leave[$val1['personnel_id']][4]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][4])?$sum_colum[4]+=$leave[$val1['personnel_id']][4]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][4])?$sum_colum_row[4]+=$leave[$val1['personnel_id']][4]:''; ?>
                              </td>
                              <td>
                                <?php echo isset($leave[$val1['personnel_id']][5])?$leave[$val1['personnel_id']][5]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][5])?$sum_row+=$leave[$val1['personnel_id']][5]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][5])?$sum_colum[5]+=$leave[$val1['personnel_id']][5]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][5])?$sum_colum_row[5]+=$leave[$val1['personnel_id']][5]:''; ?>
                              </td>
                              <td>
                                <?php echo isset($leave[$val1['personnel_id']][6])?$leave[$val1['personnel_id']][6]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][6])?$sum_row+=$leave[$val1['personnel_id']][6]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][6])?$sum_colum[6]+=$leave[$val1['personnel_id']][6]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][6])?$sum_colum_row[6]+=$leave[$val1['personnel_id']][6]:''; ?>
                              </td>
                              <td>
                                <?php echo isset($leave[$val1['personnel_id']][7])?$leave[$val1['personnel_id']][7]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][7])?$sum_row+=$leave[$val1['personnel_id']][7]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][7])?$sum_colum[7]+=$leave[$val1['personnel_id']][7]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][7])?$sum_colum_row[7]+=$leave[$val1['personnel_id']][7]:''; ?>
                              </td>
                              <td>
                                <?php echo isset($leave[$val1['personnel_id']][8])?$leave[$val1['personnel_id']][8]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][8])?$sum_row+=$leave[$val1['personnel_id']][8]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][8])?$sum_colum[8]+=$leave[$val1['personnel_id']][8]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][8])?$sum_colum_row[8]+=$leave[$val1['personnel_id']][8]:''; ?>
                              </td>
                              <td>
                                <?php echo isset($leave[$val1['personnel_id']][9])?$leave[$val1['personnel_id']][9]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][9])?$sum_row+=$leave[$val1['personnel_id']][9]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][9])?$sum_colum[9]+=$leave[$val1['personnel_id']][9]:''; ?>
                                <?php isset($leave[$val1['personnel_id']][9])?$sum_colum_row[9]+=$leave[$val1['personnel_id']][9]:''; ?>
                              </td>
                              <td><?php echo $sum_row; $sum_colum_row[10]+=$sum_row; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>รวม</th>
                            <?php for($i=1;$i<=9;$i++){ ?>
                            <th><?php echo $sum_colum_row[$i];?></th>
                            <?php } ?>
                            <th><?php echo $sum_colum_row[10];?></th>
                          </tr>
                          <tr>
                            <th colspan="11">
                              <i style="color:#27213C;">ประเภทที่ 1 : </i>ลาผักผ่อน<br/>
                              <i style="color:#5A352A;">ประเภทที่ 2 : </i>ลากิจส่วนตัว<br/>
                              <i style="color:#A33B20;">ประเภทที่ 3 : </i>ลาป่วย<br/>
                              <i style="color:#A47963;">ประเภทที่ 4 : </i>ลาคลอดบุตร<br/>
                              <i style="color:#A6A57A;">ประเภทที่ 5 : </i>ลาไปช่วยเหลือภริยาที่คลอดบุตร<br/>
                              <i style="color:#D1CCDC;">ประเภทที่ 6 : </i>ลากิจส่วนตัวเพื่อเลี้ยงดูบุตร<br/>
                              <i style="color:#424C55;">ประเภทที่ 7 : </i>ลาผักผ่อนไปต่างประเทศ<br/>
                              <i style="color:#886F68;">ประเภทที่ 8 : </i>ลาอุปสมบทหรือลาไปประกอบบพิธีการฮัจย์<br/>
                              <i style="color:#3D2C2E;">ประเภทที่ 9 : </i>ลาเข้ารับการตรวจเลือก หรือเข้ารับการเตรียมพล
                            </th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php }*/ ?>


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

  <script src="<?php echo base_url(load_file('assets/vendor/table-to-excel/dist/tableToExcel.js'));?>"></script>

  <script>
    $(document).ready(function(){
      // Call the dataTables jQuery plugin
      $(document).ready(function() {

        var table = $('.dataTable').DataTable({
          "dom": '<"row"<"col-10"l><"col-2"B>f> <"row"t> <"row"<"col-8"i><"col-4"p>>',
          "buttons": [
            {
              extend: 'excelHtml5',
              text: 'Excel',
              exportOptions: {
                columns: ':visible',
                stripHtml: true,
                modifier: {
                  selected: false,
                  page: 'current',
                  search: 'applied'
                }
              }
            },{
              extend: 'print',
              text: 'Print',
              orientation: 'landscape',
              pageSize: 'A4',
              exportOptions: {
                columns: ':visible',
                stripHtml: false,
                modifier: {
                  selected: false,
                  page: 'current',
                  search: 'applied'
                }
              }
            }
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
      });

    });

    <?php 
      $name = 'leave_report_'.(date('Y')+543);
      if(isset($_POST['year']) and isset($_POST['month']) and $_POST['month']!=''){
        $name = 'leave_report_'.$_POST['month'].'_'.$_POST['year'];
      }
    ?>

    function exportTableToExcel(){
      TableToExcel.convert(document.getElementById("tblData"), {
        name: "<?php echo $name;?>.xlsx"
      });
    }
  </script>

</body>

</html>
