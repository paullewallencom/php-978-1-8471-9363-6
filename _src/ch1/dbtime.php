<?php
  //File: dbtime.php
    $dbHost = "localhost";
    $dbHostPort="1521";
    $dbServiceName = "orcl";
    $usr = "usr";
    $pswd = "usr";
    $dbConnStr = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=".$dbHost.")(PORT=".$dbHostPort."))
     (CONNECT_DATA=(SERVICE_NAME=".$dbServiceName.")))";
    if(!$dbConn = oci_connect($usr,$pswd,$dbConnStr)) {
       $err = oci_error();
       trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
    };
    $strSQL = "SELECT TO_CHAR(SYSDATE, 'HH:MI:SS') ctime FROM DUAL";
    $stmt = oci_parse($dbConn,$strSQL);
    if (!oci_execute($stmt)) {
       $err = oci_error($stmt);
       trigger_error('Failed to execute the query: ' . $err['message'], E_USER_ERROR);
    };
    oci_fetch($stmt); 
    $rslt = oci_result($stmt, 'CTIME');
    print "<h3>The current time is ".$rslt."<h3>";
?>
