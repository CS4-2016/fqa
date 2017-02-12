<?php
	require_once("dbconn.php");
    $db = new db();
    $db-> Connect();
    session_start();

    $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
    }
	echo $standards=$_POST['hiddenStandard']; //2
	$id=$_POST['hiddenId'];
    $old=$_POST['hiddenExhibit'];//1
	$new=$_POST['textExhibit'];
	rename("add-".$old."-".$standards.".php","add-".$new."-".$standards.".php");

   $query = "SELECT * FROM exhibit WHERE exhibits=  '$new'";
    $result = mysql_query($query);
   $num_rows = mysql_num_rows($result);
if ($num_rows>0) {
   $_SESSION['errMsg'] = "<strong>$new</strong> Already Exist";
      header("Location:edit-exhibit.php?standards=".$standards."&id=".$id.""); 
}else{
    
    $new1=explode(" ", $new);
    $new1=implode("", $new1);
    
    $old1=explode(" ", $old);
    $old1=implode("", $old1);
    
    if($num_rows==0){

	$SQL="UPDATE exhibit SET exhibits='$new' WHERE id='$id'";
	$ret=mysql_query($SQL);
  echo $query3="UPDATE _documents_ SET master_exhibit='$new1' where master_exhibit='$old1'";
  $ret3=mysql_query($query3);
    echo $query3="UPDATE _documents3_ SET master_exhibit='$new' where master_exhibit='$old'";
  $ret3=mysql_query($query3);
	$query="UPDATE etable SET texhibit='$new' WHERE texhibit='$old'";
	$res=mysql_query($query);

	rename($old."-".$standards.".php",$new."-".$standards.".php");

 	$input=$old;
    $a=explode(" ", $input);
    $olddb=implode("", $a); 

	$input2=$new;
    $b=explode(" ", $input2);
    $newdb=implode("", $b); 

        mysql_query( "RENAME TABLE `" . $olddb . "` TO `" . $newdb . "`" );
        if($ret)
            header("Location:qa-crud.php?standards=$standards");
        else 
              echo mysql_error();
    }
}
?>
