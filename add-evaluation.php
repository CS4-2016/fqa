<?php
  require_once("dbconn.php");
  $db=new db();
  $db->Connect();
  session_start();	

      $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
  }
    
   $evaluation=$_POST['textEvaluation'];    
	 $dbtable=$_POST['hiddenExhibit'];
	 $tableName=$_POST['tablename'];
   $page=$_SESSION['page'];
   $s=$_POST['hiddenStandard'];

    $query1 ="SELECT * FROM exhibit";
    $ret1 =  mysql_query($query1);
    $dbtables = array();

    if ($ret1){
        while ($row = mysql_fetch_assoc($ret1))
             $dbtables[]=$row;

    }
    
    for($x=0;$x<count($dbtables);$x++){
        $dbtables[$x]['exhibits'];
        $db=$dbtables[$x]['exhibits'];
        $newdb=explode(" ",$dbtables[$x]['exhibits']);
        $newdb2=implode("",$newdb);
        $newdb3=$newdb2;
/*        $query2="SELECT * FROM $newdb3 where ename='$evaluation'";
        $ret2 =  mysql_query($query2);
        $num_row1 = mysql_num_rows($ret2);*/



}
    
/*        if ($num_row1>0) {
            echo $_SESSION['errMsg'] = "<strong>$name</strong> Already Exist";
            header("Location:add-".$page.".php?exhibits=".$page."&standards=".$s);
        }*/
