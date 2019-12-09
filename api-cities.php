<?php
require_once 'config.inc.php';
require_once 'api-cities-helper.inc.php';
require_once 'db-functions.inc.php';

header('Content-Type: application/json');

if (isset($_GET['CountryCodeISO'])) {
    $cities = getCitiesById(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $_GET['CountryCodeISO']);
} else {
    $cities = getAllCities(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
}
echo json_encode($cities, JSON_PRETTY_PRINT + JSON_NUMERIC_CHECK);
