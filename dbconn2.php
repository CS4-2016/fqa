<?php     
    if(empty($_SESSION['username'])){
        header("Location: login.php");
    }
    
    require_once("dbconn.php");

    $db = new db();
	$db -> Connect(); 
?> 