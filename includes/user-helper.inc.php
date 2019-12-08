<?php
require_once 'db-functions.inc.php';
require_once 'config.inc.php';


function getUserSQL() {
   $sql = 'SELECT UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy FROM users';
   
   return $sql;
}

/*
  You will likely need to implement functions such as these ...
*/
function getAllUsers($connection) {
  try {
    $sql = getUserSQL();
    $result = runQuery($connection, $sql, null);
    return $result;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

function getUserById($connection, $id) {
  try {
    $sql = getUserSQL() . ' WHERE UserID=? ';
    $result = runQuery($connection, $sql, $id);
    return $result;
  } catch (PDOException $e) {
    die($e->getMessage());
  }

}


function getUserByEmail($connection, $email) {
  try {
    $sql = getUserSQL() . ' WHERE Email=? ';
    $result = runQuery($connection, $sql, $email);
    return $result;
  } catch (PDOException $e) {
    die($e->getMessage());
  }

}


?>