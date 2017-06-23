<?php
/*******************************************
The Stock Class

Stores information about the stock quote.
*******************************************/

class Stock {
    var $symbol;
    var $companyName;
    var $lastTrade;
    var $change;

    function Stock($stock_data) {
        //Split the data by commas.
        $split_data = explode(",", $stock_data);

        //Add the data to the properties
        $this->symbol       = $split_data[0];
        $this->companyName  = $split_data[1];
        $this->lastTrade    = $split_data[2];
        $this->change       = $split_data[3];
    }
}
?>
