<?php
  require_once('header.php');
  require_once('dbconn.php');
  $db = new db();
  $db -> Connect();
  $position=$_SESSION['position'];
  if(!($position=='QA')){
    header("Location:404-message.php");
  }
  $SQL ="SELECT * FROM standards";
    $ret =  mysql_query($SQL);
    $standards = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $standards[]=$row;
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
           <u>Add Standards</u>
        
      </h1>
      </section>
      <section class="content">
        <form method="POST" action="add-standards.php" id="form">

          <div class="main-content">
               
              <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Standards</button><br><br>
            <table class="table-hover table table-striped">
            <thead>
              <tr style="background-color: #DDDDDD; border-bottom: 4px solid #3c8dbc;">
                <th>Standards</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody> 
                <?php
              for($x=0;$x<count($standards);$x++){
                echo"
                  <tr> 
                    <td><a href=\"qa-crud.php?standards=".$standards[$x]['standards']."\">".$standards[$x]['standards']."</a></td>
                    <td>
                    <a href=\"edit-standards.php?standards=".$standards[$x]['standards']."&id=".$standards[$x]['id']."\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;Edit</a>
                     <a href=\"delete-standards.php?standards=".$standards[$x]['standards']."\" class=\"btn btn-danger delete-exhibit\"  Onclick=\"return ConfirmDelete();\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i>&nbsp;Delete</a>
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
