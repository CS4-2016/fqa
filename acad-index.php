<?php
  require_once('dbconn.php');
  require_once('header.php');

 $position=$_SESSION['position'];
  if(!($position=='Dean' || $position=='Chair' || $position=='VPA')){
      header("Location:404-message.php");
  }
?>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <?php 
      require_once ('main-header.php');
?>
  <!-- Left side column. contains the logo and sidebar -->
 <?php 
      require_once ('side-bar-acad.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <br>
        <!-- Page Header
        <small>Optional description</small> -->
      </h1>
    
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <a href="view-profile.php" class="fontColor"><h4>Profile</h4></a>
              <p><br></p>
            </div>
            <div class="icon">
               <i class="ion ion-person"></i>
            </div>
            <br>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <a href="view-standards.php" class="fontColor"><h4>View Standards</h4></a>
              <p><br></p>
            </div>
            <div class="icon">
              <i class="ion-ios-upload-outline"></i>
            </div>
            <br>
          </div>
        </div>
           <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <a href="generate-report.php" class="fontColor"><h4>Generate Report</h4></a>
              <p><br></p>
            </div>
            <div class="icon">
              <i class="fa fa-bar-chart"></i>
            </div>
            <br>
          </div>
        </div>
        <!-- ./col -->
    </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
    <?php 
      require_once ('footer.php');
?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->



<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
