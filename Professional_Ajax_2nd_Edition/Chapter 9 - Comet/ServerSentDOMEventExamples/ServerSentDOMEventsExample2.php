<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Server-Sent DOM Events Example 2</title>      
    </head>
    <body>  
        <p>This page contains a button with an <code>onclick</code> event handler assigned. 
        The <code>click</code> event is being fired periodically by the server!</p>
        <event-source id="source" src="ServerSentDOMEventsClicks.php" />
        <input type="button" id="btnTest" onclick="alert(event.screenX + ',' + event.screenY)" value="Click Me" />
    </body>
</html>
