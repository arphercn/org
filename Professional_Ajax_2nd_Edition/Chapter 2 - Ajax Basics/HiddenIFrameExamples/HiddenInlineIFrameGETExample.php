<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Hidden Inline IFrame GET Example</title>
    <script type="text/javascript">
		//<![CDATA[
        function requestCustomerInfo() {
            var sId = document.getElementById("txtCustomerId").value;
            top.frames["hiddenFrame"].location = "GetCustomerData.php?id=" + sId;
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
    <iframe src="about:blank" name="hiddenFrame" style="display:none"></iframe>
</body>
</html>
