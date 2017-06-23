<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Hidden Dynamic IFrame GET Example</title>
    <script type="text/javascript">
		//<![CDATA[
        var oIFrame = null;
        
        function createIFrame() {
            var oIFrameElement = document.createElement("iframe");
            oIFrameElement.style.display = "none";
            oIFrameElement.name = "hiddenFrame";
            oIFrameElement.id = "hiddenFrame";
            document.body.appendChild(oIFrameElement);
            
            oIFrame = frames["hiddenFrame"];
        }
        
        function requestCustomerInfo() {
            if (!oIFrame) {
                createIFrame();
                // 等 10 毫秒让有些浏览器 创建 DOM
                setTimeout(requestCustomerInfo, 10);
                return;
            }
            
            var sId = document.getElementById("txtCustomerId").value;
            oIFrame.location = "GetCustomerData.php?id=" + sId;
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
