<?php
	require_once("dbconn.php");
	$db=new db();
	$db->Connect();
    session_start();
    
    $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
  }


     $table=$_POST['textTable'];    
	$_SESSION["dbtable"];
	$exhibit=$_SESSION["dbtable"];

	 $SQL="INSERT INTO evaluationname(tname,texhibit) values ('$table','$exhibit')"; 
	$ret = mysql_query($SQL);
?>