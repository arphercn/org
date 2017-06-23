<?php 

    //include the necessary files
    require_once 'JPSpan/JPSpan.php';
    require_once JPSPAN . 'Server/PostOffice.php';

    //include the Customer class
    require_once 'CustomerInfo.php';

    //create the PostOffice object
    $server = & new JPSpan_Server_PostOffice();

    //add a handler for your class
    $server->addHandler(new CustomerInfo());

    //check the query string
    if (isset($_SERVER['QUERY_STRING']) 
          && strcasecmp($_SERVER['QUERY_STRING'], 'client') == 0){

        //turn off JavaScript compression
        define('JPSPAN_INCLUDE_COMPRESS', false);

        //output the JavaScript wrappers
        $server->displayClient();
    } else {

        //include the error handler
        require_once JPSPAN . 'ErrorHandler.php';

        //handle incoming requests
        $server->serve();
    }
?>
