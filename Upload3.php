<?php
    require_once("Upload.php");
    require_once("dbcon-pdo.php");
    class UploadFile3 extends UploadFile
    {
        public function getArray()
        {
            for($i=0; $i<count($this->files['tmp_name']);$i++)
                $this->doclocation[$i]=$this->saveDoc($this->files['name'][$i], $this->files['tmp_name'][$i], $this->department[$i], $this->position[$i], $this->stripEmailProvider($this->uploaders[0]));
            return array(
                'docname'=>$this->files['name'],
                'dept'=>$this->department,
                'pos'=>$this->position,
                'stand'=>$this->standard,
                'ex'=>$this->m_exhibit,
                'up'=>$this->uploaders,
                'l2eval'=>$this->tables,
                'eval'=>$this->evaluations,
                'author'=>"FAITH",
                'link'=>$this->doclocation
            );
        }
        public function saveDoc($docname, $temp, $dept, $pos, $up)
        {
            error_reporting(E_ALL ^ E_DEPRECATED);
            $info=pathinfo($temp);
            $extension=$info['extension'];
            $doclocation="documents/l3/["."][".$up."][".$dept."][".$pos."] ".$docname;
            move_uploaded_file($temp, $doclocation);
            return $doclocation;
        }
        public function sendToDB()
        {
            try
            {
                $to_fetch=$this->getArray();
                for($i=0;$i<count($this->files['tmp_name']); $i++)
                {
                   $dbcon=new PDO('mysql:host='.$GLOBALS['host'].';dbname='.$GLOBALS['dbase'], $GLOBALS['lin'], $GLOBALS['pwd']);
                    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $state=$dbcon->prepare("INSERT INTO _documents3_(docname, department, position, standard, master_exhibit, uploaded_by, l3_evaluation, from_which_l2_eval, doc_author, doc_link) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
                    $state->execute(array($to_fetch['docname'][$i], $to_fetch['dept'][$i], $to_fetch['pos'][$i], $to_fetch['stand'][$i], $to_fetch['ex'][$i], $to_fetch['up'][$i], $to_fetch['eval'][$i], $to_fetch['l2eval'][$i], $to_fetch['author'][$i], $to_fetch['link'][$i]));
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