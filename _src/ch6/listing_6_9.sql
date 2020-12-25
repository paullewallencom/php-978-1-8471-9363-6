CONN /as sysdba

CREATE OR REPLACE VIEW sec_adm.accounts_v AS                   
SELECT usr_id, full_name                         
FROM TABLE(sec_adm.sec_pkg.f_auth(sec_adm.set_cxt_pkg.get_userid)); 

GRANT SELECT ON sec_adm.accounts_v TO app_conn;        

