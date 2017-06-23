<?php
//If your server shows all warnings and errors, you might
//want to uncomment the next line.
//error_reporting(0);

header("Content-Type: text/xml");
header("Cache-Control: no-cache");

if (isset($_GET["feed"]))
{
    $feedUrl  = $_GET["feed"];
    $fileName = "./xml/" . urlencode($feedUrl) . ".xml";
    
    $feed = @file_get_contents($feedUrl);
    
    if ($feed)
    {
        if ($handle = fopen($fileName, "w"))
        {
            fwrite($handle, $feed);
            
            fclose($handle);
        }
        
        echo $feed;
    }
    else
    {
        $xml = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
        $xml .= "<rss version=\"2.0\">";
        $xml .= "<channel>";
        $xml .= "<title>FooReader Error</title>";
        $xml .= "<description>FooReader Error</description> ";
        $xml .= "<link>javascript:void(0);</link>";
        $xml .= "<item>";
        $xml .= "<pubDate>Just Now</pubDate>";
        $xml .= "<title>FooReader Error</title>";
        $xml .= "<description>";
        $xml .= "<![CDATA[";
        $xml .= "<p>An error occurred.</p>";
        $xml .= "<p style='color: red'>FooReader.NET could not retrieve the XML feed. Please try again later.</p>";
        $xml .= "]]>";
        $xml .= "</description>";
        $xml .= "<link>javascript:void(0);</link>";
        $xml .= "</item>";
        $xml .= "</channel> ";
        $xml .= "</rss>";	

        echo $xml;
    }
    
    


}

?>