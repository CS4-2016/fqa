<?php
//  session_start();
  require_once("header.php");
  require_once("dbconn.php");
  $column=$_GET['editeval'];
  $dbtable=$_SESSION['dbtable'];
  $exhibits=$_GET['exhibits'];
  $stand=$_GET['stand'];     

  $SQL ="SELECT * FROM $dbtable  WHERE tname='$exhibits'";
  $ret =  mysql_query($SQL);
  
  $eval = array();

  if ($ret){
     while ($row = mysql_fetch_assoc($ret))
       $eval[]=$row;
    }
    function hasFile($ev, $t)
    {
        
        $query="SELECT l3_evaluation FROM _documents3_ WHERE from_which_l2_eval='".$t."' AND l3_evaluation='$ev' ORDER BY l3_evaluation DESC LIMIT 1;";
        
        $ret =  mysql_query($query);

        $checkEval = array();
        if ($ret)
        {
            $row = mysql_fetch_assoc($ret);
            return $row['l3_evaluation'];           
        }
        else
        {
            echo mysql_error();
            return false;
        }
        
    }
    $_GET['exhibits'];
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
    require_once("side-bar-qa.php");
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
    <div class="exhibit-content">
     
            
  <div id="wrapper">
        <form method="POST" enctype="multipart/form-data" action="uploadfilechange3.php" id="form">
          <div class="main-content">
            <?php
              echo "<h4><strong>$column</strong></h4>";
              echo "<input type=\"hidden\" name=\"hiddenColumn\" value=\"".$_GET['editeval']."\">";
              echo "<input type=\"hidden\" name=\"hiddenExhi\" value=\"".$_GET['exhibits']."\">";
            ?>

            <table style="width:100%" class="table-striped table-hover table">
             <thead>
                <tr style="background-color:#DDDDDD; border-bottom: 4px solid #3c8dbc;">
                <th>Exhibits</th>
                <th>Actions</th>
              </tr>
               
                </thead>
              <?php
              for($x=0;$x<count($eval);$x++){
               if($eval[$x]["ename"]==$column)
                {
                     echo '<tr>
                     <td>'.$eval[$x]["ename"].'</td>
                     <td>
                        <input type="hidden" name="uploaded-by[]" value="'.$_SESSION['login'].'">
                        <input type="hidden" name="evaluation[]" value="'.$eval[$x]['ename'].'">
                        <input type="hidden" name="evalName" value="'.$_GET['exhibits'].'">
                        <input type="hidden" name="t[]" value="'.$column.'">
                        <input type="hidden" name="dept" value="'.$_SESSION['department'].'">  
                        <input type="hidden" name="pos" value="'.$_SESSION['position'].'">  
                        <input type="hidden" name="stand" value="'.$stand.'">
                        <input type="hidden" name="category" value="'.$dbtable.'">  
                        
                          
                
                      <input type="file" accept="application/pdf" name="uploadedfile[]" class="uploadFile upload" id="uploadBtn"> 
                          </td>
                        </tr>';    
                    
                }
                else 
                    echo '
                      <tr> 
                        <td>'.$eval[$x]['ename'].'</td>
                        <td>--</td>
                    </tr>
                    ';
              }?>
          </table>
          <input type="submit" value="Submit" class="btn btn-primary">
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

