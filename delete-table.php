<?php
    require_once("dbconn.php");
    $db=new db();
    $db->Connect();
    session_start();

    $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
    }

    $table=$_GET['tname'];
    $dbtable=$_GET['table'];
    $id=$_GET['id'];
    $page=$_GET['page'];
    $s=$_GET['standards'];

    $input=$dbtable;
    $a=explode(" ", $input);
    $exhibit=implode("", $a);

    echo $query ="SELECT * FROM $exhibit where tname='$table'";
    $ret =  mysql_query($query);
    $link = array();

   if ($ret){
        while ($row = mysql_fetch_assoc($ret))
            $link[]=$row;
    }

    for($x=0;$x<count($link);$x++){
        echo $link[$x]['ename'];
        unlink($link[$x]['ename']."-".$exhibit."-".$s.".php");
        unlink("l2_".$link[$x]['ename']."-".$exhibit."-".$s.".php");
    }
   
        $SQL="DELETE FROM etable WHERE tid='$id'";
        $res=mysql_query($SQL);

        $query1="DELETE FROM _documents_ WHERE master_exhibit='$exhibit' AND from_which_table='$table'";
        $ret1=mysql_query($query1);

        $query="DELETE FROM $exhibit WHERE tname='$table'";
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