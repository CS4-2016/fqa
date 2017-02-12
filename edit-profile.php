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

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#toggle').hide();
    $("#button").click(function(){
        $("#toggle").toggle();
    });
});
</script>

</head>
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
      <form method="POST" action="edit-profile2.php" enctype="multipart/form-data" id="register-form">
        <div class="container">
       
          <div class="row">
               <div class="content-profile">
            <div class="panel panel-default col-md-4 col-sm-4">
                
              <div class="panel">
                  <center><h2><i class="fa fa-list-alt"></i>&nbsp; &nbsp;Profile</h2></center>
              </div>
              <div class="panel-body">
                   <?php 
                           if(!empty($_SESSION['errMsg'])) { ?>
                            <div class="alert alert-danger fade in">
                            <?php echo $_SESSION['errMsg'];?>
                            </div>
                        <?php 
                            unset($_SESSION['errMsg']);
                        } ?>
                  <?php 
                           if(!empty($_SESSION['scssMsg'])) { ?>
                            <div class="alert alert-success fade in">
                            <?php echo $_SESSION['scssMsg'];?>
                            </div>
                        <?php 
                            unset($_SESSION['scssMsg']);
                        } ?>
                    
               <?php for($x=0;$x<count($users);$x++){ 
 
    echo "<center><img src=\"img/".$users[$x]['image']."\" class=\"user-image img-responsive\"/></center>
                  <center>
                  
                
                     
                 
                        
                              <input type=\"file\" name=\"imgUpload\" value=\"img/".$users[$x]['image']."\" accept=\"image/*\" >
                          
                           
                  
                  
                  </center><br>";
                ?>
                <div class="form-group">
                    <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <?php echo "<input class=\"form-control\" id=\"disabledInput\" name=\"textEmail\" type=\"email\" value=\"".$email."\" required/>"; 
                        echo "<input type='hidden' value='".$users[$x]['email']." name='hiddenEmail'>";
                  ?>
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
                <div class="form-group input-group">
                  <span class="input-group-addon"><i class="fa fa-male"></i></span>
                    <?php 
                      echo "<input class=\"form-control\" id=\"disabledInput\" type=\"text\" value=\"".$users[$x]['position']."\" disabled />
                      ";
                    ?>
                </div>
                <div class="form-group">
                    <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <?php
                      echo "<input class=\"form-control\" id=\"disabledInput\" name=\"textFname\" type=\"text\" value=\"".$users[$x]['fname']."\" required/>
                      <input type='hidden' value='".$users[$x]['password']."' name='hiddenId'> ";
                                                  
                    ?>
                    </div>
                    <span class="help-block" id="error"></span>
                </div>   
                <div class="form-group">
                    <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <?php  
                      echo "<input class=\"form-control\" id=\"disabledInput\" name=\"textLname\" type=\"text\" value=\"".$users[$x]['lname']."\" required/>";
                  } 
                  ?>
                    </div>
                    <span class="help-block" id="error"></span>
                </div> 
                <center><input type="button" id="button" class="btn btn-primary" value="Change password"><br><br></center>
                
                  
                  <div id="toggle">
                 
                  <div class="form-group">            
                      <div class="input-group ">
                          
                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        
                      <input type="password" id="password" class="showpassword form-control" name="password" placeholder="Type New Password">  
                             
                      </div>
                    <span class="help-block" id="error"></span>                    
                  </div> 
                  <div class="form-group">
                      <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                    <input name="cpassword" type="password" class="form-control" placeholder="Retype Password">
                      </div>
                       <span class="help-block" id="error"></span> 
                  </div> 
                </div>
                  <br> <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      <input type="password"  class="form-control" name="oldPassword" placeholder="Type Password to Confirm">
                          
                      </div>
                      <span class="help-block" id="error"></span>
                  </div> 
                <center><input type="submit" class="btn btn-primary" name="submit" value="Save" Onclick="return confirm('Do you want to save the data')">
                    <a href="view-profile.php"> <input type="button" class="btn btn-danger" value="Cancel"></a>
              </center> 
              </div>
            </div>
          </div>
        </div>
        </div>
      </form>
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
<script src="js/confirm-pass.js"></script>
 <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/edit-profile.js"></script>  

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
