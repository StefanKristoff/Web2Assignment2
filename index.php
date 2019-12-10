<?php
require_once "includes/header.inc.php";
require_once "includes/hamburger.inc.php";

session_start();
$active = false;
$userEmail = null;
if (isset($_SESSION['active'])) {
    $active = $_SESSION['active'];
    if (isset($_SESSION['userid'])) {
        $userEmail = $_SESSION['userid'];
    }
}
?>


<!DOCTYPE html>
<html>
<?php
if (!$active) {
    // LOGGED OUT
    ?>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">



        <title>Main</title>
        <link rel="stylesheet" href="css\stylesheet.css">
        <link rel="stylesheet" href="css\index.css">
        <script rel="text/javascript" src="javascript\index.js"></script>
    </head>

    <body>
        <main class='grid-container'>
            <?php
                createHeader();
                createHamburger();
                ?>


            <section class='nested hero-img'>
                <h3>WELCOME</h3>
                <div class='innerNested'>

                    <div>
                        <a class="btn" href="http://localhost/Web2Assignment2/login.php"><button type='button'>Login</button></a>
                    </div>
                    <div>
                        <a class="btn" href="http://localhost/Web2Assignment2/signup.php"><button type='button'>Join</button></a>
                    </div>
                    <input type="text" placeholder="SEARCH BOX FOR PHOTOS...">
                </div>
            </section>

        </main>
    </body>
<?php
} else {
    // LOGGED IN
    require_once 'db-functions.inc.php';
    require_once 'config.inc.php';
    require_once 'includes/user-helper.inc.php';
    $user = getUserDataByEmail(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $userEmail);
    // $images = getAllImage(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));

    $images = get
    ?>

    <head>
        <title> Home Page Log In</title>
        <link rel="stylesheet" href="css\stylesheet.css">
        <link rel="stylesheet" href="css\logged-in.css">
    </head>

    <body>
        <main class='grid-container'>
            <?php
                createHeader();
                createHamburger();
                ?>
            <section class='nested'>
                <div class='userInfo card'>
                    <h3>User Info</h3>
                    <ul>
                        <li><?php echo $user[0]['FirstName'] . " " . $user[0]['LastName']; ?></li>
                        <li><?php echo $user[0]['City'] . ", " . $user[0]['Country']; ?></li>
                    </ul>
                    <div class='userNested'>
                        <div>Picture </div>
                        <div>Picture </div>
                        <div>Picture</div>
                    </div>
                </div>
                <div class='searchBox card'>
                    <h3>Search box</h3>
                    <input type="text" placeholder="SEARCH BOX FOR PHOTOS...">
                </div>
                <div class='favImg card'>
                    <h3>Favorite Images</h3>
                    <div class='favNested'>
                        <div>Picture</div>
                        <div>Picture</div>
                    </div>
                </div>
                <div class='img card'>
                    <h3>Images You May Like</h3>
                    <div class='imgNested'>
                        <div>Picture</div>
                        <div>Picture</div>
                        <div>Picture</div>
                    </div>
                </div>
            </section>
        </main>
    </body>
<?php
}
?>

</html>