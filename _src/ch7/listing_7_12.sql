CONN /as sysdba

GRANT CONNECT TO usr;   

CONNECT usr/usr         

DECLARE        
 REGDS SYS.CHNF$_REG_INFO;
 regid NUMBER;
 empid VARCHAR2(40);
 qosflags NUMBER;
BEGIN
 qosflags := DBMS_CHANGE_NOTIFICATION.QOS_RELIABLE + DBMS_CHANGE_NOTIFICATION.QOS_ROWIDS;                  
 REGDS := SYS.CHNF$_REG_INFO ('usr.orders_ntf_callback', qosflags, 0,0,0);    
 regid := DBMS_CHANGE_NOTIFICATION.NEW_REG_START (REGDS);  
 SELECT empno INTO empid FROM usr.orders WHERE ROWNUM<2;    
 DBMS_CHANGE_NOTIFICATION.REG_END;              
END;
/

CONN /as sysdba

REVOKE CONNECT FROM usr;            
