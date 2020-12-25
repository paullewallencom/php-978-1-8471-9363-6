<?php
 //File: sqlproc.php
 if (!$conn = oci_connect('hr', 'hr', '//localhost/orcl')) {
   $err = oci_error();                                          
   trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR); 
 }
 
 $query = 'SELECT * FROM EMPLOYEES WHERE department_id = :deptid';

 $stmt = oci_parse($conn, $query);
 
 $dept_id = '60';
 oci_bind_by_name($stmt, ':deptid', $dept_id);
 
 oci_define_by_name($stmt, "EMPLOYEE_ID", $empno);
 oci_define_by_name($stmt, "FIRST_NAME", $firstname);
 oci_define_by_name($stmt, "LAST_NAME", $lastname);
 oci_define_by_name($stmt, "JOB_ID", $jobid);
 oci_define_by_name($stmt, "SALARY", $salary);
 
 if (!oci_set_prefetch($stmt, 5)) {
   trigger_error('Failed to set the number of rows to be prefetched', E_USER_WARNING); 
 }
 
 if (!oci_execute($stmt, OCI_DEFAULT)) {
   $err = oci_error($stmt);
   trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
 }
 print '<font face="Arial">';
 print '<h3>'.'All employees working in Department '.$dept_id.'</h3>';

 print '<table border="1">';
 print '<th>EMP_ID</th>
        <th>FIRST NAME</th>
        <th>LAST NAME</th>
        <th>JOB_ID</th>
        <th>SALARY</th>';
 while (oci_fetch($stmt)) {
   print '<tr>';
   print '<td>'.$empno.'</td>';
   print '<td>'.oci_result($stmt, 'FIRST_NAME').'</td>';
   print '<td>'.$lastname.'</td>';
   print '<td>'.$jobid.'</td>';
   print '<td>'.$salary.'</td>';
   print '</tr>';
 }
 print '</table>';
 print '</font>';
?>
