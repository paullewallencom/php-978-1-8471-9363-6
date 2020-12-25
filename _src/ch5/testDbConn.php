<?php
  //File: testDbConn.php
  require_once 'dbConn5.php'; 
  require_once 'hrCred.php';

  $exec_mode=OCI_DEFAULT;
  $job_id='FI_MGR';
  $db = new dbConn5($user, $pswd, $conn, $exec_mode);
  $sql="UPDATE employees SET salary = salary*1.1 WHERE job_id='".$job_id."'";
  if(!$db->query($sql)){
    print 'Failed to update the employees table';
  }
  $newDb = new dbConn5($user, $pswd, $conn, $exec_mode);
  $sql="SELECT last_name, salary FROM employees WHERE job_id='".$job_id."'";
  if($newDb->query($sql)){
    print '<b>Employee Names: </b>' . '<br />';
    print '<table>';
    while ($row = $newDb->fetch()) {
       print '<tr>';
       print '<td>'.$row['LAST_NAME'].'</td>';
       print '<td>'.$row['SALARY'].'</td >';
       print '</tr>';
    }
    print '</table>';
  }
?>
