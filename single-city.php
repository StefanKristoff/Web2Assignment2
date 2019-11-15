<?php
include('includes\header.inc.php');
include('includes\hamburger.inc.php');

?>
<!DOCTYPE html>
<html>

<head>
    <title>Single City</title>
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\city-stylesheet.css">
</head>

<body>
    <div class='grid-container'>

        <main class='main'>
            <?php 
            createHeader(); 
            createHamburger();
            ?>
            <div class='box a card'>
                <h3>City Filter</h3>
            </div>
            <div class='box b card'>
                <h3>City List</h3>
            </div>

            <section>
                <div class='box c card'>
                    <h3>City Details</h3>
                </div>
                <div class='box d card'>
                    <h3>City Map</h3>
                </div>
                <div class='box e card'>
                    <h3>City Photos</h3>
                </div>
            </section>

        </main>

    </div>
</body>

</html>