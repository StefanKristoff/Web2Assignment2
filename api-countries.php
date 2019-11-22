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
// foreach(mysql_fetch_array($countries) as $row) {
//     echo json_encode($row);
// }

foreach($countries as $row) {
    echo json_encode($row, JSON_NUMERIC_CHECK+JSON_PRETTY_PRINT);
}
?>