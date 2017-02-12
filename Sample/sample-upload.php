 <?php 
	require_once('dbconn.php');
		echo "<form method=\"POST\" action=\"sample-upload2.php\" enctype=\"multipart/form-data\">
		 	 <input type=\"file\" name=\"fileUpload\" accept=\"application/pdf,application/vnd.ms-excel\"> <br><br>
		 	<input type='submit' value='Submit file'> 
		 </form>";
 ?>