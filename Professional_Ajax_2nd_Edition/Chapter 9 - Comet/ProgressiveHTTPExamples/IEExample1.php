<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>IE HTTP Streaming Example 1</title>
         <script type="text/javascript">
        //<![CDATA[ 
        
        var iTimeoutId = null;
        var oPage = null;
        
        function heartbeat() {
            clearTimeout(iTimeoutId);            
            iTimeoutId = setTimeout(resetConnection, 10000);
        }
        
        function resetConnection() {
            oPage.body.innerHTML = "<iframe src=\"IEExampleConnection.php?t=" + (new Date()).getTime() + "\"></iframe>";
            heartbeat();
        }
        
        function modifiedAt(sDateTime) {
            document.getElementById("divStatus").innerHTML = "Modified at " + sDateTime;
        }
        
        window.onload = function () {
            oPage = new ActiveXObject("htmlfile");
            oPage.open();
            oPage.write("<html><head><scr" + "ipt>document.domain=\"http://www.yourdomain.com\";</scr" + "ipt></head><body></body></html>");
            oPage.close();                        
            oPage.parentWindow._parent = self;
            resetConnection();
        };

        //]]>
        </script>         
    </head>
    <body>  
        <div id="divStatus">Waiting for first message...</div>
    </body>
</html>
