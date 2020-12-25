<?php 
 //File: getEmpOrders.php
 function getEmpOrders($dsn, $user) {       
 $db = DB::connect($dsn);      
 if(DB::isError($db)) {                        
    die($db->getMessage());                    
 }                                              
 $db->setFetchMode(DB_FETCHMODE_ASSOC);    
 $rs =$db->getAll("SELECT ordno, empname, TO_CHAR(orddate, 'DD-MON-YYYY') orddate, total FROM usr.orders_emp_v");    
 if (PEAR::isError($rs)) {  
     print $rs->getMessage();  
  }   
  return($rs);                    
 }
?>

