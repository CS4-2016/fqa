<?php
  require_once('header.php');
  require_once('dbconn.php');
  $db = new db();
  $db -> Connect();

    $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
    }
  	$id=$_GET['id'];
  	$texhibit=$_GET['table'];
    $table=$_GET['tname'];
	$SQL ="SELECT * FROM etable where texhibit='$texhibit';";
    $ret =  mysql_query($SQL);
    $exhibit = array();

    if ($ret)
    {
        while ($row = mysql_fetch_assoc($ret))
             $exhibit[]=$row;
    }
    else
    {
        echo mysql_error();
    }
    $s=$_GET['standards'];
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

?>  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
      <h1>
          <u>Edit Table Name</u>
        
      </h1>
      </section>
	  <section class="contents">
	  	<div class="main-content">
	  		<form method="POST" action="edit-table-evaluation2.php">
                 <?php 
                    echo "<input type='hidden' name='hiddenStandards' value='".$s."'>";
                           if(!empty($_SESSION['errMsg'])) { ?>
                            <div class="alert alert-danger fade in">
                            <?php echo $_SESSION['errMsg'];?>
                            </div>
                        <?php 
                            unset($_SESSION['errMsg']);
                  } ?>
	  		
	        <table  class="table-striped table-hover table">
	         	<thead>  
	              <tr style="background-color: #DDDDDD;  border-bottom: 4px solid #3c8dbc;">
	              	<td><strong>Sections</strong></td>  
	                <td><strong>Actions</strong></td>  
	            	</tr>
				</thead>
					<tr>
		  	<?php
			  for($i=0; $i<count($exhibit); $i++){
			  	if($exhibit[$i]['tname']==$table){
			  		echo "<td><input type='text' class='form-control' name='textTable' value='".$exhibit[$i]['tname']."' /></td>";
					echo "<td><input type='submit' class='btn btn-primary' value='Save'  Onclick=\"return confirm('Do you want to save the data')\"/> 
					<a href='add-".$texhibit.".php?exhibits=".$texhibit."&standards=".$s."'><input type='button' class='btn btn-danger' value='Cancel' /></a></td>
					</tr>";

			  	}
			  	else
			  	{
			  		echo "<tr><td>".$exhibit[$i]['tname']."</td>
			  				<td></td>
			  			</tr>";

			  	}
			  }
			  echo "<input type='hidden' name='hiddenTable' value='".$table."'>
			  		<input type='hidden' name='hiddenPage' value='".$texhibit."'>
			  		<input type='hidden' name='hiddenId' value='".$id."'>
			  ";
			?>
				
			</table>
		</div>
	  </section>
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
     <?php 
      require_once ('footer.php');
?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->

<!-- Optionally, you can add Sl/imscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
