<?php
require_once 'config.inc.php';
require_once 'api-image-helper.inc.php'; 
require_once 'db-functions.inc.php';

header('Content-Type: application/json');

if(isset($_GET['ImageID'])){
    $images = getImageById(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $_GET['ImageID']);
}else{
    $images = getImages(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
}

// $images = getImages(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
echo json_encode($images, JSON_PRETTY_PRINT+JSON_NUMERIC_CHECK);
?>