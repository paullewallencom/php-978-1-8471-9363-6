CONN xmlusr/xmlusr;

CREATE OR REPLACE FUNCTION transOrder (xmldoc XMLType)  
RETURN XMLType
IS
 rsltdoc XMLType;
 ordid VARCHAR2(9);
 ordno VARCHAR2(6);
 orderDate DATE;
 shipDate DATE;
BEGIN
 ordid:='US-000000';                              
 SELECT orders_seq.nextval INTO ordno FROM DUAL;  
 ordid:=SUBSTR(ordid, 1, 9-LENGTH(ordno))||ordno; 
 orderDate:=SYSDATE; 
 shipDate:=SYSDATE+1;
 SELECT XMLQuery(          
  'for $p in $xmldoc/purchaseOrder
   return (<purchaseOrder xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"        
               xsi:noNamespaceSchemaLocation="po.xsd"
               id="{$ordid}">        
           {$orderDate,      
            $shipDate,       
            $p/shipTo,       
            $p/billTo,       
            $p/items}        
         </purchaseOrder>)'  
   PASSING  xmldoc as "xmldoc",
          XMLElement("ordid", ordid) AS "ordid",
          XMLElement("orderDate", orderDate) AS "orderDate",
          XMLElement("shipDate", shipDate) AS "shipDate"
   RETURNING CONTENT) INTO rsltdoc FROM DUAL;
 RETURN rsltdoc;           
END;
/
