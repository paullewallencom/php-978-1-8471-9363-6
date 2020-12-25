CONN xmlusr/xmlusr

BEGIN 
 DBMS_XMLSCHEMA.registerschema(
  'emp.xsd',            
  '<xs:schema                 
              xmlns:xs="http://www.w3.org/2001/XMLSchema"  
              xmlns:xdb="http://xmlns.oracle.com/xdb">     
   <xs:element name="EMPLOYEE" type="EMP_TYP"/>   
   <xs:complexType name="EMP_TYP" xdb:SQLType="EMP_T"     
                   xdb:maintainDOM="false">         
    <xs:sequence>
     <xs:element name="ENAME" type ="enameType" xdb:SQLName="ENAME"
                 xdb:SQLType="VARCHAR2"/>
     <xs:element name="SALARY" type ="salaryType" xdb:SQLName="SALARY" 
                 xdb:SQLType="NUMBER"/>
    </xs:sequence> 
   <xs:attribute name="id" type="xs:positiveInteger"  
                 xdb:SQLName="EMPNO" 
                 xdb:SQLType="NUMBER"/>
   </xs:complexType>   
   <xs:simpleType name="salaryType">           
    <xs:restriction base="xs:double">    
      <xs:maxExclusive value="100000"/>  
    </xs:restriction>         
   </xs:simpleType>           
   <xs:simpleType name="enameType">           
     <xs:restriction base="xs:string">  
       <xs:minLength value="2"/>  
       <xs:maxLength value="30"/>  
      </xs:restriction>      
   </xs:simpleType> 
  </xs:schema>',
  TRUE,        
  TRUE,          
  FALSE,      
  FALSE         
 );
END;
/
