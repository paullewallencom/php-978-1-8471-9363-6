<?php 
 //File: testMyAuthOrcl_Events.php
 require_once "MyAuthOrcl_dbConn5.php";
 require_once "connOptions.php";
 require_once "dbConn5.php"; 
 function loginCallback_function($username, $authObj)  
 {
  if($authObj->getAuth()){                   
    $auth=1;
  } else {
    $auth=0;
  }
  $query="INSERT INTO log_attempts VALUES("."'".$username."',".$auth.", SYSDATE)";                       
  if(!$authObj->dbConn->query($query)){   
    print "Failed to create an audit record";
  }
 }
 
 $db = new dbConn5('usr', 'usr', '//localhost/orcl');
 $a = new MyAuthOrcl_dbConn5($auth_opts, $db);
 $a->setLoginCallback('loginCallback_function');  
 $a->setFailedLoginCallback('loginCallback_function');  
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
