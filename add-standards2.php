<?php
  require_once("dbconn.php");
  $db=new db();
  $db->Connect();
  session_start();

  $standards=$_POST['textStandards'];
    
$query = "SELECT * FROM standards WHERE standards = '$standards'";
$result = mysql_query($query);
$num_rows = mysql_num_rows($result);
if ($num_rows>0) {
   $_SESSION['errMsg'] = "The standard name <strong>$standards</strong> Already Exist";
      header("Location:add-standards.php"); 
}else{

 if($num_rows==0){   
      $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
    }

    $SQL="INSERT INTO standards(standards) values ('$standards')"; 
    $ret = mysql_query($SQL);

    if($ret){
      header("Location:standards.php");
    }else{
      $_SESSION['errMsg'] = "Invalid input";
      header("Location:add-standards.php");
    }
 }
}
?>