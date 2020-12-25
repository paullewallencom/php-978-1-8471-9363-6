<?php 
 //File: SoapClient.php
 $handle = fopen("po.xml", "r");
 $po= fread($handle, filesize("po.xml"));
 fclose($handle);
 $client = new SoapClient("po.wsdl"); 
 try {
  print($client->placeOrder($po)); 
 }
 catch (SoapFault $e) {
  print $e->getMessage();
 }
?> 
