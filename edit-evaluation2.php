<?php
    require_once("dbconn.php");
    $db=new db();
    $db->Connect();
    session_start();

    $position=$_SESSION['position'];
    if(!($position=='QA')){
      header("Location:404-message.php");
    }

    $table=addslashes($_POST['t']);
    $evaluation=addslashes($_POST['e']);
    $exhibit=addslashes($_POST['ex']); //2
    $old=addslashes($_POST['old']); //1
    $name=addslashes($_POST['new-name']);
    $page=$_SESSION['page'];
    $id=$_POST['hiddenId'];
    $standards=$_POST['hiddenStandards']; //3

    $query1 ="SELECT * FROM exhibit";
    $ret1 =  mysql_query($query1);
    $dbtables = array();

   if ($ret1){
        while ($row = mysql_fetch_assoc($ret1))
             $dbtables[]=$row;

    }
    
    for($x=0;$x<count($dbtables);$x++){
        $dbtables[$x]['exhibits'];
        $db=$dbtables[$x]['exhibits']."<br>";
        $newdb=explode(" ",$dbtables[$x]['exhibits']);
        $newdb2=implode("",$newdb);
        $newdb3=$newdb2;
        $query2="SELECT * FROM $newdb3 where ename='$name'";
        $ret2 =  mysql_query($query2);
        $num_row1 = mysql_num_rows($ret2);



}
    
        if ($num_row1>0) {
            echo $_SESSION['errMsg'] = "<strong>$name</strong> Already Exist";
            header("Location:edit-evaluation.php?exhibits=".$exhibit."&t=".$table."&e=".$old."&id=".$id."&page=".$page."&s=".$standards."&edit=yes");
        }
       else if($num_row1==0){

            $SQL = "SELECT * FROM $exhibit WHERE ename  = '$name'";
            $result = mysql_query($SQL);
            $num_rows = mysql_num_rows($result);
            if ($num_rows>0) {
               $_SESSION['errMsg'] = "<strong>$name</strong> Already Exist";
                   header("Location:edit-evaluation.php?exhibits=".$exhibit."&t=".$table."&e=".$old."&id=".$id."&page=".$page."&s=".$standards."&edit=yes");
            }else{

             if($num_rows==0){  

                $old=$evaluation;
                $new=$name;

                rename("$old-$exhibit-$standards.php","$new-$exhibit-$standards.php");
                rename("l2_$old-$exhibit-$standards.php","l2_$new-$exhibit-$standards.php");
                echo $query1="UPDATE _documents3_ SET from_which_l2_eval='$name' where from_which_l2_eval='$evaluation'";
                $ret1=mysql_query($query1);
                echo $query2="UPDATE $exhibit SET tname='$name' WHERE tname='$old'";
                $ret2=mysql_query($query2);
                echo $query1="UPDATE _documents_ SET evaluation='$name' where evaluation='$old'";
                $ret1=mysql_query($query1);
                $query="UPDATE $exhibit SET ename='$name' WHERE tname='$table' AND ename='$old' AND eid='$id'";
                $ret=mysql_query($query);



                if($ret)
                {
                    //add-Sample%20Exhibits.php?exhibits=Sample%20Exhibits&standards=Sample%20Standards
                    header("Location:add-".$page."-$standards.php?exhibits=".$page."&standards=".$standards);
                }
                else
                {
                    echo mysql_error();
                }
             }
            }
        }
                            
?>
