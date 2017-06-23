<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Dynamic Script Loading Example</title>
    <script type="text/javascript">
    //<![CDATA[
        function makeRequest() {
          var oScript = document.createElement("script");
          oScript.src = "example.js";
          document.body.appendChild(oScript);
        }

        function callback(sText) {
          alert("Loaded from file: " + sText);
        }
    //]]>
    </script>
  </head>
  <body>
    <input type="button" value="Click Me" onclick="makeRequest()" />
  </body>
</html>
