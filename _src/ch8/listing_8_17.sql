CONN xmlusr/xmlusr

CREATE TABLE emps   
AS SELECT employee_id, last_name, salary FROM hr.employees; 

ALTER TABLE emps
ADD constraint EMP_PRIMARYKEY
PRIMARY KEY (employee_id);

CREATE OR REPLACE VIEW empSch_v OF XMLType
 XMLSCHEMA "emp.xsd" ELEMENT "EMPLOYEE"    
 WITH OBJECT ID (extract(OBJECT_VALUE, '/EMPLOYEE/@id/text()').getNumberVal()) AS   
 SELECT EMP_T(e.employee_id, e.last_name, e.salary) 
 FROM emps e;

