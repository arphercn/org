<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Prototype GET Example</title>
    <script type="text/javascript"src="prototype.js"></script>
    <script type="text/javascript">
        //<![CDATA[
        function requestCustomerInfo() {
            var sId = document.getElementById("txtCustomerId").value;
            var oOptions = {
                method: "get",
                parameters: "id=" + sId,
                onSuccess: function (oXHR, oJson) {
                    displayCustomerInfo(oXHR.responseText);
                },
                onFailure: function (oXHR, oJson) {
                    displayCustomerInfo("An error occurred: " + 
                                                       oXHR.statusText);
                }
            };
            var oRequest = new Ajax.Request("GetCustomerData.php", oOptions);
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
