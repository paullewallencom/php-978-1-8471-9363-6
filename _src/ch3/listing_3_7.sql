CONN /AS sysdba                           

CREATE USER usr IDENTIFIED BY usr;        

GRANT connect, resource TO usr;           

CONN usr/usr                             

CREATE TABLE accounts (usr_id     VARCHAR2(10)  PRIMARY KEY,    
                       full_name  VARCHAR2(20),                 
                       pswd       VARCHAR2(10)  NOT NULL        
  );                                                            

CREATE TABLE logons (usr_id     VARCHAR2(10)  REFERENCES accounts,  
                     log_time   DATE                                
  );                                                                

CREATE INDEX ind_usr_id ON logons(usr_id);                          

INSERT INTO accounts VALUES ('bob', 'Bob Robinson', 'pswd');       

COMMIT;                         
