<?php
  //File: dbConn4.php
  class dbConn4 {   
    var $user;      
    var $pswd;      
    var $db;        
    var $conn;      
    var $query;     
    var $row;       
    var $exec_mode = OCI_COMMIT_ON_SUCCESS; 

    function dbConn4($user, $pswd, $db, $exec_mode=OCI_COMMIT_ON_SUCCESS)   
    {
      $this->user = $user;            
      $this->pswd = $pswd;            
      $this->db = $db;              
      $this->exec_mode = $exec_mode;  
      $this->GetConn ();             
    }
    function GetConn()         
    {
     if(!$this->conn = OCILogon($this->user, $this->pswd, $this->db)) 
       {
        $err = OCIError();
        trigger_error('Failed to establish a connection: ' . $err['message']);
       }
    }
    function query($sql)         
    {
      if(!$this->query = OCIParse($this->conn, $sql)) {
        $err = OCIError($this->conn);
        trigger_error('Failed to parse SQL query: ' . $err['message']);
        return false;
      }
      else if(!OCIExecute($this->query, $this->exec_mode)) {
        $err = OCIError($this->query);
        trigger_error('Failed to execute SQL query: ' . $err['message']);
        return false;
        }
     return true;
    }
    function fetch()          
    {
      if(!OCIFetchInto($this->query, $this->row, OCI_ASSOC)){
         return false;
        }
      return $this->row;
    }
   }
?>
