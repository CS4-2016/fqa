<?php
    require_once("docmeta/docx_metadata.php");
    require_once("dbcon-pdo.php");
//    require_once("dbconn.php");  // MySQL driver is deprecated, so I use PDO instead
    class UploadFile
    {
        public $files=array();
        public $uploaders=array();
        public $department=array();
        public $position=array();
        public $evaluations=array();
        public $m_exhibit=array();
        public $tables=array();
        public $metadata=array();
        public $doculocation=array();
        public $level=array();
        public $standard=array();
        
        // OTHER FUNCTIONS
        public function saveDoc($docname, $temp, $dept, $pos, $up)
        {
            error_reporting(E_ALL ^ E_DEPRECATED);
            $info=pathinfo($temp);
            $extension=$info['extension'];
            $doclocation="documents/["."][".$up."][".$dept."][".$pos."] ".$docname;
            move_uploaded_file($temp, $doclocation);
            return $doclocation;
        }
        public function stripEmailProvider($email)
        {
            $name='';
            $i=0;
            while($email[$i]!="@")
            {
                $name[$i]=$email[$i];
                $i++;
            }
            $name=implode("", $name);
            return $name;
        }
        // DB FUNCTIONS
        public function sendToDB()
        {
            try
            {
                $to_fetch=$this->getArray();
                for($i=0;$i<count($this->files['tmp_name']); $i++)
                {
                    $dbcon=new PDO('mysql:host='.$GLOBALS['host'].';dbname='.$GLOBALS['dbase'], $GLOBALS['lin'], $GLOBALS['pwd']);
                    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $state=$dbcon->prepare("INSERT INTO _documents_(docname, uploaded_by, department, position, standard, master_exhibit, from_which_table, evaluation, doc_author, doc_link, layer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
                    $state->execute(array($to_fetch['docname'][$i], $to_fetch['up'][$i], $to_fetch['dep'][$i], $to_fetch['pos'][$i], $to_fetch['stand'][$i], $to_fetch['master'][$i], $to_fetch['tbl'][$i], $to_fetch['eval'][$i], $to_fetch['author'][$i], $to_fetch['link'][$i], $to_fetch['level'][$i]));
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
        
        // SETTER FUNCTIONS
        public function setFiles($docs)
        {
            $this->files=$docs;
        }
        public function setUploaders($up)
        {
            $this->uploaders=$up;
        }
        public function setDepartment($dep)
        {
            $this->department=$dep;
        }
        public function setPosition($pos)
        {
            $this->position=$pos;
        }
        public function setStandard($s)
        {
            $this->standard=$s;
        }
        public function setExhibit($e)
        {
            $this->m_exhibit=$e;
        }
        public function setEvaluations($eval)
        {
            $this->evaluations=$eval;
        }
        public function setTables($tbl)
        {
            $this->tables=$tbl;
        }
        public function setLevel($level)
        {
            $this->level=$level;
        }
        public function setFileBinary()
        {
            
        }
        
        // GETTER FUNCTIONS
        public function getFiles()
        {
            return $this->files;
        }
        public function getUploaders()
        {
            return $this->uploaders;
        }
        public function getDepartment()
        {
            return $this->department;
        }
        public function getPosition()
        {
            return $this->position;
        }
        public function getStandard()
        {
            return $this->standard;
        }
        public function getEvaluations()
        {
            return $this->evaluations;
        }
        public function getTables()
        {
            return $this->tables;
        }
        public function getFileBinary()
        {
            
        }
        public function getMetadata()
        {
           
        }
        public function getArray()
        {
            for($i=0; $i<count($this->files['tmp_name']);$i++)
                $this->doclocation[$i]=$this->saveDoc($this->files['name'][$i], $this->files['tmp_name'][$i], $this->department[$i], $this->position[$i], $this->stripEmailProvider($this->uploaders[0]));
            return array(
                'docname'=>$this->files['name'],
                'up'=>$this->uploaders,
                'dep'=>$this->department,
                'pos'=>$this->position,
                'stand'=>$this->standard,
                'master'=>$this->m_exhibit,
                'tbl'=>$this->tables,
                'eval'=>$this->evaluations,
                'author'=>'FAITH',
                'link'=>$this->doclocation,
                'level'=>$this->level
            );
        }
        
    }
    
?>