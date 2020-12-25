CONN /as sysdba

GRANT SELECT ON usr.accounts TO sec_adm;      

GRANT SELECT ON usr.orders TO sec_adm;      

CREATE OR REPLACE PACKAGE sec_adm.cxt_ord_pkg  
AS
TYPE ord_rec_typ IS RECORD (                    
 EMPNAME   VARCHAR2(20),                         
 ORDDATE   DATE);                    
 TYPE ord_rec_set IS TABLE OF ord_rec_typ;
 PROCEDURE setRecentOrder(empname VARCHAR2,orddate DATE);  
 FUNCTION getRecentOrder RETURN ord_rec_set PIPELINED;     
END;
/

CREATE OR REPLACE PACKAGE BODY sec_adm.cxt_ord_pkg IS
PROCEDURE setRecentOrder(empname VARCHAR2,orddate DATE) IS
BEGIN
  DBMS_SESSION.SET_CONTEXT(      
    NAMESPACE => 'cxt_ord',      
    ATTRIBUTE => 'empname',   
    VALUE => empname         
  );         
  DBMS_SESSION.SET_CONTEXT(   
    NAMESPACE => 'cxt_ord',   
    ATTRIBUTE => 'orddate',   
    VALUE =>     orddate      
  );
END;
FUNCTION getRecentOrder RETURN ord_rec_set PIPELINED IS 
 ord_rec ord_rec_typ;
BEGIN                           
 IF SYS_CONTEXT('cxt_ord', 'empname') IS NULL THEN       
  SELECT * INTO ord_rec FROM                               
  (SELECT full_name as empname, orddate  FROM usr.orders, usr.accounts WHERE empno=usr_id ORDER BY orddate DESC)                
  WHERE rownum=1;                                          
  setRecentOrder(ord_rec.empname, ord_rec.orddate);
ELSE
  ord_rec.empname:= SYS_CONTEXT('cxt_ord', 'empname');   
  ord_rec.orddate:= SYS_CONTEXT('cxt_ord', 'orddate');   
 END IF;
 PIPE ROW(ord_rec);  
 RETURN;
END;
END;          
/

GRANT EXECUTE ON sec_adm.cxt_ord_pkg TO app_conn;

