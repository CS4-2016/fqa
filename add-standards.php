<?php
  require_once('header.php');
  require_once('dbconn.php');
    $SQL ="SELECT * FROM standards";
    $ret =  mysql_query($SQL);
    $standards = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $standards[]=$row;
    }

    $position=$_SESSION['position'];
    if(!($position=='QA')){
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
 <link rel="stylesheet" href="css/contents.css">
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
          <u>Add Standard</u>
        
      </h1>
      </section>
    <section class="stand-contents">
  
     
        <form method="POST" action="add-standards2.php">
          <div class="main-content">
               <?php 
                           if(!empty($_SESSION['errMsg'])) { ?>
                            <div class="alert alert-danger fade in">
                            <?php echo $_SESSION['errMsg'];?>
                            </div>
                        <?php 
                            unset($_SESSION['errMsg']);
                        } ?>
 
              <table class="table-striped table-hover table">
              <thead>
            <tr style="background-color:#DDDDDD">
                <th>Standards</th>
              </tr>
                </thead>
              <?php
              for($x=0;$x<count($standards);$x++){
                echo"
                  <tr> 
                    <td>".$standards[$x]['standards']."</td>
                </tr>
                ";
              }?>
             
            </table>
         <br><input type="text" name="textStandards" placeholder="Standards"  class="text-exhibit form-control" required>     
              
          <div class="exhibit-button">
            <br><a href="add-standards2.php"><input type="submit" class="btn btn-primary" value="Add Standard"></a>
          </div>
        </div>
      </form>
  </section>

    <div class="exhibit-content">
      <div class="container-fluid">
      	<div div="row">
      		<div class="col-md-6">

      		</div>

      	</div>
      </div>
    </div>
  
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php
    require_once('footer.php');
  ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->



<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
