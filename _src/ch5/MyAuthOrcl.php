<?php
  //File: MyAuthOrcl.php
  require_once 'Auth.php';                  
  class MyAuthOrcl extends Auth             
  {
   protected $auth_default_options = array(  
       'cryptType'=>'none',                  
   );
   public function __construct ($arr)        
   {
    $auth_options = array_merge($this->auth_default_options, $arr);  
    $auth_options['usernamecol'] = strtoupper($auth_options['usernamecol']);    
    $auth_options['passwordcol'] = strtoupper($auth_options['passwordcol']);     
    parent::__construct('DB',$auth_options);  
   }
  }
?>
