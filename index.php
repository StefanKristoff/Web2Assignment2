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
    require_once 'api-cities-helper.inc.php';

    $imagelist = [];
    $recommended = [];
    
    if (isset($_SESSION['add'])) {
        // print_r($_SESSION['add']);
        $ids = $_SESSION['add'];
        //removing duplicates id's from array
        $clean = array_unique($ids);
    } else {
        $_SESSION['add'] = [];
        $ids = $_SESSION['add'];
        $clean = array_unique($ids);
    }
        foreach ($clean as $id) {
            $singleImage = getImageByIDCodes(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $id);
            //Basic format is >>> array_push(array_name, value1, value2...)
            foreach ($singleImage as $i) {
                array_push($imagelist, $i);
            }
        }

        require_once 'includes/index.inc.php';
        $recommended = createRecommendedImages($imagelist, $clean);
    // }

    $user = getUserDataByEmail(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $userEmail);
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
                        <?php
                            foreach ($imagelist as $i) {
                                $imgId = $i['ImageID'];
                                $jpg = $i['Path'];
                                // $title = $i['Title'];
                                ?>
                            <div><a href='single-photo.php?id=<?= $imgId ?>'> <img height='150px' width='150px' src='images\case-travel-master\images\square150\<?= strtolower($jpg); ?>'> </a></div>
                        <?php
                            }
                            ?>
                    </div>
                </div>
                <div class='img card'>
                    <h3>Images You May Like</h3>
                    <div class='imgNested'>
                        <?php

                            foreach ($recommended as $i) {
                                $imgId = $i['ImageID'];
                                $jpg = $i['Path'];
                                ?>

                            <div><a href='single-photo.php?id=<?= $imgId ?>'> <img height='150px' width='150px' src='images\case-travel-master\images\square150\<?= strtolower($jpg); ?>'> </a></div>
                        <?php
                            }
                            ?>
                    </div>
                </div>
            </section>
        </main>
    </body>
<?php
}
?>

</html>