<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Image Example 1</title>
    <script type="text/javascript">
    //<![CDATA[
        function getCookie(sName) {
            var sRE = "(?:; )?" + encodeURIComponent(sName) + "=([^;]*);?";
            var oRE = new RegExp(sRE);
            
            if (oRE.test(document.cookie)) {
                return decodeURIComponent(RegExp["$1"]);
            } else {
                return null;
            }
        }
        
        function deleteCookie(sName) {
            document.cookie = encodeURIComponent(sName) + "=0; expires=Thu, 1 Jan 1970 00:00:00 UTC; path=/";
        }
        
        function requestCustomerInfo() {
            var sId = document.getElementById("txtCustomerId").value;
            var oImg = new Image();
            oImg.onload = function () {
                displayCustomerInfo(getCookie("info"));  
                deleteCookie("info");          
            };
            oImg.onerror = function () {
                displayCustomerInfo("An error occurred while processing the request.");
            };
            oImg.src = "GetCustomerData.php?id=" + sId;
        }
        
        function displayCustomerInfo(sText) {
            var divCustomerInfo = document.getElementById("divCustomerInfo");
            divCustomerInfo.innerHTML = sText;
        }
    //]]>
    </script>
</head>
<body>
    <pre>
        使用new Image() , onload, cookie实现XHR功能,
        优点:
            兼容所有浏览器
            跨域
        场景:数据量较小
    </pre>
    <p>Enter customer ID number to retrieve information:</p>
    <p>Customer ID: <input type="text" id="txtCustomerId" value="" /></p>
    <p><input type="button" value="Get Customer Info" onclick="requestCustomerInfo()" /></p>
    <div id="divCustomerInfo"></div>
</body>
</html>
