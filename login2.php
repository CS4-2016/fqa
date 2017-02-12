<?php
    require_once("dbconn.php");
    $db=new db();
    $db->Connect();
    session_start();
    
    $email=$_POST['textEmail'];
    $password=$_POST['textPassword'];
    
    addslashes($email);
    addslashes($password);

    
    $query="SELECT * FROM register WHERE email='$email' AND password='$password'";
    $ret=mysql_query($query);

    $SQL="SELECT position, department FROM register WHERE email='$email' AND password='$password'";
    $res=mysql_query($SQL);

    if ($res){
        $row = mysql_fetch_assoc($res);
        $position=$row['position'];
        $department=$row['department'];
        $_SESSION['position']=$position;
        $_SESSION['department']=$department;
    }
    else{
        echo mysql_error();
    }
    

    $ret=mysql_fetch_assoc($ret);
    if($ret)
    {
        if($ret['value']==0)
        {
            $_SESSION['note']="<div class='alert alert-danger' style='text-align: center;'>Your account is still under verification and therefore cannot log in.</div>";
            header("Location: login.php");
        }
        else if($ret['value']==1)
        {
            if($position=='Dean'||$position=='Chair' || $position=='VPA'){
                $_SESSION['login']=$email;
                header("Location:acad-index.php");
            }
            else if($position=='QA'){
                $_SESSION['login']=$email;
                header("Location:qa-index.php"); 
            }
            else if($position=='HRD'){
                $_SESSION['login']=$email;
                header("Location:hrd-index.php"); 
            }
        }else if($ret['value']==3){
            $_SESSION['note']="<div class='alert alert-danger' style='text-align: center;'>Your account has been deactivated.</div>";
            header("Location: login.php");
        }
        
        
    }
    else
    {
        $_SESSION['note']="<div class='alert alert-danger' style='text-align: center;'>Incorrect name or password.</div>";
        header("Location: login.php");
    }   
    
    /*if($email== && $password==$passwordArray[$i])
    {
        $_SESSION['loggedOnEmail']=$email;
        $_SESSION['pwd']=$password;
        header("Location: index.php");
    }
    else
    {
        $_SESSION['nologin']="<div class='alert alert-danger'>Invalid email or password.</div>";
        header("Location: login.php");
    } */
    /* END PART */
?>