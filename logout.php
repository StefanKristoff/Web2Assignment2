<?php
// Code for this found at https://www.tutorialspoint.com/php/php_mysql_login.htm (also the error message in login.php)

session_start();

// if(session_destroy()) {
$_SESSION['active'] = false;
unset($_SESSION['userid']);
unset($_SESSION['active']);
unset($_SESSION['add']);
// session_write_close();
header("Location: index.php");
// }
