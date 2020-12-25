<?php
  //File: transQuery.php
  if(!$dbConn = oci_connect('hr', 'hr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };
  $jobno = 'ST_MAN';
  $query = "
  UPDATE (SELECT salary, job_id FROM employees WHERE 
   (SELECT count(*) FROM employees WHERE job_id=:jobid AND 
    salary*1.1 BETWEEN (SELECT min_salary FROM jobs WHERE job_id=:jobid) AND
                      (SELECT max_salary FROM jobs WHERE job_id=:jobid)) IN
    (SELECT count(*) FROM employees WHERE job_id=:jobid)
   ) emp 
   SET emp.salary = salary*1.1
   WHERE emp.job_id=:jobid";                                      
  $stmt = oci_parse($dbConn,$query);  
  oci_bind_by_name($stmt, ':jobid', $jobno);        
  if (!oci_execute($stmt)) {                     
    $err = oci_error();                         
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  };
  $updrows = oci_num_rows($stmt);                                 
  if ($updrows>0) {                                        
     print "Transaction is committed"; 
  } else {   
     print "Transaction is rolled back"; 
  }    
?>
