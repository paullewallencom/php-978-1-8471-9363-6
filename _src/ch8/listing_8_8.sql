CONN xmlusr/xmlusr  

CREATE TABLE XSLTstylesheets (
   id NUMBER,
   stylesheet XMLType
);

INSERT INTO XSLTstylesheets VALUES (
 1,
 XMLType(
'<?xml version="1.0" encoding="utf-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"> 
   <xsl:template match="/"> 
    <html>
     <head>
       <title>Employees</title>
     </head>
      <body>
       <font face="Arial">
       <h2>List of employees from employees.xml</h2>
       <table border="1" cellspacing="0" cellpadding="5">
       <tr>
          <th><b>EMPLOYEE ID</b></th>
          <th><b>LAST NAME</b></th>
          <th><b>SALARY</b></th>  
       </tr>
         <xsl:for-each select="EMPLOYEES">
          <xsl:for-each select="EMPLOYEE">
              <tr>
                <td><xsl:value-of select="@id"/></td>
                <td><xsl:value-of select="ENAME"/></td>
                <td><xsl:value-of select="SALARY"/></td>
              </tr>
            </xsl:for-each>
           </xsl:for-each>
          </table>
        </font>
      </body>
    </html>
   </xsl:template>
  </xsl:stylesheet>')
 );

COMMIT;

