<?php
    require_once("dbconn.php");
    $db=new db();
    $db->Connect();
    session_start();

    $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
    }
    $table=addslashes($_GET['t']);
    $evaluation=addslashes($_GET['e']);
    $exhibit=addslashes($_GET['exhibits']); //1
    $page=$_SESSION['page'];
    $s=$_GET['s']; //2
    $id=$_GET['id'];

    $file=$evaluation."-".$exhibit."-".$s.".php";
    $file2="l2_".$evaluation."-".$exhibit."-".$s.".php";

    unlink($file);
    unlink($file2);
    $query1="DELETE FROM _documents_ WHERE master_exhibit='$exhibit' AND from_which_table='$table' AND evaluation='$evaluation'";
    $ret1=mysql_query($query1);

    echo $query2="DELETE FROM $exhibit WHERE layer='l3' AND tname='$evaluation'";
    $ret2=mysql_query($query2);

    $query="DELETE FROM $exhibit WHERE tname='$table' AND ename='$evaluation' AND eid='$id'";
    $ret=mysql_query($query);
    if($ret)
    {
        header("Location:add-".$page."-".$s.".php?exhibits=".$page."&standards=".$s);
    }
    else
    {
        echo mysql_error();
    }
?>