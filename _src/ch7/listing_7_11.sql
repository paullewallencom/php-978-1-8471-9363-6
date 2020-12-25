CONN /as sysdba

CREATE OR REPLACE PROCEDURE usr.orders_ntf_callback (ntfnds IN SYS.CHNF$_DESC) IS                    
 tblname VARCHAR2(60);
 numtables NUMBER;
 event_type NUMBER;
 row_id VARCHAR2(20);
 numrows NUMBER;
 usr VARCHAR2(40);
 url VARCHAR2(256) := 'http://localhost/PHPOracleInAction/ch7/dropCachedEmpOrders.php?par='; 
BEGIN
 event_type := ntfnds.event_type;     
 numtables := ntfnds.numtables;       
 IF (event_type = DBMS_CHANGE_NOTIFICATION.EVENT_OBJCHANGE) THEN  
  FOR i IN 1..numtables LOOP                           
   tblname := ntfnds.table_desc_array(i).table_name;    
   IF (bitand(ntfnds.table_desc_array(i).opflags, DBMS_CHANGE_NOTIFICATION.ALL_ROWS) = 0) THEN               
    numrows := ntfnds.table_desc_array(i).numrows;   
   ELSE
    numrows :=0;
   END IF;
   IF (tblname = 'USR.ORDERS') THEN  
    FOR j IN 1..numrows LOOP             
     row_id := ntfnds.table_desc_array(i).row_desc_array(j).row_id;  
     SELECT empno INTO usr FROM usr.orders WHERE rowid = row_id;  
     postNtf(url, tblname, usr);     
    END LOOP;
   END IF;
  END LOOP;
 END IF;
 COMMIT;
END;
/

