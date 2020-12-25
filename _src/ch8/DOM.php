<?php
  //File: DOM.php
  if(!$rsConnection = oci_connect('hr', 'hr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };
  $dept_id = 90;
  $query = "SELECT employee_id, last_name, salary FROM employees WHERE department_id = :deptid";    
  $stmt = oci_parse($rsConnection,$query);
  oci_bind_by_name($stmt, ':deptid', $dept_id);  
  if (!oci_execute($stmt)) {
   $err = oci_error($stmt);
   trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  $dom = new DOMDocument('1.0', 'UTF-8');
  $root = $dom->createElement('EMPLOYEES', '');
  $root = $dom->appendChild($root);
  while ($row = oci_fetch_assoc($stmt)) {
      $emp = $dom->createElement('EMPLOYEE', '');
      $emp = $root->appendChild($emp);
       $emp->setAttribute('id', $row['EMPLOYEE_ID']);
       $ename = $dom->createElement('ENAME', $row['LAST_NAME']);
       $ename = $emp->appendChild($ename);
       $salary = $dom->createElement('SALARY', $row['SALARY']);
       $salary = $emp->appendChild($salary);
  }
  echo $dom->saveXML();
  $dom->save("employees.xml"); 
?>
