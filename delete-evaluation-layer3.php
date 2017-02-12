<?php
    require_once("dbconn.php");
    $db=new db();
    $db->Connect();
    session_start();
    
    $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
    }
    $column=$_GET['column'];//1
    $exhibit=$_GET['dbtable'];
    $ename=$_GET['ename'];
    $id=$_GET['id'];
    echo $s=$_GET['standards'];//3
    $ex=$_GET['exhibits'];
    $a=explode(" ",$ex);
    $ex=implode("",$a); //2

    echo $query1="DELETE FROM _documents3_ WHERE from_which_l2_eval='$column' AND l3_evaluation='$ename'";
    $ret1=mysql_query($query1);
    if($query1){
    echo $query="DELETE FROM $exhibit WHERE tname='$column' AND ename='$ename' AND eid='$id'";
    $ret=mysql_query($query);
    if($ret)
    {
     
        header("Location:l2_".$column."-".$ex."-".$s.".php?ename=".$column."&standards=".$s."&exhibits=".$ex);
    }
    else
    {
        echo mysql_error();
    }
    }else{
        echo mysql_error();
    }
?>