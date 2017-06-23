<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>JSON-PHP Example</title>
    </head>
    <body>
<?php 
    require_once("JSON.php");
    $oJSON = new Services_JSON();
    
    $sJSONText = " {\"age\":26,\"hairColor\":\"brown\",\"name\":\"Mike\",\"siblingNames\":[\"Matt\",\"Tammy\"]}";
    
    $oPerson = $oJSON->decode($sJSONText);

    print("<h3>Person Information</h3>");
    print("<p>Name: ".$oPerson->name."<br />");
    print("Age: ".$oPerson->age."<br />");
    print("Hair Color: ".$oPerson->hairColor."<br />");
    print("Sibling Names:</p><ul>");
    
    for ($i=0; $i < count($oPerson->siblingNames); $i++) {
        print("<li>".$oPerson->siblingNames[$i]."</li>");
    }
    
    print("</ul>");
    
?>            
    </body>
</html>