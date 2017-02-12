<?php
  require_once('header.php');
  require_once('dbconn.php');
  $db = new db();
  $db -> Connect();

  $position=$_SESSION['position'];
  if(!($position=='HRD')){
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
    require_once("main-header.php");
  ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php 
$position=$_SESSION['position'];
if($position=='Dean'||$position=='Chair' || $position=='VPA'){
  require_once('side-bar-acad.php');
}
else if($position=='QA'){
  require_once('side-bar-qa.php');               
}
else if($position=='HRD'){
  require_once('side-bar-hrd.php');             
}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="main-content">
      <table  class="table-striped table-hover table">
        <thead>
          <tr style="border-bottom: 4px solid #3c8dbc;">
            <td><h4><strong>Manage Users</strong></h4></td>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td><a href="approve-users.php">Approve Users</a></td>
          </tr>
          <tr>
            <td><a href="deactivate-users.php">Deactivate Users</td>
          </tr>
          <tr>
            <td><a href="restore-users.php">Restore Users</td>
          </tr>
          </tbody>
    </table>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php
    require_once("footer.php");
  ?>
</div>
</body>
</html>
