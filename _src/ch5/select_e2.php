<?php
  //File: select_e2.php
  require_once 'dbConn5e2.php'; 
  require_once 'hrCred.php';
  
  try {
  $db = new dbConn5e2($user, $pswd, $conn);
  $sql="SELECT last_name FROM employees";
  $db->query($sql);
   print 'Employee Name: ' . '<br />';
   while ($row = $db->fetch()) {
       print $row['ENAME'] . '<br />';
    }
  }
   catch (Exception $e) {
     if ($e->getCode() == dbConn5e2::CONNECTION_ERROR) {       
         die($e->getMessage());                               
     }
     else if ($e->getCode() == dbConn5e2::SQLEXECUTION_ERROR) { 
         print $e->getMessage();                               
     }
  }
  //Continue execution                       
?>
