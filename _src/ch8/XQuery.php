<?php
  //File: XQuery.php
  if(!$rsConnection = oci_connect('hr', 'hr', '//localhost/orclR2')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };
  $dept_id=90;
  $query = 
   'SELECT XMLQuery('.
   "'".'for $j in 1
    return (
    <EMPLOYEES> {
     for $i in ora:view("hr", "employees")/ROW
     where $i/DEPARTMENT_ID = $deptid
     return (<EMPLOYEE id="{xs:integer($i/EMPLOYEE_ID)}">
                <ENAME>{xs:string($i/LAST_NAME)}</ENAME>
                <SALARY>{xs:integer($i/SALARY)}</SALARY>
           </EMPLOYEE>)} </EMPLOYEES>)'."'".
     'PASSING XMLElement("deptid", :deptid) AS "deptid" RETURNING CONTENT).getStringVal() RESULT FROM DUAL';
  $stmt = oci_parse($rsConnection,$query);
  oci_bind_by_name($stmt, ':deptid', $dept_id);  
  if (!oci_execute($stmt)) {
   $err = oci_error($stmt);
   trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  }
  $xmlDoc = oci_fetch_assoc($stmt); 
  $domxml = new DOMDocument();
  $domxml->loadXML($xmlDoc['RESULT']);
  print $domxml->saveXML();  
?>
