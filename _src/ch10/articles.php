<?php
  //File:articles.php   
   if(!$dbConn = oci_connect('ajax', 'ajax', '//localhost/orcl')) {           
       $err = oci_error();                                         
       trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
    };
    $sql='SELECT artno, url, title, shortdesc FROM articles';
    $stmt = oci_parse($dbConn,$sql);
    if (!oci_execute($stmt)) {                                     
       $err = oci_error($stmt);                                     
       trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
    };
?> 
<html>
 <head>
  <title>Articles on PHP and Oracle</title>
  <link rel="stylesheet" type="text/css" href="styles.css" />
  <script type="text/javascript" src="ajax.js"> </script>
  <script type="text/javascript" src="fullDesc.js"> </script>
 </head>
 <body>
  <h2>Articles on PHP and Oracle</h2>
  <table cellpadding = "8">
  <?php 
   while ($emp = oci_fetch_array($stmt, OCI_ASSOC)) {  
    print '<tr>';
    print '<td valign ="top">'.$emp['ARTNO'].'.</td>';
    print '<td>'.
           '<div id="article'.$emp['ARTNO'].'">'.
            '<a href="'.$emp['URL'].'" >'.$emp['TITLE'].'</a>'.
            '<p>'.$emp['SHORTDESC'].'</p>'.
            '<a href="#" onclick="setFullDesc('.$emp['ARTNO'].')" class = "desclink">Full Description</a>'.
           '</div>'.
          '</td>';
    print '</tr>';
   }
  ?>
  </table>
 </body>
</html>
