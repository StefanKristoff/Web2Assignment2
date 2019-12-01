<?php
include('includes/header.inc.php');
include('includes/hamburger.inc.php');
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
        <section class="box singleView">
            <div id="singlePic">
                <img src="fake.jpg" width="300" height="300">
            </div>
            <div id="singlePicInfo">
                <div id="singlePicDetails">
                    <div id="favoritesButton">
                        <button id="favorites">Add to Favorites</button>
                    </div>
                    <span id="photoTitle">Photo Title:</span>
                    </br></br>
                    <span id="username">User Name:</span>
                    </br></br>
                    <span id="countryCity">Country, City:</span>

                    <div id="descriptionsTab">
                        <button class="itemTab" id="tabDescription">Description</button>
                        <button class="itemTab" id="tabDetails">Details</button>
                        <button class="itemTab" id="tabMap">Map</button>
                        <div class="tabBox" id="tabBoxDescription">
                        </div>
                    </div>
                </div>


            </div>
        </section>
    </main>

    <?php


    ?>
</body>

</html>