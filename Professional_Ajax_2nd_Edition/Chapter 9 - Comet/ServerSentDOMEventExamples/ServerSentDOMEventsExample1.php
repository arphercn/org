<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Server-Sent DOM Events Example 1</title>
         <script type="text/javascript">
        //<![CDATA[ 
        
        function modifiedAt(sDateTime) {
            document.getElementById("divStatus").innerHTML = "Modified at " + sDateTime;
        }
        
        window.onload = function () {
            var oSource = document.getElementById("source");
            
            oSource.addEventListener("modified", function (oEvent) {
                modifiedAt(oEvent.data);
            }, false);

        };

        //]]>
        </script>         
    </head>
    <body>  
        <div id="divStatus">Waiting for first message...</div>
        <event-source id="source" src="ServerSentDOMEventsConnection.php" />
    </body>
</html>
