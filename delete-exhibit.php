<?php
    require_once("dbconn.php");
    $db = new db();
    $db -> Connect();
    session_start();

    $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
    }
    $standards=$_GET['standards']; //2
    $SQL ="SELECT * FROM exhibit";
    $res =  mysql_query($SQL);
    $exhibits = array();
    $tblname =$_GET["exhibits"]; //1
    $input=$tblname;
    $a=explode(" ", $input);
    $exhibit=implode("", $a);

    $query ="SELECT * FROM $exhibit"; 
    $ret =  mysql_query($query);
    $link = array();

    if ($ret){
        while ($row = mysql_fetch_assoc($ret))
             $link[]=$row;
    }

    for($x=0;$x<count($link);$x++){
        echo $link[$x]['ename'];
        unlink($link[$x]['ename']."-".$exhibit."-".$standards.".php");
        unlink('l2_'.$link[$x]['ename']."-".$exhibit."-".$standards.".php");
    }



    $table=$tblname;
    $file=$table."-".$standards.".php";
    $file2="add-".$table."-".$standards.".php";


    echo unlink($file);
    echo unlink($file2);
//    $query1="DELETE FROM _documents_ WHERE master_exhibit='$exhibit'";
//    $ret1=mysql_query($query1);

    //echo $db=$_SESSION['dbtable'];
    if ($res)
    {
        while ($row = mysql_fetch_assoc($res))
            $exhibits[]=$row;
        $SQL1=mysql_query("DROP TABLE thesis.$exhibit");
        $SQL="DELETE FROM exhibit WHERE exhibits='$tblname'";
        $SQL2="DELETE FROM etable WHERE texhibit='$tblname'";
        $ret2 = mysql_query($SQL2);
        $ret = mysql_query($SQL);
        if($ret)
        {
            $exhibit1=explode(" ", $_GET['exhibits']);
            $exhibit1=implode("", $exhibit1);
            $query="DELETE FROM _documents_ WHERE master_exhibit='$exhibit1';";
            mysql_query($query);
            $query="DELETE FROM _documents3_ WHERE master_exhibit='$tblname';";
            mysql_query($query);
            header("Location:qa-crud.php?standards=".$standards);
        }
        else
            echo mysql_error();
        
    }
    else
        echo mysql_error();
?>
