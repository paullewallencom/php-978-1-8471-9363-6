<?php
  //File: dbConn5e.php
  class dbConn5e {
    private $user;
    private $pswd;
    private $db;
    private $conn;
    private $query;
    private $row;   
    private $exec_mode; 
    public function __construct($user, $pswd, $db, $exec_mode= OCI_COMMIT_ON_SUCCESS)
    {
      $this->user = $user;
      $this->pswd = $pswd;
      $this->db = $db;
      $this->exec_mode = $exec_mode;
      $this->GetConn();
    }
    private function GetConn()
    {
    if(!$this->conn = oci_connect($this->user, $this->pswd, $this->db))
       {
         $err = oci_error();           
          throw new Exception('Could not establish a connection: ' . $err['message']);          
         }
    }
    public function query($sql)
    {
      if(!$this->query = oci_parse($this->conn, $sql)) {
          $err = oci_error($this->conn);
           throw new Exception('Failed to execute SQL query: ' . $err['message']);
      }
      else if(!oci_execute($this->query, $this->exec_mode)) {
          $err = oci_error($this->query);
           throw new Exception('Failed to execute SQL query: ' . $err['message']);
         }
       return true;
    }
    public function fetch()
    {
      if($this->row=oci_fetch_assoc($this->query)){
         return $this->row;
         }
      else {
         return false;            
        }
    }
   }
?>

