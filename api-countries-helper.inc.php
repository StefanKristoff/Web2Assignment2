<?php

function getCountrySQL() {
   $sql = 'SELECT ISO, ISONumeric, CountryName, Capital, CityCode, Area, Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, Neighbours, CountryDescription FROM countries';
   $sql .= " ORDER BY CountryName";
   return $sql;
}

/*
  You will likely need to implement functions such as these ...
*/
function getAllCountries($connection) {
  try {
    $result = runQuery($connection, getCountrySQL(), null);
    return $result;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

function getCountriesById($connection, $id) {
  try {
    $sql = getCountrySQL() . ' WHERE ISO=? ';
    $result = runQuery($connection, $sql, $id);
    return $result;
  } catch (PDOException $e) {
    die($e->getMessage());
  }

}



?>