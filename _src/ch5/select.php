<?php
  //File: select.php
  require_once 'dbConn4.php';    
  require_once 'hrCred.php';     

  $db = new dbConn4($user, $pswd, $conn);  
  $sql="SELECT FIRST_NAME, LAST_NAME FROM employees";
  if($db->query($sql)){
    print 'Employee Names: ' . '<br />';
    while ($row = $db->fetch()) {
       print $row['FIRST_NAME'] . '&nbsp;';
       print $row['LAST_NAME'] . '<br />';
     }
    }
?>
