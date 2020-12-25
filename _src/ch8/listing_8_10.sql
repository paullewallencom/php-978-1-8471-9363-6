CONN /as sysdba

GRANT ALTER SESSION TO xmlusr;

CONN xmlusr/xmlusr

BEGIN 
 DBMS_XMLSCHEMA.registerschema(
  'employee.xsd',            
  '<xs:schema                  
              xmlns:xs="http://www.w3.org/2001/XMLSchema"  
              xmlns:xdb="http://xmlns.oracle.com/xdb">     
   <xs:element name="EMPLOYEE" type="EMPLOYEE_TYP" 
               xdb:defaultTable="EMPLOYEES"        
               xdb:columnProps=
               "CONSTRAINT emp_pkey PRIMARY KEY (XMLDATA.empno)"/>   
   <xs:complexType name="EMPLOYEE_TYP" xdb:SQLType="EMPLOYEE_T"> 
    <xs:sequence>
     <xs:element name="ENAME" type="xs:string" xdb:SQLName="ENAME"
                 xdb:SQLType="VARCHAR2"/>
     <xs:element name="SALARY" type="xs:double" xdb:SQLName="SALARY" 
                 xdb:SQLType="NUMBER"/>
    </xs:sequence>
   <xs:attribute name="id" type="xs:positiveInteger"   
                 xdb:SQLName="EMPNO" 
                 xdb:SQLType="NUMBER"/>
   </xs:complexType>
  </xs:schema>',
  TRUE,        
  TRUE,        
  FALSE,       
  TRUE         
 );
END;
/

