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

  <style>
    .bg-login-image {
      background: url(<?php echo base_url(load_file('assets/img/logo.med.png'));?>);
      background-position: center;
      background-repeat: no-repeat;
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
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 font-weight-bold mb-4">&nbsp;</h1>
                  </div>
                  <div class="text-center">
                    <h6 class="h3 text-gray-900 font-weight-bold mb-4">เข้าสู่ระบบ</h6>
                  </div>
                  <form class="user" action="<?php echo base_url(url_index().'auth/login');?>" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="exampleInputEmail" name="username" aria-describedby="emailHelp" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">เข้าสู่ระบบ</button>
                    <input type="hidden" name="token" value="<?php echo isset($token_login)?$token_login:'';?>"/>
                    <input type="hidden" id="dest" name="dest" value=""/>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <?php echo $this->load->view('inc/js'); ?>

  <script>
    $(document).ready(function(){

      var dest = getUrlParam('dest','idp/my_course/');

      if(dest!=''){
        $('#dest').val(dest);
      }

      function getUrlParam(parameter, defaultvalue){
        var urlparameter = defaultvalue;
        if(window.location.href.indexOf(parameter) > -1){
            urlparameter = getUrlVars()[parameter];
            }
        return urlparameter;
      }
      function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
      }


    });
  </script>

</body>

</html>
