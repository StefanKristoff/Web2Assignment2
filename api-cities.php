<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
require_once 'includes/travel-config.inc.php';
require_once 'includes/service-utilities.inc.php';

require_once 'includes/api-countries-helper.inc.php'; 
require_once 'includes/api-cities-helper.inc.php';
require_once 'includes/db-functions.inc.php';
// header('Content-Type: application/json');
// header("Access-Control-Allow-Origin: *");
// require_once 'config.inc.php';


if (isset($_GET['CountryCodeISO'])) {
        $cities = getCitiesById(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $_GET['CountryCodeISO']);
    } else {
        $cities = getAllCities(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS));

}
echo $cities;
?>