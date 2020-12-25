<?php
  //File: appPageOrdersCacheNotify.php
  require_once "testAuthor.php";               
  require_once "getEmpOrders.php"; 
  require_once 'Cache/Lite/Function.php';
  $options = array( 
   'cacheDir' => '/tmp/', 
   'lifeTime' => 300 
  ); 
  $ordersPage='"'."appPageEmpOrders.php".'"';
  $rslt =$dbh->query("SELECT * FROM TABLE(sec_adm.cxt_ord_pkg.getRecentOrder)");    
  if (PEAR::isError($rslt)) {  
     print $rslt->getMessage();  
  }                         
  $cxt =$rslt->fetchRow(DB_FETCHMODE_ASSOC);
  print '<font face="Arial">';
  print "The most recent order was placed by ".$cxt['EMPNAME']." on ".$cxt['ORDDATE'];     
  $cache = new Cache_Lite_Function($options);
  $hash_usr = sha1($username);                    
  if ($rslt = $cache->call('getEmpOrders', $dbh->dsn, $hash_usr)){   
   print "<h3>List of orders placed by ".$a->getAuthData('FULL_NAME')."</h3>";            
   print '<table border="1" cellpadding="5">';
   print '<tr>';
   print '<th>Order No</th><th>Employee</th><th>Order Date</th><th>Order Total</th>';
   print '</tr>';
   foreach ($rslt as $row) {
    print '<tr>';
    print '<td>'.$row['ORDNO'].'</td><td>'.$row['EMPNAME'].'</td><td>'.$row['ORDDATE'].'</td><td align="right">'.number_format($row['TOTAL'], 2).'</td>';
    print '</tr>';
   };                     
   print '</table>';
   } else {
    print "Some problem occurred while getting orders!\n";
    $cache->drop('getEmpOrders', $dbh->dsn, $hash_usr);             
  }
  print '<br/>';
  print "Click <a href=".$ordersPage.">here</a> to see all orders placed by all employees";              
  print '</font>';
?>
