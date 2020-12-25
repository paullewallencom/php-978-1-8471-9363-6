<?php
  //File: updateQuickForm.php
  require_once 'HTML/QuickForm.php';

  if(!$dbConn = oci_connect('hr', 'hr', '//localhost/orcl')) {
      $err = oci_error();
      trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
  };
  $jobno = 'AD_VP';
  $query = "
   UPDATE employees
   SET salary = salary*1.1
   WHERE job_id=:jobid";                                      
  $stmt = oci_parse($dbConn,$query);  
  oci_bind_by_name($stmt, ':jobid', $jobno);        
  if (!oci_execute($stmt, OCI_DEFAULT)) {                     
    $err = oci_error($stmt);                         
    trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  };
  print '<h2>Update confirmation!</h2>';
  $updrows = oci_num_rows($stmt);  
  $frm=new HTML_QuickForm('frm1', 'POST');
  $frm->addElement('header','msg1','You just updated '.$updrows. ' row(s). Do you want to commit changes?');
  $grp[] =& HTML_QuickForm::createElement('radio', null, null,'commit', 'C');
  $grp[] =& HTML_QuickForm::createElement('radio', null, null,'rollback', 'R');
  $frm->addGroup($grp, 'trans');
  $frm->setDefaults(array('trans' => 'C')); 
  $frm->addElement('submit','submit','Submit');

  if(isset($_POST['submit'])) {
    if ($_POST['trans']=='C'){
        oci_commit($dbConn);
        print 'Transaction committed';
    } elseif ($_POST['trans']=='R'){
        oci_rollback($dbConn);
        print 'Transaction rolled back';
    } else {
    $frm->display();
    }
  } else {
    $frm->display();
  }
?>
