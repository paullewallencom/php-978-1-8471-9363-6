{\rtf1\ansi\ansicpg1251\deff0\deflang1049{\fonttbl{\f0\fmodern\fprq1\fcharset0 Courier;}{\f1\fswiss\fcharset0 Arial;}}
{\colortbl ;\red0\green0\blue0;}
\viewkind4\uc1\pard\nowidctlpar\sl-200\slmult0\tx240\tx480\tx720\tx960\tx1200\tx1440\tx1680\tx1920\tx2160\tx2400\tx2640\tx2880\cf1\lang1033\f0\fs20 CONN usr/usr\par
\par
CREATE OR REPLACE FUNCTION auth(user IN VARCHAR2, password IN VARCHAR2, fullname OUT VARCHAR2, msg OUT VARCHAR2 )         \par
RETURN NUMBER AS                          \par
BEGIN                    \par
 BEGIN\par
  SELECT full_name INTO fullname FROM accounts WHERE usr_id=user AND pswd=password;                      \par
 EXCEPTION\par
  WHEN NO_DATA_FOUND THEN     \par
    msg:='Wrong user/password combination';          \par
    RETURN 0;        \par
 END;\par
 BEGIN\par
  INSERT INTO logons VALUES(user, SYSDATE);   \par
  COMMIT;                   \par
 EXCEPTION\par
   WHEN OTHERS THEN\par
    msg:='Failed to insert a row into the logons table';\par
    RETURN 1;        \par
 END;\par
 RETURN 1;                        \par
END;\par
\par
\pard\nowidctlpar\sl-210\slmult0\tx168\tx336\tx503\tx672\tx840\tx1007\tx1176\tx1344\tx1512\tx1679\tx1847\tx2015\tx2183\tx2351\tx2519\tx2687\tx2855\tx3023\tx3191\tx3359\tx3527\tx3695\tx3863\tx4031\tx4199\tx4367\tx4535\tx4703\tx4871\tx5039\tx5207\tx5375\par
\pard\cf0\lang1049\f1\par
}
 