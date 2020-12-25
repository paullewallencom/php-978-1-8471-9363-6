<?php
 //File: dropCachedEmpOrders.php
 require_once 'Cache/Lite/Function.php';
 require_once "DB.php";                    
 $options = array(
    'cacheDir' => '/tmp/'
 );
 $dsn = 'oci8://app_conn:appconn@localhost:1521/orcl';   
 $dsn = DB::parseDSN($dsn);                       
 $cache = new Cache_Lite_Function($options);
 if (isset($_GET['par'])) {           
    $cache->drop('getEmpOrders', $dsn, $_GET['par']);   
 } 
?>

