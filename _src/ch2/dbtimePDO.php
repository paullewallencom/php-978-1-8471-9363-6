<?php
try {
  $dbh = new PDO('oci:host=localhost;dbname=orcl', 'hr', 'hr');
  foreach ($dbh->query("SELECT TO_CHAR(SYSDATE, 'HH:MI:SS') ctime FROM DUAL") as $row) {
     print "<h3>The current time is ".$row['CTIME']."</h3>";
  }
  $dbh = null;
} catch (PDOException $e) {
     die("Error!: " . $e->getMessage() );
}
?>
