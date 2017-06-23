<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>XHR GET Example</title>
    <script type="text/javascript" src="zxml.js"></script>
    <script type="text/javascript">
		//<![CDATA[
        function requestCustomerInfo() {
            var sId = document.getElementById("txtCustomerId").value;
            var oXHR = zXmlHttp.createRequest();
            oXHR.open("get", "GetCustomerData.php?id=" + sId, true);
            oXHR.onreadystatechange = function () {
                if (oXHR.readyState == 4) {
                    if (oXHR.status == 200 || oXHR.status == 304) {
                        displayCustomerInfo(oXHR.responseText);
                    } else {
                        displayCustomerInfo("An error occurred: " + oXHR.statusText); //statusText is not always accurate
                    }
                }            
            };
            // GET时,send(null)不能少,
            // 当同步调用时(false),通过send返回数据,可以不用onreadystatechange
            oXHR.send(null);
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
    <p><input type="button" value="Get Customer Info" onclick="requestCustomerInfo()" /></p>
    <div id="divCustomerInfo"></div>
</body>
</html>
