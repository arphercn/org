<?php
    header("Content-type: text/javascript");
    
    //get the file modification time
    $modified = filemtime('details.txt');
    $lastModified = $modified;
    
    //clear file statistics
    clearstatcache();
    
    //check every so often to see if it has changed
    while (true) {
 
        echo("heartbeat()\n");
        ob_flush();  
        flush();
        
        // sleep for 1 second
        sleep(1);
        
        //check the modification time
        $lastModified = filemtime('details.txt');        
        
        //clear file statistics
        clearstatcache();
        
        //check it against the previous time
        if ($modified != $lastModified) {
            $output = date('h:i:s', $lastModified);
            echo("modifiedAt(\"$output\")\n");     
            ob_flush();  
            flush();
            $modified = $lastModified;
                    
            // sleep for 1 second
            sleep(1);              
        }
      
    }
?>