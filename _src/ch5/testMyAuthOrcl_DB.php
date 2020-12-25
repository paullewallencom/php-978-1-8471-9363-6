<?php 
 //File: testMyAuthOrcl_DB.php 
 require_once "MyAuthOrcl.php";
 require_once "connOptions.php";
 require_once 'DB.php';                   
 $dbh = DB::connect($auth_opts['dsn']);     
 if(DB::isError($dbh)) {                                  
    die($dbh->getMessage());                              
 }                                                        
 $auth_opts['dsn'] = $dbh;           
 $a = new MyAuthOrcl($auth_opts);    
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
