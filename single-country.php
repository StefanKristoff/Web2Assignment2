<?php
include('includes/header.inc.php');
include('includes/hamburger.inc.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Single Country</title>
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\country-stylesheet.css">
    <script src="javascript/single-country.js"></script>
</head>

<body>
    <div class='grid-container'>

        <main class='main'>
            <?php
            createHeader();
            createHamburger();
            ?>
            <div class='box a card'>
                <h3>Country Filter</h3>
            </div>
            <div class='box b card'>
                <h3>Country List</h3>
                <?php

                ?>

                <ul id="filteredCountry"></ul>
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

    </div>

</body>

</html>