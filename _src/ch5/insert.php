<?php
  //File: insert.php
  require_once 'dbConn5.php'; 
  require_once 'hrCred.php';

  $db = new dbConn5($user, $pswd, $conn);
  $sql="INSERT INTO departments VALUES(330, 'DB design',null ,1700)";
  if($db->query($sql)){
      print 'data have been submitted';
     }
  else {
      print 'failed to submit data';
    }
?>
