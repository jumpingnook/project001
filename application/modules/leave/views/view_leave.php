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

  <style>
    @font-face {
      font-family: 'th-sarabun';
      src: url('<?php echo base_url(load_file('assets/font/THSarabun.ttf'));?>');
      src: url('<?php echo base_url(load_file('assets/font/THSarabun.ttf'));?>')  format('truetype'), /* Safari, Android, iOS */
    }
    .document{
      position:relative;
      font-family:'th-sarabun';
      color:#000000;
    }
    .document span{
      position:absolute;
      font-size:1.4vw;
    }
    @media print{


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
                  <div class="row mb-2">
                    <div class="col-lg-12 font-weight-bold">
                      <img src="<?php echo isset($personnel['img'])&&trim($personnel['img'])!=''?$personnel['img']:'';?>" style="max-width: 200px;width: 100%;display: block;min-height: 200px;background-color: #ccc;"/>
                    </div>
                  </div>
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
                  <hr/>
                  <div class="text-s font-weight-bold text-primary text-uppercase mb-1">ข้อมูลการลา</div>
                  <div class="row">
                    <div class="col-lg-3 font-weight-bold">
                      ประเภทการลา
                    </div>
                    <div class="col-lg-9">
                      <?php echo isset($data['leave_type_id']) && isset($leave_type[$data['leave_type_id']])?$leave_type[$data['leave_type_id']]['leave_name']:' - ';?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 font-weight-bold">
                      เลขที่
                    </div>
                    <div class="col-lg-9">
                      <?php echo isset($data['leave_no'])?$data['leave_no']:'0';?>
                    </div>
                  </div>
                  <?php if(isset($data['title']) and trim($data['title'])!=''){ ?>
                  <div class="row">
                    <div class="col-lg-3 font-weight-bold">
                      เรื่อง
                    </div>
                    <div class="col-lg-9">
                      <?php echo isset($data['title'])?htmlspecialchars_decode($data['title']):'-';?>
                    </div>
                  </div>
                  <?php } ?>
                  <?php if(isset($data['detail']) and trim($data['detail'])!=''){ ?>
                  <div class="row">
                    <div class="col-lg-3 font-weight-bold">
                      รายละเอียด
                    </div>
                    <div class="col-lg-9">
                      <?php echo isset($data['detail'])?htmlspecialchars_decode($data['detail']):'-';?>
                    </div>
                  </div>
                  <?php } ?>
                  <?php if(isset($data['contact']) and trim($data['contact'])!=''){ ?>
                  <div class="row">
                    <div class="col-lg-3 font-weight-bold">
                      ข้อมูลการติดต่อ
                    </div>
                    <div class="col-lg-9">
                      <?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="row">
                    <div class="col-lg-3 font-weight-bold">
                      ลาช่วงวันที่
                    </div>
                    <div class="col-lg-9">
                      <?php echo date('Y/m/d',strtotime($data['period_start'])).($data['period_end']!=''?' - '.date('Y/m/d',strtotime($data['period_end'])):'');?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 font-weight-bold">
                      จำนวนวันลารวม
                    </div>
                    <div class="col-lg-9">
                      <?php echo isset($data['period_count'])?floatval($data['period_count']).(($data['period_type']!='a'?$data['period_type']=='p'?' (บ่าย)':' (วัน)':' (เช้า)')):'-';?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 font-weight-bold">
                      ลงข้อมูลลาวันที่
                    </div>
                    <div class="col-lg-9">
                      <?php echo date('Y/m/d',strtotime($data['create_date']));?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 font-weight-bold">
                      สถานะข้อมูล
                    </div>
                    <div class="col-lg-9">
                      -
                    </div>
                  </div>
                  <hr/>
                  <div class="text-s font-weight-bold text-primary text-uppercase mb-1">ข้อมูลผู้อนุมัติ</div>
                  <?php if(isset($workmate) && is_array($workmate)){ ?>
                  <div class="row">
                    <div class="col-lg-3 font-weight-bold">
                      ผู้ทำงานแทน
                    </div>
                    <div class="col-lg-9">
                      <?php echo isset($workmate) && is_array($workmate)?$workmate['title'].$workmate['name_th'].' '.$workmate['surname_th']:' - ';?>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="row">
                    <div class="col-lg-3 font-weight-bold">
                      ผู้บังคับบัญชา
                    </div>
                    <div class="col-lg-9">
                      <?php echo isset($boss) && is_array($boss)?$boss['title'].$boss['name_th'].' '.$boss['surname_th']:' - ';?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 font-weight-bold">
                      ผู้บริหารระดับสูง
                    </div>
                    <div class="col-lg-9">
                      <?php 
                        if(isset($data['to']) and $data['to']==1){
                          echo 'คณะบดีคณะแพทยศาสตร์';
                        }elseif(isset($data['to']) and $data['to']==2){
                          echo 'อธิกาารบดี';
                        }else{
                          echo 'อธิกาารบดี (คณะบดีคณะแพทยศาสตร์)';
                        }
                      ?>
                    </div>
                  </div>
                  <hr/>
                  <div id="document" class="row mb-2" style="border: 1px solid #ccc;">
                    <div class="col-lg-12 document" >
                      <?php $doc = ''; if(isset($data['leave_type_id']) and intval($data['leave_type_id'])==1){$doc = 'document/leave/1,7.jpg';?>
                        <span style="top: calc(100% - 87.4%);left: calc(100% - 42%);">20</span>
                        <span style="top: calc(100% - 87.4%);left: calc(100% - 32%);">เมษายน</span>
                        <span style="top: calc(100% - 87.4%);left: calc(100% - 17%);">2563</span>
                        <span style="top: calc(100% - 78.7%);left: calc(100% - 69%);">
                          <?php 
                            echo isset($personnel['title'])?$personnel['title']:'-'; 
                            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                          ?>
                        </span>
                        <span style="top: calc(100% - 78.7%);left: calc(100% - 36%);"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

                        <span style="top: calc(100% - 76.6%);left: calc(100% - 80%);"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

                        <span style="top: calc(100% - 74.6%);left: calc(100% - 72%);">99*</span>
                        <span style="top: calc(100% - 74.6%);left: calc(100% - 23%);">99*</span>

                        <span style="top: calc(100% - 72.3%);left: calc(100% - 70%);"><?php echo date('Y/m/d',strtotime($data['period_start']));?></span>

                        <span style="top: calc(100% - 72.3%);left: calc(100% - 44%);"><?php echo ($data['period_end']!=''?date('Y/m/d',strtotime($data['period_end'])):'');?></span>

                        <span style="top: calc(100% - 72.3%);left: calc(100% - 17%);"><?php echo isset($data['period_count'])?floatval($data['period_count']).(($data['period_type']!='a'?$data['period_type']=='p'?' (บ่าย)':'':' (เช้า)')):'-';?></span>

                        <span style="top: calc(100% - 70.1%);left: calc(100% - 63%);"><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></span>

                        <span style="top: calc(100% - 59.4%);left: calc(100% - 44%);">
                          <?php 
                            echo isset($personnel['title'])?$personnel['title']:'-'; 
                            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                          ?>
                        </span>

                        <span style="top: calc(100% - 50.8%);left: calc(100% - 45%)"><?php echo isset($workmate) && is_array($workmate)?$workmate['title'].$workmate['name_th'].' '.$workmate['surname_th']:' - ';?></span>

                        <span style="top: calc(100% - 41.6%);left: calc(100% - 45%)"><?php echo isset($boss) && is_array($boss)?$boss['title'].$boss['name_th'].' '.$boss['surname_th']:' - ';?></span>









                        




                      <?php }elseif(isset($data['leave_type_id']) and intval($data['leave_type_id'])>=2 and intval($data['leave_type_id'])<=4){ $doc = 'document/leave/2-4.jpg';?>
                        <span style="top: calc(100% - 86.7%);left: calc(100% - 42%);">20</span>
                        <span style="top: calc(100% - 86.7%);left: calc(100% - 32%);">เมษายน</span>
                        <span style="top: calc(100% - 86.7%);left: calc(100% - 17%);">2563</span>
                        <span style="top: calc(100% - 82.8%);left: calc(100% - 78%);"><?php echo isset($data['leave_type_id']) && isset($leave_type[$data['leave_type_id']])?$leave_type[$data['leave_type_id']]['leave_name']:' - ';?></span>
                        <span style="top: calc(100% - 75.2%);left: calc(100% - 72%);">
                          <?php 
                            echo isset($personnel['title'])?$personnel['title']:'-'; 
                            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                          ?>
                        </span>
                        <span style="top: calc(100% - 75.2%);left: calc(100% - 37%);"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

                        <span style="top: calc(100% - 72.6%);left: calc(100% - 76%);"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

                        <span style="top: calc(100% - 70%);left: calc(100% - 36%);"><?php echo isset($data['detail'])?htmlspecialchars_decode($data['detail']):'-';?></span>

                        <span style="top: calc(100% - 62.3%);left: calc(100% - 79%);"><?php echo date('Y/m/d',strtotime($data['period_start']));?></span>

                        <span style="top: calc(100% - 62.3%);left: calc(100% - 53%);"><?php echo ($data['period_end']!=''?date('Y/m/d',strtotime($data['period_end'])):'');?></span>

                        <span style="top: calc(100% - 62.3%);left: calc(100% - 23%);"><?php echo isset($data['period_count'])?floatval($data['period_count']).(($data['period_type']!='a'?$data['period_type']=='p'?' (บ่าย)':'':' (เช้า)')):'-';?></span>

                        <span style="top: calc(100% - 57.3%);left: calc(100% - 71%);"><?php echo date('Y/m/d',strtotime($data['period_start']));?></span>

                        <span style="top: calc(100% - 57.3%);left: calc(100% - 49%);"><?php echo ($data['period_end']!=''?date('Y/m/d',strtotime($data['period_end'])):'');?></span>

                        <span style="top: calc(100% - 57.3%);left: calc(100% - 20%);"><?php echo isset($data['period_count'])?floatval($data['period_count']).(($data['period_type']!='a'?$data['period_type']=='p'?' (บ่าย)':'':' (เช้า)')):'-';?></span>

                        <span style="top: calc(100% - 54.6%);left: calc(100% - 63%);"><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></span>

                        <span style="top: calc(100% - 44.2%);left: calc(100% - 47%);">
                          <?php 
                            echo isset($personnel['title'])?$personnel['title']:'-'; 
                            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                          ?>
                        </span>

                        <span style="top: calc(100% - 32.6%);left: calc(100% - 42%)"><?php echo isset($boss) && is_array($boss)?$boss['title'].$boss['name_th'].' '.$boss['surname_th']:' - ';?></span>
                        









                        
                      <?php }elseif(isset($data['leave_type_id']) and intval($data['leave_type_id'])==5){$doc = 'document/leave/5.jpg';?>
                        <span style="top: calc(100% - 91.8%);left: calc(100% - 29%);"><?php echo isset($data['write_at'])?$data['write_at']:'-';?></span>
                        <span style="top: calc(100% - 89.2%);left: calc(100% - 39%);">20</span>
                        <span style="top: calc(100% - 89.2%);left: calc(100% - 31%);">เมษายน</span>
                        <span style="top: calc(100% - 89.2%);left: calc(100% - 15%);">2563</span>
                        <span style="top: calc(100% - 84.2%);left: calc(100% - 83%);">20*</span>

                        <span style="top: calc(100% - 78.9%);left: calc(100% - 69%);">
                          <?php 
                            echo isset($personnel['title'])?$personnel['title']:'-'; 
                            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                          ?>
                        </span>
                        <span style="top: calc(100% - 78.9%);left: calc(100% - 36%);"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

                        <span style="top: calc(100% - 76.3%);left: calc(100% - 82%);">99*</span>

                        <span style="top: calc(100% - 76.3%);left: calc(100% - 67%);"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

                        <span style="top: calc(100% - 73.8%);left: calc(100% - 69%);">99*</span>

                        <span style="top: calc(100% - 71.2%);left: calc(100% - 71%);">99*</span>
                        <span style="top: calc(100% - 71.2%);left: calc(100% - 64%);">99*</span>
                        <span style="top: calc(100% - 71.2%);left: calc(100% - 51.7%);">99*</span>

                        <span style="top: calc(100% - 71.2%);left: calc(100% - 71%);">99*</span>
                        <span style="top: calc(100% - 71.2%);left: calc(100% - 64%);">99*</span>
                        <span style="top: calc(100% - 71.2%);left: calc(100% - 51.7%);">99*</span>

                        <span style="top: 31.3%;left: 17.3%;">99*</span>
                        <span style="top: 31.3%;left: 24.3%;">99*</span>
                        <span style="top: 31.3%;left: 35.3%;">99*</span>
                        <span style="top: 31.3%;left: 47.3%;">99*</span>
                        <span style="top: 31.3%;left: 55.3%;">99*</span>
                        <span style="top: 31.3%;left: 66%;">99*</span>
                        <span style="top: 31.3%;left: 77.5%;">99*</span>
                        
                        <span style="top: calc(100% - 66.1%);left: calc(100% - 63%);"><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></span>

                        <span style="top: calc(100% - 66.1%);left: calc(100% - 23%);"><?php echo isset($personnel['data']['phone'])?$personnel['data']['phone']:'-';?></span>

                        <span style="top: calc(100% - 58.4%);left: calc(100% - 56%);">
                          <?php 
                            echo isset($personnel['title'])?$personnel['title']:'-'; 
                            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                          ?>
                        </span>

                        <span style="top: calc(100% - 40.6%);left: calc(100% - 56%)"><?php echo isset($boss) && is_array($boss)?$boss['title'].$boss['name_th'].' '.$boss['surname_th']:' - ';?></span>















                      <?php }elseif(isset($data['leave_type_id']) and intval($data['leave_type_id'])==6){$doc = 'document/leave/6.jpg';?>

                      <?php }elseif(isset($data['leave_type_id']) and intval($data['leave_type_id'])==7){$doc = 'document/leave/7.jpg';?>

                      <?php }elseif(isset($data['leave_type_id']) and intval($data['leave_type_id'])==8){$doc = 'document/leave/8.jpg';?>

                      <?php }elseif(isset($data['leave_type_id']) and intval($data['leave_type_id'])==9){$doc = 'document/leave/9.jpg';?>
                          
                      <?php } ?>
                      <img src="<?php echo base_url(load_file($doc));?>" style="width:100%;">
                    </div>
                  </div>
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


                      <?php if(isset($data['url_personnel']) and trim($data['url_personnel'])!='') {?>
                        <hr/>
                        <div class="row">
                          <div class="text-s font-weight-bold text-danger text-uppercase mb-1">ลงลายเซ็นผู้ลา</div>
                        </div>
                      <?php if(trim($data['signature_personnel'])==''){?>  
                        <div class="row mb-1">
                          <a href="<?php echo trim($data['url_personnel']);?>" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                            <i class="fas fa-signature"></i>
                            </span>
                            <span class="text">ลงลายเซ็นที่นี่</span>
                          </a>
                        </div>
                      <?php }elseif(trim($data['signature_personnel'])!=''){?>
                        <div class="row mb-1">
                          <a href="#" class="btn btn-lg btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fas fa-check"></i>
                            </span>
                            <span class="text">ผู้ลาลงลายเซ็นแล้ว</span>
                          </a>
                        </div>
                      <?php }}?>


                      <?php if(isset($data['url_workmate']) and trim($data['url_workmate'])!='') {?>
                        <hr/>
                        <div class="row">
                          <div class="text-s font-weight-bold text-danger text-uppercase mb-1">แชร์เพื่อลงลายเซ็นผู้ทำงานแทน</div>
                        </div>
                      <?php if(trim($data['signature_workmate'])==''){?>  
                        <div class="row mb-1">
                          <a href="<?php echo 'https://social-plugins.line.me/lineit/share?url='.urlencode($data['url_workmate']);?>" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fab fa-line"></i>
                            </span>
                            <span class="text">ส่งผ่าน Line</span>
                          </a>
                        </div>
                        <div class="row mb-1">
                          <a href="#" class="btn btn-info btn-icon-split" onclick="copy_url('<?php echo htmlspecialchars_decode($data['url_workmate']);?>')">
                            <span class="icon text-white-50">
                              <i class="fas fa-copy"></i>
                            </span>
                            <span class="text">คัดลอก URL เพื่อส่งช่องทางอื่น</span>
                          </a>
                        </div>
                        <div class="row mb-1">
                          <a href="#" onclick="open_qr('<?php echo $data['qr_workmate'];?>');" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fas fa-qrcode"></i>
                            </span>
                            <span class="text">QR CODE URL</span>
                          </a>
                        </div>
                      <?php }elseif(trim($data['signature_workmate'])!=''){?>
                        <div class="row mb-1">
                          <a href="#" class="btn btn-lg btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fas fa-check"></i>
                            </span>
                            <span class="text">ผู้ทำงานแทนลงลายเซ็นแล้ว</span>
                          </a>
                        </div>
                      <?php }}?>
                      
                      
                      
                      <?php if(isset($data['url_boss']) and trim($data['url_boss'])!='') {?>
                        <hr/>
                        <div class="row">
                          <div class="text-s font-weight-bold text-danger text-uppercase mb-1">แชร์เพื่อลงลายเซ็นผู้บังคับบัญชา</div>
                        </div>
                      <?php if(trim($data['signature_boss'])=='' and intval($data['boss_cancel'])==0){?>  
                        <div class="row mb-1">
                          <a href="<?php echo 'https://social-plugins.line.me/lineit/share?url='.urlencode('https://med.nu.ac.th');?>" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fab fa-line"></i>
                            </span>
                            <span class="text">ส่งผ่าน Line</span>
                          </a>
                        </div>
                        <div class="row mb-1">
                          <a href="#" class="btn btn-info btn-icon-split" onclick="copy_url('<?php echo htmlspecialchars_decode($data['url_boss']);?>')">
                            <span class="icon text-white-50">
                              <i class="fas fa-copy"></i>
                            </span>
                            <span class="text">คัดลอก URL เพื่อส่งช่องทางอื่น</span>
                          </a>
                        </div>
                        <div class="row mb-1">
                          <a href="#" onclick="open_qr('<?php echo $data['qr_boss'];?>');" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fas fa-qrcode"></i>
                            </span>
                            <span class="text">QR CODE URL</span>
                          </a>
                        </div>
                      <?php }elseif(trim($data['signature_boss'])!=''){?>
                        <div class="row mb-1">
                          <a href="#" class="btn btn-lg btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fas fa-check"></i>
                            </span>
                            <span class="text">ผู้บังคับบัญชาลงลายเซ็นแล้ว</span>
                          </a>
                        </div>
                      <?php }elseif(intval($data['boss_cancel'])==1){?>
                        <div class="row mb-1">
                          <a href="#" class="btn btn-lg btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fas fa-times"></i>
                            </span>
                            <span class="text">ผู้บังคับบัญชาไม่อณุญาตให้ลา</span>
                          </a>
                        </div>
                      <?php }}?>
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
            a.document.write("<style>@font-face {font-family: 'th-sarabun';src: url('<?php echo base_url(load_file('assets/font/THSarabun.ttf'));?>');src: url('<?php echo base_url(load_file('assets/font/THSarabun.ttf'));?>')  format('truetype'), /* Safari, Android, iOS */}.document{position:relative;font-family:'th-sarabun';color:#555555;}.document span{position:absolute;font-size:2vw;line-height: 56px;}@media print{.document span{position:absolute;font-size:16px;line-height: 24px;}}</style>"); 
            a.document.write(divContents); 
            a.print(); 
            a.close();
        });
        
      });

  </script>

</body>

</html>
