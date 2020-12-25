<?php
  //File: DBServerXSLTransView.php
  if(!$rsConnection = oci_connect('xmlusr', 'xmlusr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: '.$err['message'], E_USER_ERROR);
  };
  $dept_id = 90;
  $query = 'SELECT XMLtransform(x.xmlcol,   
   (SELECT stylesheet FROM XSLTstylesheets WHERE id = 1)).getStringVal()
   AS result FROM
    (SELECT * FROM EmpsXML WHERE dept_id=:deptid) x';
  $stmt = oci_parse($rsConnection,$query); 
  oci_bind_by_name($stmt, ':deptid', $dept_id);  
  if (!oci_execute($stmt)) {
   $err = oci_error($stmt);
   trigger_error('Query failed: '.$err['message'], E_USER_ERROR);
  }
  $xmlDoc = oci_fetch_assoc($stmt);  
  $dom = new DOMDocument();
  $dom->loadXML($xmlDoc['RESULT']);   
  echo $dom->saveXML(); 
?>

