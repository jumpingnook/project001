<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
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
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>รายการข้อมูลการลา</span></a>
  <?php if(isset($personnel['signature']) and trim($personnel['signature'])==''){ ?>
    <a href="#" class="nav-link" data-toggle="modal" data-target="#signature">
  <?php }else{ ?>
    <a class="nav-link" href="<?php echo base_url(url_index().'leave/add');?>">
  <?php } ?>
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>แบบฟอร์มข้อมูลการลา</span></a>
  <a class="nav-link" href="<?php echo base_url(url_index().'leave/list_approve');?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>รายการที่ต้องพิจารณา</span>
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

<!-- Heading -->
<div class="sidebar-heading">
  ฝ่ายทรัพยากรบุคคล
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url(url_index().'leave/list_hr');?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>รายการข้อมูลการลา</span>
  </a>
  <a class="nav-link" href="<?php echo base_url(url_index().'leave/calendar');?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>จัดการปฏิทิน</span>
  </a>
  <a class="nav-link" href="<?php echo base_url(url_index().'leave/report_smu_hr');?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>รายงานสรุปการลา</span>
  </a>

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

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->