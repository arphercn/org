<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>XHR POST Example</title>
    <script type="text/javascript"src="zxml.js"></script>
    <script type="text/javascript">
    //<![CDATA[
        function sendRequest() {
            var oForm = document.forms[0];
            var sBody = getRequestBody(oForm);

            var oXHR = zXmlHttp.createRequest();
            oXHR.open("post", oForm.action, true);
            oXHR.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            
            oXHR.onreadystatechange = function () {
                if (oXHR.readyState == 4) {
                    if (oXHR.status == 200) {
                        saveResult(oXHR.responseText);
                    } else {
                        saveResult("An error occurred: " + oXHR.statusText);
                    }
                }            
            };
            oXHR.send(sBody);        
        }

        /**
         * 名值url编码为字符串
         * 
         * @param  {[type]} sName  [description]
         * @param  {[type]} sValue [description]
         * @return {[type]}        [description]
         */
        function encodeNameAndValue(sName, sValue) {
            var sParam = encodeURIComponent(sName);
            sParam += "=";
            sParam += encodeURIComponent(sValue);
            return sParam;				
        }
        
        /**
         * 序列化表单
         * 
         * @param  {[type]} oForm [description]
         * @return {[type]}       [description]
         */
        function getRequestBody(oForm) {
        
            //array to hold the params
            var aParams = new Array();
            
            //get your reference to the form
            var oForm = document.forms[0];
            
            //iterate over each element in the form
            for (var i=0 ; i < oForm.elements.length; i++) {
            
                //get reference to the field
                var oField = oForm.elements[i];
                
                //different behavior based on the type of field
                switch (oField.type) {
                
                    //buttons - we don't care
                    case "button":
                    case "submit":
                    case "reset":
                             break;
                    
                    //checkboxes/radio buttons - only return the value if the control is checked.
                    case "checkbox":
                    case "radio":
                        if (!oField.checked) {
                            break;
                        } //End: if
                    
                    //text/hidden/password all return the value
                    case "text":
                    case "hidden":
                    case "password":
                        aParams.push(encodeNameAndValue(oField.name, oField.value));			
                        break;
                    
                    //everything else
                    default:
                    
                        switch(oField.tagName.toLowerCase()) {
                            case "select":
                                aParams.push(encodeNameAndValue(oField.name, oField.options[oField.selectedIndex].value));
                                break;
                            default:	
                                aParams.push(encodeNameAndValue(oField.name, oField.value));
                        }
                }							
            
            }
        
            return aParams.join("&");
        }
        
        function saveResult(sMessage) {
            var divStatus = document.getElementById("divStatus");
            divStatus.innerHTML = "Request completed: " + sMessage;            
        }
    //]]>
    </script>
</head>
<body>
    <form method="post" action="SaveCustomer.php" onsubmit="sendRequest(); return false">
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
