<?php
  //File: select_e.php
  require_once 'dbConn5e.php';        
  require_once 'hrCred.php';
  
  try {
  $db = new dbConn5e($user, $pswd, $conn);   
  $sql="SELECT last_name FROM employees";
  $db->query($sql);                        
  print 'Employee Name: ' . '<br />';
  while ($row = $db->fetch()) {
       print $row['LAST_NAME'] . '<br />';
    }
  }
   catch (Exception $e) {          
     print $e->getMessage();       
     exit();                       
  }
?>
