var req = null;
function initRequest() {
  if (!req) {
   try {
    req = new XMLHttpRequest();
   }
   catch (e) {
    try {
     req = new ActiveXObject('MSXML2.XMLHTTP');
    }
    catch (e) {
     try {
      req = new ActiveXObject('Microsoft.XMLHTTP');
     }
     catch (e) {
      req = null;
     }
    }
   }
  }
 }
 