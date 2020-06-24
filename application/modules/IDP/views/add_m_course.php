<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>เพิ่มบทเรียน - IDP - med.nu.ac.th</title>

  <?php echo $this->load->view('inc/css'); ?>

  <link href="<?php echo base_url(load_file('assets/js/quill/quill.snow.css'));?>" rel="stylesheet">
  <link href="<?php echo base_url(load_file('assets/js/lou-multi-select/css/multi-select.css'));?>" media="screen" rel="stylesheet" type="text/css">

  <style>
    .ql-container {
      height: 500px;
      color:#555;
    }
    ._search-input{
      width: 167px;
      margin-top: 5px;
      margin-bottom: 5px;
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
            <h1 class="h3 mb-0 text-gray-800">แบบฟอร์มเพิ่มข้อมูลข้อมูลบทเรียน</h1>
          </div>

          <div class="row">
            <div class="col-lg-12">

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
                        <select id="type_course" class="form-control">
                          <option value="1">บทเรียนแบบภายนอก</option>
                          <!-- <option value="2">ลาพักผ่อน</option> -->
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><?php echo isset($method) && $method=='add'?'เพิ่มบทเรียน':'แก้ไขบทเรียน';?> <span class="course-text"></span></h1>
                  </div>

                  <form class="form" action="<?php echo base_url(url_index().'idp/save_course');?>" method="post">
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>ชื่อบทเรียน <span class="text-primary">*</span></label>
                        <input type="text" class="form-control" placeholder="ระบุชื่อบทเรียน" name="course_name" value="<?php echo isset($course['course_name'])?htmlspecialchars_decode($course['course_name']):'';?>" required="required">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>รายละเอียดบทเรียน</label>
                        <div id="text_editor"></div>
                        <div></div>
                        <input id="course_detail" type="hidden" name="course_detail" value="<?php echo isset($course['course_detail'])?htmlspecialchars_decode($course['course_detail']):'';?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>URL บทเรียนภายนอก <a href="https://thaimooc.org/" target="_blank">Link</a><span class="text-primary">*</span></label>
                        <input type="text" class="form-control" placeholder="ระบุ URL บทเรียนภายนอก เช่น Thaimooc " name="course_link" value="<?php echo isset($course['course_link'])?htmlspecialchars_decode($course['course_link']):'';?>" required="required">
                      </div>
                    </div>
                    <!-- <div class="form-group row">
                      <div class="col-sm-12">
                        <label>URL แบบประเมินหลังเรียน <a href="https://docs.google.com/forms/" target="_blank">Link</a></label>
                        <input type="text" class="form-control" placeholder="ระบุ URL แบบประเมินหลังเรียน"  name="form_link" value="<?php //echo isset($course['form_link'])?htmlspecialchars_decode($course['form_link']):'';?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>URL Google Sheet <a href="https://docs.google.com/spreadsheets" target="_blank">Link</a></label>
                        <input type="text" class="form-control" placeholder="ระบุ URL Google Sheet" name="sheet_token" value="<?php //echo isset($course['sheet_token'])?'https://docs.google.com/spreadsheets/d/'.htmlspecialchars_decode($course['sheet_token']).'/edit':'';?>">
                      </div>
                    </div> -->

                    <!-- <hr>
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label>เลือกหมวดหมู่</label>
                        <div class="form-group">
                          <select id="tag" name="[]" multiple="multiple" class="form-control">
                            <option value="1">Primary</option>
                            <option value="2">IT</option>
                          </select>
                        </div>
                      </div>
                    </div> -->

                    <hr>
                    <button type="submit" class="btn btn-primary btn-user btn-block">บันทึก</button>
                    <input type="hidden" name="course_type" value="1">
                    <input type="hidden" name="method" value="<?php echo (isset($method) && trim($method)!=''?$method:'');?>">
                    <input type="hidden" name="token" value="<?php echo isset($token)?$token:'';?>">
                        <?php if(isset($course['course_id'])){ ?>
                          <input type="hidden" name="course" value="<?php echo $course['course_id'];?>">
                        <?php } ?>

                  </form>

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

  <script src="<?php echo base_url(load_file('assets/js/quill/quill.js'));?>" type="text/javascript"></script>
  <script src="<?php echo base_url(load_file('assets/js/lou-multi-select/js/jquery.multi-select.js'));?>" type="text/javascript"></script>
  <script src="<?php echo base_url(load_file('assets/js/quicksearch/jquery.quicksearch.js'));?>" type="text/javascript"></script>

  <script>

    var toolbarOptions = [
      [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
      //[{ 'header': [1, 2, 3, 4, 5, 6, false] }],
      ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
      [{ 'color': [] }],          // dropdown with defaults from theme
      //['blockquote', 'code-block'],
      //[{ 'header': 1 }, { 'header': 2 }],               // custom button values
      //[{ 'list': 'ordered'}, { 'list': 'bullet' }],
      //[{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
      //[{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
      //[{ 'direction': 'rtl' }],                         // text direction
      //[{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
      //[{ 'font': [] }],
      //[{ 'align': [] }],
      [{ 'image': 'showImageUI' }],
      ['clean']                                         // remove formatting button
    ];
    var quill = new Quill('#text_editor', {
      modules: {
        toolbar: toolbarOptions
      },
      placeholder: 'ระบุรายละเอียดบทเรียน',
      theme: 'snow'
    });
    
    quill.on('text-change', get_html);

    function get_html() {
      var contents = quill.root.innerHTML;
      $('#course_detail').val(contents);
    }
    set_html();
    function set_html(){
      quill.root.innerHTML = $('#course_detail').val();
    }

    $('#tag').multiSelect({
      keepOrder: true,
      selectableHeader: "<span>หมวดหมู่ทั้งหมด</span><br/><input type='text' class='_search-input' autocomplete='off' placeholder='พิมพ์เพื่อค้นหา'>",
      selectionHeader: "<span>หมวดหมู่ที่เลือก</span><br/><input type='text' class='_search-input' autocomplete='off' placeholder='พิมพ์เพื่อค้นหา'>",
      afterInit: function(ms){
        var that = this,
          $selectableSearch = that.$selectableUl.prev(),
          $selectionSearch = that.$selectionUl.prev(),
          selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
          selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
        .on('keydown', function(e){
          if (e.which === 40){
            that.$selectableUl.focus();
            return false;
          }
        });
        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
        .on('keydown', function(e){
          if (e.which == 40){
            that.$selectionUl.focus();
            return false;
          }
        });
      },
      afterSelect: function(){
        this.qs1.cache();
        this.qs2.cache();
      },
      afterDeselect: function(){
        this.qs1.cache();
        this.qs2.cache();
      }
    });

  </script>

</body>

</html>
