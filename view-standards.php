<?php
  require_once('header.php');
  require_once('dbconn.php');
  $db = new db();
  $db -> Connect();
  $position=$_SESSION['position'];
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
          <u>View Standards</u>
        
      </h1>
      </section>
<section class="content">
          <div class="main-content">
            
            <table class="table-hover table table-striped">
            <thead>
              <tr style="background-color: #DDDDDD; border-bottom: 4px solid #3c8dbc;">
                <th>Standards</th>
              </tr>
            </thead>
            <tbody> 
                <?php
              for($x=0;$x<count($standards);$x++){
                echo"
                  <tr> 
                    <td><a href=\"exhibits.php?standards=".$standards[$x]['standards']."\">".$standards[$x]['standards']."</a></td>
                </tr>
                ";
              }?>
            </tbody>
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
