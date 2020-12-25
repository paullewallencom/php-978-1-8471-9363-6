function setFullDesc (artid) {
    var thisFullDesc = document.getElementById('fullDesc'+artid); 
    var thisArticle = document.getElementById('article'+artid); 
   // var thisDesc = document.getElementById('desc'+artid); 
    if (!thisFullDesc){ 
      initRequest(); 
      req.open("POST", "getFullDesc.php?temp="+new Date().getTime(), true);  
      req.onreadystatechange = function(){
       if (req.readyState == 4) {  

         var fullDescHTML = req.responseText; 
         var newFullDesc = document.createElement("div");
         newFullDesc.setAttribute("id", "fullDesc"+artid);
         newFullDesc.innerHTML=fullDescHTML;
         thisArticle.appendChild(newFullDesc);
        }
       }; 
       req.setRequestHeader("Content-Type",
                           "application/x-www-form-urlencoded");
       req.send("artid="+artid); 
     } else {
      thisArticle.removeChild(thisFullDesc); 
   }
}
