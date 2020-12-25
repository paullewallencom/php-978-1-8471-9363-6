CONN /as sysdba

CREATE OR REPLACE PACKAGE sec_adm.app_cxt_pkg IS    
  userid VARCHAR2(40);                              
END;                                                
/

CREATE OR REPLACE PACKAGE sec_adm.set_cxt_pkg IS   
  FUNCTION get_userid RETURN VARCHAR2;              
  PROCEDURE set_userid(usrid VARCHAR2);            
END;                                               
/

CREATE OR REPLACE PACKAGE BODY sec_adm.set_cxt_pkg IS            
 FUNCTION get_userid RETURN VARCHAR2                     
 AS
 BEGIN
    RETURN app_cxt_pkg.userid;                             
 END;
 PROCEDURE set_userid(usrid VARCHAR2)                     
 AS
 BEGIN
  IF (SYS_CONTEXT('USERENV', 'IP_ADDRESS') = '127.0.0.1')        
  THEN                                                       
    app_cxt_pkg.userid:=usrid;                               
  END IF;                                                   
END;
END;
/

GRANT EXECUTE ON sec_adm.set_cxt_pkg TO app_conn;       

