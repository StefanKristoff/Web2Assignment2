<?php
require_once "includes/header.inc.php";
require_once "includes/hamburger.inc.php";
?>


<!DOCTYPE html>
<html>

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

</html>