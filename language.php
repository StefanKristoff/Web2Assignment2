<?php
require_once 'includes/db-functions.inc.php';
require_once 'config.inc.php';

function getLanguageSQL(){
    $sql = 'SELECT id, name, iso FROM languages'; 
    return $sql;
}

function getLang($connection){
try{
    $sql = getLanguageSQL();
    $result = runQuery($connection, $sql, null);
    return $result;
} catch (PDOException $e){
    die($e->getMessage());
}
}
?>