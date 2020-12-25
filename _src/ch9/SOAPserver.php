<?php
//File: SOAPserver.php
require_once "po.php"; 
$srv= new SoapServer("po.wsdl");
$srv->setClass("po");
$srv->handle();
?>