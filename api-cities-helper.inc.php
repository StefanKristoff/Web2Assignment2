<?php
require_once 'db-functions.inc.php';
require_once 'config.inc.php';

function getCitySQL()
{
    $sql = 'SELECT cities.CityCode, AsciiName, cities.CountryCodeISO, cities.Latitude, cities.Longitude, Population, Elevation, TimeZone FROM cities';
    return $sql;
}

function getAllCities($connection)
{
    try {
        $sql = getCitySQL() . " ORDER BY AsciiName";
        $result = runQuery($connection, $sql, null);
        return $result;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function getCitiesById($connection, $id)
{
    try {
        $sql = getCitySQL() . ' WHERE CountryCodeISO=? ' . " ORDER BY AsciiName";
        $result = runQUery($connection, $sql, $id);
        return $result;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function getCityWithImages($connection){
    try{
        $sql = getCitySQL() . ' INNER JOIN imagedetails ON cities.CityCode = imagedetails.CityCode GROUP BY cities.AsciiName';
        $result = runQuery($connection, $sql, null);
        return $result;

    }catch(PDOException $e){
        die($e->getMessage());
    }
}

?>
