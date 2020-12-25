<?php
  //File: QueryXML.php
  if(!$rsConnection = oci_connect('xmlusr', 'xmlusr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: '.$err['message'], E_USER_ERROR);
  };
  $xpath_exp = '/EMPLOYEE/@id=100';
  $query = 'SELECT value(x).GetStringVal() as RESULT FROM employees x WHERE existsNode(value(x), :xpath) = 1';    
  $stmt = oci_parse($rsConnection,$query); 
  oci_bind_by_name($stmt, ":xpath", $xpath_exp);  
  if (!oci_execute($stmt)) {
   $err = oci_error($stmt);
   trigger_error('Query failed: '.$err['message'], E_USER_ERROR);
  }
  $xmlDoc = oci_fetch_assoc($stmt);  
  $dom = new DOMDocument();
  $dom->loadXML($xmlDoc['RESULT']);   
  echo $dom->saveXML(); 
?>

