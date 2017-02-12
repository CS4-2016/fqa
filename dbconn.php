<?php
error_reporting(E_ALL & ~E_DEPRECATED);
class db{
    public function Connect(){
        $this->host="localhost";
        $this->db="thesis";
        $this->user="root";
        $this->pass="";
        
        $this->link=mysql_connect($this->host,$this->user,$this->pass);
        mysql_select_db($this->db) or die(mysql_error());
        mysql_query("set names utf8;",$this->link);
        
    }
}

?>