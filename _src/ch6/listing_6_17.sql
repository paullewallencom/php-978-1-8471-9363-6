CONN /as sysdba

GRANT EXECUTE ON sec_adm.set_cxt_pkg TO usr;

CREATE OR REPLACE FUNCTION usr.f_get_userid RETURN VARCHAR2 IS  
BEGIN                           
   RETURN sec_adm.set_cxt_pkg.get_userid;  
END;           
/

CREATE OR REPLACE VIEW usr.orders_decode_v AS       
SELECT ordno, DECODE(empno, usr.f_get_userid, full_name, NULL) empname, orddate, total    
FROM usr.orders, usr.accounts  
WHERE empno=usr_id;   

GRANT SELECT ON usr.orders_decode_v TO app_conn;

