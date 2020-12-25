<?php 
 //File: SoapClientSecure.php
 $handle = fopen("po.xml", "r");
 $po= fread($handle, filesize("po.xml"));
 fclose($handle);
 $xmlpo = simplexml_load_string($po);
 $billName = $xmlpo->shipTo->name;
 $pswd=sha1($billName);
 $client = new SoapClient("http://localhost/PHPOracleInAction/ch9/po_sec.wsdl"); 
 try {
  print($client->placeOrderSecure($po, $pswd)); 
 }
 catch (SoapFault $e) {
  print $e->getMessage();
 }
?>

