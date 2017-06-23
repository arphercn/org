<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Create New Customer</title>
<?php
    //get information
    $sName = $_POST["txtName"];
    $sAddress = $_POST["txtAddress"];
    $sCity = $_POST["txtCity"];
    $sState = $_POST["txtState"];
    $sZipCode = $_POST["txtZipCode"];
    $sPhone = $_POST["txtPhone"];
    $sEmail = $_POST["txtEmail"];
    
    //status message
    $sStatus = "";
        
    //database information
    $sDBServer = "localhost";
    $sDBName = "ajax";
    $sDBUsername = "root";
    $sDBPassword = "root";


    //create the SQL query string
    $sSQL = "Insert into Customers(Name,Address,City,State,Zip,Phone,`Email`) ".
              " values ('$sName','$sAddress','$sCity','$sState', '$sZipCode'".
              ", '$sPhone', '$sEmail')";

    $oLink = mysql_connect($sDBServer,$sDBUsername,$sDBPassword);
    @mysql_select_db($sDBName) or $sStatus = "Unable to open database";
        
    if($oResult = mysql_query($sSQL)) {
        $sStatus = "Added customer; customer ID is ".mysql_insert_id();
     } else {
        $sStatus = "An error occurred while inserting; customer not saved.";
    }
    
    mysql_free_result($oResult);
    mysql_close($oLink);
?>
    <script type="text/javascript">
    //<![CDATA[
        window.onload = function () {
            parent.saveResult("<?php echo $sStatus ?>");        
        }
    //]]>
    </script>
</head>
<body>
</body>
</html>
