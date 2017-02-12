<?php
  require_once('dbconn.php');
  require_once('header.php');
  
    $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
  }
//  echo $_SESSION['pattern']='[^/\'\\x22]+"';



?>

<html>
<head>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/app.min.js"></script>
  <style>
      .download-content{min-height:500px;padding:15px;margin-right:auto;margin-left:auto;padding-left:15px;padding-right:15px}
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
 <?php 
      require_once ('main-header.php');
?>
  <!-- Left side column. contains the logo and sidebar -->
 <?php 
      require_once ('side-bar-qa.php');
?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
         <section class="content-header">
       <h1>
           <u>Users</u>
        
      </h1>
      </section>
    <section class="download-content">
        <div class="main-content">
        
   
        <a href="#" title="CCIT" class="btn btn-primary" data-toggle="popover" data-trigger="focus"  data-placement="bottom" data-content=" 
        <?php
        $SQL ="SELECT * FROM register where (department='CCIT')AND value=1";
    $ret =  mysql_query($SQL);
    $users = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $users[]=$row;
    }
                                                                                                                                   
        for($x=0;$x<count($users);$x++)
          echo"
            <table >
            
           <td><a href='qa-download-files.php?user=".$users[$x]['fname'].$users[$x]['lname']."'>".$users[$x]['fname'].$users[$x]['lname']."</a></td>
               
            
           </table>
          ";
        ?>">CCIT</a>
          <a href="#" title="Dismissible popover" class="btn btn-primary" data-toggle="popover" data-trigger="focus"  data-placement="bottom" data-content="<?php
        $SQL ="SELECT * FROM register where (department='COE')AND value=1";
    $ret =  mysql_query($SQL);
    $users = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $users[]=$row;
    }
                                                                                                                                   
        for($x=0;$x<count($users);$x++)
          echo"
            <table >
            
           <td><a href='qa-download-files.php?user=".$users[$x]['fname'].$users[$x]['lname']."'>".$users[$x]['fname'].$users[$x]['lname']."</a></td>
          
             
            
           </table>
          ";
        ?>">COE</a>
        <a href="#" title="Dismissible popover" class="btn btn-primary" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="<?php
        $SQL ="SELECT * FROM register where (department='COPS')AND value=1";
    $ret =  mysql_query($SQL);
    $users = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $users[]=$row;
    }
                                                                                                                                   
        for($x=0;$x<count($users);$x++)
          echo"
            <table >
            
           <td><a href='qa-download-files.php?user=".$users[$x]['fname'].$users[$x]['lname']."'>".$users[$x]['fname'].$users[$x]['lname']."</a></td>
          
             
            
           </table>
          ";
        ?>">COPS</a>
            <a href="#" title="Dismissible popover" class="btn btn-primary" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="<?php
        $SQL ="SELECT * FROM register where (department='CIHM')AND value=1";
    $ret =  mysql_query($SQL);
    $users = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $users[]=$row;
    }
                                                                                                                                   
        for($x=0;$x<count($users);$x++)
          echo"
            <table >
            
           <td><a href='qa-download-files.php?user=".$users[$x]['fname'].$users[$x]['lname']."'>".$users[$x]['fname'].$users[$x]['lname']."</a></td>
          
             
            
           </table>
          ";
        ?>">CIHM</a>
            <a href="#" title="Dismissible popover" class="btn btn-primary" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="<?php
        $SQL ="SELECT * FROM register where (department='CBA')AND value=1";
    $ret =  mysql_query($SQL);
    $users = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $users[]=$row;
    }
                                                                                                                                   
        for($x=0;$x<count($users);$x++)
          echo"
            <table >
            
           <td><a href='qa-download-files.php?user=".$users[$x]['fname'].$users[$x]['lname']."'>".$users[$x]['fname'].$users[$x]['lname']."</a></td>
          
             
            
           </table>
          ";
        ?>">CBA</a>
            <a href="#" title="Dismissible popover" class="btn btn-primary" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="<?php
        $SQL ="SELECT * FROM register where (department='CAS')AND value=1";
    $ret =  mysql_query($SQL);
    $users = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $users[]=$row;
    }
                                                                                                                                   
        for($x=0;$x<count($users);$x++)
          echo"
            <table >
            
           <td><a href='qa-download-files.php?user=".$users[$x]['fname'].$users[$x]['lname']."'>".$users[$x]['fname'].$users[$x]['lname']."</a></td>
          
             
            
           </table>
          ";
        ?>">CAS</a>
            <a href="#" title="Dismissible popover" class="btn btn-primary" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="<?php
        $SQL ="SELECT * FROM register where (department='CON')AND value=1";
    $ret =  mysql_query($SQL);
    $users = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $users[]=$row;
    }
                                                                                                                                   
        for($x=0;$x<count($users);$x++)
          echo"
            <table >
            
           <td><a href=/'qa-download-files.php?user=".$users[$x]['fname'].$users[$x]['lname']."/'>".$users[$x]['fname'].$users[$x]['lname']."</a></td>
          
             
            
           </table>
          ";
        ?>">CON</a>
            <a href="#" title="Dismissible popover" class="btn btn-primary" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="<?php
        $SQL ="SELECT * FROM register where (position='QA')AND value=1";
    $ret =  mysql_query($SQL);
    $users = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $users[]=$row;
    }
                                                                                                                                   
        for($x=0;$x<count($users);$x++)
          echo"
            <table >
            
           <td><a href='qa-download-files.php?user=".$users[$x]['fname'].$users[$x]['lname']."'>".$users[$x]['fname'].$users[$x]['lname']."</a></td>
          
             
            
           </table>
          ";
        ?>">QA</a>
            <a href="#" title="Dismissible popover" class="btn btn-primary" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="<?php
        $SQL ="SELECT * FROM register where (position='VPA')AND value=1";
    $ret =  mysql_query($SQL);
    $users = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $users[]=$row;
    }
                                                                                                                                   
        for($x=0;$x<count($users);$x++)
          echo"
            <table >
            
           <td><a href=/'qa-download-files.php?user=".$users[$x]['fname'].$users[$x]['lname']."/'>".$users[$x]['fname'].$users[$x]['lname']."</a></td>
          
             
            
           </table>
          ";
        ?>">VPA</a>
            <a href="#" title="Dismissible popover" class="btn btn-primary" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content="<?php
        $SQL ="SELECT * FROM register where (position='HRD')AND value=1";
    $ret =  mysql_query($SQL);
    $users = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $users[]=$row;
    }
                                                                                                                                   
        for($x=0;$x<count($users);$x++)
          echo"
            <table >
            
           <td><a href='qa-download-files.php?user=".$users[$x]['fname'].$users[$x]['lname']."'>".$users[$x]['fname'].$users[$x]['lname']."</a></td>
          
             
            
           </table>
          ";
        ?>">HR</a>
           
        </table>
        </div>
        </section>
        
    </div>
      <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Education for a fast-changing world
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 FAITH.</strong> All rights reserved.
  </footer>
</div>
    
<script>
$("[data-toggle=popover]")
.popover({html:true})
</script>

</body>
</html>
 