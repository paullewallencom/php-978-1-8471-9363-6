<?php
 //File: DB_func.php
 require_once 'Auth/Container/DB.php';                    
 class Auth_Container_DB_func extends Auth_Container_DB    
 {
  function fetchData($username, $password, $isChallengeResponse=false){  
   $this->options['table']="TABLE(".$this->options['table']."('".$username."'))";          
   return parent::fetchData($username, $password, $isChallengeResponse=false);         
  }
 }
?>
