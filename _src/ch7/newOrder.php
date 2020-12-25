<?php
 //File: newOrder.php 
 require_once "testAuthor.php";                 
 require_once "HTML/QuickForm.php";        
 $form = new HTML_QuickForm('newOrderForm');    
 $form->setDefaults(              
    array(                        
    'empno' => $username          
    )                             
 );                               
 $form->addElement('text', 'ordno', 'Enter order number:', array('size' => 10, 'maxlength' => 10));   
 $form->addElement('text', 'empno', 'Your account name:', array('size' => 20, 'readonly'));         
 $form->addElement('text', 'total', 'Enter order total:', array('size' => 20, 'maxlength' => 20));  
 $form->addElement('submit', 'submit', 'Send');
 // Define validation rules
 $form->addRule('ordno', 'Please enter order number', 'required', null, 'client');       
 $form->addRule('total', 'Please enter order total', 'required', null, 'client');       
 if(isset($_POST['submit'])) {                            
    $arr_ord =array(                              
               $form->getSubmitValue('ordno'),    
               $form->getSubmitValue('empno'),    
               $form->getSubmitValue('total')     
              );                                  
    $rslt =$dbh->query("BEGIN usr.newOrder(?,?,?); END;",$arr_ord);  
    if (PEAR::isError($rslt)) {      
     die($rslt->getMessage());       
    }                                
    $f_name =$a->getAuthData('FULL_NAME');   
    $rslt =$dbh->query("BEGIN sec_adm.cxt_ord_pkg.setRecentOrder(?,SYSDATE); END;",$f_name);  
    if (PEAR::isError($rslt)) {  
     print $rslt->getMessage();  
    }
     print "<h4>You just placed a new order!</h4>";
 } else{
 $form->display();    
 }
?>

