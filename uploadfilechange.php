<?php
    session_start();
    require_once("EditUpload.php");
    require_once("docmeta/docx_metadata.php");
    $email=null;
    try
    {
        $dbcon=new PDO('mysql:host='.$GLOBALS['host'].';dbname='.$GLOBALS['dbase'], $GLOBALS['lin'], $GLOBALS['pwd']);
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $state=$dbcon->prepare("SELECT email FROM register WHERE department='QA' AND value=1;");
        $state->execute();
        $row=$state->fetchAll();
        $email=$row[0]['email'];
        print_r($row);
    }
    catch(PDOException $le)
    {
        echo $le->getMessage();
    }
    
    $s=$_POST['s'];
    $ex=$_POST['e'];
    $pos=$_SESSION['position'];
    $cleanPOST=array();
    $cleanFILES=array();
    $e=$_POST['e'];
    for($i=0; $i<count($_FILES['uploadedfile']['name']); $i++)
    {
        if($_FILES['uploadedfile']['size'][$i]>148480)
        {
            if($_FILES['uploadedfile']['name'][$i])
            {
                $cleanPOST['uploaded-by'][]=$_POST['uploaded-by'][$i];
                $cleanPOST['exhibit'][]=$_POST['exhibit'][$i];
                $cleanPOST['t'][]=$_POST['t'][$i];
                $cleanPOST['level'][]=$_POST['level'][$i];
                $cleanPOST['master-exhibit'][]=$_POST['master-exhibit'][$i];
                $cleanPOST['department'][]=$_SESSION['department'];
                $cleanPOST['position'][]=$_SESSION['position'];

                $cleanFILES['uploadedfile']['name'][]=$_FILES['uploadedfile']['name'][$i];
                $cleanFILES['uploadedfile']['type'][]=$_FILES['uploadedfile']['type'][$i];
                $cleanFILES['uploadedfile']['tmp_name'][]=$_FILES['uploadedfile']['tmp_name'][$i];
                $cleanFILES['uploadedfile']['error'][]=$_FILES['uploadedfile']['error'][$i];
                $cleanFILES['uploadedfile']['size'][]=$_FILES['uploadedfile']['size'][$i];
            }
        }
        else
        {
            $_SESSION['note']="<div class='alert alert-danger'>Upload failed; document is empty.</div>";
            header("Location: ".$e."-".$s.".php?&exhibits=".$e."&standards=".$s);
        }
        
    }
    
    $Evaluation=new EditUploadFile();
    
    $Evaluation->setUploaders($cleanPOST['uploaded-by']);
    $Evaluation->setEvaluations($cleanPOST['exhibit']);
    $Evaluation->setTables($cleanPOST['t']);
    $Evaluation->setDepartment($cleanPOST['department']);
    $Evaluation->setPosition($cleanPOST['position']);
    $Evaluation->setExhibit($cleanPOST['master-exhibit']);
    $Evaluation->setFiles($cleanFILES['uploadedfile']);
    $Evaluation->setLevel($cleanPOST['level']);
    $Evaluation->getMetadata();
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
//    print_r($_FILES['uploadedfile']);
//       print_r($Evaluation->getArray());
    echo "</pre>";
    //   echo file_get_contents($_FILES['uploadedfile']['tmp_name']);
    if($Evaluation->sendToDB()==true)
    {
                $_SESSION['d'];
        for($x=0;$x<count($_SESSION['d']);$x++)
        {
            $link=$_SESSION['d'][$x];
            $message = $link;
            $headers = "From: no-reply@codeofaninja.com";
            echo $email;
            mail($email, "File Download Link", $message, $headers);
        }
        $_SESSION['note']="<div class='alert alert-success'>Document changed successfully.</div>";
        header("Location: ".$e."-".$s.".php?&exhibits=".$e."&standards=".$s);
    }
?>