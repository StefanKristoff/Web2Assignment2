<?php
include('includes\header.inc.php');
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
        <?php createHeader(); ?>
        <section class="box singleView">
            <div id="singlePic">
                <img src="fake.jpg" width="300" height="300">
            </div>
            <div id="singlePicInfo">
                <div id="singlePicDetails">
                    <label>Photo Title:</label>
                    <span id="photoTitle"></span>
                    </br></br>
                    <label>User Name:</label>
                    <span id="username"></span>
                    </br></br>
                    <label>Country, City:</label>
                    <span id="countryCity"></span>

                    <div id="favoritesButton">
                        <button id="favorites">Favorites</button>
                    </div>
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