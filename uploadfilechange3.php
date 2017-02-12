<?php
    session_start();
    require_once("EditUpload3.php");
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
    
//    if(!isset($_FILES))
//    {
//        $_SESSION['note']="<div class='alert alert-warning'>No document uploaded. Please upload one to proceed.</div>";
//        header("Location: ".$e.".php?&exhibits=".$e."&standards=".$s);
//    }
    $e=$_POST['hiddenExhi'];
    $eva=$_POST['evalName'];
    $d=$_POST['dept'];
    $p=$_POST['pos'];
    $s=$_POST['stand'];
    echo $exh=$_POST['category'];
    $cleanPOST=array();
    $cleanFILES=array();
    for($i=0; $i<count($_FILES['uploadedfile']['name']); $i++)
    {
        if($_FILES['uploadedfile']['size'][$i]>148480)
        {
            if($_FILES['uploadedfile']['name'][$i])
            {
                $cleanPOST['uploaded-by'][]=$_POST['uploaded-by'][$i];
                $cleanPOST['exhibit'][]=$_POST['evaluation'][$i];
                $cleanPOST['t'][]=$_POST['t'][$i];
                $cleanPOST['d'][]=$d;
                $cleanPOST['p'][]=$p;
        //        $cleanPOST['level'][]=$_POST['level'][$i];
          //      $cleanPOST['master-exhibit'][]=$_POST['master-exhibit'][$i];

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
            header("Location: ".$e."-".$exh."-".$s.".php?&exhibits=".$e."&standards=".$s."&ename=".$eva);
        }
            
    }
    
    $Evaluation=new EditUploadFile3();
    
    $Evaluation->setUploaders($cleanPOST['uploaded-by']);
    $Evaluation->setEvaluations($cleanPOST['exhibit']);
    $Evaluation->setTables($cleanPOST['t']);
    $Evaluation->setDepartment($cleanPOST['d']);
    $Evaluation->setPosition($cleanPOST['p']);
//    $Evaluation->setExhibit($cleanPOST['master-exhibit']);
    $Evaluation->setFiles($cleanFILES['uploadedfile']);
//    $Evaluation->setLevel($cleanPOST['level']);
    $Evaluation->getMetadata();
    echo "<pre>";
    echo $s;
    echo $eva;
//    print_r($_POST);
//    print_r($_FILES);
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
        header("Location: ".$e."-".$exh."-".$s.".php?&exhibits=".$e."&standards=".$s."&ename=".$eva);
    }
?>