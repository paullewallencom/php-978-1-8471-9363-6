<?php 
  //File: testAuth.php
  require_once "Auth.php";         
  
  $auth_opts = array(                               
   'dsn'=>'oci8://usr:usr@localhost:1521/orcl',    
   'table'=>'accounts',                          
   'usernamecol'=>'usr_id',                       
   'passwordcol'=>'pswd',                         
   'db_fields' => '*',                            
   'cryptType'=>'none'                            
  );
  $auth_opts['usernamecol'] = strtoupper($auth_opts['usernamecol']); 
  $auth_opts['passwordcol'] = strtoupper($auth_opts['passwordcol']); 
  $a = new Auth('DB', $auth_opts);                         
  $a->setIdle(5);                                   
  $a->setExpire(15);                                 
  $a->start();                                       
  if ($a->getAuth()) {                              
   print "<h2>Hello, ".$a->getAuthData('FULL_NAME')."!</h2><br/>";  
  } else {
   exit;
  }
?>
