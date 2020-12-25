CONN usr/usr 

CREATE OR REPLACE TYPE emp_t AS OBJECT(
 empno   VARCHAR2(6),
 name    VARCHAR2(30),
 job_ref REF job_t,
 salary  NUMBER,
 MEMBER FUNCTION newsalary(inc_sal NUMBER) RETURN NUMBER DETERMINISTIC  
);
/

CREATE OR REPLACE TYPE BODY emp_t IS           
MEMBER FUNCTION newsalary(inc_sal NUMBER) RETURN NUMBER IS     
 job_obj job_t;                                 
 maxsal NUMBER;
BEGIN
 UTL_REF.SELECT_OBJECT(self.job_ref,job_obj);    
 maxsal:=job_obj.max_salary;
 IF (inc_sal*self.salary > maxsal) THEN
   RAISE_APPLICATION_ERROR(-20000, 'New salary exceeds the maximum allowable salary');            
 END IF;
 RETURN inc_sal*self.salary;        
END;
END;
/

CREATE TABLE emps_obj_table OF emp_t;     

ALTER TABLE emps_obj_table ADD PRIMARY KEY (empno);

CONN /AS SYSDBA

GRANT SELECT on hr.employees TO usr;

CONN usr/usr

INSERT INTO emps_obj_table(empno, name, salary, job_ref)        
SELECT employee_id, last_name, salary, (SELECT REF(j) FROM jobs_obj_table j WHERE j.job_id=e.job_id)                      
FROM hr.employees e;                                           
