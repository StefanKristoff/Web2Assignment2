<?php
require_once 'includes/db-functions.inc.php';
require_once 'config.inc.php';

function getImageSQL()
{
    $sql = 'SELECT ImageID, UserID, Title, Description, Latitude, Longitude, CityCode, CountryCodeISO, ContinentCode, Path, Exif, ActualCreator, CreatorURL, SourceURL, Colors FROM imagedetails';
    return $sql;
}

function getImages($connection)
{
    try {
        $sql = getImageSQL();
        $result = runQuery($connection, $sql, null);
        return $result;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function getImageById($connection, $id){
    try{
        $sql = getImageSQL() . ' WHERE ImageID=?' . " ORDER BY ImageID";
        $result = runQuery($connection, $sql, $id);
        return $result;
    }catch(PDOException $e){
        die($e->getMessage());
    }
}

?>