<?php
include('includes/header.inc.php');
include('includes/hamburger.inc.php');
include('includes/loggedinsession.inc.php');
?>
<!--  DONT EDIT THIS FILE DONT EDIT THIS FILE!!!!!!!!!!!!!!!!!! IF YOU NEED TO EDIT HOME PAGE, EDIT IN THE INDEX PAGE!!!!!!!!!!!! Will delete this file later, as backup, despite git. -->
<!DOCTYPE html>
<html>

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
                <p>He is tall and short...</p>
                <p>Eyes blue...ish</p>
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

</html>