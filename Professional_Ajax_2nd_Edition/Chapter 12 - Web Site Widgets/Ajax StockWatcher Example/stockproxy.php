<?php
//If your server shows all warnings and errors, you might
//want to uncomment the next line.
//error_reporting(0);

header("Content-Type: text/plain; charset=UTF-8");
header("Cache-Control: no-cache");

require_once("inc/stock.class.php");
require_once("inc/JSON.php");

class JSONObject {}

$SYMBOLS = array(
    "MSFT",
    "GE"
);

function get_stock_quotes() {
    global $SYMBOLS;

    //Get the symbols in a format we can use.
    $symbol_string = implode("+", $SYMBOLS);

    //Build the URL
    $url = "http://finance.yahoo.com/d/quotes.csv?s=" . $symbol_string . "&f=snl1c1";

    //Get the data.
    $data = file_get_contents($url);
    
    //Create the JSON object.
    $json = new Services_JSON();

    //Create the JSONObject
    $object_to_serialize = new JSONObject();

    if (!$data) {
        $object_to_serialize->error = true;
    } else {
        //Remove the quotes that we get from Yahoo!
        $data = preg_replace('/"/',"",$data);

        //Start to populate our JSON object.
        $object_to_serialize->error = false;
        $object_to_serialize->stocks = array();

        //Create an array.
        $split_data = explode("\r\n", $data);

        //The last element is just \r\n. Pop it off.
        array_pop($split_data);

        foreach($split_data as $stock_data)
            $object_to_serialize->stocks[] = new Stock($stock_data);
    }

    //Echo the serialized data, yo!
    echo $json->encode($object_to_serialize);
}

get_stock_quotes();
?>