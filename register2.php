<?php
	session_start();
	require_once("dbconn.php");
	$db=new db();
	$db->Connect();


	$fname=$_POST['textFname'];
	$lname=$_POST['textLname'];
	$position=$_POST['selectPosition'];
	$email=$_POST['textEmail'];	
	$password=$_POST['textPassword'];
	$cpassword=$_POST['textCpassword'];
	echo $captcha=$_POST['captcha'];
	
	echo $_SESSION["vercode"];

	if(!($captcha==$_SESSION["vercode"])){
		$_SESSION['errMsg'] = "Wrong Captcha code";
      	header("Location:login.php"); 
	}else{
$query = "SELECT * FROM register WHERE email = '$email'";
$result = mysql_query($query);
   $num_rows = mysql_num_rows($result);
if ($num_rows>0) {
   $_SESSION['errMsg'] = "The Email <strong>$email</strong> Already Exist";
      header("Location:login.php"); 
}else{
    $message = "Hi $fname, you are now registered to our system. Your account is now upon approval.";
    $headers = "From: no-reply@codeofaninja.com";
    mail("$email", "Attention!!", $message, $headers);
 if($num_rows==0){   
	if(empty($_POST['selectDept'])){
		if($position=='HRD'){
			$SQL="INSERT INTO register(fname,lname,position,email,password,value,image,department) values  ('$fname','$lname','$position','$email','$password',0,'user.png','HRD')";
			$ret = mysql_query($SQL);

			if($ret){
             $_SESSION['scssMsg'] = "You've been registered, wait for the approval.";
			header("Location:login.php");
        }else
        {
			 mysql_error();
        }

		}else if($position=='QA'){
			$SQL="INSERT INTO register(fname,lname,position,email,password,value,image,department) values  ('$fname','$lname','$position','$email','$password',0,'user.png','QA')";
			$ret = mysql_query($SQL);

			if($ret){
				 $_SESSION['scssMsg'] = "You've been registered, wait for the approval.";
				header("Location:login.php");
			}else
				 mysql_error();
				
		}else if($position=='VPA'){
			$SQL="INSERT INTO register(fname,lname,position,email,password,value,image,department) values  ('$fname','$lname','$position','$email','$password',0,'user.png','VPA')";
			$ret = mysql_query($SQL);

			if($ret){
             $_SESSION['scssMsg'] = "You've been registered, wait for the approval.";
			header("Location:login.php");
        }else
        {
			 mysql_error();
        }
				
		}
		else{
			echo mysql_error();
		}
	}else{
		$dept=$_POST['selectDept'];
		$SQL="INSERT INTO register(fname,lname,position,email,password,value,image,department) values  ('$fname','$lname','$position','$email','$password',0,'user.png','$dept')";
		$ret = mysql_query($SQL);
			
		if($ret){
             $_SESSION['scssMsg'] = "You've been registered, wait for the approval.";
			header("Location:login.php");
        }else
        {
			 mysql_error();
        }
    }
 }
}
}
?>