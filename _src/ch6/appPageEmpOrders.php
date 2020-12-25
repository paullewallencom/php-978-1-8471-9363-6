<?php
  //File: appPageEmpOrders.php
  require_once "testAuthor.php";                
  $infoPage='"'."appPageInfo.php".'"';
  $rslt =$dbh->query("SELECT ordno, empname, TO_CHAR(orddate, 'DD-MON-YYYY') orddate, total FROM usr.orders_decode_v");        
  if (PEAR::isError($rslt)) {  
     print $rslt->getMessage();  
  }                         
  print '<font face="Arial">';
  print "<h3>List of orders placed by all employees</h3>";
  print '<table border="1" cellpadding="5">';
  print '<tr>';
  print '<th>Order No</th><th>Employee</th><th>Order Date</th><th>Order Total</th>';
  print '</tr>';
  while($row = $rslt->fetchRow(DB_FETCHMODE_ASSOC)){ 
    print '<tr>';
    if (is_null($row['EMPNAME'])){$row['EMPNAME']='&nbsp;';} 
    print '<td>'.$row['ORDNO'].'</td><td>'.$row['EMPNAME'].'</td><td>'.$row['ORDDATE'].'</td><td align="right">'.number_format($row['TOTAL'], 2).'</td>';
    print '</tr>';
  };                     
  print '</table>';
  print '<br/>';
  print "Click <a href=".$infoPage.">here</a> to see the account info related to the current user"; 
  print '</font>';
?>

