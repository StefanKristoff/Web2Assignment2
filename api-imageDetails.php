<?php
require_once 'config.inc.php';
require_once 'api-image-helper.inc.php'; 
require_once 'db-functions.inc.php';

header('Content-Type: application/json');

$images = getImages(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
echo json_encode($images, JSON_PRETTY_PRINT+JSON_NUMERIC_CHECK);
?>