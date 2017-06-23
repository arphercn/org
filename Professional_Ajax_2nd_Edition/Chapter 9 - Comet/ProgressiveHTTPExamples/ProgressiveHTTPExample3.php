<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Progressive HTTP Example 3</title>
    </head>
    <body>
    <pre>
        PHP检测文件的修改
    </pre>
<?php
    //get the file modification time
    $modified = filemtime('details.txt');
    $lastModified = $modified;
    
    //clear file statistics
    clearstatcache();
    
    //check every so often to see if it has changed
    while (true) {

        // sleep for 1 second
        sleep(1);
        
        //check the modification time
        $lastModified = filemtime('details.txt');        
        
        //clear file statistics
        clearstatcache();
        
        //check it against the previous time
        if ($modified != $lastModified) {
            $output = date('h:i:s', $lastModified);
?>
             <script type="text/javascript">
            //<![CDATA[
                document.title = "modified at <?php echo $output ?>";
            //]]>
            </script>
<?php        
            ob_flush();  
            flush();
            
            $modified = $lastModified;
        }
    }
?>

    </body>
</html>
