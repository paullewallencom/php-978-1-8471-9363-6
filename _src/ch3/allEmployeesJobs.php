<?php
  //File: allEmployeesJobs.php
  if(!$rsConnection = oci_connect('hr', 'hr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };
  $query = "SELECT employee_id, CONCAT(CONCAT(first_name,' '),last_name) ename, salary, job_title FROM employees e, jobs j WHERE e.job_id=j.job_id";      
  $stmt = oci_parse($rsConnection,$query);
  if (!oci_execute($stmt)) {
   $err = oci_error();
   trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  print '<font face="Arial">';
  print '<h2>All employees</h2>';
  print '<table border="1">';
   print '<th>ID</th>';
   print '<th>NAME</th>';
   print '<th>SALARY</th>';
   print '<th>TITLE</th>';
   while ($emp = oci_fetch_array($stmt, OCI_ASSOC)) {                
    print '<tr>';
    print '<td>'.$emp['EMPLOYEE_ID'].'</td>';
    print '<td>'.$emp['ENAME'].'</td>';                 
    print '<td>'.$emp['SALARY'].'</td>';
   print '<td>'.$emp['JOB_TITLE'].'</td>';
   print '</tr>';
 }
 print '</table>';
 print '</font>'; 
?>
