<?php
require_once 'db-functions.inc.php';
require_once 'config.inc.php';

function getCitySQL()
{
    $sql = 'SELECT cities.CityCode, AsciiName, cities.CountryCodeISO, cities.Latitude, cities.Longitude, Population, Elevation, TimeZone FROM cities';
    return $sql;
}
function allImageSQL(){
    $sql = 'SELECT ImageID, CityCode, CountryCodeISO, Path, Title, Description, Latitude, Longitude
            FROM imagedetails';
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

function getCityById($connection, $id)
{
    try {
        $sql = getCitySQL() . ' WHERE CityCode=? ';
        $result = runQUery($connection, $sql, $id);
        return $result;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function getCityWithImagesSQL($connection){
    try{
        $sql = getCitySQL() . ' INNER JOIN imagedetails ON cities.CityCode = imagedetails.CityCode GROUP BY cities.AsciiName';
        $result = runQuery($connection, $sql, null);
        return $result;

    }catch(PDOException $e){
        die($e->getMessage());
    }
}

function getAllImage($connection){
    try{
        $result = runQuery($connection, allImageSQL(), null);
        return $result;
    }catch(PDOException $e){
        die($e->getMessage());
    }
}
function getImage(){
    $sql =  "SELECT ImageID, Title, Description, i.Latitude, i.Longitude,
    AsciiName, CountryName, ContinentCode, Path, Exif, ActualCreator,
    CreatorURL, SourceURL, UserID, Colors
        FROM imagedetails as i
        INNER JOIN cities as city ON i.CityCode = city.CityCode
        INNER JOIN countries as c ON i.CountryCodeISO = c.ISO";
    return $sql;
}

function getImageDetail(){
    $sql =  "SELECT ImageID, Title, Description, i.Latitude, i.Longitude,
    CityCode, CountryCodeISO, ContinentCode, Path, Exif, ActualCreator,
    CreatorURL, SourceURL, UserID, Colors
        FROM imagedetails as i";
    return $sql;
}


//--------------------------------------------------------------------- FOR THE BROWSER PAGE ----------------------------------------------------------------

// Fucntions that are Grabbing images with similar CityCode or CountryISO 
function getCityImg($connection, $cityCode){
    try{
        $sql = getImage() . " WHERE i.CityCode = '$cityCode' ";
        $result = runQuery($connection, $sql, null);
        return $result;
    }catch(PDOException $e){
        die($e->getMessage());
    }
}
function getCountryImg($connection, $countryCode){
    try{
        $sql = getImage() . " WHERE i.CountryCodeISO = '$countryCode'";
        $result = runQuery($connection, $sql, null);
        return $result;
    }catch(PDOException $e){
        die($e->getMessage());
    }
}

function getUserImg($connection, $userID){
    try{
        $sql = getImage() . " WHERE i.UserID = '$userID'";
        $result = runQuery($connection, $sql, null);
        return $result;
    }catch(PDOException $e){
        die($e->getMessage());
    }
}

//DO I EVEN NEED THIS?????? WE'LL SEE
function getImageByName($connection, $name){
    try{
        $sql = getImage() . " WHERE i.Title = '$name'";
        $result = runQuery($connection, $sql, null);
        return $result;
    }catch(PDOException $e){
        die($e->getMessage());
    }
}

// function that gets a single photo using the image Id passed from the browser page
function getImageByID($connection, $id){
    try{
        $sql = getImage() . " WHERE ImageID = '$id'";
        $result = runQuery($connection, $sql, null);
        return $result;
    }catch(PDOException $e){
        die($e->getMessage());
    }
}

// function that gets a single photo using the image Id passed from the browser page. Uses city & country code. not names.
function getImageByIDCodes($connection, $id){
    try{
        $sql = getImageDetail() . " WHERE ImageID = '$id'";
        $result = runQuery($connection, $sql, null);
        return $result;
    }catch(PDOException $e){
        die($e->getMessage());
    }
}

?>