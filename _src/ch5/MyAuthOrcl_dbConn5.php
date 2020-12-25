<?php
 //File: MyAuthOrcl_dbConn5.php
 require_once 'HTML/QuickForm.php';
 require_once 'Auth.php';
 class MyAuthOrcl_dbConn5 extends Auth
 {
  protected $auth_default_options = array(
       'cryptType'=>'none',
  );
  private $dbConn = null;                      
  public function __construct ($arr, $conn)    
  {
   $this->dbConn=$conn;                       
   function login_function($username, $status)
   {
     ...
      // Here is the body of the login_function function as shown in listing 5.16
     ...
    }
    $auth_options = array_merge($this->auth_default_options, $arr);
    $auth_options['usernamecol'] = strtoupper($auth_options['usernamecol']);
    $auth_options['passwordcol'] = strtoupper($auth_options['passwordcol']);
    parent::__construct('DB',$auth_options, 'login_function');
  }
  public function login()                   
  {
    function defaultLoginCallback($username, $authObj)   
    {
     $query="INSERT INTO logons VALUES("."'".$username."',"."SYSDATE)"; 
     if(!$authObj->dbConn->query($query)){         
        print "Failed to create an audit record";
     }
    };
    if ($this->loginCallback==''){                
        $this->setLoginCallback('defaultLoginCallback');  
    }
    return parent::login();                
  }
 }
?>
