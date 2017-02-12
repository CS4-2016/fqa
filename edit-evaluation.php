<?php
    require_once('header.php');
    $db = new db();
    $db -> Connect();
    if(!isset($_GET['edit']))
    {
        show_404();
    }

    $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
    }

    require_once('header.php');
    require_once('dbconn.php');
    $exhibits=$_GET['exhibits'];
    $table=$_GET['t'];
    $e=$_GET['e'];
    $id=$_GET['id'];
    $page=$_GET['page'];
    $standards=$_GET['s'];
    //$exhi=$_GET['exhibit'];
    $SQL ="SELECT * FROM $exhibits WHERE tname='$table'";
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
          <u>Edit Section Name</u>
        
      </h1>
      </section>
    <section class="contents">
        <div class="main-content">
                 <?php 
                           if(!empty($_SESSION['errMsg'])) { ?>
                            <div class="alert alert-danger fade in">
                            <?php echo $_SESSION['errMsg'];?>
                            </div>
                        <?php 
                            unset($_SESSION['errMsg']);
                  } ?>
             <h4> <strong><?php echo $table; ?></strong></h4>
            <table  class="table-striped table-hover table">
           
                 <thead>  
              <tr style="background-color: #DDDDDD; border-bottom: 4px solid #3c8dbc;">
                  <td><strong>Sections</strong></td>  
                  <td><strong>Actions</strong></td>  
            </tr>
                </thead>
            <?php
                for($i=0; $i<count($exhibit); $i++)
                {
                    echo "<tr>";
                    if($exhibit[$i]['ename']==$e)
                    {
                    //   echo $e;
                        echo "<form method='POST' action='edit-evaluation2.php'>";
                        echo "<input type='hidden' name='t' value='".$table."'>";
                        echo "<input type='hidden' name='e' value='".$e."'>";
                        echo "<input type='hidden' name='ex' value='".$exhibits."'>";
                        echo "<input type='hidden' name='old' value='".$exhibit[$i]['ename']."'>";
                        echo "<td><input type='text' class='form-control' name='new-name' value='".$exhibit[$i]['ename']."' /></td>";
                        echo "<td><input type='submit' class='btn btn-primary' value='Save'  Onclick=\"return confirm('Do you want to save the data')\"/> <a href=\"add-".$page.".php?exhibits=".$page."&standards=".$standards."\"><input type='button' class='btn btn-danger' value='Cancel' /></a></td>";
                        echo "<input type='hidden' name='hiddenId' value='".$id."'>";
                        echo "<input type='hidden' name='hiddenStandards' value='".$standards."'>";
                        echo "</form>";
                    }
                    else
                    {
                        echo "<td>".$exhibit[$i]['ename']."</td>";
                        echo "<td></td>";
                    }
                    
                    echo "</tr>";
                }
            ?>
            </table>
        </div>
  </section>

    <div class="exhibit-content">
      <div class="container-fluid">
      	<div div="row">
      		<div class="col-md-6">

      		</div>

      	</div>
      </div>
    </div>
  
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php
    require_once('footer.php');
  ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->



<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
