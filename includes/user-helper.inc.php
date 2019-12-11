<?php
require_once 'db-functions.inc.php';
require_once 'config.inc.php';


function getUserDataSQL()
{
  $sql = 'SELECT UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy FROM users';

  return $sql;
}

/*
  You will likely need to implement functions such as these ...
*/
function getAllUsersData($connection)
{
  try {
    $sql = getUserDataSQL();
    $result = runQuery($connection, $sql, null);
    return $result;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

function getUserDataById($connection, $id)
{
  try {
    $sql = getUserDataSQL() . ' WHERE UserID=? ';
    $result = runQuery($connection, $sql, $id);
    return $result;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}


function getUserDataByEmail($connection, $email)
{
  try {
    $sql = getUserDataSQL() . ' WHERE Email=? ';
    $result = runQuery($connection, $sql, $email);
    return $result;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

function insertUserData($connection, $userid, $first, $last, $city, $country, $email) {
    try {
        $connection->beginTransaction();

        $sql = "INSERT INTO users (UserID, FirstName, LastName, City, Country, Email) VALUES (?,?,?,?,?,?)";
        $statement = $connection->prepare($sql);
        $statement->execute(array($userid, $first, $last, $city, $country, $email));
        $id = $connection->lastInsertId();
        $connection->commit();
        return $id;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
