CONN /as sysdba

GRANT EXECUTE ON dbms_crypto TO usr;  

CREATE OR REPLACE PROCEDURE usr.postNtf(url IN VARCHAR2, sch_tbl IN VARCHAR2, usr IN VARCHAR2) IS     
 req   UTL_HTTP.REQ;
 resp  UTL_HTTP.RESP;
 err_msg VARCHAR2(100);
 usr_hash VARCHAR2(40);
BEGIN
    BEGIN
     usr_hash:= DBMS_CRYPTO.HASH (           
     UTL_I18N.STRING_TO_RAW (usr, 'AL32UTF8'), 
     DBMS_CRYPTO.HASH_SH1);             
     usr_hash:=NLS_LOWER(usr_hash);
     req := UTL_HTTP.BEGIN_REQUEST(url||usr_hash);   
     resp := UTL_HTTP.GET_RESPONSE(req);            
     INSERT INTO ntfresults VALUES(SYSDATE, sch_tbl, usr, resp.reason_phrase);                                
     UTL_HTTP.END_RESPONSE(resp);
    EXCEPTION WHEN OTHERS THEN
     err_msg := SUBSTR(SQLERRM, 1, 100);
     INSERT INTO ntfresults VALUES(SYSDATE, sch_tbl, usr, err_msg); 
    END;
 COMMIT;
END;
/

