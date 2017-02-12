<?php
	session_start();
	if($_SESSION['position']=='QA' || $_SESSION['position']=='VPA')
	{
		require_once("QA-rep.php");
	}
	
	// if not QA or VPA
	else
	{
		require_once("NQA-rep.php");
	}
?>