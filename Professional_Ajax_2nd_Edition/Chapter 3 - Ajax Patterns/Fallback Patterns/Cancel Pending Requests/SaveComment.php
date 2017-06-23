<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Save Comment</title>
<?php
    //get information
    $sName = $_POST["txtName"];
    $sMessage = $_POST["txtMessage"];
    
    $sStatus = "";
        
    //database information
    $sDBServer = "localhost";
    $sDBName = "ajax";
    $sDBUsername = "root";
    $sDBPassword = "root";

    //create the SQL query string
    $sSQL = "Insert into BlogComments(BlogEntryId,Name,Message,Date) ".
              " values (0,'$sName','$sMessage',NOW())";

    $oLink = mysql_connect($sDBServer,$sDBUsername,$sDBPassword);
    @mysql_select_db($sDBName) or $sStatus = "Unable to open database";
        
    if ($sStatus == "") {
        if(mysql_query($sSQL)) {
            $sStatus = "Added comment; comment ID is ".mysql_insert_id();
        } else {
            $sStatus = "An error occurred while inserting; comment not saved.";
        }
    }

    mysql_close($oLink);
?>
</head>
<body>
    <?php echo $sStatus ?>
</body>
</html>
