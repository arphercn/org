<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>JPSpan Example</title>
    <script type="text/javascript"
            src="/DwrExample/dwr/interface/CustomerInfo.js"></script>
    <script type="text/javascript"src="/DwrExample/dwr/engine.js"></script>
    <script type="text/javascript"src="DwrExample.js"></script>
</head>
<body>
    <p>Enter customer ID number to retrieve information:</p>
    <p>Customer ID: <input type="text" id="txtCustomerId" value="" /></p>
    <p><input type="button" value="Get Customer Info" 
              onclick="requestCustomerInfo()" /></p>
    <div id="divCustomerInfo"></div>
</body>
</html>
