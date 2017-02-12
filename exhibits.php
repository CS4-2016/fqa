<?php
  require_once('header.php');
  require_once('dbconn.php');
  $db = new db();
  $db -> Connect();
  $standards=$_GET['standards'];
  $SQL ="SELECT * FROM exhibit where standards='$standards'";
    $ret =  mysql_query($SQL);
    $exhibit = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $exhibit[]=$row;
    }
    $position=$_SESSION['position'];
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
          <u>Upload Category</u>
        
      </h1>
         <ol class="breadcrumb">
      <?php echo "Standards: <a href='view-standards.php'>".$_GET['standards']."</a><strong>>Categories: <a href='exhibits.php?standards=".$standards."'>Exhibits</a>"; ?></strong>>
        </ol>
      </section>
      <section class="content">
          <div class="main-content">
          
            <table  class="table-striped table-hover table">
              <thead>
              <tr style="background-color:#DDDDDD; border-bottom: 4px solid #3c8dbc;">
                <th>Category</th>
              </tr>
              </thead>
              <?php
              for($x=0;$x<count($exhibit);$x++){
                echo"
                  <tr> 
                    <td><a href=\"".$exhibit[$x]['exhibits']."-".$standards.".php?exhibits=".$exhibit[$x]['exhibits']."&standards=".$_GET['standards']."\">".$exhibit[$x]['exhibits']."</a></td>
                </tr>
                ";
              }?>
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
