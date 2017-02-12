<?php
    require_once("Upload3.php");
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
    $e=$_POST['e'];
    $s=$_POST['stand'];
    $exh=$_POST['exh'];

    $a=explode(" ",$exh);
    echo $exh=implode("",$a);
    $cleanPOST=array();
    $cleanFILES=array();
   for($i=0; $i<count($_FILES['uploadedfile']['name']); $i++)
    {
        if($_FILES['uploadedfile']['size'][$i]>148480)
        {
            if($_FILES['uploadedfile']['name'][$i])
            {
                $cleanPOST['uploaded-by'][]=$_POST['uploaded-by'][$i];
                $cleanPOST['evaluation'][]=$_POST['evaluation'][$i];
                $cleanPOST['exh'][]=$exh;
                $cleanPOST['s'][]=$s;
                $cleanPOST['dept'][]=$_POST['dept'][$i];
                $cleanPOST['pos'][]=$_POST['pos'][$i];
                $cleanPOST['t'][]=$_POST['t'][$i];
           //     $cleanPOST['master-exhibit'][]=$_POST['master-exhibit'][$i];

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
            header("Location: ".$e."-".$exh."-".$s.".php?&exhibits=".$e."&standards=".$s."&ename=".$exh);
        }
            
    }
    
    $Evaluation=new UploadFile3();
    
    $Evaluation->setUploaders($cleanPOST['uploaded-by']);
    $Evaluation->setEvaluations($cleanPOST['evaluation']);
    $Evaluation->setStandard($cleanPOST['s']);
    $Evaluation->setExhibit($cleanPOST['exh']);
    $Evaluation->setTables($cleanPOST['t']);
    $Evaluation->setDepartment($cleanPOST['dept']);
    $Evaluation->setPosition($cleanPOST['pos']);
    $Evaluation->setFiles($cleanFILES['uploadedfile']);
    $Evaluation->getMetadata();
    
    echo "<pre>";
	
//    print_r($_FILES);
//    print_r($_FILES['uploadedfile']);
//       print_r($Evaluation->getArray());
//    echo "</pre>";
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
        header("Location: ".$e."-".$exh."-".$s.".php?ename=".$e."&standards=".$s."&exhibits=".$exh);
    }
     //  echo file_get_contents($_FILES['uploadedfile']['tmp_name']);
?>