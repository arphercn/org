<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Firefox HTTP Streaming Example</title>
         <script type="text/javascript">
        //<![CDATA[ 
        
        var iTimeoutId = null;
        var oHttp = null;
        
        function heartbeat() {
            clearTimeout(iTimeoutId);            
            iTimeoutId = setTimeout(resetConnection, 10000);
        }
        
        function resetConnection() {
            oHttp.abort();
            oHttp.open("get", "FirefoxExampleConnection.php?t=" + (new Date()).getTime(), true);
            oHttp.onreadystatechange = function () {
                switch(oHttp.readyState) {
                    case 3:
                        var aCommands = oHttp.responseText.split(";");
                        var sCommand = aCommands.pop();
                        eval(sCommand);
                        break;
                    case 4:                        
                        resetConnection();
                        break;
                }
            };
            oHttp.send(null);
            heartbeat();
        }
        
        function modifiedAt(sDateTime) {
            document.getElementById("divStatus").innerHTML = "Modified at " + sDateTime;
        }
        
        window.onload = function () {
            oHttp = new XMLHttpRequest();
            resetConnection();
        };

        //]]>
        </script>         
    </head>
    <body>  
        <div id="divStatus">Waiting for first message...</div>
    </body>
</html>
