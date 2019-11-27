<?php
/*
    This services returns company information from the stocks database.
    
    Possible values: 
    
    1. No parameters - returns all companies 
    2. symbol=[value] - returns just the company with the specified symbol value
                     e.g., symbol=AMZN
*/

require_once('includes/stock-config.inc.php');
require_once('includes/service-utilities.inc.php');

// Tell the browser to expect JSON rather than HTML
header('Content-type: application/json');
// needed for javascript clients from another domain
header("Access-Control-Allow-Origin: *");

// first get 
$gate = new CompanyDB($connection);



if (isset($_GET['symbol'])) {
   if (! empty($_GET['symbol']))
      $results = $gate->findById($_GET['symbol']);  
   else
      $results = NULL;
}
else {      
       
   $results = $gate->getAll();

}

// output the JSON for the retrieved data

if (is_null($results))
    echo getJsonErrorMessage();
else
    echo json_encode($results);

$connection =  null;


?>
