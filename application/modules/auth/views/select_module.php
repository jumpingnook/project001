<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>เลือกระบบ - med.nu.ac.th</title>

  <?php echo $this->load->view('inc/css'); ?>

  <style>
    .box_module{
      display:block;
      width: 100px;
      height: 100px;
      background-color: #d2d2d2;
      border-radius: 5px;
      color: #fff !important;
      text-align: center;
      font-size: 18px;
      font-weight: bold;
    }
  </style>

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-2 p-4">เลือกระบบ</h1>
                </div>
              </div>
            </div>

            <div class="row p-5">
              <div class="col-lg-2 mb-5">
                <a href="<?php echo base_url(url_index().'leave/');?>" class="box_module">Leave</a>
              </div>
              <div class="col-lg-2 mb-5">
                <a href="<?php echo base_url(url_index().'idp/');?>" class="box_module">IDP</a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <?php echo $this->load->view('inc/js'); ?>

</body>

</html>
