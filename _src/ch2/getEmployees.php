<?php
  //File: getEmployees.php
  function getEmployees($deptno) {                                   
   if(!$rsConnection = oci_connect('hr', 'hr', '//localhost/orcl')) {
        $err = oci_error();
        trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
    };
   $strSQL = "SELECT * FROM employees WHERE department_id =:deptid";
   $rsStatement = oci_parse($rsConnection,$strSQL);
   oci_bind_by_name($rsStatement, ":deptid", $deptno, 4);           
   if (!oci_execute($rsStatement)) {
    $err = oci_error();
    trigger_error('Query failed: ' . $err['message'], E_USER_WARNING);
    return false;
   }
   $nrows = oci_fetch_all($rsStatement, $employees);                
   return array ($nrows, $ employees);                              
 }
?>
