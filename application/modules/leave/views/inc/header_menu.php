<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url(url_index().'leave');?>">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-calendar-day"></i>
  </div>
  <div class="sidebar-brand-text mx-3">ระบบลางาน</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  ระบบลา
</div>
<!-- Nav Item - Dashboard -->
<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url(url_index().'leave');?>">
      <i class="far fa-fw fa-file-alt"></i>
      <span>รายการข้อมูลการลา</span></a>

  <!-- <span test="<?php //echo '<pre>';print_r($personnel);?>"></span> -->
  <?php if(isset($personnel['email']) || trim($personnel['email'])==''){ ?>
    <a class="nav-link" href="<?php echo base_url(url_index().'leave/add');?>">
  <?php }elseif(!isset($personnel['email'])){ ?>
    <a class="nav-link" href="<?php echo base_url(url_index().'leave/add');?>">
  <?php }else{ ?>
    <a href="#" class="nav-link" data-toggle="modal" data-target="#update-email-form">
  <?php }?>
      <i class="far fa-fw fa-copy"></i>
      <span>กรอกใบลา</span>
    </a>
    <a class="nav-link" href="<?php echo base_url(url_index().'leave/list_approve');?>">
      <i class="far fa-fw fa-address-book"></i>
      <span>ใบลาที่เสนอเข้ามา</span>
    </a>
</li>

<?php /*

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  หัวหน้า
</div>


<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Components</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Custom Components:</h6>
      <a class="collapse-item" href="buttons.html">Buttons</a>
      <a class="collapse-item" href="cards.html">Cards</a>
    </div>
  </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-fw fa-wrench"></i>
    <span>Utilities</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Custom Utilities:</h6>
      <a class="collapse-item" href="utilities-color.html">Colors</a>
      <a class="collapse-item" href="utilities-border.html">Borders</a>
      <a class="collapse-item" href="utilities-animation.html">Animations</a>
      <a class="collapse-item" href="utilities-other.html">Other</a>
    </div>
  </div>
</li>
*/?>


<!-- Divider -->
<hr class="sidebar-divider">

<?php if($this->session->personnel['personnel_id'] == 1692){//sanan ?>
<!-- Heading -->
<div class="sidebar-heading">
  ฝ่ายทรัพยากรบุคคล
</div>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url(url_index().'leave/list_hr');?>">
    <i class="far fa-fw fa-list-alt"></i>
    <span>รายการข้อมูลการลา</span>
  </a>
  <a class="nav-link" href="<?php echo base_url(url_index().'leave/calendar');?>">
    <i class="far fa-fw fa-calendar-alt"></i>
    <span>การจัดการปฏิทิน</span>
  </a>
  <a class="nav-link" href="<?php echo base_url(url_index().'leave/list_email_hr');?>">
    <i class="far fa-fw fa-calendar-alt"></i>
    <span>รายการอีเมล</span>
  </a>
  <a class="nav-link" href="<?php echo base_url(url_index().'leave/list_approve_hr');?>">
    <i class="far fa-fw fa-calendar-alt"></i>
    <span>รายการพิจารณา</span>
  </a>


  <!-- <a class="nav-link" href="<?php echo base_url(url_index().'leave/special_fn');?>">
    <i class="fas fa-fw fa-cogs"></i>
    <span>การตั้งค่าผู้ใช้เฉพาะ</span>
  </a>
  <a class="nav-link" href="<?php echo base_url(url_index().'leave/report_smu_hr');?>">
    <i class="fas fa-fw fa-chart-bar"></i>
    <span>รายงานสรุปการลา</span>
  </a> -->
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  <?php } ?>

  <?php /*
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-folder"></i>
    <span>Pages</span>
  </a>
  <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Login Screens:</h6>
      <a class="collapse-item" href="login.html">Login</a>
      <a class="collapse-item" href="register.html">Register</a>
      <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
      <div class="collapse-divider"></div>
      <h6 class="collapse-header">Other Pages:</h6>
      <a class="collapse-item" href="404.html">404 Page</a>
      <a class="collapse-item active" href="blank.html">Blank Page</a>
    </div>
  </div>
  */ ?>
</li>

<?php /*
<!-- Nav Item - Charts -->
<li class="nav-item">
  <a class="nav-link" href="charts.html">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Charts</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
  <a class="nav-link" href="tables.html">
    <i class="fas fa-fw fa-table"></i>
    <span>Tables</span></a>
</li>
*/ ?>



<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->