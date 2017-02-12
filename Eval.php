<?php
  require_once("header.php");
  require_once("dbconn.php");

  $column=$_GET['ename'];
  $dbtable=$_SESSION['dbtable'];

  $SQL ="SELECT * FROM $dbtable  WHERE layer='l3' AND tname='$column'";
  $ret =  mysql_query($SQL);
  
  $eval = array();

  if ($ret){
     while ($row = mysql_fetch_assoc($ret))
       $eval[]=$row;
    }
    function hasFile($login, $pos, $ev, $t, $dept)
    {
        
        $query="SELECT l3_evaluation FROM _documents3_ WHERE uploaded_by='".$login."' AND position='".$pos."' AND from_which_l2_eval='".$t."' AND department='".$dept."' AND l3_evaluation='".$ev."' ORDER BY l3_evaluation DESC LIMIT 1;";
        
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
          <u>Sub-sections</u>
        
      </h1>
      <ol class="breadcrumb">
    
       <?php echo "Standards: <a href='view-standards.php'>".$_GET['standards']."</a>>Sections: <a href='".$_GET['exhibits'].".php?exhibits=".$_GET['exhibits']."&standards=".$_GET['standards']."'>".$_GET['exhibits']."</a>><strong>Sub-sections: <a href='l2_".$_GET['ename'].".php?ename=".$_GET['ename']."&standards=".$_GET['standards']."&exhibits=".$_GET['exhibits']."'>".$_GET['ename']."</a>"; ?>
        </ol>
    
    </section>
    <div class="exhibit-content">
    
            
  <div id="wrapper">
  <?php if(isset($_SESSION['note'])) echo $_SESSION['note']; unset($_SESSION['note']); ?>
        <form method="POST" action="uploadfile3.php" enctype="multipart/form-data" id="form">
       
          <div class="main-content">
            <?php
              echo "<h4><strong>$column</strong></h4>";
              echo "<input type=\"hidden\" name=\"hiddenColumn\" value=\"".$_GET['ename']."\">
              <input type=\"hidden\" value=\"".$column."\" name=\"hiddenExhi\">";
            ?>

            <table  class="table-striped table-hover table">
              <thead>
              <tr style="background-color:#DDDDDD; border-bottom: 4px solid #3c8dbc;">
                <th>Sub-sections</th>
                <th>Actions</th>
              </tr>
              </thead>
              
              <?php
              for($x=0;$x<count($eval);$x++){
                if($eval[$x]["ename"]==hasFile($_SESSION['login'], $_SESSION['position'], $eval[$x]["ename"], $column, $_SESSION['department']))
                {
                     echo '<tr>
                          <td>'.$eval[$x]["ename"].'</td>
                          <td>Document available. <a href="changeDocument3.php?exhibits='.$column.'&editeval='.$eval[$x]["ename"].'&dept='.$_SESSION['department'].'&pos='.$_SESSION['position'].'">Change Document</a>  or <a href="download3.php?f='.$column.'&e='.$eval[$x][
"ename"].'&dept='.$_SESSION['department'].'&pos='.$_SESSION['position'].'">Download</a>
                          </td>
                        </tr>';    
                    
                }
                else
                    echo '
                      <tr> 
                        <input type="hidden" name="uploaded-by[]" value="'.$_SESSION['login'].'">
                        <input type="hidden" name="evaluation[]" value="'.$eval[$x]['ename'].'">
                        <input type="hidden" name="t[]" value="'.$column.'">
                        <input type="hidden" name="dept[]" value="'.$_SESSION['department'].'">
                        <input type="hidden" name="pos[]" value="'.$_SESSION['position'].'">
                        <input type="hidden" name="e" value="'.$column.'">
                        <input type="hidden" name="exh" value="'.$_GET['exhibits'].'">
                        <input type="hidden" name="stand" value="'.$_GET['standards'].'">
                        <td>'.$eval[$x]['ename'].'</td>
                        <td>
                             
                           <input type="file" name="uploadedfile[]"  accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                            </div>
                          </td>
                    </tr>
                    ';
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
		$('input[type=file]').each(function(){
			$(this).wrap('<div class=\"file\" />');
			$(this).parent().prepend('<div class=\"btn btn-primary\"><i class=\"fa fa-upload\" aria-hidden=\"true\"></i>&nbsp;Upload file</div>');
			$(this).parent().prepend('<span>No file chosen</span>');
			$(this).fadeTo(0,0);
			$(this).attr('size', '30'); // Use this to adjust width for FireFox.
			$(this).width($(this).parent().width());
			$(this).height($(this).parent().height());
		});
	},
	
	update:function(x){
		// Update the filename display.
		var filename = x.val().replace(/^.*\/g,'');
		if(filename.length > this.maxlength){
			trim_start = this.maxlength/2-1;
			trim_end = trim_start+filename.length-this.maxlength+1;
			filename = filename.substr(0,trim_start)+'&#8230;'+filename.substr(trim_end);
		}
		if(filename == '')
			filename = 'No file chosen';
		x.siblings('span').html(filename);
	}
}

$(document).ready(function(){
	file.convert();
	$('input[type=file]').change(function(){
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

