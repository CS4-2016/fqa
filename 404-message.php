<?php
	session_start();
  require_once('dbconn.php');
  $db=new db();
  $db->Connect();

    if(!isset($_SESSION['login']))
  {
      $_SESSION['note']="<div class='alert alert-warning' style='text-align: center;'>You must log in first.</div>";
      header("Location: login.php");
  }
?>
<link rel="stylesheet" href="css/404.css">
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- ####################################################################################################### -->
    <!-- ####################################################################################################### -->
    <!-- ####################################################################################################### -->
    <!-- ####################################################################################################### -->
    <section id="fof" class="clear">
      <!-- ####################################################################################################### -->
      <div class="fl_left">
        <h1><span>404 Error</span><strong>?</strong></h1>
      </div>
      <div class="fl_right">
        <h2>Sorry, Possible Reasons:</h2>
        <ul>
          <li>In at nulla at lectus pulvinar commodo id et neque.</li>
          <li>Suspendisse sed ipsum nec nisi fringilla molestie.</li>
          <li>Sed tincidunt turpis at mauris interdum vitae fringilla urna posuere.</li>
          <li>Vivamus et lorem enim, vel placerat nulla.</li>
          <li>Ut interdum pharetra lorem, quis placerat purus dapibus in.</li>
        </ul>
      </div>
      <p><a class="go-back" href="javascript:history.go(-1)">&laquo; Go Back</a> <strong>OR</strong> 
      <?php
      	if($_SESSION['position']=='QA'){
      	echo '<a class="go-home" href="qa-index.php">Go Home &raquo;</a></p>';
      }else if($_SESSION['position']=='HRD'){
      	echo '<a class="go-home" href="hrd-index.php">Go Home &raquo;</a></p>';
      }else if($_SESSION['position']=='Dean' || $_SESSION['position']=='Chair' || $_SESSION['position']=='VPA'){
      	echo '<a class="go-home" href="acad-index.php">Go Home &raquo;</a></p>';
      }

      ?>
      <!-- ####################################################################################################### -->
    </section>
    <!-- ####################################################################################################### -->
    <!-- ####################################################################################################### -->
    <!-- ####################################################################################################### -->
    <!-- ####################################################################################################### -->
  </div>
</div>