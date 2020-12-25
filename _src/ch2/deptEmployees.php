<?php
  //File: deptEmployees.php
require_once 'getEmployees.php';                                     
$deptno = 60;
if(!list($nrows, $employess) = getEmployees($deptno)){               
 print '<h3>'.'All employees working in Department '.$deptno.'</h3>';
 if ($nrows > 0) {
  print "<table border=1>";
  print "<tr>\n";
  while (list($key, $value) = each($employees)) {                
   print "<th>$key</th>\n";                                      
  }                                                              
  print "</tr>\n";
  print "</tr>\n";
  
  for ($i = 0; $i < $nrows; $i++) {                          
     print "<tr>\n";                                         
     foreach ($employees as $emp) {                          
        print "<td>$emp[$i]</td>\n";                         
     }                                                       
     print "</tr>\n";                                    
  }                                                      
  print "</table>\n";
 } else {
  echo "No employees found<br />\n";
 }      
}
?>
