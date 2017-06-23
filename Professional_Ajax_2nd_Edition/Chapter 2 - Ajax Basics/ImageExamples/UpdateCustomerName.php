<?php

    header("Content-Type: image/jpeg");
    // error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $sID = $_GET["id"];
    $sName = mysql_real_escape_string($_POST["txtName"]);
    
    if (is_numeric($sID)) {
        $iWidth = 1;
        
        $sDBServer = "localhost";
        $sDBName = "ajax";
        $sDBUsername = "root";
        $sDBPassword = "root";

        $sSQL = "Update Customers set `Name` = '$sName' where CustomerId=$sID";

        $oLink = mysql_connect($sDBServer,$sDBUsername,$sDBPassword);
        @mysql_select_db($sDBName) or $iWidth = 3;
        
        if ($iWidth == 1) {
            if (mysql_query($sSQL)) {
                $iWidth = (mysql_affected_rows() > 0) ? 1 : 2;
                mysql_close($oLink);
            } else {
                $iWidth = 3;
            }
        }
    } else {
        $iWidth = 9;
    }
    
    $image = imagecreate($iWidth,1);
    $white = imagecolorallocate($image, 255, 255, 255);    
    imagejpeg($image);
    imagedestroy($image);
?>
