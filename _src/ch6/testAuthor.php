<?php 
 //File: testAuthor.php
 require_once "Auth.php";
 require_once "DB.php";                    
 $auth_opts = array(
  'dsn'=>'oci8://app_conn:appconn@localhost:1521/orcl',
  'table'=>"sec_adm.sec_pkg.f_auth", 
  'usernamecol'=>'usr_id',
  'passwordcol'=>'pswd',
  'db_fields' => '*',
  'cryptType'=>'none'
 );
 $dbh = DB::connect($auth_opts['dsn']);      
 if(DB::isError($dbh)) {                                   
    die($dbh->getMessage());                               
 }                                                        
 $auth_opts['dsn'] = $dbh;          
 $auth_opts['usernamecol'] = strtoupper($auth_opts['usernamecol']);
 $auth_opts['passwordcol'] = strtoupper($auth_opts['passwordcol']);
 $a = new Auth('DB_func', $auth_opts);                  
 $a->setExpire(5);
 $a->start(); 
 if ($a->getAuth()) {
   $username= $a->getUsername();          
   $rslt =$dbh->query("BEGIN sec_adm.set_cxt_pkg.set_userid('".$username."'); END;");          if (PEAR::isError($rslt)) {      print $rslt->getMessage();    }                              |#8
   print '<font face="Arial">';
   print "<h2>Hello, ".$a->getAuthData('FULL_NAME')."!</h2><br/>"; 
   print '</font>';
 } else {
  exit;
 }
?>

