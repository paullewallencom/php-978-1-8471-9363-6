<?php
  //File:getFullDesc.php
  if (isset($_POST['artid'])) {
    $artid=$_POST['artid'];
    if(!$dbConn = oci_connect('ajax', 'ajax', '//localhost/orcl')) {           
       $err = oci_error();                                         
       trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
    };
    $sql='SELECT XMLQuery('."'".
           'for $i in ora:view("articles")/ROW 
            where $i/ARTNO = $artno
            return (
             <div class="fulldesc">
             <p>{xs:string($i/FULLDESC)}</p>
             <h3>Further Reading</h3>
             <ul type="square"> {
             for $j in ora:view("resources")/ROW
             where $i/ARTNO = $j/ARTNO
             return (<li>
                    <a href="{xs:string($j/URL)}">{xs:string($j/TITLE)}</a>
                   </li>)
                  } </ul></div>)'."'".
         'PASSING XMLElement("artno", :artno) AS "artno"
          RETURNING CONTENT) AS FULLDESC FROM DUAL';
    $stmt = oci_parse($dbConn,$sql);
    oci_bind_by_name($stmt, ':artno', $artid);  
    if (!oci_execute($stmt)) {                                     
       $err = oci_error($stmt);                                     
       trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
    };
    oci_fetch($stmt);                                      
    $fullDesc = oci_result($stmt, 'FULLDESC');  
  //  header("Context-Type: text/xml");
    print $fullDesc; 
 }
?>
