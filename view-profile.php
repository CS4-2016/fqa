  <?php
  require_once('dbconn.php');
  require_once('header.php');
   $email=$_SESSION['login'];
   $SQL ="SELECT * FROM register where email='$email'";
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
      require_once ('main-header.php');
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
        <br>
        <!-- Page Header
        <small>Optional description</small> -->
      </h1>
   
    </section>

    <section class="content">
      <form>
        <div class="container">
          <div class="content-profile">
            <div class="row">
            <div>
            <div class="panel panel-default col-md-4 col-sm-4">
              <div class="panel">
                  <center><h2><i class="fa fa-list-alt"></i>&nbsp; &nbsp;Profile</h2></center>
                   <?php 
                           if(!empty($_SESSION['scssMsg'])) { ?>
                            <div class="alert alert-success fade in">
                            <?php echo $_SESSION['scssMsg'];?>
                            </div>
                        <?php 
                            unset($_SESSION['scssMsg']);
                        } ?>
              </div>
              <div class="panel-body">
                 
               <?php for($x=0;$x<count($users);$x++){ 
                  echo "<center><img src=\"img/".$users[$x]['image']."\" class=\"user-image img-responsive\"/></center>";
                ?>
                <div class="form-group input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <?php echo "<input class=\"form-control\" id=\"disabledInput\" type=\"text\" value=\"".$email."\" disabled />"; ?>
                </div>
                <div class="form-group input-group">
                  <span class="input-group-addon"><i class="fa fa-male"></i></span>
                    <?php 
                      $_SESSION['position']=$users[$x]['position'];
                      if($users[$x]['position']=='Dean' || $users[$x]['position']=='Chair'){
                        echo "<input class=\"form-control\" id=\"disabledInput\" type=\"text\" value=\"".$users[$x]['department']." ".$users[$x]['position']."\" disabled />";
                      }else{
                         echo "<input class=\"form-control\" id=\"disabledInput\" type=\"text\" value=\"".$users[$x]['position']."\" disabled />";
                      }

                    ?>
                </div>
                <div class="form-group input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <?php
                      echo "<input class=\"form-control\" id=\"disabledInput\" type=\"text\" value=\"".$users[$x]['fname']."\" disabled />";
                    ?>
                </div>   
                <div class="form-group input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <?php  
                      echo "<input class=\"form-control\" id=\"disabledInput\" type=\"text\" value=\"".$users[$x]['lname']."\" disabled />";
                  } ?>
                </div> 
              </div>
            </div>
          </div>
            </div>
        </div>
      </div>
        <center><a href="edit-profile.php"><input type="button" class="btn btn-primary" value="Edit Profile"></a></center> 
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
