<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Progressive HTTP Example 2</title>
    </head>
    <body>
        <script type="text/javascript">
        //<![CDATA[
            document.title = "First message";
        //]]>
        </script>
<?php
    ob_flush();  
    flush();
    
    // sleep for 10 seconds
    sleep(5);
?>
        <script type="text/javascript">
        //<![CDATA[
            document.title = "Second message";
        //]]>
        </script>
    </body>
</html>
