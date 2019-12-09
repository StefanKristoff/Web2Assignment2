<?php

require_once 'config.inc.php';
require_once "includes/userlogin-helper.inc.php";
session_start();

if (isset($_SESSION['userid']) && $_SESSION['active']) {
    $userid = $_SESSION['userid'];
    $active = $_SESSION['active'];
} else {
    header("Location: login.php");
}


?>