CREATE OR REPLACE TRIGGER accounts_trigger        
   BEFORE INSERT OR UPDATE OF usr_id              
   ON accounts                                    
   FOR EACH ROW                                   
DECLARE                                          
   not_allowed_symbol EXCEPTION;                 
BEGIN
   IF REGEXP_INSTR(:new.usr_id,'[[:digit:]]{1}')=1 THEN    
     RAISE not_allowed_symbol;                             
   END IF;
 EXCEPTION
   WHEN not_allowed_symbol                                 
   THEN                                                    
      RAISE_APPLICATION_ERROR (-20500,                    
        'This record cannot be inserted or updated because usr_id begins with a digit');                                    
END;
/                  
