<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>รายละเอียดบทเรียน - IDP - med.nu.ac.th</title>


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
            <h1 class="h3 mb-0 text-gray-800">รายละเอียดบทเรียน</h1>
          </div>

          <div class="row">
            <div class="col-lg-8">
              <div class="row">
                <div class="col-lg-12">
                  <!-- DataTales Example -->
                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">รายละเอียด</h6>
                    </div>
                    <div class="card-body">
                      <div class="row mb-4">
                        <div class="col-lg-12">
                          <h4 class="m-0 font-weight-bold text-primary">[<?php echo $course['course_id']; ?>] - <?php echo $course['course_name'];?></h4>
                        </div>
                      </div>
                      <div class="row mb-2">
                        <div class="col-lg-12">
                          <h6 class="m-0 font-weight-bold text-primary">คำอธิบายรายวิชา</h6>
                          <p><?php echo $course['course_detail'];?></p>
                        </div>
                      </div>
                      <div class="row mb-2">
                        <div class="col-lg-12">
                          <h6 class="m-0 font-weight-bold text-primary mb-2">อื่นๆ</h6>
                          <?php if(isset($course) and trim($course['form_link'])!=''){ ?>

                            <a href="<?php echo $course['form_link'];?>" target="_blank" type="button" class="btn btn-info btn-icon-split mb-1">
                              <span class="icon text-white-50">
                                <i class="fab fa-google"></i>
                              </span>
                              <span class="text">แบบฟอร์มการประเมิน</span>
                            </a>

                          <?php } ?>

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
                      <h6 class="m-0 font-weight-bold text-primary">ภาพรวมการพัฒนาทักษะ</h6>
                    </div>
                    <div class="card-body">
                      <div class="row p-2">
                        <div class="col-lg-12">

                          <?php if(isset($group_tag) and count($group_tag)>0){ foreach($group_tag as $key=>$val){?>
                          <button type="button" class="btn btn-info btn-icon-split mb-1">
                            <span class="icon text-white-50">
                              ?
                            </span>
                            <span class="text"><?php echo isset($tag[$val['tag_id']])?$tag[$val['tag_id']]['tag_name']:' - '; ?></span>
                          </button>
                          <?php }} ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="row">
                <div class="col-lg-12">
                  <!-- DataTales Example -->
                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">บทเรียน</h6>
                    </div>
                    <div class="card-body">

                      <?php if(isset($course) and trim($course['course_link'])!=''){ ?>
                        <a href="<?php echo $course['course_link'];?>" target="_blank" type="button" class="btn btn-info btn-icon-split mb-1">
                          <span class="icon text-white-50">
                            <i class="fas fa-external-link-alt"></i>
                          </span>
                          <span class="text">รายละเอียดบทเรียนภายนอกระบบ</span>
                        </a>
                      <?php } ?>

                      <?php /*
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th width="50px">#</th>
                              <th>ชื่อ</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php for($i=1;$i<=12;$i++){?>
                            <tr>
                              <td><?php echo $i;?></td>
                              <td>Intro</td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                      */ ?>


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
        
      });

    });
  </script>

</body>

</html>
