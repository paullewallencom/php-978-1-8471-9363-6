<?php
  //File: XPath.php
  $dom = new DomDocument();
  $dom->load('employees.xml');
  $xpath = new DOMXPath($dom);
  $query = '//EMPLOYEE/SALARY[. > "15000"]';
  $emps = $xpath->query($query);
  print '<font face="Arial">';
  print '<h3>Executive officers whose salaries > $15,000</h3>';
  print '<table border="1" cellpadding="5">';
  print '<th>Employee ID</th><th>Last Name</th><th>Salary</th>';
  foreach ($emps as $emp) {
    print '<tr><td>'.$emp->parentNode->getAttribute('id').'</td>';
    print '<td>'.$emp->previousSibling->nodeValue.'</td>';
    print '<td>'.$emp->nodeValue.'</td></tr>';
  }
  print '</table>';
  print '</font>';
?>