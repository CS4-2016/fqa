<?php
    require_once("dbconn.php");
    $db = new db();
    $db -> Connect();
    session_start();
      $position=$_SESSION['position'];
      if(!($position=='HRD')){
        header("Location:404-message.php");
      }
    $id=$_GET['id'];
    $SQL ="SELECT * FROM register where value=0";
    $res =  mysql_query($SQL);
    $users = array();
    
    $email=$_GET['email'];
    $fname=$_GET['fname'];

    $message = "Hi $fname, your account has been approved.";
    $headers = "From: no-reply@codeofaninja.com";
    mail("$email", "Attention!!", $message, $headers);



    if ($res){
        while ($row = mysql_fetch_assoc($res))
            $users[]=$row;
    }

    $SQL="UPDATE `register` SET `value`=1 where id=$id";

    $ret = mysql_query($SQL);
  
    if($ret)
        header("Location:approve-users.php");
    
    else
        echo mysql_error();

?>                      