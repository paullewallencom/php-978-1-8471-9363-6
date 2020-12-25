<?php
 //File:dbtimeADOdb.php
 include "adodb\adodb.inc.php";
 if (!$db = NewADOConnection("oci8://hr:hr@localhost:1521/orcl")){ 
   die("Connection failed");}
 $db->SetFetchMode(ADODB_FETCH_ASSOC);
 if (!$rs = $db->Execute("SELECT TO_CHAR(SYSDATE, 'HH:MI:SS') ctime FROM DUAL")){
   die("Query failed: ".$db->ErrorMsg());} 
 $row = $rs->FetchRow();
 print "<h3>The current time is ".$row['CTIME']."</h3>";
?>