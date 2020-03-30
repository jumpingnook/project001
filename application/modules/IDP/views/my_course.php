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
                      <div class="col-lg-4">BM068</div>
                      <div class="col-lg-2 text-md font-weight-bold">ประเภทงาน</div>
                      <div class="col-lg-4">พนักงานมหาวิทยาลัย สายสนับสนุน (เงินรายได้)</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-2 text-md font-weight-bold">ชื่อ - นามสกุล</div>
                      <div class="col-lg-4">นายสนาน ราตรีพรทิพย์</div>
                      <div class="col-lg-2 text-md font-weight-bold">ตำแหน่ง</div>
                      <div class="col-lg-4">นักวิชาการคอมพิวเตอร์?</div>
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

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Machine Leaning</div>
                      <div class="h8 mb-0 text-gray-800">รายละเอียดบทเรียน</div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x"></i>
                    </div>
                  </div>
                  <div class="row p-2">
                    <div class="col-lg-12">
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                      </div>
                    </div>
                  </div>
                  <div class="row p-2">
                    <div class="col-auto">
                      <a href="<?php echo base_url(url_index().'idp/view_course');?>" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                          <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">เข้าสู่บทเรียน</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Machine Leaning</div>
                      <div class="h8 mb-0 text-gray-800">กรณีเรียนเสร็จสิ้น</div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-check-circle  fa-2x"></i>
                    </div>
                  </div>
                  <div class="row p-2">
                    <div class="col-lg-12">
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Complete</div>
                      </div>
                    </div>
                  </div>
                  <div class="row p-2">
                    <div class="col-auto">
                      <a href="<?php echo base_url(url_index().'idp/measure');?>" class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                          <i class="fas fa-tasks"></i>
                        </span>
                        <span class="text">ประเมิน</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Machine Leaning</div>
                      <div class="h8 mb-0 text-gray-800">กรณีเรียนยังไม่จบ</div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x"></i>
                    </div>
                  </div>
                  <div class="row p-2">
                    <div class="col-lg-12">
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                      </div>
                    </div>
                  </div>
                  <div class="row p-2">
                    <div class="col-auto">
                      <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                          <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">เข้าสู่บทเรียน</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Machine Leaning</div>
                      <div class="h8 mb-0 text-gray-800">พื้นฐาน ML</div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x"></i>
                    </div>
                  </div>
                  <div class="row p-2">
                    <div class="col-lg-12">
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                      </div>
                    </div>
                  </div>
                  <div class="row p-2">
                    <div class="col-auto">
                      <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                          <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">เข้าสู่บทเรียน</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Machine Leaning</div>
                      <div class="h8 mb-0 text-gray-800">พื้นฐาน ML</div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-check-circle  fa-2x"></i>
                    </div>
                  </div>
                  <div class="row p-2">
                    <div class="col-lg-12">
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Complete</div>
                      </div>
                    </div>
                  </div>
                  <div class="row p-2">
                    <div class="col-auto">
                      <a href="#" class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                          <i class="fas fa-tasks"></i>
                        </span>
                        <span class="text">ประเมิน</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Machine Leaning</div>
                      <div class="h8 mb-0 text-gray-800">พื้นฐาน ML</div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x"></i>
                    </div>
                  </div>
                  <div class="row p-2">
                    <div class="col-lg-12">
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                      </div>
                    </div>
                  </div>
                  <div class="row p-2">
                    <div class="col-auto">
                      <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                          <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">เข้าสู่บทเรียน</span>
                      </a>
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

</body>

</html>
