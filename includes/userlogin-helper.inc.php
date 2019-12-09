<?php
require_once 'db-functions.inc.php';
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

function insertUserLogin($connection, $user, $pass, $datejoin)
{
    try {
        $connection->beginTransaction();

        $sql = "INSERT INTO userslogin (UserName, Password, DateJoined, DateLastModified) VALUES (?,?,?,?)";
        $statement = $connection->prepare($sql);
        $statement->execute(array($user, $pass, $datejoin, $datejoin));
        $connection->commit();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
