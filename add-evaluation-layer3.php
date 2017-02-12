<?php
  require_once("dbconn.php");
  $db=new db();
  $db->Connect();
  session_start();  

  $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
    }
    
    $evaluation=$_POST['textEvaluation']; 
    $hidden=$_POST['hiddenColumn'];    
    $page=$_SESSION['dbtable'];
    $s=$_POST['hiddenStandard'];
    $ex=$_POST['hiddenExhibits'];
    $a=explode(" ", $ex);
    $exhi=implode("",$a);

    $query = "SELECT * FROM $page WHERE ename = '$evaluation' AND tname='$hidden'";
    $result = mysql_query($query);
    $num_rows = mysql_num_rows($result);
if ($num_rows>0) {
   $_SESSION['errMsg'] = "The name <strong>$evaluation</strong> Already Exist";
    header("Location:l2_".$hidden."-".$exhi."-".$s.".php?ename=".$hidden."&standards=".$s."&exhibits=".$ex);
}else{
  echo $SQL="INSERT INTO $page(ename,tname,layer) values ('$evaluation','$hidden','l3')"; 
  $ret = mysql_query($SQL);

  if($ret)
    {
        header("Location:l2_".$hidden."-".$exhi."-".$s.".php?ename=".$hidden."&standards=".$s."&exhibits=".$ex);
    }
   else
    {
       mysql_error();
       echo $_SESSION['errMsg'] = "<strong>\ '</strong> are not allowed";
       header("Location:l2_".$hidden."-".$exhi."-".$s.".php?ename=".$hidden."&standards=".$s."&exhibits=".$ex);
    }
}
?>