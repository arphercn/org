<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Live Connect Example</title>
         <script type="text/javascript">
        //<![CDATA[ 
        
        var iTimeoutId = null;
        var oReader = null;

        function resetConnection() {
            var oURL = new java.net.URL("http://localhost/LiveConnectExampleConnection.php");
            var oStream = oURL.openStream();
            if (oReader != null) {
                oReader.close();
            }
            oReader = new java.io.BufferedReader(new java.io.InputStreamReader(oStream));
                            
            checkInput();
        }        
        
        function checkInput() {
            try {
                var sLine = oReader.readLine(); 
                if (sLine != null) {
                    eval(sLine + "");
                }
                setTimeout(checkInput, 500);
            } catch (oEx) {
                resetConnection();
            }
        }
        
        function heartbeat() {
            clearTimeout(iTimeoutId);            
            iTimeoutId = setTimeout(resetConnection, 10000);
        }        
        
        function modifiedAt(sDateTime) {
            document.getElementById("divStatus").innerHTML = "Modified at " + sDateTime;
        }
        
        window.onload = resetConnection;

        //]]>
        </script>         
    </head>
    <body>  
        <div id="divStatus">Waiting for first message...</div>
    </body>
</html>
