<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Hidden Dynamic IFrame POST Example</title>
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
        
        function checkIFrame() {
            if (!oIFrame) {
                createIFrame();                
            } 
        
            //takes a cycle for some browers to recognize the new element
            // 10毫秒后隐藏表单 加载 ProxyForm.php,
            //  通过里面的onload实现 只要加载成功后调用
            //  在里面调用formReady函数 把可见表单遍历到隐藏表单,然后提交
            setTimeout(function () {
                // location实现hiddenFrame提交,
                oIFrame.location = "ProxyForm.php";
            }, 10);                              
        }
        
        /**
         * 创建隐藏表单表单并追加到oIFram
         * 
         * @param  {[type]} oHiddenForm [description]
         * @param  {[type]} sName       [description]
         * @param  {[type]} sValue      [description]
         * @return {[type]}             [description]
         */
        function createInputField(oHiddenForm, sName, sValue) {
            oHidden = oIFrame.document.createElement("input");
            oHidden.type = "hidden";
            oHidden.name = sName;        								
            oHidden.value = sValue;
            oHiddenForm.appendChild(oHidden);					
        }

        /**
         * 遍历表单到隐藏表单并提交
         * 
         * @return {[type]} [description]
         */
        function formReady() {
        
            //get your reference to the form
            var oForm = document.forms[0];
            var oHiddenForm = oIFrame.document.forms[0];
            
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
                    
                //checkboxes/radio buttons - only return the value if the controlis checked.
                case "radio":
                case "checkbox":
                    if (!oField.checked) {
                        break;
                    }
                    
                //text/hidden/password all return the value
                case "text":
                case "hidden":
                case "password":
                    createInputField(oHiddenForm, oField.name, oField.value);			
                    break;
                    
                default:
                    switch(oField.tagName.toLowerCase()) {
                        case "select":
                            createInputField(oHiddenForm, oField.name, oField.options[oField.selectedIndex].value);
                            break;
                        default:	
                            createInputField(oHiddenForm, oField.name, oField.value);
                    }
                }							
            
            }
            
            // 隐藏表单设置和显示表单相同的action
            oHiddenForm.action = oForm.action;
            oHiddenForm.submit();
        };
        
        function saveResult(sMessage) {
            var divStatus = document.getElementById("divStatus");
            divStatus.innerHTML = "Request completed: " + sMessage;            
        }
    //]]>
    </script>
</head>
<body>
    
    <!-- action是为了被复制到隐藏表单,
     checkIFrame()实现隐藏表单的提交, return false阻止本表单提交 -->
    <form method="post" action="SaveCustomer.php" onsubmit="checkIFrame(); return false">
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
