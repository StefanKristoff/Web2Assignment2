<?php
include('includes\header.inc.php');
include('includes\hamburger.inc.php');
?>


<!DOCTYPE html>
<html>

<head>
    <title> Home Page Log In</title>
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\index.css">
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