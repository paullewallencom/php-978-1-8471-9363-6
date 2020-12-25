CONN xmlusr/xmlusr; 

BEGIN
 DBMS_XMLSCHEMA.registerschema(
  'po.xsd',
  '<?xml version="1.0" encoding="UTF-8"?>  
<xs:schema                
         xmlns:xs="http://www.w3.org/2001/XMLSchema"  
         xmlns:xdb="http://xmlns.oracle.com/xdb"
         xdb:storeVarrayAsTable="true" > 
   <xs:element name="purchaseOrder" type="purchaseOrder_typ" 
               xdb:defaultTable="PO"                    
               xdb:columnProps=
               "CONSTRAINT po_pkey PRIMARY KEY (XMLDATA.pono)"/>   
   <xs:complexType name="purchaseOrder_typ" > 
    <xs:sequence>
     <xs:element name="orderDate" type="xs:date" minOccurs="0"/>   
     <xs:element name="shipDate" type="xs:date" minOccurs="0"/>    
     <xs:element name="shipTo" type="Address"/>
     <xs:element name="billTo" type="Address"/>
     <xs:element name="items" type="Items"/>
    </xs:sequence>
    <xs:attribute name="id" xdb:SQLName="PONO" >            
      <xs:simpleType>
       <xs:restriction base="xs:string">
        <xs:pattern value="[A-Z]{2}-\d{6}"/>        
       </xs:restriction>
      </xs:simpleType>
     </xs:attribute>
   </xs:complexType>
   <xs:complexType name="Address" >
    <xs:sequence>
     <xs:element name="name" type="xs:string" />
     <xs:element name="street" type="xs:string" />
     <xs:element name="city" type="xs:string" />
     <xs:element name="state" type="xs:string" />
     <xs:element name="zip">
      <xs:simpleType>
       <xs:restriction base="xs:string">
        <xs:pattern value="\d{5}"/> 
       </xs:restriction>
      </xs:simpleType>
     </xs:element>
    </xs:sequence>
    <xs:attribute name="country" type="xs:NMTOKENS" fixed="US"/>
   </xs:complexType>
   <xs:complexType name="Items" >
    <xs:sequence>
     <xs:element name="item" minOccurs="0" maxOccurs="unbounded" >
      <xs:complexType>
       <xs:sequence>
        <xs:element name="partId" >
        <xs:simpleType>
         <xs:restriction base="xs:string">
          <xs:pattern value="\d{3}"/> 
         </xs:restriction>
        </xs:simpleType>
       </xs:element>
       <xs:element name="quantity" >
        <xs:simpleType>
         <xs:restriction base="xs:positiveInteger">
          <xs:maxExclusive value="100"/>                 
         </xs:restriction>
        </xs:simpleType>
       </xs:element>
       <xs:element name="price" type="xs:decimal"/>
      </xs:sequence>
     </xs:complexType>
    </xs:element>
   </xs:sequence>
  </xs:complexType>
 </xs:schema>',
 TRUE,      
 TRUE,      
 FALSE,     
 TRUE       
 );
END;
/

