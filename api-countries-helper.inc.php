<?php

function getCountrySQL() {
   $sql = 'SELECT ISO, ISONumeric, CountryName, Capital, CityCode, Area, Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, Neighbours, CountryDescription FROM countries';
   
   return $sql;
}

/*
  You will likely need to implement functions such as these ...
*/
function getAllCountries($connection) {
  try {
    $sql = getCountrySQL() . " ORDER BY CountryName";
    $result = runQuery($connection, getCountrySQL(), null);
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



?>