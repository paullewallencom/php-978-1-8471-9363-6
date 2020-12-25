<?php 
 //File: testMyAuthOrcl_dbConn5.php
 require_once "MyAuthOrcl_dbConn5.php";
 require_once "connOptions.php";
 require_once "dbConn5.php";                              
 $db = new dbConn5('usr', 'usr', '//localhost/orcl');     
 $a = new MyAuthOrcl_dbConn5($auth_opts, $db);            
 $a->setIdle(5);
 $a->setExpire(10);
 $a->start(); 
 if ($a->getAuth()) {
   print '<font face="Arial">';
   print "<h2>Hello, ".$a->getAuthData('FULL_NAME')."!</h2><br/>"; 
   print '</font>';
 } else {
  exit;
 }
?>
