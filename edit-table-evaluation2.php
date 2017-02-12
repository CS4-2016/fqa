<?php
    require_once("dbconn.php");
    $db=new db();
    $db->Connect();
    session_start();

    $oldname=$_POST['hiddenTable'];
    $newname=$_POST['textTable'];
    $page=$_POST['hiddenPage']; //1
    $id=$_POST['hiddenId'];
    $s=$_POST['hiddenStandards']; //2


    $input=$page;
    $a=explode(" ", $input);
    $dbtable=implode("", $a); 

$query = "SELECT * FROM etable WHERE tname  = '$newname'";
$result = mysql_query($query);
   $num_rows = mysql_num_rows($result);
if ($num_rows>0) {
   $_SESSION['errMsg'] = "The tablename <strong>$newname</strong> Already Exist";
       header("Location:edit-table-evaluation.php?tname=".$oldname."&table=".$page."&id=".$id."&standards=".$s);
}else{

 if($num_rows==0){  

	$SQL="UPDATE $dbtable SET tname='$newname' WHERE tname='$oldname'";
    $res=mysql_query($SQL);
    echo $query3="UPDATE _documents_ SET from_which_table='$newname' where from_which_table='$oldname'";
    $ret3=mysql_query($query3);
    $query="UPDATE etable SET tname='$newname' WHERE tid='$id'";
    $ret=mysql_query($query);



    if($ret)
    {
        header("Location:add-".$page."-".$s.".php?exhibits=".$page."&standards=".$s);
    }
    else
    {
        echo mysql_error();
    }
 }
}
?>
