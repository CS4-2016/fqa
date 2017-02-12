<?php
  require_once('header.php');
  require_once('dbconn.php');
  $db = new db();
  $db -> Connect();
  $position=$_SESSION['position'];
  if(!($position=='QA')){
    header("Location:404-message.php");
  }
  $standards=$_GET['standards'];
  $SQL ="SELECT * FROM exhibit WHERE standards='$standards'";
    $ret =  mysql_query($SQL);
    $exhibit = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $exhibit[]=$row;
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
        
        <ol class="breadcrumb">
    
      <?php echo "Standards: <a href='standards.php'>".$_GET['standards']."</a><strong>>Categories: <a href='qa-crud.php?standards=".$standards."'>Exhibits</a>"; ?></strong>>
        </ol>
    
    </section>
      
     <section class="content">
        <form method="POST" action="add-exhibit.php" id="form">

          <div class="main-content">
            
               
              <?php echo "<a href=\"add-exhibit.php?standards=".$standards."\" class=\"btn btn-primary\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i>&nbsp;Add Category</a> <br><br>"; ?>
            <table class="table-hover table table-striped">
            <thead>
              <tr style="background-color: #DDDDDD; border-bottom: 4px solid #3c8dbc;">
                <th>Categories</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody> 
                <?php
                echo"<input type='hidden' name='hiddenStandards' value='".$standards."'>";
              for($x=0;$x<count($exhibit);$x++){
                echo"
                  <tr> 
                    <td><a href=\"add-".$exhibit[$x]['exhibits']."-$standards.php?exhibits=".$exhibit[$x]['exhibits']."&standards=".$_GET['standards']."\">".$exhibit[$x]['exhibits']."</a></td>
                    <td>
                    <a href=\"edit-exhibit.php?standards=".$standards."&id=".$exhibit[$x]['id']."\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;Edit</a>
                     <a href=\"delete-exhibit.php?standards=".$standards."&exhibits=".$exhibit[$x]['exhibits']."\" class=\"btn btn-danger delete-exhibit\"  Onclick=\"return ConfirmDelete();\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i>&nbsp;Delete</a>
                  </td>
                </tr>
                ";
              }?>
            </tbody>
          </table>
      </div>
    </form>
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
