<?php
    header("Content-Type: image/gif");
    
    //customer ID
    $sID = $_GET["id"];
    
    //variable to hold customer info
    $sInfo = "";
    
    if (is_numeric($sID)) {
        //database information
        $sDBServer = "localhost";
        $sDBName = "ajax";
        $sDBUsername = "root";
        $sDBPassword = "root";
    
        //create the SQL query string
        $sQuery = "Select * from Customers where CustomerId=".$sID;
    
        //make the database connection
        $oLink = mysql_connect($sDBServer,$sDBUsername,$sDBPassword);
        @mysql_select_db($sDBName) or $sInfo = "Unable to open database";
    
        if ($sInfo == "") {
            if($oResult = mysql_query($sQuery) and mysql_num_rows($oResult) > 0) {
                $aValues = mysql_fetch_array($oResult,MYSQL_ASSOC);
                $sInfo = $aValues['Name'];
                mysql_free_result($oResult);								 
            } else {
                $sInfo = "Customer with ID $sID doesn't exist.";
            }
        }
    } else {
        $sInfo = "Invalid customer ID.";
    }
    
    mysql_close($oLink);
    
    //set the cookie
    setcookie("info", $sInfo);
    
    //redirect to the image
    header("Location: pixel.gif");
?>
