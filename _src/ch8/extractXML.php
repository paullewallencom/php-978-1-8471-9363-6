<?php
  //File: extractXML.php
  if(!$rsConnection = oci_connect('xmlusr', 'xmlusr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: '.$err['message'], E_USER_ERROR);
  };
  $id = 100;
  $exist_exp = '/EMPLOYEE/@id='.$id;
  $extr_exp = '/EMPLOYEE/ENAME/text()';
  $query = 'SELECT x.OBJECT_VALUE.extract(:extr).getStringVal() ENAME
            FROM employees x
            WHERE x.OBJECT_VALUE.existsNode(:exist)=1';
  $stmt = oci_parse($rsConnection,$query); 
  oci_bind_by_name($stmt, ":extr", $extr_exp);  
  oci_bind_by_name($stmt, ":exist", $exist_exp);  
  if (!oci_execute($stmt)) {
   $err = oci_error($stmt);
   trigger_error('Query failed: '.$err['message'], E_USER_ERROR);
  }
  $xmlDoc = oci_fetch_assoc($stmt);
  print '<h2>The name of employee whose id='.$id.' is:</h2>'; 
  print $xmlDoc['ENAME'];   
?>

