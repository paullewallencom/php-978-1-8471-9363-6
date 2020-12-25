CONN xmlusr/xmlusr;

DECLARE
  rslt BOOLEAN;
  xmldoc VARCHAR2(250) :=
  '<EMPLOYEE 
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:noNamespaceSchemaLocation="employee.xsd"
    id="303">
    <ENAME>Locke</ENAME>
    <SALARY>7000</SALARY>
  </EMPLOYEE>';

BEGIN
 IF (NOT DBMS_XDB.existsResource('/public/xmlusr')) THEN
  rslt:=DBMS_XDB.createFolder('/public/xmlusr');
 END IF;
 IF (NOT DBMS_XDB.existsResource('/public/xmlusr/emps')) THEN
  rslt:=DBMS_XDB.createFolder('/public/xmlusr/emps');
 END IF;
 rslt := DBMS_XDB.createResource('/public/xmlusr/emps/emp303.xml', xmldoc);
 COMMIT;
END;
/