/*        else if($num_row1==0){

            $SQL = "SELECT * FROM $dbtable WHERE ename  = '$evaluation'";
            $result = mysql_query($SQL);
            $num_rows = mysql_num_rows($result);*/   
            $SQL = "SELECT * FROM $dbtable WHERE ename  = '$evaluation'";
            $result = mysql_query($SQL);
            $num_rows = mysql_num_rows($result);
            if ($num_rows>0) {
               $_SESSION['errMsg'] = "<strong>$name</strong> Already Exist";
                //header("Location:add-".$page.".php?exhibits=".$page."&standards=".$s);
               header("Location:add-".$page."-".$s.".php?exhibits=".$page."&standards=".$s);
            }else{

             if($num_rows==0){  
                $SQL="INSERT INTO $dbtable(ename,tname,layer) values ('$evaluation','$tableName','l2')"; 
                $ret=mysql_query($SQL);


	$file = fopen("l2_$evaluation-$dbtable-$s.php","w+");    
    fwrite($file, '<?php
  require_once("header.php");
  require_once("dbconn.php");

  $pattern=$_SESSION[\'pattern\'];

  $column=$_GET[\'ename\'];
  $dbtable=$_SESSION[\'dbtable\'];

  $SQL ="SELECT * FROM $dbtable  WHERE layer=\'l3\' AND tname=\'$column\'";
  $ret =  mysql_query($SQL);
  
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
$position=$_SESSION[\'position\'];
if($position==\'Dean\'||$position==\'Chair\' || $position==\'VPA\'){
  require_once(\'side-bar-acad.php\');
}
else if($position==\'QA\'){
  require_once(\'side-bar-qa.php\');               
}
else if($position==\'HRD\'){
  require_once(\'side-bar-hrd.php\');             
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          <u>Sub-section</u>
        
      </h1>
      
      <ol class="breadcrumb">
      <?php echo "Standards: <a href=\'standards.php\'>".$_GET[\'standards\']."</a>>Options: <a href=\'qa-crud.php?standards=".$_GET[\'standards\']."\'>Exhibits</a>>Category: <a href=\'add-".$dbtable."-".$_GET[\'standards\'].".php?exhibits=".$dbtable."&standards=".$_GET[\'standards\']."\'>".$dbtable."</a><strong>>Sub-Category: <a href=\'l2_".$column."-".$dbtable."-".$_GET[\'standards\'].".php?ename=".$column."&standards=".$_GET[\'standards\']."&exhibits=".$dbtable."\'>".$column."</a></strong>"; 
          ?>
        </ol>
    
    </section>
    <div class="exhibit-content">
      
            
  <div id="wrapper">
        <form method="POST" action="add-evaluation-layer3.php" id="form">
        <?php 
                           if(!empty($_SESSION[\'errMsg\'])) { ?>
                            <div class="alert alert-danger fade in">
                            <?php echo $_SESSION[\'errMsg\'];?>
                            </div>
                        <?php 
                            unset($_SESSION[\'errMsg\']);
                        } ?>
       
          <div class="main-content">
        
            <?php
              echo "<h4><strong>$column</h4></strong>";;
              echo "<input type=\"hidden\" name=\"hiddenColumn\" value=\"".$_GET[\'ename\']."\">";
            ?>

            <table  class="table-striped table-hover table">
              <thead>
              <tr style="background-color:#DDDDDD;  border-bottom: 4px solid #3c8dbc;">
                <th>Sub-section</th>
                <th>Actions</th>
              </tr>
              </thead>
              
              <?php
              for($x=0;$x<count($eval);$x++){
                echo"
                  <tr> 
                    <td>".$eval[$x][\'ename\']."</td>
                    <td>
                                       <a href=\"edit-evaluation-layer3.php?column=".$column."&dbtable=".$dbtable."&ename=".$eval[$x][\'ename\']."&id=".$eval[$x][\'eid\']."&standards=".$_GET[\'standards\']."&exhibits=".$_GET[\'exhibits\']."\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;Edit</a></a>
                     <a href=\"delete-evaluation-layer3.php?column=".$column."&dbtable=".$dbtable."&ename=".$eval[$x][\'ename\']."&id=".$eval[$x][\'eid\']."&standards=".$_GET[\'standards\']."&exhibits=".$_GET[\'exhibits\']."\" class=\"btn btn-danger delete-exhibit\" Onclick=\"return ConfirmDelete();\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i>&nbsp;Delete</a>
                  </td>
                </tr>
                ";
                     }
                      echo "<input type=\'hidden\' value=\'".$_GET[\'standards\']."\' name=\'hiddenStandard\'>
                     <input type=\'hidden\' value=\'".$_GET[\'exhibits\']."\' name=\'hiddenExhibits\'> ";               
?>
                <tr>
                  <td>
                  <?php echo "<input type=\"text\" name=\"textEvaluation\" class=\"form-control\" pattern=\"".$pattern."\" title=\"Invalid format\"required>"; ?>
                  </td>
                  <td>
                    <input type="submit" class="form-control btn btn-primary" value="Add row" />

                  </td>
                </tr>
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
</html>');

  $file2 = fopen("$evaluation-$dbtable-$s.php","w+");    
    fwrite($file2, '<?php
  require_once("header.php");
  require_once("dbconn.php");

  $column=$_GET[\'ename\'];
  $dbtable=$_SESSION[\'dbtable\'];

  $SQL ="SELECT * FROM $dbtable  WHERE layer=\'l3\' AND tname=\'$column\'";
  $ret =  mysql_query($SQL);
  
  $eval = array();

  if ($ret){
     while ($row = mysql_fetch_assoc($ret))
       $eval[]=$row;
    }
    function hasFile($login, $pos, $ev, $t, $dept)
    {
        
        $query="SELECT l3_evaluation FROM _documents3_ WHERE uploaded_by=\'".$login."\' AND position=\'".$pos."\' AND from_which_l2_eval=\'".$t."\' AND department=\'".$dept."\' AND l3_evaluation=\'".$ev."\' ORDER BY l3_evaluation DESC LIMIT 1;";
        
        $ret =  mysql_query($query);

        $checkEval = array();
        if ($ret)
        {
            $row = mysql_fetch_assoc($ret);
            return $row[\'l3_evaluation\'];           
        }
        else
        {
            echo mysql_error();
            return false;
        }
        
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
$position=$_SESSION[\'position\'];
if($position==\'Dean\'||$position==\'Chair\' || $position==\'VPA\'){
  require_once(\'side-bar-acad.php\');
}
else if($position==\'QA\'){
  require_once(\'side-bar-qa.php\');               
}
else if($position==\'HRD\'){
  require_once(\'side-bar-hrd.php\');             
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
        <h1>
          <u>Sub-section</u>
        
      </h1>
      <ol class="breadcrumb">
      <?php echo "Standards: <a href=\'view-standards.php\'>".$_GET[\'standards\']."</a>>Options: <a href=\'exhibits.php?standards=".$_GET[\'standards\']."\'>Exhibits</a>>Category: <a href=\'".$dbtable."-".$_GET[\'standards\'].".php?exhibits=".$dbtable."&standards=".$_GET[\'standards\']."\'>".$dbtable."</a><strong>>Sub-Category: <a href=\'".$column."-".$dbtable."-".$_GET[\'standards\'].".php?ename=".$column."&standards=".$_GET[\'standards\']."&exhibits=".$dbtable."\'>".$column."</a></strong>"; 
          ?>
        </ol>
    
    </section>
    <div class="exhibit-content">
    
            
  <div id="wrapper">
  <?php if(isset($_SESSION[\'note\'])) echo $_SESSION[\'note\']; unset($_SESSION[\'note\']); ?>
        <form method="POST" action="uploadfile3.php" enctype="multipart/form-data" id="form">
       
          <div class="main-content">
            <?php
              echo "<h4><strong>$column</strong></h4>";
              echo "<input type=\"hidden\" name=\"hiddenColumn\" value=\"".$_GET[\'ename\']."\">
              <input type=\"hidden\" value=\"".$column."\" name=\"hiddenExhi\">";
            ?>

            <table  class="table-striped table-hover table">
              <thead>
              <tr style="background-color:#DDDDDD">
                <th>Sub-section</th>
                <th>Actions</th>
              </tr>
              </thead>
              
              <?php
              for($x=0;$x<count($eval);$x++){
                if($eval[$x]["ename"]==hasFile($_SESSION[\'login\'], $_SESSION[\'position\'], $eval[$x]["ename"], $column, $_SESSION[\'department\']))
                {
                     echo \'<tr>
                          <td>\'.$eval[$x]["ename"].\'</td>
                          <td>Document available. <a href="changeDocument3.php?exhibits=\'.$column.\'&editeval=\'.$eval[$x]["ename"].\'&dept=\'.$_SESSION[\'department\'].\'&pos=\'.$_SESSION[\'position\'].\'&stand=\'.$_GET[\'standards\'].\'">Change Document</a>  or <a href="download3.php?f=\'.$column.\'&e=\'.$eval[$x][
"ename"].\'&dept=\'.$_SESSION[\'department\'].\'&pos=\'.$_SESSION[\'position\'].\'">Download</a>
                          </td>
                        </tr>\';    
                        $p=$_SESSION[\'position\'];
                        $dep=$_SESSION[\'department\'];
                        $_SESSION[\'d\']=\'download.php?e=\'.$exhibit.\'&t=\'.$tablename[$x][\'tname\'].\'&ev=\'.$cell[$i][\'ename\'].\'&dept=\'.$dep.\'&pos=\'.$p;
                        $_SESSION[\'d\'];
                }
                else
                    echo \'
                      <tr> 
                        <input type="hidden" name="uploaded-by[]" value="\'.$_SESSION[\'login\'].\'">
                        <input type="hidden" name="evaluation[]" value="\'.$eval[$x][\'ename\'].\'">
                        <input type="hidden" name="t[]" value="\'.$column.\'">
                        <input type="hidden" name="dept[]" value="\'.$_SESSION[\'department\'].\'">
                        <input type="hidden" name="pos[]" value="\'.$_SESSION[\'position\'].\'">
                        <input type="hidden" name="e" value="\'.$column.\'">
                        <input type="hidden" name="exh" value="\'.$_GET[\'exhibits\'].\'">
                        <input type="hidden" name="stand" value="\'.$_GET[\'standards\'].\'">
                        <td>\'.$eval[$x][\'ename\'].\'</td>
                        <td>
                             
                           <input type="file" name="uploadedfile[]"  accept="application/pdf">
                            </div>
                          </td>
                    </tr>
                    \';
              }?>
              
          </table>
      </div>
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
<script>
    
    var file = {
	maxlength:20, 
		
	convert:function(){
		// Convert all file type inputs.
		$(\'input[type=file]\').each(function(){
			$(this).wrap(\'<div class=\"file\" />\');
			$(this).parent().prepend(\'<div class=\"btn btn-primary\"><i class=\"fa fa-upload\" aria-hidden=\"true\"></i>&nbsp;Upload file</div>\');
			$(this).parent().prepend(\'<span>No file chosen</span>\');
			$(this).fadeTo(0,0);
			$(this).attr(\'size\', \'30\'); // Use this to adjust width for FireFox.
			$(this).width($(this).parent().width());
			$(this).height($(this).parent().height());
		});
	},
	
	update:function(x){
		// Update the filename display.
		var filename = x.val().replace(/^.*\\/g,\'\');
		if(filename.length > this.maxlength){
			trim_start = this.maxlength/2-1;
			trim_end = trim_start+filename.length-this.maxlength+1;
			filename = filename.substr(0,trim_start)+\'&#8230;\'+filename.substr(trim_end);
		}
		if(filename == \'\')
			filename = \'No file chosen\';
		x.siblings(\'span\').html(filename);
	}
}

$(document).ready(function(){
	file.convert();
	$(\'input[type=file]\').change(function(){
		file.update($(this));
	});
});
    </script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>

');
 fclose($file); 
 fclose($file2);   
                if($ret)
                {
                    header("Location:add-".$page."-".$s.".php?exhibits=".$page."&standards=".$s);
                }
                else
                {
                    mysql_error();
                    echo $_SESSION['errMsg'] = "<strong>/ \ '</strong> are not allowed";
                    header("Location:add-".$page."-".$s.".php?exhibits=".$page."&standards=".$s);
                }
             }
            }
                            
        //}
?>