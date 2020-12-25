CONN /as sysdba

CREATE OR REPLACE VIEW usr.orders_emp_v AS      
SELECT ordno, full_name as empname, orddate, total 
FROM usr.orders, usr.accounts 
WHERE (empno=usr.f_get_userid) AND (empno=usr_id); 

GRANT SELECT ON usr.orders_emp_v TO app_conn;

