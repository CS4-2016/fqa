<?php
  require_once("header.php");
  require_once("dbconn.php");
   
    // SORTS TABLES ACCORDING TO TABLE NAMES
    function getSubtables($tname, $dbtable)
    {
        $SQL ="SELECT * FROM $dbtable  WHERE tname='$tname';";
        $ret1 =  mysql_query($SQL);

        $cell = array();
        if ($ret1)
        {
            while ($row = mysql_fetch_assoc($ret1))
                $cell[]=$row;
        }
        foreach($cell as $a)
            foreach($a as $b)
                stripslashes($b);
        return $cell;
    }
    $oldexhibit=$_GET["exhibits"];
    $_SESSION['page']=$oldexhibit;
    $input=$oldexhibit;
    $a=explode(" ", $input);
    $exhibit=implode("", $a); 
    $dbtable=addslashes($exhibit);
    $_SESSION["dbtable"]=$dbtable;
    
    $SQL ="SELECT * FROM etable where texhibit='$oldexhibit'";
    $ret =  mysql_query($SQL);
    
    $tablename = array();
    if ($ret)
    {
        while ($row = mysql_fetch_assoc($ret))
            $tablename[]=$row;
    }
    else
    {
        echo mysql_error();
    }
    
    function hasFile($ev, $t)
    {
        
        $query="SELECT evaluation FROM _documents_ WHERE from_which_table='".$t."' AND evaluation='$ev' ORDER BY evaluation DESC LIMIT 1;";
        
        $ret =  mysql_query($query);

        $checkEval = array();
        if ($ret)
        {
            $row = mysql_fetch_assoc($ret);
            return $row['evaluation'];           
        }
        else
        {
            echo mysql_error();
            return false;
        }
        
    }

    
    
 /*   $cell=getSubtables("andrew", $dbtable);
    echo "<pre>";
        print_r($cell);
    echo "</pre>";
*/
    
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
        <br>
        <!-- Page Header
        <small>Optional description</small> -->
      </h1>
     
  </section>
    <div class="exhibit-content">
   
  <div id="wrapper">
       <?php
            for($x=0;$x<count($tablename);$x++){
              echo '<form action="uploadfilechange.php" enctype="multipart/form-data" method="POST">';            
              echo '<br><br>';
              echo  "<h4>".$tablename[$x]['tname']."</h4>";
              $cell=getSubtables($tablename[$x]['tname'], $dbtable);
             echo '<table  class="table-striped table-hover table">
                <thead>
                    <tr style="background-color:#DDDDDD; border-bottom: 4px solid #3c8dbc;">
                      <td>Evaluation</td>
                      <td>Action</td>
                    </tr>
                </thead>
            ';
           
             stripslashes($exhibit);
              for($i=0;$i<count($cell);$i++){
                if($cell[$i]["ename"]==$_GET['editeval'])
                {
                     echo '<tr>
                          <td>'.$cell[$i]["ename"].'</td>
                          <td>
                            <input type="hidden" name="uploaded-by[]" value="'.$_SESSION['login'].'" />
                            <input type="hidden" name="exhibit[]" value="'.$cell[$i]['ename'].'"/>
                            <input type="hidden" name="t[]" value="'.$tablename[$x]['tname'].'" />
                            <input type="hidden" name="level[]" value="2" />
                            <input type="hidden" name="master-exhibit[]" value="'.$exhibit.'" />
                            
                            <input type="hidden" name="e" value="'.$_GET['exhibits'].'" />
                            <input type="hidden" name="s" value="'.$_GET['standards'].'" />
    

                            <input type="file" accept="application/pdf" name="uploadedfile[]" class="uploadFile upload" id="uploadBtn"> 
                          </td>
                        </tr>
                     ';
                }
                else
                
                {
                     echo '<tr>
                          <td>'.$cell[$i]["ename"].'</td>
                          <td></td>
                        </tr>
                     ';
                }
            }
              
              echo "<input type=\"hidden\" name=\"tablename\" value='".$tablename[$x]["tname"]."'>";
              echo "<tr>
                  </tr>
                </table>

              ";
            
              }

      ?>
    <input type="submit" value="Submit" class="btn btn-primary">
  </form>
     
  </div>

        
    </div>
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
