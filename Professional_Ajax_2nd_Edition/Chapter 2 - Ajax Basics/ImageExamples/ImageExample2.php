<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Image Example 2</title>
    <script type="text/javascript">
    //<![CDATA[
        function sendRequest() {
            var oForm = document.forms[0];
            var sQueryString = "id=" + encodeURIComponent(oForm.txtID.value)
                + "&name=" + encodeURIComponent(oForm.txtName.value);
                
            var oImg = new Image();
            
            oImg.onload = function () {
                var divStatus = document.getElementById("divStatus");
                switch(this.width) {
                    case 1:
                        divStatus.innerHTML = "Customer name updated successfully.";
                        break;
                    case 2:
                        divStatus.innerHTML = "Invalid customer ID; name not updated.";
                        break;
                    default:
                        divStatus.innerHTML = "An error occurred while trying to process this request.";
        
                }					
            };
            oImg.onerror = function () {
                divStatus.innerHTML = "An error occurred while trying to process this request.";
            };
        
            oImg.src = "UpdateCustomerName.php?" + sQueryString;     
        }				        
    
    //]]>
    </script>
</head>
<body>
    <form method="post" action="UpdateCustomerName.php">
        <p>Enter the customer ID to update: <input type="text" name="txtID" value="" /></p>
        <p>Enter the new customer name: <input type="text" name="txtName" value="" /></p>
        <p><input type="submit" value="Update Customer Name" /></p>
    </form>
    <div id="divStatus"></div>
</body>
</html>
