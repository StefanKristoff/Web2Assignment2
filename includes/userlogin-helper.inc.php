<?php
require_once 'includes/db-functions.inc.php';
require_once 'config.inc.php';


function getUserSQL()
{
    $sql = 'SELECT UserID, UserName, Password, Salt, Password_sha256, State, DateJoined, DateLastModified FROM userslogin';

    return $sql;
}

/*
You will likely need to implement functions such as these ...
*/
function getAllUsers($connection)
{
    try {
        $sql = getUserSQL();
        $result = runQuery($connection, $sql, null);
        return $result;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function getUserLoginByUser($connection, $user)
{
    try {
        $sql = getUserSQL() . ' WHERE UserName=?';
        $result = runQuery($connection, $sql, $user);
        return $result;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function insertUserLogin($connection, $user, $pass, $datejoin, $first, $last, $city, $country)
{
    try {
        $connection->beginTransaction();

        $sql = "INSERT INTO userslogin (UserName, Password, DateJoined, DateLastModified) VALUES (?,?,?,?)";
        $statement = $connection->prepare($sql);
        $statement->execute(array($user, $pass, $datejoin, $datejoin));

        $id = $connection->lastInsertId();
        $sqluser = "INSERT INTO users (UserID, FirstName, LastName, City, Country, Email) VALUES (?,?,?,?,?,?)";
        $statement = $connection->prepare($sqluser);
        $statement->execute(array($id, $first, $last, $city, $country, $user));
        $connection->commit();

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getLastUserId($connection) {
    try {
        $sql = 'SELECT max(UserID) FROM userslogin';
        $result = runQuery($connection, $sql);
        return $result;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}