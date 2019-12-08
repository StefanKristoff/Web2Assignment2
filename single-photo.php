<?php
include('includes/header.inc.php');
include('includes/hamburger.inc.php');
require_once 'api-cities-helper.inc.php';
require_once 'config.inc.php';

$pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
$info;


//getting the image id from the image that is passed from broswer
$id = $_GET['name'];

$singleImage = getImageByID($pdo, $id);
$info = $singleImage;

foreach($info as $i){
    $img = $i['Path'];
    $latitude = $i['Latitude'];
    $longitude = $i['Longitude'];
    $Title = $i['Title'];
    $Description = $i['Description'];
    $cityName = $i['AsciiName'];
    $CountryName = $i['CountryName'];

    //for details part
    $exif = $i['Exif'];
    $creator = $i['ActualCreator'];
    $creatorURL = $i['CreatorURL'];
    $sourceURL = $i['SourceURL'];
    $colors = $i['Colors'];
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Single Photo</title>
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\single-photo.css">
    <script src="javascript\single-photo.js"></script>
</head>

<body>
    <main class='grid-container'>
        <?php 
        createHeader(); 
        createHamburger();
        ?>
        <section class="box singleView">
            <div id="singlePic">
                <img src="images/case-travel-master/images/medium800/<?= $img?>" >
            </div>
            <div id="singlePicInfo">
                <div id="singlePicDetails">
                    <div id="favoritesButton">
                        <button id="favorites">Add to Favorites</button>
                    </div>
                    <span id="photoTitle">Photo Title: <?= $Title?></span>
                    </br></br>
                    <span id="username">User Name:</span>
                    </br></br>
                    <span id="countryCity"><?= $CountryName . ", " . $cityName?></span>
                    <?php
                        
                    ?>

                    <div id="descriptionsTab">
                        <button class="itemTab" id="tabDescription">Descripttion</button>
                        <button class="itemTab" id="tabDetails">Details</button>
                        <button class="itemTab" id="tabMap">Map</button>
                        <div class="tabBox" id="tabBoxDescription">
                            <?= $Description?>
                        </div>
                        <div class="tabBox" id="tabBoxDetails">
                            <p>Hello</p>
                        </div>
                        <div class="tabBox" id="tabBoxMap">
                            <p>World</p>
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