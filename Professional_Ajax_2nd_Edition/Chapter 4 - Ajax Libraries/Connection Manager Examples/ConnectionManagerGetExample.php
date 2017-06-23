<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Connection Manager GET Example</title>
    <script type="text/javascript"src="yahoo.js"></script>
    <script type="text/javascript"src="connection.js"></script>
    <script type="text/javascript">
    //<![CDATA[
        function requestCustomerInfo() {
            var sId = document.getElementById("txtCustomerId").value;
            var oCallback = {
                success: function (oResponse) {
                    displayCustomerInfo(oResponse.responseText);
                },
                failure: function (oResponse) {
                    displayCustomerInfo("An error occurred: " + 
                                        oResponse.statusText);
                }
            };
            YAHOO.util.Connect.asyncRequest("GET", 
                                     "GetCustomerData.php?id=" + sId, oCallback);
        }
        
        function displayCustomerInfo(sText) {
            var divCustomerInfo = document.getElementById("divCustomerInfo");
            divCustomerInfo.innerHTML = sText;
        }
    //]]>
    </script>
</head>
<body>
    <p>Enter customer ID number to retrieve information:</p>
    <p>Customer ID: <input type="text" id="txtCustomerId" value="" /></p>
    <p><input type="button" value="Get Customer Info" 
              onclick="requestCustomerInfo()" /></p>
    <div id="divCustomerInfo"></div>
</body>
</html>
