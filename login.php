<?php
require_once 'config.inc.php';
require_once "includes/header.inc.php";
require_once "includes/hamburger.inc.php";
require_once "includes/userlogin-helper.inc.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = getUserLoginByUser(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $_POST['email']);

    if ($user) {
        if (password_verify($_POST['password'], $user[0]['Password']) && strtolower($_POST['email']) == strtolower($user[0]['UserName'])) {
            $_SESSION["userid"] = $user[0]['UserName'];
            $_SESSION["active"] = true;
            header("location: index-logged-in.php");
        }
    } else {
        $error = "Email or Password are incorrect";
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Home Page Log In</title>
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\login.css">
    <script rel="text/javascript" src="javascript\index.js"></script>
</head>

<body>
    <main class='grid-container'>
        <?php
        createHeader();
        createHamburger();
        ?>

        <h3>LOGIN</h3>
        <form class='loginform' action='login.php' method='post' id='loginform'>
            <div class='formitem'>
                <label>Email:</label>
                <input type="email" name='email' />
            </div>
            <div class='formitem'>
                <label>Password:</label>
                <input type="password" name='password' />
            </div>
            <button type="submit" form='loginform' value='Login'>Login</button>
        </form>
    </main>
</body>

</html>