<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Get Customer Data</title>
<?php
    
    //customer ID
    $sID = $_GET["id"];
    
    //variable to hold customer info
    $sInfo = "";
    
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
        
    if($sInfo == "") {
        if($oResult = mysql_query($sQuery) and mysql_num_rows($oResult) > 0) {
            $aValues = mysql_fetch_array($oResult,MYSQL_ASSOC);
            $sInfo = $aValues['Name']."<br />".$aValues['Address']."<br />".
                     $aValues['City']."<br />".$aValues['State']."<br />".
                     $aValues['Zip']."<br /><br />Phone: ".$aValues['Phone']."<br />".
                     "<a href=\"mailto:".$aValues['Email']."\">".$aValues['Email']."</a>";
        } else {
            $sInfo = "Customer with ID $sID doesn't exist.";
        }
        
        mysql_free_result($oResult);
    }
    mysql_close($oLink);

?>
    
    <script type="text/javascript">
		//<![CDATA[
        window.onload = function () {
            var divInfoToReturn = document.getElementById("divInfoToReturn");
            parent.displayCustomerInfo(divInfoToReturn.innerHTML);        
        };
    //]]>
    </script>

</head>
<body>
    <div id="divInfoToReturn"><?php echo $sInfo ?></div>
</body>
</html>
