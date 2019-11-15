<?php
include('includes\header.inc.php');
include('includes\hamburger.inc.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Single Photo</title>
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\single-photo.css">
</head>

<body>
    <main class='grid-container'>
        <?php 
        createHeader(); 
        createHamburger();
        ?>
        <div class='box a card'>
            <h3>Country Filter</h3>
        </div>
        <div class='box b card'>
            <h3>Country List</h3>
        </div>

        <section>
            <div class='box c card'>
                <h3>Country Details</h3>
            </div>
            <div class='box d card'>
                <h3>City List</h3>
            </div>
            <div class='box e card'>
                <h3>Country Photos</h3>
            </div>
        </section>

    </main>
</body>

</html>