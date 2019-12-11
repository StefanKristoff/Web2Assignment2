<?php
require_once 'config.inc.php';
require_once 'api-image-helper.inc.php'; 
require_once 'includes/db-functions.inc.php';

header('Content-Type: application/json');

if(isset($_GET['ImageID'])){
    $images = getImageById(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $_GET['ImageID']);
}else{
    $images = getImages(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS));
}

// $images = getImages(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS));
echo json_encode($images, JSON_PRETTY_PRINT+JSON_NUMERIC_CHECK);
?>