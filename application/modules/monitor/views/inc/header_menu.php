<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-desktop"></i>
  </div>
  <div class="sidebar-brand-text mx-3">Monitor</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  List Report Monitor
</div>
<!-- Nav Item - Dashboard -->
<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url(url_index().'monitor/login');?>">
    <i class="fas fa-fw fa-tachometer-alt"></i><span>Login</span></a>
</li>

<?php /* ?>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  การจัดการ
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url(url_index().'idp/request_course/');?>">
    <i class="fas fa-fw fa-tachometer-alt"></i><span>คำร้องขอศึกษาบทเรียน</span>
  </a>
  <a class="nav-link" href="<?php echo base_url(url_index().'idp/list_personnel/');?>">
    <i class="fas fa-fw fa-tachometer-alt"></i><span>รายชื่อผู้ปฏิบัติงานในสังกัด</span>
  </a>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-fw fa-wrench"></i>
    <span>รายงาน</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?php echo base_url(url_index().'idp/report/');?>">รายงาน 1</a>
      <a class="collapse-item" href="<?php echo base_url(url_index().'idp/report/');?>">รายงาน 2</a>
    </div>
  </div>
</li>
<?php */ ?>

<?php if(isset($_GET['admin']) and $_GET['admin']){?>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  การจัดการเฉพาะเจ้าหน้าที่
</div>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url(url_index().'idp/manage_course/?admin=1');?>">
    <i class="fas fa-fw fa-tachometer-alt"></i><span>จัดการบทเรียน</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url(url_index().'idp/report/?admin=1');?>">
    <i class="fas fa-fw fa-tachometer-alt"></i><span>รายงาน</span>
  </a>
</li>

<?php } ?>



<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->