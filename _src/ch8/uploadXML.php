<?php
  //File: uploadXML.php 
  $host='localhost';  
  $port=2100;      
  $timeout=30;       
  $db_user='xmlusr';  
  $db_pswd='xmlusr';  
  $root_dir='/public/xmlusr/emps';  
  $empid=304;
  $file='emp'.$empid.'.xml';
  $cnt=
  '<?xml version="1.0"?>
    <EMPLOYEE
       xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
       xsi:noNamespaceSchemaLocation="employee.xsd" 
       id="'.$empid.'">
      <ENAME>Polonski</ENAME>
      <SALARY>8200</SALARY>
    </EMPLOYEE>';
  print $cnt;
  $temp = tmpfile();           
  fwrite($temp, $cnt);         
  fseek($temp, 0);             
  $ftpcon = ftp_connect($host, $port, $timeout);      
  $login = ftp_login($ftpcon, $db_user, $db_pswd);    
  ftp_chdir($ftpcon, $root_dir);    
  ftp_fput($ftpcon, $file, $temp, FTP_ASCII);  
  ftp_close($ftpcon);
?>

