<?php
  require_once('header.php');
  require_once('dbconn.php');
  $db = new db();
  $db -> Connect();

  $position=$_SESSION['position'];
  if(!($position=='HRD')){
      header("Location:404-message.php");
  }

  $SQL ="SELECT * FROM register where (position='QA'||position='Chair'||position='VPA'||position='Dean')AND value=1";
    $ret =  mysql_query($SQL);
    $users = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $users[]=$row;
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
       <h1>
          <u>Deactivate Users</u>
        
      </h1>
      </section>
    <section class="content">
     <div class="main-content">
      <table  class="table-striped table-hover table">
        <thead>
          <tr style="border-bottom: 4px solid #3c8dbc;">
          <td>First Name</td>
          <td>Last Name</td>
          <td>Email Address</td>
          <td>Action</td>
        </tr>
          </thead>
          <tbody>
        <?php
        for($x=0;$x<count($users);$x++)
          echo"
            <tr>
            
            <td>".$users[$x]['fname']."</td>
            <td>".$users[$x]['lname']."</td>
            <td>".$users[$x]['email']."</td>
            <td>
              <a href=\"deactivate-users2.php?id=".$users[$x]['id']."&email=".$users[$x]['email']."&fname=".$users[$x]['fname']."\" class=\"btn btn-danger\" Onclick=\"return ConfirmDeactivate();\"><i class=\"fa fa-ban\" aria-hidden=\"true\" ></i>&nbsp;Deactivate</a>
            </td>
            </tr>
          ";
        ?>
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
<!-- ./wrapper -->




<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
