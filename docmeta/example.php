<?php
	include("docx_metadata.php");
	$docxmeta = new docxmetadata();
	
	$docxfile = "Bio.docx";
	$docxmeta->setDocument($docxfile);
	echo "<strong>File : ".$docxfile . "</strong><br>";
	echo "Title : " . $docxmeta->getTitle() . "<br>";
	echo "Subject : " . $docxmeta->getSubject() . "<br>";
	echo "Creator : " . $docxmeta->getCreator() . "<br>";
	echo "Keywords : " . $docxmeta->getKeywords() . "<br>";
	echo "Description : " . $docxmeta->getDescription() . "<br>";
	echo "Last Modified By : " . $docxmeta->getLastModifiedBy() . "<br>";
	echo "Revision : " . $docxmeta->getRevision() . "<br>";
	echo "Date Created : " . $docxmeta->getDateCreated() . "<br>";
	echo "Date Modified : " . $docxmeta->getDateModified() . "<br>";
?>