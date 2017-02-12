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
	//echo $exhibit=$_SESSION["dbtable"];
	//$page=$_SESSION['page'];
	$standard=$_POST['hiddenStandard'];
	$exhibit=$_POST['hiddenExhibit'];

	$query = "SELECT * FROM etable WHERE tname = '$table'";
$result = mysql_query($query);
   $num_rows = mysql_num_rows($result);
if ($num_rows>0) {
   $_SESSION['errMsg'] = "The table <strong>$table</strong> Already Exist";
      //header("Location:add-".$exhibit.".php?exhibits=".$exhibit."&standards=".$standard);
    header("Location:add-".$exhibit."-$standard.php?exhibits=".$exhibit."&standards=".$standard);
}else{

 if($num_rows==0){   
	
	$SQL="INSERT INTO etable(tname,texhibit,layer) values ('$table','$exhibit','l2')"; 
	$ret = mysql_query($SQL);

	if($ret)
    	header("Location:add-".$exhibit."-$standard.php?exhibits=".$exhibit."&standards=".$standard);
  	else
  echo  $_SESSION['errMsg'] = "Invalid formatt";
      header("Location:add-".$exhibit."-$standard.php?exhibits=".$exhibit."&standards=".$standard);
 }
}





?>