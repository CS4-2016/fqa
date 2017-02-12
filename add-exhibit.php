<?php
  require_once('header.php');
  require_once('dbconn.php');
   $standards=$_GET['standards'];
    $SQL ="SELECT * FROM exhibit WHERE standards='$standards'";
    $ret =  mysql_query($SQL);
    $exhibit = array();
    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $exhibit[]=$row;
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
          <u>Add Category</u>
        
      </h1>
      </section>
    <section class="content">
      
     
        <form method="POST" action="add-exhibit2.php">
          <div class="main-content">
               <?php 
                echo "<input type='hidden' name='hiddenStandards' value='".$standards."'>";
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
                <th>Categories</th>
              </tr>
                </thead>
              <?php
              for($x=0;$x<count($exhibit);$x++){
                echo"
                  <tr> 
                    <td>".$exhibit[$x]['exhibits']."</td>
                </tr>
                ";
              }?>
             
            </table>
         <br><input type="text" name="textExhibit" placeholder="Category"  class="text-exhibit form-control" pattern="[a-zA-Z0-9\s]+" title="Special Character are not Allowed" required>     
              
          <div class="exhibit-button">
            <br><a href="add-exhibit2.php"><input type="submit" class="btn btn-primary" value="Add Category"></a>
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
