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

  <link rel="stylesheet" href="<?php echo base_url(load_file('assets/vendor/jquery-ui/jquery-ui.css'));?>">

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
            <h1 class="h3 mb-0 text-gray-800">การพิจารณาข้อมูลเลขที่ <?php echo isset($data['leave_no'])?$data['leave_no']:'0';?></h1>
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
                      <div class="row">
                        <div class="col-lg-3 font-weight-bold">
                          อายุงาน
                        </div>
                        <div class="col-lg-9">
                          <?php 
                            if(isset($personnel['data']['work_end_date']) and $personnel['data']['work_end_date']=='0000-00-00'){

                              $datetime1 = date_create($personnel['data']['work_start_date']); 
                              $datetime2 = date_create(date('Y-m-d')); 
                                
                              $interval = date_diff($datetime1, $datetime2);

                              if($interval->y!=0){
                                echo $interval->y.' ปี ';
                              }
                              if($interval->m!=0){
                                echo $interval->m.' เดือน ';
                              }
                              if($interval->d!=0){
                                echo $interval->d.' วัน ';
                              }

                            }else{
                              echo date_th($personnel['data']['work_start_date'],2).' - '.date_th($personnel['data']['work_end_date'],2);
                            }
                          ?>
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
                      <?php if($data['status']==1){ ?>
                        <?php 
                          if($signature_type>=2 and $signature_type!=5){
                            $btn[] = 'เห็นควรอนุญาต';
                            $btn[] = 'เห็นควรไม่อนุญาต';
                            $title = isset($cancel_approve) && $cancel_approve?'ยกเลิกวันลา':'อนุมัติการลา';
                          }elseif($signature_type==1){
                            $btn[] = 'ยอมรับการปฏิบัติงานแทน';
                            $btn[] = 'ไม่ยอมรับการปฏิบัติงานแทน';
                            $title = 'ผู้ปฏิบัติงานแทน';
                          }elseif($signature_type==5  && intval($data['personnel_id_6'])==0){
                            $btn[] = 'อนุญาต';
                            $btn[] = 'ไม่อนุญาต';
                            $title = isset($cancel_approve) && $cancel_approve?'ยกเลิกวันลา':'อนุมัติการลา';
                          }elseif($signature_type==5  && intval($data['personnel_id_6'])!=0){
                            $btn[] = 'เห็นควรอนุญาต';
                            $btn[] = 'เห็นควรไม่อนุญาต';
                            $title = isset($cancel_approve) && $cancel_approve?'คำสั่งอนุมัติยกเลิกวันลา':'คำสั่งอนุมัติการลา';
                          }
                        ?>

                        <div class="row">
                          <div class="text-s font-weight-bold text-danger text-uppercase mb-1">การพิจารณา<?php echo $title;?></div>
                        </div>

                        <?php //if(!$approve_status and trim($personnel_list['data'][$personnel_id]['signature'])!=''){ ?>

                        <div class="row mb-1">
                          <button type="submit" name="approve" form="form" value="1" class="btn btn-success btn-icon-split" style="width: 100%;">
                            <span class="icon text-white-600">
                              <i class="fas fa-check"></i>
                            </span>
                            <span class="text" style="width: 100%;"><?php echo $btn[0];?></span>
                          </button>
                        </div>

                        <br>
                        <div class="row mb-1">
                          <?php if($signature_type>=2 and $signature_type!=5){ ?>
                            <textarea form="form" class="form-control" name="note_personnel_<?php echo $signature_type;?>" rows="3" style="width:100%;" placeholder="ระบุความคิดเห็นเห็นควรไม่อนุญาต"></textarea>
                          <?php } ?>
                          <button type="submit" name="approve" form="form" value="2" class="btn btn-primary btn-icon-split" style="width: 100%;">
                            <span class="icon text-white-600" style="width:43px;">
                              <i class="fas fa-times"></i>
                            </span>
                            <span class="text" style="width: 100%;"><?php echo $btn[1];?></span>
                          </button>
                        </div>
                        <?php if(($signature_type==5 && intval($data['personnel_id_6'])==0) || ($signature_type==6 && intval($data['personnel_id_6'])!=0)){?>
                          <div class="form-group row mb-1 ">
                            <textarea form="form" class="form-control" name="note_personnel_<?php echo $signature_type;?>" rows="3" style="width:100%;" placeholder="ระบุความคิดเห็นกรณีไม่อนุญาต"></textarea>
                          </div>
                        
                          <hr>

                          <form id="assign_form" action="<?php echo base_url(url_index().'leave/assign_approve');?>" method="post">
                            <div class="row mb-1">
                              <div class="text-s font-weight-bold text-danger text-uppercase mb-1">หมอบหมายรักษาการแทน</div>
                              <div class="form-group" style="width: 100%;">
                                <label>คณบดี</label>
                                <input type="text" class="input_hide form-control name_personnel name_personnel_5" auto_type="deputy_dean" placeholder="ระบุชื่อผู้พิจารณารักษาการแทน" autocomplete="off" required>
                                <input id="deputy_dean" type="hidden" name="personnel_id_5" class="input_hide personnel_id_5" value="" autocomplete="off" required/>
                                <input id="deputy_dean_position" type="text" class="input_hide form-control position_personnel_5" name="position_personnel_5"  placeholder="ระบุตำแหน่งผู้พิจารณา" value="" required/>
                              </div>
                              <button type="submit" class="btn btn-warning btn-icon-split" style="width: 100%;">
                                <span class="icon text-white-600" style="width:43px;">
                                  <i class="fas fa-times"></i>
                                </span>
                                <span class="text" style="width: 100%;">บันทึกผู้พิจารณารักษาการแทน</span>
                              </button>
                            </div>
                            <input type="hidden" name="leave_id" value="<?php echo $leave_id;?>">
                          </form>
                        <?php } ?>


                        <?php if(isset($cancel_approve) and $cancel_approve and trim($personnel_list['data'][$personnel_id]['signature'])!=''){?>
                          <div class="row mb-1">
                            <button type="submit" name="approve" form="form" value="1" class="btn btn-success btn-icon-split">
                              <span class="icon text-white-600">
                                <i class="fas fa-check"></i>
                              </span>
                              <span class="text"><?php echo $btn[0];?></span>
                            </button>
                          </div>

                          <div class="row mb-1">
                            <button type="submit" name="approve" form="form" value="2" class="btn btn-primary btn-icon-split">
                              <span class="icon text-white-600">
                                <i class="fas fa-times"></i>
                              </span>
                              <span class="text"><?php echo $btn[1];?></span>
                            </button>
                          </div>
                        <?php } ?>

                        <form id="form" action="<?php echo base_url(url_index().'leave/save_approve');?>" method="post">
                            <input type="hidden" name="personnel_id" value="<?php echo $personnel_id;?>">
                            <input type="hidden" name="type" value="<?php echo $signature_type;?>">
                            <input type="hidden" name="leave_id" value="<?php echo $leave_id;?>">
                            <?php if(isset($cancel_approve) and $cancel_approve){ ?>
                              <input type="hidden" name="cancel" value="n29gknk626e3gh">
                            <?php } ?>
                            <?php if($signature_type==5 && intval($data['personnel_id_6'])!=0){ ?>
                              <input type="hidden" name="next_approve" value="true">
                            <?php } ?>
                        </form>
                      <?php }elseif($data['status']>2){ ?>
                        <button class="btn btn-primary btn-icon-split">
                          <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                          </span>
                          <span class="text">บุคคลากรยกเลิกการลาเมื่อวันที่<br/><?php echo date_th($data['cancel_date'],2);?></span>
                        </button>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <div id="preload" style="position: absolute;width: 100vw;height: 100%;background-color: rgba(0, 0, 0, 0.5);z-index: 99;top: 0;left: 0;display:none;">
        <img src="<?php echo base_url(load_file('assets/img/loading.gif'));?>" style="position: fixed;left: 0;right: 0;margin: auto;top: 25%;">
        </div>

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php echo $this->load->view('inc/footer'); ?>
      <!-- End of Footer -->

      <!-- Boss Modal-->
      <a id="modal-boss" class="dropdown-item" href="#" data-toggle="modal" data-target="#_boss" style="display:none;"></a>
      <div class="modal fade" id="_boss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">เลือกชื่อตำแหน่ง</h5>
                  <button id="close_position" class="close" type="button" data-dismiss="modal" aria-label="Close" style="display:none;">
                  <span aria-hidden="true">×</span>
                  </button>
              </div>

              <div class="modal-body">
                  <div class="form-group">
                    <div id="boss_position_list">
                    </div>
                  </div>
              </div>

              <div class="modal-footer">
                  <button id="ok_position" type_id="" class="btn btn-secondary" type="button">ตกลง</button>
              </div>
              </div>
          </div>
      </div>

      <div id="preload" style="position: absolute;width: 100vw;height: 100%;background-color: rgba(0, 0, 0, 0.5);z-index: 99;top: 0;left: 0;display:none;">
        <img src="<?php echo base_url(load_file('assets/img/loading.gif'));?>" style="position: fixed;left: 0;right: 0;margin: auto;top: 25%;">
      </div>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php echo $this->load->view('inc/scroll_to'); ?>
  
  <?php echo $this->load->view('inc/logout'); ?>
  
  <?php echo $this->load->view('inc/js'); ?>

  <script src="<?php echo base_url(load_file('assets/vendor/jquery-ui/jquery-ui.min.js'));?>" ></script>

  <!-- Logout Modal-->

  <?php /*if(trim($personnel_list['data'][$personnel_id]['signature'])==''){ ?>
  <a href="#" id="add-sig" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#signature" style="display:none;"></a>
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
            <style>
              #qrcode1 img{
                margin: auto;
              }
            </style>

            <div class="row">
               <div class="col-lg-5 mb-4">
                <div id="qrcode-sig"></div>
               </div>

               <div class="col-lg-7"><br/><br/>

                <center><span class="font-weight-bold" style="color: red;">
                **เนื่องจากท่านยังไม่ไมีลายเซ็นอิเล็กทรอนิกส์ในระบบลานี้<br/>
                กรุณาบันทึกลายเซ็นอิเล็กทรอนิกส์ของท่านเพื่อใช้งานระบบ
                </span></center><br/>
                <center><-- ใช้โทรศัพท์ของท่านสแกน QR Code เพื่อบันทึกลายเซ็น หรือ</center><br/>
                <center>
                  <a href="<?php echo $signature_url;?>" target="_blank" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-600">
                      <i class="fas fa-link"></i>
                    </span>
                    <span class="text">คลิกที่นี่เพื่อเพิ่มลายเซ็นผ่านหน้าเว็บไซต์</span>
                  </a>
                </center>

               </div>

            </div>

            <script src="<?php echo base_url(load_file('assets/js/qrcodejs/qrcode.min.js'));?>"></script>
            <script>

              var qrcode1 = new QRCode("qrcode-sig", {
                text: "<?php echo $personnel_list['data'][$personnel_id]['url_signature'];?>",
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
        </div>
      </div>
    </div>
  </div>
  <?php }*/ ?>

  <script>
      $(document).ready(function(){
        $('#form').submit(function(){
          var con = confirm('ท่านต้องบันทึกผลการพิจารณานี้ใช่หรือไม่');
          if(con){

            $('#preload').show();
            
            return true;
          }
          return false;
        });

        var data = {
          'APP-KEY':'<?php echo $api['APP-KEY'];?>',
          token:'<?php echo $api['token'];?>',
          ip:'<?php echo $api['ip'];?>',
          term:''
        };

        $(".name_personnel").autocomplete({
          source: function(request,response) {

            data.term = request.term;
            $.ajax( {
              type: "POST",
              url: "<?php echo base_url(url_index().'personnel/api_v1/personnel'); ?>",
              dataType: "jsonp",
              data: data,
              success: function(data) {

                let res = [];

                if(!data.status){
                  location.reload();
                  return false;
                }

                if(data.count>0){

                  $.each( data.data, function( key, value ) {
                    res[key] = {'value':'','label':'','id':''};
                    res[key].value = value.title+value.name_th+' '+value.surname_th+', '+value.email;
                    res[key].label = value.title+value.name_th+' '+value.surname_th+', '+value.email;
                    res[key].boss  = value.position_boss;
                    res[key].id    = value.personnel_id;
                  });
                  response(res);
                }else{
                  return false;
                }
                
              }
            } );
          },
          minLength: 2,
          select: function( event, ui ) {
            var id = $(this).attr('auto_type');
            var position = ui.item.boss;
            if(position!=null && position!==''){
              var res = position.split(",");
              if(res.length>0){
                var html = '';
                $('#boss_position_list').empty();
                $.each(res,function(key,val){
                  console.log(key,val);
                  html += '<div class="radio"><label><input type="radio" class="position_bosss" name="position_bosss" value="'+(val.trim())+'" '+(key==0?'checked="checked"':'')+'> '+(val.trim())+'</label></div>';
                });
                html += '<div class="radio"><label><input type="radio" class="position_bosss" name="position_bosss" value="" '+(html==''?'checked="checked"':'')+'> เลือกกรอกตำแหน่งอื่นๆ</label></div>';
                $('#boss_position_list').append(html);
                $('#ok_position').attr('type_id',id);
                $('#modal-boss').click();
              }

            }else{
              $(this).next().next().focus();
            }

            $(this).next().val(ui.item.id);
          },
          change: function (event, ui) {
            if (ui.item === null) {
              $(this).val('');
              $(this).next().val('');
              $(this).next().next().val('');
            }
        }

        });

        $('#ok_position').click(function(){
          var type_id = $(this).attr('type_id');
          $('#'+type_id+'_position').val($('#boss_position_list .position_bosss:checked').val()).focus();
          $('#close_position').click();
        });

        $('#assign_form').submit(function(){
          $('#preload').show();
          var id = $('#deputy_dean').val();
          var position = $('#deputy_dean_position').val();

          if(id=='' || position==''){
            alert('กรุณาระบุผู้พิจารณารักษาการแทนให้ครบถ้วน');
            $('#preload').hide();
            return false;
          }

          return true;
        });

        <?php if($data['status']==98 || $data['status']==99){ ?>
          alert('บุคคลากรยกเลิกการลาเมื่อวันที่ <?php echo date_th($data['cancel_date'],2);?>');
        <?php } ?>
      });

  </script>

</body>

</html>
