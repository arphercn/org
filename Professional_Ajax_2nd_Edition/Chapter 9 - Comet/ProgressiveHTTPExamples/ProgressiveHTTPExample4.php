<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Progressive HTTP Example 4</title>
         <script type="text/javascript">
        //<![CDATA[ 
        
        var iTimeoutId = null;
        
        function heartbeat() {
            clearTimeout(iTimeoutId);            
            iTimeoutId = setTimeout(resetConnection, 10000);
        }
        
        function resetConnection() {
            frames["connection"].location.replace("ProgressiveHTTPExample4Connection.php?t=" + (new Date()).getTime());
            heartbeat();
        }
        
        function modifiedAt(sDateTime) {
            document.getElementById("divStatus").innerHTML = "Modified at " + sDateTime;
        }
        
        window.onload = resetConnection;

        //]]>
        </script>         
    </head>
    <body>
        <pre>
            心跳机制: iframe每隔10秒调用服务端
        </pre>  
        <div id="divStatus">Waiting for first message...</div>
        <iframe src="about:blank" name="connection"></iframe>
    </body>
</html>
