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
  $SQL ="SELECT * FROM exhibit where id='$id'";
    $ret =  mysql_query($SQL);
    $exhibit = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $exhibit[]=$row;
    }
    $standards=$_GET['standards'];
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

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
      <h1>
          <u>Edit Category Name</u>
        
      </h1>
      </section>
    <section class="contents">
    
     
        <form method="POST" action="edit-exhibit2.php" id="form">
          <div class="main-content">
              <?php 
                           if(!empty($_SESSION['errMsg'])) { ?>
                            <div class="alert alert-danger fade in">
                            <?php echo $_SESSION['errMsg'];?>
                            </div>
                        <?php 
                            unset($_SESSION['errMsg']);
                        } ?>
           
            <table  class="table-hover table table-striped">
              <thead>
                <tr style="background-color: #DDDDDD;  border-bottom: 4px solid #3c8dbc;">
                <th>Categories</th>
                <th>Actions</th>
              </tr>
                </thead>
              <?php
              echo "<input type='hidden' value=\"".$id."\" name=\"hiddenId\">
              <input type='hidden' value=\"".$standards."\" name=\"hiddenStandard\">";
              for($x=0;$x<count($exhibit);$x++){
                echo"
                  <tr> 
                    <td><input type=\"text\" value=\"".$exhibit[$x]['exhibits']."\" name=\"textExhibit\" placeholder=\"Edit Exhibit\" required class=\"form-control\" required  >
                  <input type='hidden' value=\"".$exhibit[$x]['exhibits']."\" name=\"hiddenExhibit\">
                    </td>
                    <td>
                    <input type=\"submit\" value=\"Save\" class=\"btn btn-primary\" Onclick=\"return confirm('Do you want to save the data')\"></a>
                    <a href=\"qa-crud.php?standards=".$standards."\"><input type=\"button\" value=\"Cancel\" class=\"btn btn-danger delete-exhibit\"></a>
                  </td>
                </tr>
                ";
              }?>
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

