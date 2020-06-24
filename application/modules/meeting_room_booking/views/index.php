<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>เข้าสู่ระบบ - med.nu.ac.th</title>

  <?php echo $this->load->view('inc/css'); ?>

  <!-- <link href="<?php echo base_url(load_file('assets/vendor/calendar/calendar.css'));?>" rel="stylesheet"> -->
  <link href="<?php echo base_url(load_file('assets/vendor/calendar/packages/core/main.min.css'));?>" rel="stylesheet">
  <link href="<?php echo base_url(load_file('assets/vendor/calendar/packages/daygrid/main.min.css'));?>" rel="stylesheet">
  <link href="<?php echo base_url(load_file('assets/vendor/calendar/packages/timegrid/main.min.css'));?>" rel="stylesheet">
  <link href="<?php echo base_url(load_file('assets/vendor/calendar/packages/interaction/main.min.css'));?>" rel="stylesheet">

  <style>
  </style>

</head>

<body class="bg-gradient-primary">

  <div class="container" style="max-width: unset;">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div id='wrap' style="padding: 5px;">
                  <div id='calendar'></div>
                  <div style='clear:both'></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php echo $this->load->view('inc/js'); ?>

  <!-- Add Booking-->
  <a href="#" id="booking-modal-click" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#booking-modal" style="display:none;"></a>
  <div class="modal fade" id="booking-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">ลงข้อมูลขอใช้ห้องประชุม</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-3">
              <div class="form-group cc_cursor">
                <label>หัวข้อการประชุม</label>
                <input class="form-control">
                <p class="help-block cc_cursor">Example block-level help text here.</p>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group cc_cursor">
                <label>ระบุหน่วยงาน</label>
                <input class="form-control">
                <p class="help-block cc_cursor">Example block-level help text here.</p>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group cc_cursor">
                <label>ชื่อผู้จอง</label>
                <input class="form-control">
                <p class="help-block cc_cursor">Example block-level help text here.</p>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group cc_cursor">
                <label>หมายเลขโทรศัพท์ติดต่อ</label>
                <input class="form-control">
                <p class="help-block cc_cursor">Example block-level help text here.</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-3">
              <div class="form-group cc_cursor">
                <label>จำนวนผู้เข้าประชุม</label>
                <input type="number" class="form-control">
                <p class="help-block cc_cursor">Example block-level help text here.</p>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>ห้องประชุม</label>
                <select class="form-control">
                  <option>เลือกห้องประชุม</option>
                  <option>404 Innovation</option>
                  <option>414 Together</option>
                  <option>416 Happiness</option>
                </select>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group cc_cursor">
                <label>วันเวลาที่เริ่มประชุม</label>
                <input type="datetime-local" class="form-control">
                <p class="help-block cc_cursor">Example block-level help text here.</p>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group cc_cursor">
                <label>วันเวลาสิ้นสุดการประชุม</label>
                <input type="datetime-local" class="form-control">
                <p class="help-block cc_cursor">Example block-level help text here.</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                  <label>แจ้งอุปกรณ์หรือสิ่งอำนวยความสะดวกเพิ่มเติม เช่น จัดเบรค โต๊ะ เก้าอี้ เป็นต้น</label>
                  <textarea class="form-control" rows="3"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button">บันทึก</button>
        </div>
      </div>
    </div>
  </div>

  <!-- View Booking-->
  <a href="#" id="view-booking-modal-click" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#view-booking-modal" style="display:none;"></a>
  <div class="modal fade" id="view-booking-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">ข้อมูลขอใช้ห้องประชุม</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <table width="100%" class="table table-bordered">
            <thead>
              <tr role="row">
                <th width="200">หัวข้อ</th>
                <th>ข้อมูล</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>หัวข้อการประชุม</td>
                <td>ประชุมคณะกรรมการนวัตกรรม</td>
              </tr>
              <tr>
                <td>ห้องประชุม</td>
                <td>404 Innovation</td>
              </tr>
              <tr>
                <td>หน่วยงาน</td>
                <td>สำนักงานเลขานุการ</td>
              </tr>
              <tr>
                <td>ชื่อผู้จอง</td>
                <td>นายสนาน ราตรีพรทิพย์</td>
              </tr>
              <tr>
                <td>หมายเลขโทรศัพท์ติดต่อ</td>
                <td>06161655650</td>
              </tr>
              <tr>
                <td>จำนวนผู้เข้าประชุม</td>
                <td>12 คน</td>
              </tr>
              <tr>
                <td>ระยะเวลา</td>
                <td>11 มิ.ย. 2563 09:00 - 11 มิ.ย. 2563 11:00</td>
              </tr>
              <tr>
                <td>อุปกรณ์หรือสิ่งอำนวยความสะดวกเพิ่มเติม</td>
                <td>เครื่องคอมพิวเตอร์</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-dismiss="modal" aria-label="Close">ยกเลิกการประชุม</button>
          <button class="btn btn-primary" type="button" data-dismiss="modal" aria-label="Close">แก้ไข</button>
          <button class="btn btn-primary" type="button" data-dismiss="modal" aria-label="Close">ปิด</button>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo base_url(url_index().'leave/get_weekend/js');?>" ></script>
  <script src="<?php echo base_url(load_file('assets/vendor/calendar/packages/core/main.min.js'));?>"></script>
  <script src="<?php echo base_url(load_file('assets/vendor/calendar/packages/daygrid/main.min.js'));?>"></script>
  <script src="<?php echo base_url(load_file('assets/vendor/calendar/packages/timegrid/main.min.js'));?>"></script>
  <script src="<?php echo base_url(load_file('assets/vendor/calendar/packages/interaction/main.min.js'));?>"></script>
  
  <script>
    $(document).ready(function(){
      // var date = new Date();
      // var d = date.getDate();
      // var m = date.getMonth();
      // var y = date.getFullYear();

      var event_date = [];
      for(var i=0;i<=10;i++){
        event_date[i] = {
          id:'c'+i,
          title: 'test',
          start: new Date(),
          end: new Date(),
          allDay: true,
          cal:123
        };
      }

      /* initialize the calendar -----------------------------------------------------------------*/
      // https://bootsnipp.com/snippets/M3jmA
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        header: {   
          left: 'title',
          right: 'prev,next today'
        },
        editable: true,
        firstDay: 0, //  1(Monday) this can be changed to 0(Sunday) for the USA system
        plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
        allDaySlot: false,
        selectHelper: true,
        events: event_date,
        handleWindowResize:true,
        aspectRatio: 1.5,
        windowResize: function(view) {},
        selectable: true,
        select: function(info) {
          $('#booking-modal-click').click();
          //alert('selected ' + info.startStr + ' to ' + info.endStr);
        },
        eventClick: function(info) {
          $('#view-booking-modal-click').click();
          //alert('click ' + info.event.title + ' to ' + info.event.start);
        }
      });

      calendar.render();
    });
  </script>

</body>

</html>
