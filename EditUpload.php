<?php
    require_once("Upload.php");
    require_once("docmeta/docx_metadata.php");
    require_once("dbcon-pdo.php");
    class EditUploadFile extends UploadFile
    {
        // OVERRIDE FUNCTION sendToDB()
        public function sendToDB()
        {
            try
            {
                $to_fetch=$this->getArray();
                for($i=0;$i<count($this->files['tmp_name']); $i++)
                {
                    $dbcon=new PDO('mysql:host='.$GLOBALS['host'].';dbname='.$GLOBALS['dbase'], $GLOBALS['lin'], $GLOBALS['pwd']);
                    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $state=$dbcon->prepare("UPDATE _documents_ SET docname=?, uploaded_by=?, doc_author=?, doc_link=? WHERE evaluation=? AND from_which_table=? AND department=? AND position=?;");
                    $state->execute(array($to_fetch['docname'][$i], $to_fetch['up'][$i], $to_fetch['author'][$i], $to_fetch['link'][$i], $to_fetch['eval'][$i], $to_fetch['tbl'][$i], $to_fetch['dep'][$i], $to_fetch['pos'][$i]));
   //                 $state->setFetchMode(PDO::FETCH_ASSOC);
    //                $row=$state->fetch();
    //                $applicantId=$row['applicant_id'];
                    $dbcon=null;
//                  return $applicantId;
                    
                }
                
                return true;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
                return false;
            }
        }
    }
?>