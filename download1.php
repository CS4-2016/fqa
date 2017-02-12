<?php
    $d=$_GET['link'];    
    header("Content-type: application/pdf");
    header("Content-Disposition: attachment; filename=".$d);
    echo file_get_contents($d);
    
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