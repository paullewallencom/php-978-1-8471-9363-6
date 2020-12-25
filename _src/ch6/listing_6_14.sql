CONN /as sysdba

CREATE TABLE usr.orders(   
  ordno   NUMBER PRIMARY KEY,                
  empno   VARCHAR2(40) REFERENCES usr.accounts(usr_id), 
  orddate DATE,                                  
  total   NUMBER(10,2)                         
);                 

INSERT INTO usr.orders VALUES
(1001, 'bob', '01-aug-2006', 5870.00); 
INSERT INTO usr.orders VALUES 
(1002, 'bob', '01-aug-2006', 12500.00); 

INSERT INTO usr.orders VALUES 
(1003, 'maya', '04-aug-2006', 1100.50); 

INSERT INTO usr.orders VALUES 
(1004, 'bob', '05-aug-2006', 10230.00); 

COMMIT;
