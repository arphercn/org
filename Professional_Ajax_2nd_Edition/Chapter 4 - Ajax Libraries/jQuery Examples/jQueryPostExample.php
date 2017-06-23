<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>jQuery POST Example</title>
    <script type="text/javascript"src="jquery.js"></script>
    <script type="text/javascript">
    //<![CDATA[
        function sendRequest() {
            var oForm = document.forms[0];
            var oBody = getRequestBody(oForm);
            $.post("SaveCustomer.php", oBody, saveResult);   
        }
        
        function getRequestBody(oForm) {

            var oParams = {};
            
            for (var i=0 ; i < oForm.elements.length; i++) {            
                var oField = oForm.elements[i];                
                switch (oField.type) {
                
                    case "button":
                    case "submit":
                    case "reset":
                        break;

                    case "checkbox":
                    case "radio": 
                        if (!oField.checked) {
                            break;
                        }
                    
                    case "text":
                    case "hidden":
                    case "password":
                        oParams[oField.name] = oField.value;
                        break;
                    
                    default:
                    
                        switch(oField.tagName.toLowerCase()) {
                            case "select":
                                oParams[oField.name] = 
                                        oField.options[oField.selectedIndex].value;
                                break;
                            default:	
                                oParams[oField.name] = oField.value;
                        }
                }							
            
            }

            return oParams;
        }
        
        function saveResult(sMessage, sStatus) {
            if (sStatus == "success") {
                $("div#divStatus").html("Request completed: " + sMessage);
            } else {
                $("div#divStatus").html("An error occurred.");
            }
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
