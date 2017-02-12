<?php
    require_once('header.php');
    require_once('dbconn.php');
    require_once("dbcon-pdo.php");
    $db = new db();
    $db -> Connect();
    $position=$_SESSION['position'];
    $user=$_SESSION['login'];
    $standards=array();
    
    $dbcon=new PDO('mysql:host='.$GLOBALS['host'].';dbname='.$GLOBALS['dbase'], $GLOBALS['lin'], $GLOBALS['pwd']);
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    function dumpArray($a)
    {
        echo "<pre>";
            print_r($a);
        echo "</pre>";
        
    }
    function getFile($standard, $user, $level)
    {
        try
        {
            $dbcon=new PDO('mysql:host='.$GLOBALS['host'].';dbname='.$GLOBALS['dbase'], $GLOBALS['lin'], $GLOBALS['pwd']);
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if($level=="l2")
                $state=$dbcon->prepare("SELECT * FROM _documents_ WHERE standard=? AND uploaded_by=?;");
            else if($level=="l3")
                $state=$dbcon->prepare("SELECT * FROM _documents3_ WHERE standard=? AND uploaded_by=?;");
                
            $state->execute(array($standard, $user));
            $s=$state->fetchAll();            
//          $state=null;
            return $s;
        }
        catch(PDOException $e)
        {
            $e->getMessage();
        }
    }
    try
    {
        $state=$dbcon->prepare("SELECT standards FROM standards;");
        $state->execute();
        $standards=$state->fetchAll();
        $state=null;
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
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
          <u>Uploaded Files</u>
        
      </h1>
      </section>
      
<section class="content">
    <?php $g=array();
    echo '<div class="main-content">';
        for($i=0; $i<count($standards); $i++)
        {
            $g=getFile($standards[$i]['standards'], $user, "l3");
            echo '
            '.$standards[$i]['standards'].'
            <table class="table-hover table table-striped">
            <thead>
              <tr style="background-color: #DDDDDD; border-bottom: 4px solid #3c8dbc;">
                <th>Categories</th>
                <th>File Name</th>
                <th>Action</th>
              </tr>
            </thead>';
            for($j=0;$j<count($g);$j++)
            echo '
            <tr>
            <td>'.$g[$j]['master_exhibit'].'</td>
            <td>'.$g[$j]['docname'].'</td>
            <td><a href="download1.php?link='.$g[$j]['doc_link'].'"><input type="button" name="downloadFile" class="btn btn-primary" value="Download file"></a></td>
            </tr>';
                
          echo '</table>';
        
        }
    echo '</div>';        
            
    ?>
  </section>
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
<?php 
      require_once ('footer.php');
?>
</div>

</body>
</html>
