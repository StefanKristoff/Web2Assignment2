<?php
require_once 'includes/db-functions.inc.php';
require_once 'config.inc.php';


function getCountrySQL() {
   $sql = 'SELECT ISO, ISONumeric, CountryName, Capital, countries.CityCode, Area, Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, Neighbours, CountryDescription FROM countries';
   
   return $sql;
}

/*
  You will likely need to implement functions such as these ...
*/
function getAllCountries($connection) {
  try {
    $sql = getCountrySQL() . " ORDER BY CountryName";
    $result = runQuery($connection, $sql, null);
    return $result;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

function getCountriesById($connection, $id) {
  try {
    $sql = getCountrySQL() . ' WHERE ISO=? ' . " ORDER BY CountryName";
    $result = runQuery($connection, $sql, $id);
    return $result;
  } catch (PDOException $e) {
    die($e->getMessage());
  }

}

function getCountryWithImages($connection){
  try{
      $sql = getCountrySQL() . ' INNER JOIN imagedetails ON countries.ISO = imagedetails.CountryCodeISO GROUP BY countries.ISO ORDER BY CountryName';
      $result = runQuery($connection, $sql, null);
      return $result;

  }catch(PDOException $e){
      die($e->getMessage());
  }
}



?>