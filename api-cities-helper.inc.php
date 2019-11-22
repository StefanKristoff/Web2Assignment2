<?php
function getCitySQL()
{
    $sql = 'SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone FROM cities';
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
        $sql = getCitySQL() . ' WHERE ISO=? ' . " ORDER BY AsciiName";
        $result = runQUery($connection, $sql, $id);
        return $result;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
?>
