<?php
    $recipient=$_POST['textEmail'];
    require_once("dbcon-pdo.php");
    $dbcon=new PDO('mysql:host='.$GLOBALS['host'].';dbname='.$GLOBALS['dbase'], $GLOBALS['lin'], $GLOBALS['pwd']);
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $state=$dbcon->prepare("SELECT password FROM register WHERE email=?");
    $state->execute(array($recipient));
    $p=$state->fetchAll();

    mail($p[0]['email'], "Testaeng", "Your password is :".$p[0]['password']);
    if(!$p)
    {
        $_SESSION['errMsg']="<div class='alert alert-danger'>Sorry, the email provided doesn't match with any active account.</div>";
        header("Location: forgot.php");
    }
    else
    {
        $_SESSION['note1']="<div class='alert alert-success'>An email has been sent to the provided email address.</div>";
        header("Location: forgotsuccess.php");
    }
?>