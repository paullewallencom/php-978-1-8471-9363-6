<?php
  //File: SQLXMLQuery.php
  if(!$rsConnection = oci_connect('hr', 'hr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };
  $dept_id = 90;
  $query = 'SELECT XMLELEMENT("EMPLOYEES",
             XMLAgg(XMLELEMENT("EMPLOYEE",
              XMLATTRIBUTES(employee_id AS "id"),
              XMLFOREST(last_name as "ENAME", salary as "SALARY")))) AS result
           FROM employees WHERE department_id=:deptid';    
  $stmt = oci_parse($rsConnection,$query);
  oci_bind_by_name($stmt, ':deptid', $dept_id);  
  if (!oci_execute($stmt)) {
   $err = oci_error($stmt);
   trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  $xmlDoc = oci_fetch_assoc($stmt); 
  $domxml = new DOMDocument();
  $domxml->loadXML($xmlDoc['RESULT']);
  $domxsl = new DOMDocument();
  $domxsl->load('employees.xsl');  
  $proc = new XSLTProcessor;   
  $xsl = $proc->importStylesheet($domxsl);  
  $rslt = $proc->transformToXml($domxml);  
  print $rslt;           
?>
