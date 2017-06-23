<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>jQuery GET Example</title>
    <script type="text/javascript"src="jquery.js"></script>
    <script type="text/javascript">
          //<![CDATA[
        function requestCustomerInfo() {
            var sId = $("input#txtCustomerId").val();            
            $.get("GetCustomerData.php?id=" + sId, displayCustomerInfo);
        }
        
        function displayCustomerInfo(sText, sStatus) {
            if (sStatus == "success") {
                $("div#divCustomerInfo").html(sText);
            } else {
                $("div#divCustomerInfo").html("An error occurred.");
            }
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
