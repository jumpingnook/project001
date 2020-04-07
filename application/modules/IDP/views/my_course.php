<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>บทเรียนของฉัน - med.nu.ac.th</title>

  <?php echo $this->load->view('inc/css'); ?>

  <style>
    .btn-eva{
      display:none;
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
            <h1 class="h3 mb-0 text-gray-800">บทเรียนของฉัน</h1>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">ข้อมูลบุคลากร</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-2 text-md font-weight-bold">รหัสพนักงาน</div>
                      <div class="col-lg-4"><?php echo isset($personnel['personnel_code'])?$personnel['personnel_code']:'-';?></div>
                      <div class="col-lg-2 text-md font-weight-bold">ประเภทงาน</div>
                      <div class="col-lg-4"><?php echo isset($personnel['emp_type_name'])?$personnel['emp_type_name']:'-';?></div>
                    </div>
                    <div class="row">
                      <div class="col-lg-2 text-md font-weight-bold">ชื่อ - นามสกุล</div>
                      <div class="col-lg-4">
                        <?php 
                          echo isset($personnel['title'])?$personnel['title']:'-'; 
                          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                        ?>
                      </div>
                      <div class="col-lg-2 text-md font-weight-bold">ตำแหน่ง</div>
                      <div class="col-lg-4"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php /* ?>
          <div class="row">
            <div class="col-lg-12">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">สรุปผล</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="collapseCardExample2">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-8">
                        <!-- Bar Chart -->
                        <div class="card shadow mb-4">
                          <div class="card-body">
                            <div class="chart-bar">
                              <canvas id="myBarChart"></canvas>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <!-- Donut Chart -->
                        <div class="card shadow mb-4">
                          <div class="card-body">
                            <div class="chart-bar pt-4">
                              <canvas id="myPieChart"></canvas>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php */ ?>

          <div class="row">
          <?php
            $i = 0;
            if(isset($primary_course) and count($primary_course)>0){
              foreach($primary_course as $key=>$val){
          ?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="course_box col-xl-4 col-md-6 mb-4" sheet_token="<?php echo $val['sheet_token'] ?>">
              <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1"><?php echo $val['course_name']; ?></div>
                      <div class="h8 mb-0 text-gray-800"><?php echo $val['course_detail']; ?></div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x"></i>
                    </div>
                  </div>
                  <div class="row p-2">
                    <!-- <div class="col-lg-12">
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                      </div>
                    </div> -->
                  </div>
                  <div class="row p-2">
                    <div class="col-auto">
                      <a href="<?php echo $val['course_link']; ?>" target="_blank" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                          <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">เข้าสู่บทเรียน</span>
                      </a>
                      <a href="<?php echo $val['form_link']; ?>" target="_blank" class="btn-eva btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                          <i class="fas fa-tasks"></i>
                        </span>
                        <span class="text">ประเมินหลังเรียน</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          <?php
                $i++;
                if($i==2){
                  echo '</div><div class="row">';
                  $i = 0;
                }
              }
            }
          ?>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!--Add buttons to initiate auth sequence and sign out-->
        <button id="authorize_button" style="display: none;">Authorize</button>
        <button id="signout_button" style="display: none;">Sign Out</button>

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

  <script>
    $(document).ready(function(){


      /* bar chart*/
      // Set new default font family and font color to mimic Bootstrap's default styling
      Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
      Chart.defaults.global.defaultFontColor = '#858796';

      function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
          prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
          sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
          dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
          s = '',
          toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
          };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
          s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
          s[1] = s[1] || '';
          s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
      }

      // Bar Chart Example
      var ctx = document.getElementById("myBarChart");
      var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["January", "February", "March", "April", "May", "June"],
          datasets: [{
            label: "Revenue",
            hoverBackgroundColor: "#2e59d9",
            data: [4215, 5312, 6251, 7841, 9821, 14984],
            backgroundColor: [
              '#5E7CC2',
              '#00A0DE',
              '#00C1D9',
              '#00DBB9',
              '#91EF8D',
              '#F9F871'
            ],
            borderColor: [
              '#5E7CC2',
              '#00A0DE',
              '#00C1D9',
              '#00DBB9',
              '#91EF8D',
              '#F9F871'
            ]
          }]
        },
        
        options: {
          maintainAspectRatio: false,
          layout: {
            padding: {
              left: 10,
              right: 25,
              top: 25,
              bottom: 0
            }
          },
          scales: {
            xAxes: [{
              time: {
                unit: 'month'
              },
              gridLines: {
                display: false,
                drawBorder: false
              },
              ticks: {
                maxTicksLimit: 6
              },
              maxBarThickness: 25,
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 15000,
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                  return '$' + number_format(value);
                }
              },
              gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
              }
            }],
          },
          legend: {
            display: false
          },
          tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
              label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
              }
            }
          },
        }
      });
      /* bar chart*/

      /* donut chart*/
      // Set new default font family and font color to mimic Bootstrap's default styling
      Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
      Chart.defaults.global.defaultFontColor = '#858796';

      // Pie Chart Example
      var ctx = document.getElementById("myPieChart");
      var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ["January", "February", "March", "April", "May", "June"],
          datasets: [{
            data: [50, 25, 10, 5, 5, 5],
            backgroundColor: [
              '#5E7CC2',
              '#00A0DE',
              '#00C1D9',
              '#00DBB9',
              '#91EF8D',
              '#F9F871'
            ],
            hoverBackgroundColor: [
              '#5E7CC2',
              '#00A0DE',
              '#00C1D9',
              '#00DBB9',
              '#91EF8D',
              '#F9F871'
            ],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
          }],
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
          },
          legend: {
            display: true
          },
          cutoutPercentage: 80,
        },
      });
      /* donut chart*/

    });
  </script>



  <script type="text/javascript">
    // Client ID and API key from the Developer Console
    var CLIENT_ID = '1057073406216-qudn29k74ddf47rn38msb2f35n5mbidg.apps.googleusercontent.com';
    var API_KEY = 'AIzaSyDnQBD9bsOTkkWif23z3KI-9xPM9KZN9Wc';

    // Array of API discovery doc URLs for APIs used by the quickstart
    var DISCOVERY_DOCS = ["https://sheets.googleapis.com/$discovery/rest?version=v4"];

    // Authorization scopes required by the API; multiple scopes can be
    // included, separated by spaces.
    var SCOPES = "https://www.googleapis.com/auth/spreadsheets.readonly";

    var authorizeButton = document.getElementById('authorize_button');
    var signoutButton = document.getElementById('signout_button');

    /**
      *  On load, called to load the auth2 library and API client library.
      */
    function handleClientLoad() {
      gapi.load('client:auth2', initClient);
    }

    /**
      *  Initializes the API client library and sets up sign-in state
      *  listeners.
      */
    function initClient() {
      gapi.client.init({
        apiKey: API_KEY,
        clientId: CLIENT_ID,
        discoveryDocs: DISCOVERY_DOCS,
        scope: SCOPES
      }).then(function () {
        // Listen for sign-in state changes.
        gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

        // Handle the initial sign-in state.
        updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
        // authorizeButton.onclick = handleAuthClick;
        // signoutButton.onclick = handleSignoutClick;
      }, function(error) {
        appendPre(JSON.stringify(error, null, 2));
      });
    }

    /**
      *  Called when the signed in status changes, to update the UI
      *  appropriately. After a sign-in, the API is called.
      */
    function updateSigninStatus(isSignedIn) {
      if (isSignedIn) {
        // authorizeButton.style.display = 'none';
        // signoutButton.style.display = 'block';
        course_check();
      } else {
        gapi.auth2.getAuthInstance().signIn();
      }
    }

    /**
      *  Sign in the user upon button click.
      */
    function handleAuthClick(event) {
      gapi.auth2.getAuthInstance().signIn();
    }

    /**
      *  Sign out the user upon button click.
      */
    function handleSignoutClick(event) {
      gapi.auth2.getAuthInstance().signOut();
    }

    function course_check() {

      var course = $('.course_box');
      if(('.course_box').length > 0){
        $.each(course,function(key,val){
          var sheet = $(this).attr('sheet_token');

          if(sheet!=''){
            gapi.client.sheets.spreadsheets.values.get({
              spreadsheetId: sheet,
              range:'B2:C',
              majorDimension:'COLUMNS'
            }).then(function(response) {
              var range = response.result;
              //console.log(range);
              if (range.values.length > 0) {
                $.each(range.values[0],function(key2,val2){
                  if(val2 == '<?php echo $personnel['username']?>@nu.ac.th'){
                    return false;
                  }
                  $('.course_box').find('.btn-eva').css('display','inline-block');
                });                
              }
            }, function(response) {
              console.log(response.result.error.message);
            });
          }
        });
      }

      return false;
    }

  </script>

  <script async defer src="https://apis.google.com/js/api.js"
    onload="this.onload=function(){};handleClientLoad()"
    onreadystatechange="if (this.readyState === 'complete') this.onload()">
  </script>

</body>

</html>
