<?php
include('includes\header.inc.php');
?>


<!DOCTYPE html>
<html>

<head>
    <title> Home Page Log In</title>
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\logIn-stylesheet.css">
</head>

<body>
    <main class='grid-container'>
        <?php createHeader(); ?>
        <section class='nested'>
            <h3>Hero Image</h3>
            <img src="" alt="">
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