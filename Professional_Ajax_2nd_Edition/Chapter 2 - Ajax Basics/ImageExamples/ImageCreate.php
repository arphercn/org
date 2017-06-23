<?php
    header("Content-type: image/jpeg");
    $image = imagecreate(1,1);
    $white = imagecolorallocate($image, 255, 255, 255);    
    imagejpeg($image);
    imagedestroy($image);
?>
