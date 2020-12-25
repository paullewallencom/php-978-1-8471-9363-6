<?php
  //File: userLogin.php
  function login($usr, $pswd) {
  if(!$rsConnection = oci_connect('usr', 'usr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };
  $query = "BEGIN :rslt:=auth(:usrid, :pwd, :fullname, :msg); END;"; 
  $stmt = oci_parse($rsConnection,$query);
  oci_bind_by_name($stmt, ':rslt', $func_rslt,1);          
  oci_bind_by_name($stmt, ':usrid', $usr, 10);             
  oci_bind_by_name($stmt, ':pwd', $pswd, 10);              
  oci_bind_by_name($stmt, ':fullname', $full_name, 20);            
  oci_bind_by_name($stmt, ':msg', $err_msg, 100);          
  if (!oci_execute($stmt)) {
   $err = oci_error($stmt);
   trigger_error('Function call failed: ' . $err['message'], E_USER_ERROR);
  }
  if ($func_rslt) {                                         
    print "Hello, ".$full_name;                       
    session_start();                                  
    $_SESSION['user']=$usr;                           
  } else {
    print $err_msg;                                         
    return false;                                           
  }
  if (isset($err_msg)){                                   
   print '<p><i>'.'Warning: '.$err_msg.'</i></p>';        
  }
  return true;
 }
?>
