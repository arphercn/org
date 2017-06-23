<?php
include("inc/appSettings.inc.php");

class WeatherInfo
{
    var $cachedFile;
    
    function WeatherInfo()
    {
		$this->cachedFile = "weather_cache.xml";
	}
	
	function getWeather()
	{
	    $timeLimit = strtotime("+30 minutes", $this->getLastModified());
	    
	    if ($timeLimit <= time())
	    {
	        return $this->_getWebWeather();
	    }
	    else
	    {
	        return $this->_getCachedWeather();
	    }
	}
	
	function _getWebWeather()
	{
	    $url = "http://xoap.weather.com/weather/local/".LICENSE."?cc=*&prod=xoap&par=".PARTNER."&key=".LICENSE."";
	    
	    $xml = file_get_contents($url);
	    
	    if ($xml)
	    {
	        $arguments = array(
                '/_xml' => $xml
            );
            
            $xsltProcessor = xslt_create();
            
            $result = xslt_process($xsltProcessor, 'arg:/_xml', "weather.xslt", $this->cachedFile, $arguments);
            xslt_free($xsltProcessor);
            
            return $this->_getCachedWeather();
        }
        else
        {
        
            $xmlStr = "<errorDoc>";
            $xmlStr .= "<alert>An Error Occurred!</alert>";
            $xmlStr .= "<message>An error occurred attempting to contact Weather.com!</message>";
            $xmlStr .= "</errorDoc>";
            
            $arguments = array(
                '/_xml' => $xmlStr
            );
            
            $xsltProcessor = xslt_create();
            
            $result = xslt_process($xsltProcessor, 'arg:/_xml', "weather.xslt", NULL, $arguments);
            return $result;
            
            xslt_free($xsltProcessor);
        }
        
        	
	}
	
	function _getCachedWeather()
	{
		if (file_exists($this->cachedFile))
		{
		    $str = file_get_contents($this->cachedFile);
		
		    //Return the contents
		    return $str;
		}
	}
	
	function getLastModified()
	{
	    if (file_exists($this->cachedFile))
	    {
	        return filemtime($this->cachedFile);
	    }
	    else
	    {
	        return 0;
	    }
	}
}


?>