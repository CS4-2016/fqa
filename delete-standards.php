<?php
    require_once("dbconn.php");
    $db = new db();
    $db -> Connect();
    session_start();

    $standards=$_GET['standards'];

    $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
    }
    $SQL="DELETE FROM standards WHERE standards='$standards'";
    $res =  mysql_query($SQL);
    $SQL ="SELECT * FROM exhibit WHERE standards='$standards'";
    $res =  mysql_query($SQL);
    $standardname=array();
    if ($res){
        while ($row = mysql_fetch_assoc($res))
            $standardname[]=$row;
    }
        for ($x=0; $x <count($standardname) ; $x++) { 
            $a=$standardname[$x]['exhibits'];
            $b=explode(" ",$a);
            $c=implode("",$b);
            echo $add='add-'.$a.'-'.$standards.'.php'; echo "<br>";
            echo $vl2=$a.'-'.$standards.'.php';
            unlink($add);
            unlink($vl2);
            $SQL="DELETE FROM etable WHERE texhibit='$c'";
            $ret = mysql_query($SQL);
            $SQL="DELETE FROM exhibit WHERE standards='$standards'";
            $ret = mysql_query($SQL);
            $SQL="SELECT * FROM $c";
            $ret = mysql_query($SQL);
            $link=array();
            if ($ret){
                while ($row = mysql_fetch_assoc($ret))
                    $link[]=$row;
            }
            for ($i=0; $i <count($link) ; $i++){
                $linka=$link[$i]['ename']."-".$c."-".$standards;
                $linkb='l2_'.$linka.'.php';
                $linkc=$linka.'.php';
                unlink($linkb);
                unlink($linkc);
            }
             $SQL=("DROP TABLE thesis.$c");
             $ret = mysql_query($SQL);
             if($ret){
                header('Location:standards.php');
             }else{
                echo mysql_error();
             }
        }
        header('Location:standards.php');
?>
