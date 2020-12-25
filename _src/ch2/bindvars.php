<?php
  //File: bindvars.php
   if(!$dbConn = oci_connect('hr', 'hr', '//localhost/orcl')) {
        $err = oci_error();
        trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
    };
   $depts = array(array("deptno" => 330, "deptname" => 'Research'),
                   array("deptno" => 340, "deptname" => 'DB Development'));
   $query = 'INSERT INTO departments (department_id, department_name) VALUES(:dept_id, :dept_name)';
   $stmt = oci_parse($dbConn, $query); 
   foreach ($depts as $dept) {
    oci_bind_by_name($stmt, ':dept_id', $dept['deptno']);
    oci_bind_by_name($stmt, ':dept_name', $dept['deptname']);
    if (!oci_execute($stmt)){
        $err = oci_error($stmt);
        trigger_error('Insertion failed: ' . $err['message'], E_USER_WARNING);
      } else {
        print 'Row inserted! <br />';
     }
   }
?>
