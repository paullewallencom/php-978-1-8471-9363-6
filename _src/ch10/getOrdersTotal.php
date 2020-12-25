<?php
  //File:getOrdersTotal.php
    $dat = '15-nov-2006';
    if(!$dbConn = oci_connect('ajax', 'ajax', '//localhost/orcl')) {           
       $err = oci_error();                                         
       trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
    };
    $strSQL = "SELECT TO_CHAR(SYSDATE, 'HH:MI:SS') time, 
                      count(*) num, SUM(total) total FROM orders WHERE orddate= :dat";
    $stmt = oci_parse($dbConn,$strSQL);
    oci_bind_by_name($stmt, ':dat', $dat);  
    if (!oci_execute($stmt)) {                                     
       $err = oci_error($stmt);                                     
       trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
    };
    oci_fetch($stmt);                                      
    $rslt[0] = oci_result($stmt, 'TIME');   
    $rslt[1] = oci_result($stmt, 'NUM');   
    $rslt[2] = oci_result($stmt, 'TOTAL');   
    print $rslt[0]."/".
          $rslt[1]."/".
          $rslt[2];       
?>
