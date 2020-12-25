CONN xmlusr/xmlusr;

CREATE OR REPLACE FUNCTION placeNewOrder (xmldoc IN XMLType, msg OUT VARCHAR2)      
RETURN NUMBER
IS
  tmpxml XMLType;
  errcode NUMBER;
  errmesg VARCHAR2(256);
BEGIN
  tmpxml := xmldoc;
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


