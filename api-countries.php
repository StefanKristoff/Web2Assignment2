<?php
require_once 'config.inc.php';
require_once 'api-countries-helper.inc.php'; 
require_once 'db-functions.inc.php';

header('Content-Type: application/json');

if (isset($_GET['iso'])) {
    $countries = getCountriesById(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $_GET['iso']);
} else {
    $countries = getAllCountries(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
}

echo $countries;
?>