CONN /AS sysdba

CREATE VIEW sec_adm.accounts_empty_v AS        
SELECT * FROM usr.accounts WHERE 1=0;         

CREATE OR REPLACE PACKAGE sec_adm.sec_pkg IS                
 TYPE acc_rec_set IS TABLE OF accounts_empty_v%ROWTYPE ;       
 FUNCTION f_auth(usrid VARCHAR2) RETURN acc_rec_set PIPELINED;  
 END sec_pkg;
/

CREATE OR REPLACE PACKAGE BODY sec_adm.sec_pkg IS            
FUNCTION f_auth(usrid VARCHAR2)                     
RETURN acc_rec_set PIPELINED IS                   
 acc_rec accounts_empty_v%ROWTYPE;                    
BEGIN
 SELECT * INTO acc_rec FROM usr.accounts WHERE usr_id=usrid; 
 PIPE ROW(acc_rec);                                        
 RETURN;                                                   
END;
END sec_pkg;
/
