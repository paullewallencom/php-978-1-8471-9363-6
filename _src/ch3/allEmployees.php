<?php
  //File: allEmployees.php
  if(!$rsConnection = oci_connect('hr', 'hr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };
  $query = 'SELECT employee_id, first_name, last_name, salary, job_id FROM employees';
  $stmt = oci_parse($rsConnection,$query);
  if (!oci_execute($stmt)) {
   $err = oci_error();
   trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  print '<font face="Arial">';
  print '<h2>All employess</h2>';
  print '<table border="1">';
   print '<th>ID</th>';
   print '<th>NAME</th>';
   print '<th>SALARY</th>';
   print '<th>JOB ID</th>';
   while ($emp = oci_fetch_array($stmt, OCI_ASSOC)) {
    print '<tr>';
    print '<td>'.$emp['EMPLOYEE_ID'].'</td>';
    print '<td>'.$emp['FIRST_NAME'].'&nbsp;'.$emp['LAST_NAME'].'</td>';
    print '<td>'.$emp['SALARY'].'</td>';
    print '<td>'.$emp['JOB_ID'].'</td>';
    print '</tr>';
  }
 print '</table>';
 print '</font>'; 
?>

