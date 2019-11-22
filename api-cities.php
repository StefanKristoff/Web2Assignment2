<?php
require_once 'config.inc.php';
require_once 'api-cities-helper.inc.php';
require_once 'db-functions.inc.php';

header('Content-Type: application/json');

if (isset($_GET['CityCode'])) {
        $cities = getCitiesById(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $_GET['CityCode']);
    } else {
        $cities = getAllCities(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));

}
echo $cities;
?>