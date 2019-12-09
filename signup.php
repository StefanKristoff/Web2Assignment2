<?php
require_once 'config.inc.php';
require_once "includes/header.inc.php";
require_once "includes/hamburger.inc.php";
require_once "includes/userlogin-helper.inc.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first = "";
    $last = "";
    $country = "";
    $city = "";
    $email = "";
    $password = "";
    $confirm = "";

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
        header("location: index-logged-in.php");
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\login.css">
    <script rel="text/javascript" src="javascript\signup.js"></script>

</head>

<body>

    <main class='grid-container'>
        <?php
        createHeader();
        createHamburger();
        ?>

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