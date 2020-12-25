  
 function getOrdersTotal() {
     initRequest();
     req.open("GET", "getOrdersTotal.php?temp="+new Date().getTime(), true);
     req.onreadystatechange = updateOrdersTotal;
     req.send(null);
  }

  window.onload = getOrdersTotal;

  function updateOrdersTotal() {
    if (req.readyState == 4) {
      var ordersInfo = req.responseText;
      var param = ordersInfo.split("/");
      var curTime = document.getElementById("currentTime");
      var ordNumber = document.getElementById("ordersNumber");
      var ordTotal = document.getElementById("ordersTotal");
      if (curTime.firstChild) {
        curTime.removeChild(curTime.firstChild);
      }
      curTime.appendChild(document.createTextNode(param[0]));

      if (ordNumber.firstChild) {
        ordNumber.removeChild(ordNumber.firstChild);
      }
      ordNumber.appendChild(document.createTextNode(param[1]));

      if (ordTotal.firstChild) {
        ordTotal.removeChild(ordTotal.firstChild);
      }
      ordTotal.appendChild(document.createTextNode(param[2]));
      var tmId = setTimeout(getOrdersTotal, 30000);
    }
  }
