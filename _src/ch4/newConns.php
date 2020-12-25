<?php
  //File: newConns.php
  function select_emp_job ($conn, $jobno) {
      $query = "SELECT employee_id, first_name, last_name, salary FROM employees WHERE job_id =:jobid";                                      
      $stmt = oci_parse($conn,$query);  
      oci_bind_by_name($stmt, ':jobid', $jobno);        
      if (!oci_execute($stmt,OCI_DEFAULT)) {                     
        $err = oci_error($stmt);                         
        trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
      };
      print '<table border="1">';
      while ($emp = oci_fetch_array($stmt, OCI_ASSOC)) {
          print '<tr>';
          print '<td>'.$emp['EMPLOYEE_ID'].'</td>';
          print '<td>'.$emp['FIRST_NAME'].'&nbsp;'.$emp['LAST_NAME'].'</td>';
          print '<td>'.$emp['SALARY'].'</td>';
          print '</tr>';
      }
      print '</table>';
  } 
  if(!$conn1 = oci_connect('hr', 'hr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };
  if(!$conn2 = oci_new_connect('hr', 'hr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };

  $jobno = 'AD_VP';
  $query = "UPDATE employees SET salary = 18000 WHERE job_id=:jobid";                                      
  $stmt = oci_parse($conn1,$query);  
  oci_bind_by_name($stmt, ':jobid', $jobno);        
  if (!oci_execute($stmt, OCI_DEFAULT)) {                     
    $err = oci_error($stmt);                         
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  };
    print "<h2>Transaction isolation testing!</h2>";
  print "<h4>Transaction A on conn1:</h4>";
  print "<p>(results after the update and before the commit on conn1)</p>";
  select_emp_job($conn1, $jobno);
  print "<h4>Transaction B on conn2:</h4>";
  print "<p>(results after the update and before the commit on conn1)</p>";
  select_emp_job($conn2, $jobno);

  if (!oci_commit($conn1)) {  
     $err = oci_error($conn1);
     trigger_error('Failed to commit transaction: '.$err['message'], E_USER_ERROR);
  }
  print "<h4>Transaction B on conn2:</h4>";
  print "<p>(results after the update and after the commit on conn1)</p>";
  select_emp_job($conn2, $jobno);
  $query = "UPDATE employees SET salary = 17000 WHERE job_id=:jobid";                                      
  $stmt = oci_parse($conn1,$query);  
  oci_bind_by_name($stmt, ':jobid', $jobno);        
  if (!oci_execute($stmt)) {                     
    $err = oci_error($stmt);                         
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  };

?>
