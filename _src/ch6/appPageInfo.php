<?php
  //File: appPageInfo.php
  require_once "testAuthor.php";                
  $thisPage='"'."appPageInfo.php".'"';
  $rslt =$dbh->query('SELECT * FROM sec_adm.accounts_v');  
  if (PEAR::isError($rslt)) {
    print $rslt->getMessage();
  }                         
  print '<font face="Arial">';
  print "<h3>Here's your account information</h3>";
  $row = $rslt->fetchRow(DB_FETCHMODE_ASSOC);                     
  print '<table border="1" cellpadding="5">';
  print '<tr>';
  print '<td><b>Account name</b></td><td>'.$row['USR_ID'].'</td>';
  print '</tr>';
  print '<tr>';
  print '<td><b>Full name</b></td><td>'.$row['FULL_NAME'].'</td >';
  print '</tr>';
  print '</table>';
  print '<br/>';
  print "Click <a href=".$thisPage.">here</a> to reload this page"; 
  print '</font>';
?>

