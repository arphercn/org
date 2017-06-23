<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Progressive HTTP Example 5</title>
         <script type="text/javascript">
        //<![CDATA[ 
        
        var iTimeoutId = null;
        var oFrame = null;
        
        function heartbeat() {
            clearTimeout(iTimeoutId);            
            iTimeoutId = setTimeout(resetConnection, 10000);
        }
        
        function resetConnection() {
            oFrame.src = "ProgressiveHTTPExample4Connection.php?t=" + (new Date()).getTime();
            heartbeat();
        }
        
        function modifiedAt(sDateTime) {
            document.getElementById("divStatus").innerHTML = "Modified at " + sDateTime;
        }
        
        window.onload = function () {
            oFrame = document.createElement("iframe");	
            oFrame.style.display = "none";
            document.body.appendChild(oFrame);		
            resetConnection();
        };

        //]]>
        </script>         
    </head>
    <body>  
        <div id="divStatus">Waiting for first message...</div>
    </body>
</html>
