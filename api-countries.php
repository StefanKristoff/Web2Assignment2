<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
require_once 'includes/travel-config.inc.php';
require_once 'includes/service-utilities.inc.php';

require_once 'includes/api-countries-helper.inc.php'; 
require_once 'includes/db-functions.inc.php';
// header('content-type: application/json; charset=utf-8');
// header("access-control-allow-origin: *");
// require_once 'config.inc.php';


if (isset($_GET['iso'])) {
    $countries = getCountriesById(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $_GET['iso']);
} else {
    $countries = getAllCountries(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS));
}

echo json_encode($countries, JSON_PRETTY_PRINT+JSON_NUMERIC_CHECK);
?>