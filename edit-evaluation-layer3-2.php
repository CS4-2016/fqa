<?php
    require_once("dbconn.php");
    $db=new db();
    $db->Connect();
    session_start();

    $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
    }

    $oldcell=$_POST['hiddenCell'];
    $newcell=$_POST['textTable'];
    $column=$_POST['hiddenTable'];
    $dbtable=$_POST['hiddenDbtable'];
    $id=$_POST['hiddenId'];
    echo $s=$_POST['hiddenStandards'];
    $ex=$_POST['hiddenExhibits'];

    $query = "SELECT * FROM $dbtable WHERE  ename=  '$newcell'";
    $result = mysql_query($query);
   $num_rows = mysql_num_rows($result);
if ($num_rows>0) {
    $_SESSION['errMsg'] = "<strong>$newcell</strong> Already Exist";
    header("Location:edit-evaluation-layer3.php?column=".$column."&dbtable=".$dbtable."&ename=".$oldcell."&id=".$id."&standards=".$s."&exhibits=".$ex); 
}else{

    if($num_rows==0){
    
    $query1="UPDATE _documents3_ SET l3_evaluation='$newcell' WHERE from_which_l2_eval='$column' AND l3_evaluation='$oldcell'";
    $ret1=mysql_query($query1);

    if($ret1){

    $query="UPDATE $dbtable SET ename='$newcell' WHERE tname='$column' AND ename='$oldcell' AND eid=$id";
    $ret=mysql_query($query);



            if($ret)
            {
                header("Location:l2_".$column."-".$dbtable."-".$s.".php?ename=".$column."&standards=".$s."&exhibits=".$ex);
            }
            else
            {
                echo mysql_error();
            }
        }else{
            $_SESSION['errMsg'] = "Invalid input";
            header("Location:edit-evaluation-layer3.php?column=".$column."&dbtable=".$dbtable."&ename=".$oldcell."&id=".$id."&standards=".$s."&exhibits=".$ex);
        }
    }
}
?>
