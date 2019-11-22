<?php
require_once 'config.inc.php';
require_once 'api-cities-helper.inc.php';
require_once 'db-functions.inc.php';

header('Content-Type: application/json');

$data = $cities;
if (isset($_GET['CityCode'])) {
    //     $found = null;
    //     $cities = getCitiesById(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $_GET['CityCode']);
    // } else {
    //     $cities = getAllCities(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));

    $found = null;
    foreach ($cities as $c) {
        if ($c['CityCode'] == $_GET['CityCode']) {
            $found = $c;
            $cities = getCitiesById(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $_GET['CityCode']);
        }
    }
    if (isset($found)) {
        $data = $found;
    } else { }
}

foreach ($cities as $row) {
    echo json_encode($row, JSON_NUMERIC_CHECK + JSON_PRETTY_PRINT);
}
