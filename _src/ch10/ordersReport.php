<html>
 <head>
  <title>Orders report</title>
  <style type="text/css">
   body {
     font-family:     Verdana, Geneva, Arial, Helvetica, sans-serif;
     font-size:       small;
   }
   table {
    border:          2px solid black;
    border-collapse: collapse;
   }
   td, th {
    border:          2px dotted grey;
    padding:         .8em;
   }
   td {
    text-align:      left;
   }
   th {
    text-align:      right;
    background-color: #cccccc;
   }
  </style>
  <script type="text/javascript" src="ajax.js"> </script>
  <script type="text/javascript" src="ordersTotal.js"> </script>
 </head>
 <body>
  <h1>Today's Orders report</h1>
   <table>
    <tr><th>Current time</th>
     <td><span id="currentTime"></span></td></tr>
    <tr><th>Number of orders placed</th>
     <td><span id="ordersNumber"></span></td></tr>
    <tr><th>Total amount of orders</th>
     <td><span id="ordersTotal"></span></td></tr>
   </table>
 </body>
</html>
