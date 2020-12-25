<?php 
 //File: testAuth.php
 require_once "Auth.php";
 $auth_opts = array(
  'dsn'=>'oci8://app_conn:appconn@localhost:1521/orcl',
  'table'=>"sec_adm.sec_pkg.f_auth",                      
  'usernamecol'=>'usr_id',
  'passwordcol'=>'pswd',
  'db_fields' => '*',
  'cryptType'=>'none'
 );
 $auth_opts['usernamecol'] = strtoupper($auth_opts['usernamecol']);
 $auth_opts['passwordcol'] = strtoupper($auth_opts['passwordcol']);
 $a = new Auth('DB_func', $auth_opts);                  
 $a->setExpire(5);
 $a->start(); 
 if ($a->getAuth()) {
   print '<font face="Arial">';
   print "<h2>Hello, ".$a->getAuthData('FULL_NAME')."!</h2><br/>"; 
   print '</font>';
 } else {
  exit;
 }
?>

