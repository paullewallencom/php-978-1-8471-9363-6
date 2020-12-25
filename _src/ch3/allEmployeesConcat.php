<?php
  //File: allEmployees.php
  if(!$rsConnection = oci_connect('hr', 'hr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };
  $query = "SELECT employee_id, CONCAT(CONCAT(first_name,' '),last_name) ename, job_id FROM employees";
  $stmt = oci_parse($rsConnection,$query);
  if (!oci_execute($stmt)) {
   $err = oci_error();
   trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  print '<table border="1">';
  while ($emp = oci_fetch_array($stmt, OCI_ASSOC)) {
   print '<tr>';
   print '<td>'.$emp['EMPLOYEE_ID'].'</td>';
   print '<td>'.$emp['ENAME'].'</td>';
   print '<td>'.$emp['JOB_ID'].'</td>';
   print '</tr>';
 }
 print '</table>';
?>

