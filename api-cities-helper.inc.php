<?php
function getCitySQL()
{
    $sql = 'SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone FROM cities';
    $sql .= " ORDER BY CityCode";
    return $sql;
}

function getAllCities($connection)
{
    try {
        $sql = getCitySQL();
        $result = runQuery($connection, $sql, null);
        return $result;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function getCitiesById($connection, $id)
{
    try {
        $sql = getCitySQL() . ' WHERE ISO=? ';
        $result = runQUery($connection, $sql, $id);
        return $result;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
?>
