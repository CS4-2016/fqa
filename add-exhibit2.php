<?php
  require_once("dbconn.php");
  $db = new db();
  $db -> Connect();
  session_start();
  $standards=$_POST['hiddenStandards'];
    $_SESSION['errMsg']='';
    $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
  }
  $exhibit=$_POST['textExhibit'];
  $page=$exhibit;
  $_SESSION['exhibit'] = $exhibit;

/*$sql = "SELECT * FROM exhibit WHERE exhibits =  '$exhibit'";
$res = mysql_query($sql);*/

$query = "SELECT * FROM exhibit WHERE exhibits=  '$exhibit'";
$result = mysql_query($query);
   $num_rows = mysql_num_rows($result);
if ($num_rows>0) {
   $_SESSION['errMsg'] = "<strong>$exhibit</strong> Already Exist";
      header("Location:add-exhibit.php?standards=".$standards.""); 
}else{

    if($num_rows==0){
    $input=$exhibit;
    $a=explode(" ", $input);
    echo $exhibit=implode("", $a); 
    $dbtable=$exhibit;
    $_SESSION['dbtable']=$exhibit;
    mysql_select_db("thesis");
    $createtbl = "CREATE TABLE $exhibit (
    ename varchar (200) NOT NULL,
    eid int NOT NULL auto_increment PRIMARY KEY,
    tname varchar (200) NOT NULL,
    layer varchar(20)
    )";
        $results = mysql_query($createtbl);
   if(!$results){  
       $_SESSION['errMsg']="Title invalid. Please use a different title.";
       header("Location: add-exhibit.php?standards=".$standards."");
   }else{
       $SQL="INSERT INTO exhibit(exhibits,standards) values ('$input','$standards')"; 
        $ret = mysql_query($SQL);
	$file = fopen("add-$page-$standards.php","w+");
  fwrite($file, '<?php
  require_once("header.php");
  require_once("dbconn.php");
  $pattern=$_SESSION[\'pattern\']; 
    // SORTS TABLES ACCORDING TO TABLE NAMES
    function getSubtables($tname, $dbtable)
    {
        $SQL ="SELECT * FROM $dbtable  WHERE tname=\'$tname\'";
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
    $_SESSION[\'page\']=$oldexhibit;
    $input=$oldexhibit;
    $a=explode(" ", $input);
    $exhibit=implode("", $a); 
    $dbtable=addslashes($exhibit);
    $_SESSION["dbtable"]=$dbtable;
    
    $SQL ="SELECT * FROM etable where texhibit=\'$oldexhibit\'";
    $ret =  mysql_query($SQL);
    
    $tablename = array();
    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $tablename[]=$row;
    }
    else
    {
        echo mysql_error();
    }
 /*   $cell=getSubtables("andrew", $dbtable);
    echo "<pre>";
        print_r($cell);
    echo "</pre>";
*/

  $s=$_GET[\'standards\'];  
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
          <u>Sections</u>
        
      </h1>
      <ol class="breadcrumb">
      <?php echo "Standards: <a href=\'standards.php\'>".$_GET[\'standards\']."</a>>Options: <a href=\'qa-crud.php?standards=".$s."\'>Exhibits</a>><strong>Category: ><a href=\'add-".$oldexhibit."-".$s.".php?exhibits=".$oldexhibit."&standards=".$s."\'>".$oldexhibit."</a></strong>"; 
          ?>>
        </ol>
    
    </section>
    
  <form method="POST" action="add-table-evaluation.php">
    <div class="exhibit-content">
   
        <?php
        echo "<input type=\'hidden\' value=\'".$_GET[\'standards\']."\' name=\'hiddenStandard\'>";
          require_once("add-table.php");
        ?>
  <div id="wrapper">
  <?php 
                           if(!empty($_SESSION[\'errMsg\'])) { ?>
                            <div class="alert alert-danger fade in">
                            <?php echo $_SESSION[\'errMsg\'];?>
                            </div>
                        <?php 
                            unset($_SESSION[\'errMsg\']);
                        } ?>
               <?php echo "<input type=\'hidden\' value=\'".$_GET[\'exhibits\']."\' name=\'hiddenExhibit\'>";?>
    <center><input type="button" class="add btn btn-primary" value="Add Section table" id="myBtn"></center>
    </form>
       <?php
            for($x=0;$x<count($tablename);$x++){
              
              echo \'<br><br>\';
              echo "<a href=\"edit-table-evaluation.php?tname=".$tablename[$x][\'tname\']."&table=".$tablename[$x][\'texhibit\']."&id=".$tablename[$x][\'tid\']."&standards=".$_GET[\'standards\']."\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;Edit Table Name</a>  
                    <a href=\"delete-table.php?tname=".$tablename[$x][\'tname\']."&table=".$tablename[$x][\'texhibit\']."&id=".$tablename[$x][\'tid\']."&page=".$oldexhibit."&standards=".$s."\" class=\"btn btn-danger\" Onclick=\"return ConfirmDelete();\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i>&nbsp;Delete Table</a>
                    <h4><strong>".$tablename[$x][\'tname\']."</strong></h4>";
              $cell=getSubtables($tablename[$x][\'tname\'], $dbtable);
              echo \'<table width="90%" class="table-hover table-striped table">
                   <thead>
                   <tr style="background-color:#DDDDDD;  border-bottom: 4px solid #3c8dbc;">
                      <td><strong>Sections</strong></td>
                      <td><strong>Actions</strong></td>
                    </tr>
                    </thead>\';
            if(isset($_GET["e"]) && isset($_GET["t"]))
            {
                $edit_table=$_GET["t"];
                $edit_cell=$_GET["e"];
            }
            else if(!isset($_GET["e"]) && !isset($_GET["t"]) || !isset($_GET["t"]) || !isset($_GET["e"]))
            {
                $edit_table=false;
                $edit_cell=false;
            }
             stripslashes($exhibit);
              for($i=0;$i<count($cell);$i++){
                     echo \'<tr>
                          <td><a href="l2_\'.$cell[$i]["ename"].\'-\'.$dbtable.\'-\'.$s.\'.php?ename=\'.$cell[$i][\'ename\'].\'&standards=\'.$_GET[\'standards\'].\'&exhibits=\'.$_GET[\'exhibits\'].\'">\'.$cell[$i]["ename"].\'</a></td>
                          <td>
 <a href="edit-evaluation.php?exhibits=\'.$exhibit.\'&t=\'.$tablename[$x]["tname"].\'&e=\'.$cell[$i]["ename"].\'&id=\'.$cell[$i][\'eid\'].\'&page=\'.$oldexhibit.\'&s=\'.$s.\'&edit=yes" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Edit </a>
                            <a href="delete-l2.php?exhibits=\'.$exhibit.\'&t=\'.$tablename[$x][\'tname\'].\'&e=\'.$cell[$i]["ename"].\'&id=\'.$cell[$i][\'eid\'].\'&s=\'.$_GET[\'standards\'].\'&delete=yes" class="btn btn-danger"  Onclick="return ConfirmDelete();"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Delete</a>
                            
                          </td>
                        </tr>\';
                }
                echo \'<form action="add-evaluation.php" method="POST">\';
              echo "<input type=\"hidden\" name=\"tablename\" value=\'".$tablename[$x]["tname"]."\'>";
              echo "<tr>
                        <td><input type=\"text\" class=\"form-control\" name=\"textEvaluation\" pattern=\"".$pattern."\" title=\"Invalid format\"  required/></td>
                        <td><input type=\"submit\" class=\"form-control btn btn-primary\" value=\"Add Section\" /></td>
                         <input type=\'hidden\' value=\'".$_GET[\'standards\']."\' name=\'hiddenStandard\'>
                         <input type=\'hidden\' value=\'".$dbtable."\' name=\'hiddenExhibit\'>
                  </tr>
                </table>
                </form>
              ";
            
            }

      ?>
    
     
  </div>

        
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
 <?php
    require_once("footer.php");
  ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebars background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

  <!-- Main Footer -->
 <?php
    require_once("footer.php");
  ?>
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

$file2 = fopen("$page-$standards.php","w+");
  fwrite($file2, '<?php
  require_once("header.php");
  require_once("dbconn.php");
   
    // SORTS TABLES ACCORDING TO TABLE NAMES
    function getSubtables($tname, $dbtable)
    {
        $SQL ="SELECT * FROM $dbtable  WHERE tname=\'$tname\';";
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
    $_SESSION[\'page\']=$oldexhibit;
    $input=$oldexhibit;
    $a=explode(" ", $input);
    $exhibit=implode("", $a); 
    $dbtable=addslashes($exhibit);
    $_SESSION["dbtable"]=$dbtable;
    $s=$_GET[\'standards\'];
    
    $SQL ="SELECT * FROM etable where texhibit=\'$oldexhibit\'";
    $ret =  mysql_query($SQL);
    
    $tablename = array();
    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $tablename[]=$row;
    }
    else
    {
        echo mysql_error();
    }
    
    function hasFile($ev, $t, $dept, $pos)
    {
        
        $query="SELECT evaluation FROM _documents_ WHERE from_which_table=\'".$t."\' AND evaluation=\'$ev\' AND department=\'$dept\' AND position=\'$pos\' ORDER BY evaluation DESC LIMIT 1;";
        
        $ret =  mysql_query($query);

        $checkEval = array();
        if ($ret)
        {
            $row = mysql_fetch_assoc($ret);
            return $row[\'evaluation\'];           
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
 <section class="content-header">
        <h1>
          <u>Sections</u>
        
      </h1>
      <ol class="breadcrumb">
      <?php echo "Standards: <a href=\'view-standards.php\'>".$_GET[\'standards\']."</a>>Options: <a href=\'exhibits.php?standards=".$s."\'>Exhibits</a>><strong>Category: ><a href=\'".$oldexhibit."-".$s.".php?exhibits=".$oldexhibit."&standards=".$s."\'>".$oldexhibit."</a></strong>"; 
          ?>>
        </ol>
    
    </section>
    <div class="exhibit-content">
   
  <div id="wrapper">
  <?php if(isset($_SESSION[\'note\'])) echo $_SESSION[\'note\']; unset($_SESSION[\'note\']); ?>
       <?php
            for($x=0;$x<count($tablename);$x++){
              echo \'<form action="uploadfile.php" enctype="multipart/form-data" method="POST">\';            
              echo \'<br><br>\';
              echo  "<h4><strong>".$tablename[$x][\'tname\']."</strong></h4>";
              $cell=getSubtables($tablename[$x][\'tname\'], $dbtable);
             echo \'<table  class="table-striped table-hover table">
                <thead>
                    <tr style="background-color:#DDDDDD; border-bottom: 4px solid #3c8dbc;">
                      <td><strong>Sections</strong></td>
                      <td><strong>Actions</strong></td>
                    </tr>
                </thead>
            \';
            if(isset($_GET["e"]) && isset($_GET["t"]))
            {
                $edit_table=$_GET["t"];
                $edit_cell=$_GET["e"];
            }
            else if(!isset($_GET["e"]) && !isset($_GET["t"]) || !isset($_GET["t"]) || !isset($_GET["e"]))
            {
                $edit_table=false;
                $edit_cell=false;
            }
             stripslashes($exhibit);
              for($i=0;$i<count($cell);$i++){
                     if($cell[$i]["ename"]==hasFile($cell[$i]["ename"], $tablename[$x]["tname"], $_SESSION[\'department\'], $_SESSION[\'position\']))
                {
                     echo \'<tr>
                          <td><a href="\'.$cell[$i]["ename"].\'-\'.$dbtable.\'-\'.$s.\'.php?ename=\'.$cell[$i][\'ename\'].\'&standards=\'.$_GET[\'standards\'].\'&exhibits=\'.$_GET[\'exhibits\'].\'">\'.$cell[$i]["ename"].\'</a></td>
                          <td>Document available. <a href="changeDocument2.php?exhibits=\'.$oldexhibit.\'&editeval=\'.$cell[$i]["ename"].\'&dept=\'.$_SESSION[\'department\'].\'&pos=\'.$_SESSION[\'position\'].\'&standards=\'.$_GET[\'standards\'].\'">Change Document</a> or <a href="download.php?e=\'.$exhibit.\'&t=\'.$tablename[$x][\'tname\'].\'&ev=\'.$cell[$i]["ename"].\'&dept=\'.$_SESSION[\'department\'].\'&pos=\'.$_SESSION[\'position\'].\'">Download</a>
                          </td>
                        </tr>\';  
                        $p=$_SESSION[\'position\'];
                        $dep=$_SESSION[\'department\'];
                        $_SESSION[\'d\']=\'download.php?e=\'.$exhibit.\'&t=\'.$tablename[$x][\'tname\'].\'&ev=\'.$cell[$i][\'ename\'].\'&dept=\'.$dep.\'&pos=\'.$p;
                        $_SESSION[\'d\'];
                    
                }
                else
                {
                     echo \'<tr>
                           <td><a href="\'.$cell[$i]["ename"].\'-\'.$exhibit.\'-\'.$s.\'.php?ename=\'.$cell[$i][\'ename\'].\'&standards=\'.$_GET[\'standards\'].\'&exhibits=\'.$_GET[\'exhibits\'].\'">\'.$cell[$i]["ename"].\'</a></td>
                          <td>
                            <input type="hidden" name="uploaded-by[]" value="\'.$_SESSION[\'login\'].\'" />
                            <input type="hidden" name="dept[]" value="\'.$_SESSION[\'department\'].\'" />
                            <input type="hidden" name="exhibit[]" value="\'.$cell[$i][\'ename\'].\'"/>
                            <input type="hidden" name="t[]" value="\'.$tablename[$x][\'tname\'].\'" />
                            <input type="hidden" name="level[]" value="2" />
                            <input type="hidden" name="master-exhibit[]" value="\'.$exhibit.\'" />
                            <input type ="hidden" name="hiddenStandards" value="\'.$_GET[\'standards\'].\'">
                            <input type ="hidden" name="hiddenExhibits" value="\'.$_GET[\'exhibits\'].\'">
                            <input type="hidden" name="e" value="\'.$oldexhibit.\'" />
                            
                            <input type="file" name="uploadedfile[]"  accept="application/pdf">
                         
                          </td>
                        </tr>
                     \';
                }
            }
              
              echo "<input type=\"hidden\" name=\"tablename\" value=\'".$tablename[$x]["tname"]."\'>";
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
    header("Location:qa-crud.php?standards=".$standards."");
  else
     echo mysql_error();
    }
}
}
?>