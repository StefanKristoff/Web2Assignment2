<?php
require_once 'config.inc.php';
require_once "includes/header.inc.php";
require_once "includes/userlogin-helper.inc.php";
require_once "includes/user-helper.inc.php";
require_once "db-functions.inc.php";

session_start();
$first = "";
$last = "";
$country = "";
$city = "";
$email = "";
$password = "";
$confirm = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user = getUserLoginByUser(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $_POST['email']);

    if ($user) {
        $error = "Email already exists";
        $first = $_POST['first'];
        $last = $_POST['last'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm = $_POST['confirmpassword'];
    } else {
        // insert into db stuff here
        $loginid = insertUserLogin(
            setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS),
            $_POST['email'],
            password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]),
            date('Y-m-d H:i:s'),
            $_POST['first'],
            $_POST['last'],
            $_POST['city'],
            $_POST['country']
        );

        $_SESSION["userid"] = $_POST['email'];
        $_SESSION["active"] = true;
        header("location: index.php");
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\login.css">
    <script rel="text/javascript" src="javascript\signup.js"></script>

</head>

<body>

    <main class='grid-container'>
        <?php createHeader(); ?>
        <?php include('includes/hamburger.inc.php'); ?>

        <h3>SIGNUP</h3>
        <form class='loginform' action='signup.php' method='post' id='signupform'>
            <div class='formitem'>
                <label>First Name:</label>
                <input type="text" name='first' value="<?php echo $first; ?>" required />
            </div>
            <div class='formitem'>
                <label>Last Name:</label>
                <input type="text" name='last' value="<?php echo $last; ?>" required />
            </div>
            <div class='formitem'>
                <label>Country:</label>
                <input type="text" id="countrySearch" name="country" class="search" placeholder="Search Countries" list="filteredCountry" value="<?php echo $country; ?>" required />
                <datalist id="filteredCountry">
                    <!-- Filled with countries to select from -->
                </datalist>
            </div>
            <div class='formitem'>
                <label>City:</label>
                <input type="text" name='city' name="city" id="citySearch" class="search" placeholder="Search Cities" list="filteredCity" value="<?php echo $city; ?>" required />
                <datalist id="filteredCity">
                    <!-- Filled with cities to select from -->
                </datalist>
            </div>
            <div class='formitem'>
                <label>Email:</label>
                <input type="email" name='email' value="<?php echo $email; ?>" required />
            </div>
            <div class='formitem'>
                <label>Password:</label>
                <input type="password" id="password" name='password' value="<?php echo $password; ?>" required />
            </div>
            <div class='formitem'>
                <label>Confirm Password:</label>
                <input type="password" id="confirmPassword" name='confirmpassword' value="<?php echo $confirm; ?>" required />
            </div>
            <button type="submit" id="submitbtn" form='signupform' value='Signup'>Signup</button>
        </form>
    </main>
</body>


</html>