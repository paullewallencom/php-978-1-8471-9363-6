<?php
  //File: userLogin.php
  function login($usr, $pswd) {
  if(!$rsConnection = oci_connect('usr', 'usr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };
  $query = "SELECT full_name FROM accounts WHERE usr_id = :userid AND pswd = :passwd";                                            
  $stmt = oci_parse($rsConnection,$query);
  oci_bind_by_name($stmt, ':userid', $usr);             
  oci_bind_by_name($stmt, ':passwd', $pswd);            
  if (!oci_execute($stmt)) {
   $err = oci_error($stmt);
   trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  if ($arr = oci_fetch_array($stmt, OCI_ASSOC)) {
    print "Hello, ".$arr['FULL_NAME'];                
    session_start();                                  
    $_SESSION['user']=$usr;                            
  } else {
    print "Wrong user/password combination";
    return false;
  }
  oci_free_statement($stmt); 
  $query = "INSERT INTO logons VALUES (:userid, SYSDATE)";      
  $stmt = oci_parse($rsConnection,$query);
  oci_bind_by_name($stmt, ':userid', $usr);             
  if (!oci_execute($stmt)) {                                
   $err = oci_error($stmt);
   trigger_error('Insertion failed: ' . $err['message'], E_USER_WARNING);
  }
  return true;
 }
?>
