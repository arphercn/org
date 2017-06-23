<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Connection Manager POST Example</title>
    <script type="text/javascript"src="yahoo.js"></script>
    <script type="text/javascript"src="connection.js"></script>
    <script type="text/javascript">
    //<![CDATA[
        function sendRequest() {
            var oForm = document.forms[0];
            
            var oCallback = {
                success: function (oResponse) {
                    saveResult(oResponse.responseText);
                },
                
                failure: function (oResponse) {
                    saveResult("An error occurred: " + oResponse.statusText);
                }
            };
            
            YAHOO.util.Connect.setForm(oForm);
            YAHOO.util.Connect.asyncRequest("POST", oForm.action, oCallback);       
        }
                
        function saveResult(sMessage) {
            var divStatus = document.getElementById("divStatus");
            divStatus.innerHTML = "Request completed: " + sMessage;            
        }
    //]]>
    </script>
</head>
<body>
    <form method="post" action="SaveCustomer.php" 
          onsubmit="sendRequest(); return false">
    <p>Enter customer information to be saved:</p>
    <p>Customer Name: <input type="text" name="txtName" value="" /><br />
    Address: <input type="text" name="txtAddress" value="" /><br />
    City: <input type="text" name="txtCity" value="" /><br />
    State: <input type="text" name="txtState" value="" /><br />
    Zip Code: <input type="text" name="txtZipCode" value="" /><br />
    Phone: <input type="text" name="txtPhone" value="" /><br />
    E-mail: <input type="text" name="txtEmail" value="" /></p>
    <p><input type="submit" value="Save Customer Info" /></p>
    </form>
    <div id="divStatus"></div>
</body>
</html>
