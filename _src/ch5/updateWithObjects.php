<?php
  //File: updateWithObjects.php
  if(!$dbConn = oci_connect('usr', 'usr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };
  $jobno = 'ST_MAN';
  $query = "
  UPDATE emps_obj_table e                          
  SET salary=e.newsalary(1.1)                      
  WHERE DEREF(job_ref).job_id =:jobid;             
  $stmt = oci_parse($dbConn,$query);  
  oci_bind_by_name($stmt, ':jobid', $jobno);  
  if (!oci_execute($stmt, OCI_COMMIT_ON_SUCCESS)) {           
    $err = oci_error($stmt);                         
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  };
  print "Transaction is committed";                 
?>

