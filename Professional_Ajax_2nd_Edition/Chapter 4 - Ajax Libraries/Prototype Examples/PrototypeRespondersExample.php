<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Prototype Responders Example</title>
    <script type="text/javascript"src="prototype.js"></script>
    <script type="text/javascript">
        //<![CDATA[
        
        
        var oGlobalOptions = {
            onCreate : function (oXHR, oJson) {
                document.getElementById("divStatus").innerHTML = 
                    "Contacting the server...";
            },
            onComplete : function (oXHR, oJson) {
                document.getElementById("divStatus").innerHTML = 
                    "Response received.";
            }
        };
        Ajax.Responders.register(oGlobalOptions);
	
        function requestCustomerInfo() {
            var sId = document.getElementById("txtCustomerId").value;
            var oOptions = {
                method: "get",
                parameters: "id=" + sId,
                onFailure: function (oXHR, oJson) {
                    alert("An error occurred: " + oXHR.status);
                }
            };
            var oRequest = new Ajax.Updater({ 
                success: "divCustomerInfo"
            }, "GetCustomerData.php", oOptions);
        }

        //]]>
    </script>
</head>
<body>
    <p>Enter customer ID number to retrieve information:</p>
    <p>Customer ID: <input type="text" id="txtCustomerId" value="" /></p>
    <p><input type="button" value="Get Customer Info" 
              onclick="requestCustomerInfo()" /></p>
    <div id="divStatus" style="color: blue"></div>
    <div id="divCustomerInfo"></div>    
</body>
</html>
