<?php
    session_start();
//    error_reporting(-1);
    require_once("Upload.php");
    require_once("docmeta/docx_metadata.php");
    require_once("dbcon-pdo.php");
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
    $s=$_POST['hiddenStandards'];
    $ex=$_POST['hiddenExhibits'];
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
                $cleanPOST['dept'][]=$_POST['dept'][$i];
                $cleanPOST['exhibit'][]=$_POST['exhibit'][$i];
                $cleanPOST['s'][]=$s;
                $cleanPOST['t'][]=$_POST['t'][$i];
                $cleanPOST['level'][]=$_POST['level'][$i];
                $cleanPOST['master-exhibit'][]=$_POST['master-exhibit'][$i];
                $cleanPOST['position'][]=$pos;

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
    
    $Evaluation=new UploadFile();
    
    $Evaluation->setUploaders($cleanPOST['uploaded-by']);
    $Evaluation->setDepartment($cleanPOST['dept']);
    $Evaluation->setPosition($cleanPOST['position']);
    $Evaluation->setStandard($cleanPOST['s']);
    $Evaluation->setEvaluations($cleanPOST['exhibit']);
    $Evaluation->setTables($cleanPOST['t']);
    $Evaluation->setExhibit($cleanPOST['master-exhibit']);
    $Evaluation->setFiles($cleanFILES['uploadedfile']);
    $Evaluation->setLevel($cleanPOST['level']);
    echo "<pre>";
//    echo $Evaluation->sendToDB();
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
        
        $_SESSION['note']="<div class='alert alert-success'>Document uploaded successfully.</div>";
        header("Location: ".$e."-".$s.".php?&exhibits=".$e."&standards=".$s);
    }
?>