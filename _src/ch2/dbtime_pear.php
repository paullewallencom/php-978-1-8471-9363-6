<?php
  //File: dbtime_pear.php 
  require_once 'DB.php';                                       
  $dbh = DB::connect("oci8://hr:hr@localhost:1521/orcl");      
  if(DB::isError($dbh)) {                                   
    die($dbh->getMessage());                                
  }                                                         
  $dbh->setFetchMode(DB_FETCHMODE_ASSOC);                   
  $rslt = $dbh->query("SELECT TO_CHAR(SYSDATE, 'HH:MI:SS') ctime FROM DUAL");                                                     
  if (PEAR::isError($rslt)) {
        die($res->getMessage());
  }
  $rslt->fetchInto($row);                                   
  print "<h3>The current time is ".$row['CTIME']."</h3>";
?>
