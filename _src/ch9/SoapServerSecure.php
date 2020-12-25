<?php
 //File: SOAPServerSecure.php
 require_once "po_sec.php"; 
 $srv= new SoapServer("po_sec.wsdl");
 $srv->setClass("po_sec");
 $srv->handle();
?>

