CONN usr/usr      

CREATE OR REPLACE TYPE job_t AS OBJECT(  
 job_id              VARCHAR2(10),       
 job_title           VARCHAR2(35),       
 min_salary          NUMBER(6),          
 max_salary          NUMBER(6)           
);                                  
/

CREATE TABLE jobs_obj_table OF job_t;   

ALTER TABLE jobs_obj_table ADD PRIMARY KEY (job_id);  

CONN /AS SYSDBA                     

GRANT SELECT on hr.jobs TO usr;        

CONN usr/usr

INSERT INTO jobs_obj_table SELECT * FROM hr.jobs;  
