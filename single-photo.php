<?php
include('includes/header.inc.php');
include('includes/hamburger.inc.php');
require_once 'api-cities-helper.inc.php';
require_once 'config.inc.php';

$pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
$info;


//getting the image id from the image that is passed from broswer
$id = $_GET['name'];

if($id == ''){
    
}else{

}

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
    
    $creator = $i['ActualCreator'];
    $creatorURL = $i['CreatorURL'];
    $sourceURL = $i['SourceURL'];

    if($sourceURL == ''){
        $sourceURL = 'NONE';
    }
    // $colors = $i['Colors'];
    // $exif = $i['Exif'];
    $colors = json_decode($i['Colors'], true);
    $exif = json_decode($i['Exif'], true);

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
                    <span id="username">User Name:<?= $creator?></span>
                    </br></br>
                    <span id="countryCity"><?= $CountryName . ", " . $cityName?></span>

                    <div id="descriptionsTab">
                        <button class="itemTab" id="tabDescription">Descripttion</button>
                        <button class="itemTab" id="tabDetails">Details</button>
                        <button class="itemTab" id="tabMap">Map</button>
                        <div class="tabBox" id="tabBoxDescription">
                            <?= $Description?>
                        </div>
                        <div class="tabBox" id="tabBoxDetails">
                             <div class="card">
                                <label>Model: </label>
                                <span id="exifModel">
                                    <?= $exif['make']?>
                                </span>
                            </div>
                            <div class="card">
                                <label>Exposure: </label>
                                <span id="exifExposure">
                                <?= $exif['exposure_time']?>                                
                            </span>
                            </div>
                            <div class="card">
                                <label>Aperture: </label>
                                <span id="exifAperture">
                                <?= $exif['aperture']?>
                                </span>
                            </div>
                            <div class="card">
                                <label>Focal Length: </label>
                                <span id="exifFocal">
                                <?= $exif['focal_length']?>
                                </span>
                            </div>
                            <div class="card">
                                <label>Iso: </label>
                                <span id="exifIso">
                                <?= $exif['iso']?>
                                </span>
                            </div>
                            <div class="card">
                                <label>Credit: </label> <br>                           
                                <span id="exifCredit">
                                    <?php
                                        echo "Actual Creator: " . $creator . "<br>";
                                        echo "Creator: " . $creatorURL . "<br>";
                                        echo "Source: " . $sourceURL . "<br>";
                                    ?>
                                </span>
                            </div>
                            <div class="card" id="colorHexCard">
                                <label>Colours</label>
                                <!-- <span id="exifColourBox"></span><span id="exifColour"></span> -->
                                <?php  
                                    foreach($colors as $c){
                                        echo "<div id='colorContainer'>";
                                        echo "<span id='spanColor' style=\"background-color: " . $c. "\">" . $c . " <span>";
                                        echo "</div>";
                                    }
                                ?>
                            </div>
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