
CONN xmlusr/xmlusr;

CREATE OR REPLACE FUNCTION placeNewOrderSecure (xmldoc IN XMLType, pswd IN VARCHAR2, msg OUT VARCHAR2)       
RETURN NUMBER
IS
  tmpxml XMLType;
  errcode NUMBER;
  errmesg VARCHAR2(256);
BEGIN
  tmpxml := xmldoc;
  checkCred(tmpxml, pswd);
  XMLTYPE.schemaValidate(tmpxml);  
  tmpxml:=transOrder(tmpxml);    
  INSERT INTO po VALUES(tmpxml); 
  COMMIT;
  msg:='Ok!';
  RETURN 1;                
  EXCEPTION 
   WHEN OTHERS THEN       
    errcode := SQLCODE;    
    errmesg := SUBSTR(SQLERRM, 1, 256); 
    msg:= errcode || ': ' || errmesg;  
    RETURN 0;                      
END;
/

