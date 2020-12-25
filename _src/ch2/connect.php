<?php
  //File: connect.php
   function GetConnection(
               $usr,
               $pswd,
               $dbServiceName = "orcl",
               $dbHost = "localhost",
               $dbHostPort="1521")
  {
    $dbConnStr = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=".$dbHost.")(PORT=".$dbHostPort."))
                  (CONNECT_DATA=(SERVICE_NAME=".$dbServiceName.")))";
    if(!$dbConn = oci_connect($usr,$pswd,$dbConnStr)) {
       $err = oci_error();
       trigger_error('Failed to connect ' . $err['message']);
       return false;
      }
    return $dbConn;
  }
?>
