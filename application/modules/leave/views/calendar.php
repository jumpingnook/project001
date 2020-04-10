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

  <link href="<?php echo base_url(load_file('assets/vendor/calendar/calendar.css'));?>" rel="stylesheet">

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
            <h1 class="h3 mb-0 text-gray-800">จัดการปฏทิน</h1>
          </div>

          <div class="row">
            <div class="col-lg-12">

              <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  
                  <div class="row">
                    <div class="col-lg-12">
                      <h6 class="m-0 font-weight-bold text-primary">ปฏทิน</h6>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row" >
                    <div class="col-lg-12">
                      <div id='wrap'>
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

  <script src="<?php echo base_url(url_index().'leave/get_weekend/js');?>" ></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(load_file('assets/vendor/calendar/calendar.js'));?>"></script>

  <script>
    $(document).ready(function() {
      var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();

      var new_date = 1;

      var event_date = [];
      var i=0;
      $.each(date_fix,function(key,val){
        event_date[i] = {
          id:'c'+i,
          title: val['name'],
          start: new Date(val['cal_id']),
          end: new Date(val['cal_id']),
          allDay: true,
          cal:val['cal_id']
        };
        i++;
      });
    
      /* initialize the calendar -----------------------------------------------------------------*/
      // https://bootsnipp.com/snippets/M3jmA
      var calendar =  $('#calendar').fullCalendar({
        header: {
          left: 'title',
          right: 'prev,next today'
        },
        editable: true,
        firstDay: 0, //  1(Monday) this can be changed to 0(Sunday) for the USA system
        selectable: true,
        defaultView: 'month',
        
        axisFormat: 'h:mm',
        columnFormat: {
                  month: 'ddd',    // Mon
                  week: 'ddd d', // Mon 7
                  day: 'dddd M/d',  // Monday 9/7
                  agendaDay: 'dddd d'
              },
              titleFormat: {
                  month: 'MMMM yyyy', // September 2009
                  week: "MMMM yyyy", // September 2009
                  day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
              },
        allDaySlot: false,
        selectHelper: true,
        select: function(start, end, allDay) {
          var title = prompt('กรอกชื่อวันเพื่อบันทึก:');

          if (title) {

            var date_start = new Date(end);
            var get_date = date_start.toISOString().substring(0, 10);

            var data = {
              date:get_date,
              name:title,
              'APP-KEY':'<?php echo $APP_KEY;?>',
              token:'<?php echo $token;?>',
              ip:'<?php echo $ip;?>',
              plus:1
            };

            $.ajax({
              type: "POST",
              data:data,
              url: "<?php echo base_url(url_index().'leave/api_v1/add_date'); ?>",
              dataType: "json",
              success: function(data){
                if(data.status){
                  alert('บันทึกเรียบร้อยแล้ว');
                  calendar.fullCalendar('renderEvent',
                    {
                      id:'c'+new_date,
                      title: title,
                      start: start,
                      end: end,
                      allDay: allDay,
                      cal:'new'+new_date
                    },
                    true // make the event "stick"
                  );
                }else{
                  alert('ไม่สามารถบันทึกได้!');
                }
              }
            });

            new_date++;
          }

          calendar.fullCalendar('unselect');
        },
        events: event_date,
        eventClick: function(info) {
          var ans = confirm('ต้องการลบวัน "'+info.title+'" ใช่หรือไม่');

          if(ans){
            var data = {
              cal:info.cal,
              'APP-KEY':'<?php echo $APP_KEY;?>',
              token:'<?php echo $token;?>',
              ip:'<?php echo $ip;?>'
            };

            $.ajax({
              type: "POST",
              data:data,
              url: "<?php echo base_url(url_index().'leave/api_v1/del_date'); ?>",
              dataType: "json",
              success: function(data){
                if(data.status){
                  alert('ระบบได้ทำการลบข้อมูลเรียบร้อยแล้ว');

                  console.log(info.id);
                  calendar.fullCalendar('removeEvents',info.id);
                }else{
                  alert('ไม่สามารถลบข้อมูลได้!');
                }
              }
            });
          }



          


        },
        handleWindowResize:true
      });
      
      
    });

  </script>

</body>

</html>
