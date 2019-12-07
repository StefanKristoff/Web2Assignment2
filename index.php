<!DOCTYPE html>
<?php
require_once "includes/header.inc.php";
require_once "includes/hamburger.inc.php";
?>


<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Home Page Log In</title>
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\index.css">
    <script rel="text/javascript" src="javascript\indexthing.js"></script>
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
                    <button type='button'>Login</button>
                </div>
                <div>
                    <button type='button'>Join</button>
                </div>
                <input type="text" placeholder="SEARCH BOX FOR PHOTOS...">
            </div>
        </section>
    </main>
</body>

</html>