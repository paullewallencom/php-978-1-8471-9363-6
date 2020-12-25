CONN /as sysdba

ALTER TABLE usr.accounts                      
MODIFY (pswd VARCHAR2(40));                 

CREATE OR REPLACE PACKAGE sec_adm.sec_pkg IS                  
 TYPE acc_rec_set IS TABLE OF accounts_empty_v%ROWTYPE ;       
 FUNCTION f_auth(usrid VARCHAR2) RETURN acc_rec_set PIPELINED;  
 END sec_pkg;      
/

GRANT EXECUTE ON dbms_crypto TO sec_adm;         

CREATE OR REPLACE PACKAGE BODY sec_adm.sec_pkg IS         
FUNCTION f_auth(usrid VARCHAR2) 
RETURN acc_rec_set PIPELINED IS   
 acc_rec accounts_empty_v%ROWTYPE; 
BEGIN
 SELECT * INTO acc_rec FROM usr.accounts WHERE usr_id=usrid;
 acc_rec.pswd := DBMS_CRYPTO.HASH (                          
 UTL_I18N.STRING_TO_RAW (acc_rec.pswd, 'AL32UTF8'),          
 DBMS_CRYPTO.HASH_MD5);           
 acc_rec.pswd:=NLS_LOWER(acc_rec.pswd); 
 PIPE ROW(acc_rec);  
 RETURN; 
END;
END sec_pkg;
/

