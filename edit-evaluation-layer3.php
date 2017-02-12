<?php
  require_once("header.php");
  require_once("dbconn.php");

  $position=$_SESSION['position'];
  if(!($position=='QA')){
      header("Location:404-message.php");
  }

  $id=$_GET['id'];
  $cell=$_GET['ename'];
  $table=$_GET['column'];
  $dbtable=$_GET['dbtable'];
  $SQL ="SELECT * FROM $dbtable  WHERE layer='l3' AND tname='$table'";
  $ret =  mysql_query($SQL);
  $s=$_GET['standards'];
  $ex=$_GET['exhibits'];
  $eval = array();

  if ($ret){
     while ($row = mysql_fetch_assoc($ret))
       $eval[]=$row;
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
               <u>Edit Sub-sections</u>
      </h1>
      
  </section>
    <div class="exhibit-content">
      
            
  <div id="wrapper">
        <form method="POST" action="edit-evaluation-layer3-2.php" id="form">
        <?php 
                           if(!empty($_SESSION['errMsg'])) { ?>
                            <div class="alert alert-danger fade in">
                            <?php echo $_SESSION['errMsg'];?>
                            </div>
                        <?php 
                            unset($_SESSION['errMsg']);
                        } ?>
          <div class="main-content">
            <?php
              echo "<h4><strong>$table</strong></h4>";
            ?>

            <table  class="table-striped table-hover table">
              <thead>
              <tr style="background-color:#DDDDDD;  border-bottom: 4px solid #3c8dbc;">
                <th>Sub-sections</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tr>
              <?php
                for($i=0; $i<count($eval); $i++){
                  if($eval[$i]['ename']==$cell){
                    echo "<td><input type='text' class='form-control' name='textTable' value='".$eval[$i]['ename']."' /></td>";
                      echo "<td><input type='submit' class='btn btn-primary' value='Save'  Onclick=\"return confirm('Do you want to save the data')\"/> 
                            <a href='l2_".$table.".php?ename=".$table."&standards=".$s."&exhibits=".$ex."'><input type='button' class='btn btn-danger' value='Cancel' /></a></td>
                </tr>";

                  }
                  else
                  {
                    echo "<tr><td>".$eval[$i]['ename']."</td>
                        <td></td>
                      </tr>";

                  }
                }
                echo "
                  <input type=\"hidden\" name=\"hiddenCell\" value='".$cell."'>
                  <input type=\"hidden\" name=\"hiddenTable\" value='".$table."'>
                  <input type=\"hidden\" name=\"hiddenDbtable\" value='".$dbtable."'>
                  <input type=\"hidden\" name=\"hiddenId\" value='".$id."'>
                ";
              echo "<input type=\"hidden\" value=\"".$s."\" name=\"hiddenStandards\">
              <input type=\"hidden\" value=\"".$ex."\" name=\"hiddenExhibits\">";
              ?>
          </table>
      </div>
    </form>
  </div>

        
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
 <?php
    require_once("footer.php");
  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebars background. This div must be placed
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