<?php
	require_once("dbconn.php");
    $db = new db();
    $db-> Connect();
    session_start();

     $standard=$_POST['editStandards'];
	$id=$_POST['hiddenId'];  
	$oldStandard=$_POST['hiddenStandard'];

    $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
    }

   


$query = "SELECT * FROM standards WHERE standards=  '$standard'";
    $result = mysql_query($query);
   $num_rows = mysql_num_rows($result);
if ($num_rows>0) {
   $_SESSION['errMsg'] = "<strong>$standard</strong> Already Exist";
      header("Location:edit-standards.php?standards=".$oldStandard."&id=".$id.""); 
}else{

    if($num_rows==0){
	
	$SQL="UPDATE exhibit SET standards='$standard' where standards='$oldStandard'";
	$ret=mysql_query($SQL);
	$SQL="UPDATE standards SET standards='$standard' where id='$id'";
	$ret=mysql_query($SQL);

        if($ret){
            header("Location:standards.php");
        }else{
            echo mysql_error();
        }
    }
}

?>
