<?php
  //File: updateSleep.php
  if(!$dbConn = oci_connect('hr', 'hr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };
  $jobno = 'AD_VP';
  $query = "
   UPDATE employees
   SET salary = salary*1.1
   WHERE job_id=:jobid";                                      
  $stmt = oci_parse($dbConn,$query);  
  oci_bind_by_name($stmt, ':jobid', $jobno);        
  if (!oci_execute($stmt, OCI_DEFAULT)) {                     
    $err = oci_error();                         
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  };
  $updrows = oci_num_rows($stmt);  
  print 'You just updated '.$updrows. ' row(s)'.'<br/>';
  sleep(20);
  oci_rollback($dbConn);
  print 'Transaction is rolled back';
?>
