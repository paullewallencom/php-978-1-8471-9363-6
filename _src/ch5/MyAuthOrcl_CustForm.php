<?php
 //File: MyAuthOrcl_CustForm.php
 require_once 'HTML/QuickForm.php';            
 //Obtain the Auth class so it can be extended 
 require_once 'Auth.php';                      
 class MyAuthOrcl_CustForm extends Auth             
 {
  protected $auth_default_options = array(
       'cryptType'=>'none',
   );
  public function __construct ($arr)
  {
   function login_function($username, $status)   
    {
     $headerTemplate  = '<tr><td style="background-color: #dddddd;" align="center" colspan="2"><font face="Arial"><i>{header}</i></font></td></tr>';  
     $elementTemplate  = '<tr><td align="right"><font face="Arial"><!-- BEGIN required --><span style="color: #ff0000">*</span>';
     $elementTemplate  .= '<!-- END required -->{label}</font></td><td align="left">{element}</td></tr>';
     $form=new HTML_QuickForm('login', 'POST');       
     $renderer = $form->defaultRenderer();            
     $renderer->setHeaderTemplate($headerTemplate);
     $renderer->setElementTemplate($elementTemplate);
     $header='Please enter your credentials';
     switch ($status) {
      case -1: $header='You have been idle for too long. Please login again.';
                break;
      case -2: $header='Session expired. Please login again.';
                break;
      case -3: $header='You entered wrong data. Please try again.';
                break;
     }
     $form->addElement('header',null,$header );
     $form->addElement('text','username','User name:');
     $form->addRule('username','The username field is required!','required', null, 'client');
     $form->addElement('password','password','Password:');
     $form->addRule('password','The password field is required!','required', null, 'client');
     $form->addElement('submit','submit','Sign in!');
     $form->display();
    }
    $auth_options = array_merge($this->auth_default_options, $arr);
    $auth_options['usernamecol'] = strtoupper($auth_options['usernamecol']);
    $auth_options['passwordcol'] = strtoupper($auth_options['passwordcol']);
    parent::__construct('DB',$auth_options, 'login_function');   
  }
}
?>

