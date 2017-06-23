<?php
//If your server shows all warnings and errors, you might
//want to uncomment the next line.
//error_reporting(0);

header("Content-Type: text/xml");
header("Cache-Control: no-cache");

include("inc/WeatherInfo.class.php");

$weather = new WeatherInfo();
$weatherData = $weather->getWeather();

echo $weatherData;
?>