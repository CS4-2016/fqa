<?php
    require_once("dbconn.php");
    $db = new db();
    $db -> Connect();
    session_start();
    $id=$_GET['id'];
    $value=$_GET['value'];
    $SQL ="SELECT * FROM register where value=0";
    $res =  mysql_query($SQL);
    $users = array();

    $position=$_SESSION['position'];
    if(!($position=='HRD')){
      header("Location:404-message.php");
    }

    if ($res){
        while ($row = mysql_fetch_assoc($res))
            $users[]=$row;
    }

    $SQL="DELETE FROM register WHERE id=$id";

    $ret = mysql_query($SQL);
  
    if($ret){
        if($value=1){
            header("Location:approve-users.php");
        }else if($value=3){
            header("Location:restore-users.php");
        }
    }
    else
        echo mysql_error();

?>