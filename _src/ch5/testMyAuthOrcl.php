<?php 
  //File: testMyAuthOrcl.php
  require_once "MyAuthOrcl.php";            
  require_once "connOptions.php";           
  $a = new MyAuthOrcl($auth_opts);          
  $a->setIdle(5);
  $a->setExpire(15);
  $a->start(); 
  if ($a->getAuth()) {
   print "<h2>Hello, ".$a->getAuthData('FULL_NAME')."!</h2><br/>"; 
  } else {
   exit;
  }
?> 
