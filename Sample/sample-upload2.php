 <?php 
	require_once('dbconn.php');
 	$db = new db();
	$db -> Connect(); 

	$file=$_FILES['fileUpload']['name'];
	$folder="img/";
	

	$SQL = "INSERT INTO sampleupload (filename) values ('$file')";
    $result = mysql_query($SQL);

    if($result){
    	move_uploaded_file ($_FILES['fileUpload']['tmp_name'],$folder.$file);
    	header("Location: sample-upload.php");
    }
    else
    	echo mysql_error();

 ?>