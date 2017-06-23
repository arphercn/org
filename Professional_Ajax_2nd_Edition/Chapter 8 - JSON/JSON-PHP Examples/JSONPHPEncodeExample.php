<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>JSON-PHP Example</title>
    </head>
    <body>
<?php 
    class Person {
    
        var $age;
        var $hairColor;
        var $name;
        var $siblingNames;
        
        function Person($name, $age, $hairColor) {
            $this->name = $name;
            $this->age = $age;
            $this->hairColor = $hairColor;
            $this->siblingNames = array();
        }    
    }
?>
<?php 
    require_once("JSON.php");
    $oJSON = new Services_JSON();
    
    $oPerson = new Person("Mike", 26, "brown");
    $oPerson->siblingNames[0] = "Matt";
    $oPerson->siblingNames[1] = "Tammy";

    $sOutput = $oJSON->encode($oPerson);
    print($sOutput);
?>            
    </body>
</html>