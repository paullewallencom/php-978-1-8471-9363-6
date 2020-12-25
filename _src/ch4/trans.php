<?php
  //File: trans.php
  if(!$dbConn = oci_connect('hr', 'hr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };
  $query = "SELECT count(*) num_rows FROM employees WHERE job_id='ST_MAN'";
  $stmt = oci_parse($dbConn,$query);            
  if (!oci_execute($stmt)) {                     
    $err = oci_error();                         
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  };
  oci_fetch($stmt);                             
  $numrows = oci_result($stmt, 'NUM_ROWS');
  oci_free_statement($stmt);
  $query = "UPDATE EMPLOYEES e
  SET salary = salary*1.1
  WHERE e.job_id='ST_MAN' AND salary*1.1 
    BETWEEN (SELECT min_salary FROM jobs j WHERE j.job_id=e.job_id) 
    AND     (SELECT max_salary FROM jobs j WHERE j.job_id=e.job_id)";
  $stmt = oci_parse($dbConn,$query);
  if (!oci_execute($stmt, OCI_DEFAULT)) {
   $err = oci_error();
   trigger_error('Update failed: ' . $err['message'], E_USER_ERROR);
  }
  $updrows = oci_num_rows($stmt);
  print "Tried to update ".$numrows." rows.<br />";
  print "Managed to update ".$updrows." rows.<br />";
  if ($updrows<$numrows) {                                       
     if (!oci_rollback($dbConn)) {
           $err = oci_error();
           trigger_error('Failed to rollback transaction: '.$err['message'], E_USER_ERROR);
     }
     print "Transaction is rolled back";                          
  } else {                                                        
     if (!oci_commit($dbConn)) {
           $err = oci_error();
           trigger_error('Failed to commit transaction: '.$err['message'], E_USER_ERROR);
     }
     print "Transaction is committed";                            
  }                                                               
?>
