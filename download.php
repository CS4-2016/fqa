<?php
    $e=$_GET['e'];  // exhibit
    $t=$_GET['t'];  // l2 table
    $ev=$_GET['ev']; // evaluation
    $d=$_SESSION['department'];
    $p=$_SESSION['position'];
    function dumpArray($a)
    {
        echo "<pre>";
        print_r($a);
        echo "</pre>";
    }
    $query="SELECT * FROM _documents_ WHERE  master_exhibit=? AND from_which_table=? AND evaluation=?";
    try
    {
        $dbcon=new PDO('mysql:host=localhost;dbname=thesis', 'root', '' );
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $state=$dbcon->prepare($query);
        $state->execute(array($e, $t, $ev));
        $row=$state->fetchAll();
        header("Content-type: application/pdf");
//        header("Content-Disposition: attachment; filename=".$row[0]['doc_link']);
        echo file_get_contents($row[0]['doc_link']);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
//    for($i=0; $i<count($ret); $i++)
//    {
//        if($ret[$i]['educ_transcriptrecorddocname'][count($ret[$i]['educ_transcriptrecorddocname'])-1]=="x" || $ret[$i]['educ_transcriptrecorddocname'][count($ret[$i]['educ_transcriptrecorddocname'])-1]=="c")
//            header("Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
//        else if($ret[$i]['educ_transcriptrecorddocname'][count($ret[$i]['educ_transcriptrecorddocname'])-1]=="f")
//            header("Content-type: application/pdf");
//    }
//    header("Content-Disposition: attachment;filename=".$ret[$docNo]['educ_transcriptrecorddocname'].'');
//    echo $ret[$docNo]['educ_transcriptrecorddoc'];
?>