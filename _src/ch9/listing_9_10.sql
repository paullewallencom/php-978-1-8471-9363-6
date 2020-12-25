CONN /as sysdba

GRANT EXECUTE ON dbms_crypto TO xmlusr;        

CONN xmlusr/xmlusr;

CREATE OR REPLACE PROCEDURE checkCred (xmldoc XMLType, pswd VARCHAR2)  
IS
 billName VARCHAR2(30);
 hashName VARCHAR2(40);
BEGIN
 SELECT extractValue(xmldoc, '/purchaseOrder/billTo/name') INTO billName FROM DUAL;  
 hashName := DBMS_CRYPTO.HASH (                         
 UTL_I18N.STRING_TO_RAW (billName, 'AL32UTF8'),         
 DBMS_CRYPTO.HASH_SH1);          
 hashName:=NLS_LOWER(hashName); 
 IF (hashName!=pswd) THEN
  raise_application_error(-20101, 'Specified token is not valid');
 END IF;
END;
/

