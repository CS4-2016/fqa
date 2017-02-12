<?php
    require_once("dbconn.php");
    $db=new db();
    $db->Connect();
    session_start();

    $oldemail=$_SESSION['login'];
    $email=$_POST['textEmail'];
    $fname=$_POST['textFname'];
    $lname=$_POST['textLname'];
    $oldpassword=$_POST['oldPassword'];
    $newpassword=$_POST['password'];
    $image=$_FILES['imgUpload']['name'];
    $password=$_POST['hiddenId'];
    $folder="img/";

    if(!($oldemail==$email)){
    $message = "Hi $fname, your email has been changed";
    $headers = "From: no-reply@codeofaninja.com";
    mail("$email", "Attention!!", $message, $headers);
    }else{
        echo'ds';
    }
   $_SESSION['login']=$email;
    

 if($password==$oldpassword){       
       if(empty($newpassword) AND empty($image)){
            echo $query="UPDATE register SET email='$email', fname='$fname', lname='$lname' WHERE email='$oldemail'";
            $ret=mysql_query($query);
           if($ret)
            {
                $_SESSION['scssMsg'] = "You have successfully edit your profile.";
                header("Location:view-profile.php");
            }
            else
            {
                echo mysql_error();
            }
        }else if(empty($newpassword)){
            echo $query="UPDATE register SET email='$email', fname='$fname', lname='$lname',image='$image' WHERE email='$oldemail'";
            $ret=mysql_query($query);
           if($ret)
            {
                move_uploaded_file ($_FILES['imgUpload']['tmp_name'],$folder.$image);
                header("Location:view-profile.php");
            }
            else
            {
                echo mysql_error();
            }
        }else if(empty($image)){
            echo $query="UPDATE register SET email='$email', fname='$fname', lname='$lname',password='$newpassword' WHERE email='$oldemail'";
            $ret=mysql_query($query);
           if($ret)
            {
               echo $_SESSION['scssMsg'] = "You have successfully edit your profile.";
                header("Location:view-profile.php");
            }
            else
            {
                echo mysql_error();
            }
        }else{
            echo $query="UPDATE register SET email='$email', fname='$fname', lname='$lname', password='$newpassword',image='$image' WHERE email='$oldemail'";
            $ret=mysql_query($query);
            if($ret)
            {
                move_uploaded_file($_FILES['imgUpload']['tmp_name'],$fodler.$image);
               echo $_SESSION['scssMsg'] = "You have successfully edit your profile.";
                header("Location:view-profile.php");
            }
            else
            {
                echo mysql_error();
            }
        }
    }
else{
     echo $_SESSION['errMsg'] = "Wrong Password";
    header("Location:edit-profile.php"); 
}
  
?>
