<?php
  //File: userLoginTrans.php
  function login($usr, $pswd) {
  if(!$rsConnection = oci_connect('usr', 'usr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };
  $query = "SELECT full_name, num_logons FROM accounts WHERE usr_id = :userid AND pswd = :passwd";                                       
  $stmt = oci_parse($rsConnection,$query);
  oci_bind_by_name($stmt, ':userid', $usr);        
  oci_bind_by_name($stmt, ':passwd', $pswd);       
  if (!oci_execute($stmt)) {
   $err = oci_error($stmt);
   trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  if (!$arr = oci_fetch_array($stmt, OCI_ASSOC)) {      
    print "Wrong user/password combination";            
    return false;                                       
  }
  $num_logons=$arr['NUM_LOGONS']+1;
  oci_free_statement($stmt); 
  $query = "UPDATE accounts SET num_logons = num_logons + 1";      
  $stmt = oci_parse($rsConnection,$query);
  if (!oci_execute($stmt, OCI_DEFAULT)) {                         
   $err = oci_error($stmt);
   trigger_error('Update failed: ' . $err['message'], E_USER_WARNING);
   return false;                                                 
  }
  oci_free_statement($stmt); 
  $query = "INSERT INTO logons VALUES (:userid, SYSDATE)";      
  $stmt = oci_parse($rsConnection,$query);
  oci_bind_by_name($stmt, ':userid', $usr);             
  if (!oci_execute($stmt, OCI_COMMIT_ON_SUCCESS)) {              
   $err = oci_error($stmt);
   trigger_error('Insertion failed: ' . $err['message'], E_USER_WARNING);
   if ($err['code']=='02290'){                                      
     print "You cannot connect on Saturday or Sunday";              
    }                                                              
   return false;                                                 
  }
  print "Hello, ".$arr['FULL_NAME']."<br/>";                   
  print "You have visited us ".$num_logons." time(s)"; 
  session_start();                                     
  $_SESSION['user']=$usr;                              
  return true;                                         
 }
?>

