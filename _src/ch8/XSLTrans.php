<?php
 $domxsl = new DOMDocument();
 $domxsl->load('employees.xsl');
 $proc = new XSLTProcessor;
 $xsl = $proc->importStylesheet($domxsl);
 $domxml = new DOMDocument();
 $domxml->load('employees.xml');
 $rslt = $proc->transformToXml($domxml);
 print $rslt;
?>
