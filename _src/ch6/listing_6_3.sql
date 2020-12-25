CONN /AS sysdba                                             

CREATE OR REPLACE PACKAGE sec_adm.sec_pkg IS                
 TYPE acc_rec_typ IS RECORD (                             
 USR_ID      VARCHAR2(10),                              
 FULL_NAME   VARCHAR2(20),                              
 PSWD        VARCHAR2(10),                              
 NUM_LOGONS  NUMBER(38));                               
 TYPE acc_rec_set IS TABLE OF acc_rec_typ;        
 FUNCTION f_auth(usrid VARCHAR2) RETURN acc_rec_set PIPELINED;  
 END sec_pkg;
/

CREATE OR REPLACE PACKAGE BODY sec_adm.sec_pkg IS            
FUNCTION f_auth(usrid VARCHAR2)                     
RETURN acc_rec_set PIPELINED IS                   
 acc_rec acc_rec_typ;                    
BEGIN
 SELECT * INTO acc_rec FROM usr.accounts WHERE usr_id=usrid; 
 PIPE ROW(acc_rec);                                        
 RETURN;                                                   
END;
END sec_pkg;
/

