<?php
 //File po.php
 class po {
   function placeOrder($po) {
    if(!$conn = oci_connect('xmlusr', 'xmlusr', '//localhost/orcl')){
        throw new SoapFault("Server","Failed to connect to database"); 
    };
    $sql = "BEGIN :rslt:=placeNewOrder(XMLType(:po).createSchemaBasedXML('po.xsd'), :msg); END;";
    $query = oci_parse($conn, $sql);
    oci_bind_by_name($query, ':rslt', $rslt);
    oci_bind_by_name($query, ':po', $po);
    oci_bind_by_name($query, ':msg', $msg, 300);
    if (!oci_execute($query)) {
        throw new SoapFault("Server","Failed to execute query"); 
    };
    if ($rslt==0) {
        throw new SoapFault("Server","Failed to validate or insert PO".$msg); 
    };
    return $msg;
   }
 }
?>