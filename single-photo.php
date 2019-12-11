<?php
session_start();
include('includes/header.inc.php');
require_once 'api-cities-helper.inc.php';
require_once 'config.inc.php';

$pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
$info;


//getting the image id from the image that is passed from broswer
$id = $_GET['id'];

// getting the image from the Sql according to the imageID passed
$singleImage = getImageByID($pdo, $id);
$info = $singleImage;

//looping to get all the nessesary information
foreach ($info as $i) {
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

    if ($sourceURL == '') {
        $sourceURL = 'NONE';
    }
    $colors = json_decode($i['Colors'], true);
    $exif = json_decode($i['Exif'], true);
}

// Session to add the image to the favorites page
if (isset($_POST['singlefavorite'])) { //chedk 
    $singleID = $_POST['Id'];
    if (isset($_SESSION['add'])) {
        $addSingleFav = $_SESSION['add'];
    } else {
        $addSingleFav = [];
    }
    // add img to favorites
    $addSingleFav[] = $singleID;
    $_SESSION['add'] = $addSingleFav;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Single Photo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\single-photo.css">
    <script src="javascript\single-photo.js"></script>
</head>

<body>
    <main class='grid-container'>
        <?php createHeader(); ?>
        <?php include('includes/hamburger.inc.php'); ?>
        <section class="box singleView">
            <div id="singlePic">
                <img id="<?= $id ?>" src="images/case-travel-master/images/medium800/<?= $img ?>">
            </div>
            <div id="singlePicInfo">
                <div id="singlePicDetails">
                    <div id="favoritesButton">
                        <!-- <button id="favorites">Add to Favorites</button> -->
                        <form method='post'>
                            <input type='hidden' id='Id' name='Id' value='<?= $id ?>'>
                            <input type='submit' getId='<?= $id ?>' name='singlefavorite' value='Add to Favorites'>
                        </form>
                    </div>
                    <span id="photoTitle">Photo Title: <?= $Title ?></span>
                    </br></br>
                    <span id="username">User Name:<?= $creator ?></span>
                    </br></br>
                    <span id="countryCity"><?= $CountryName . ", " . $cityName ?></span>

                    <div id="descriptionsTab">
                        <!-- Buttons for image description, details and the map -->
                        <button class="itemTab" id="tabDescription">Descripttion</button>
                        <button class="itemTab" id="tabDetails">Details</button>
                        <button class="itemTab" id="tabMap">Map</button>
                        <!-- THE DESCRIPTION BOX -->
                        <div class="tabBox" id="tabBoxDescription">
                            <?= $Description ?>
                        </div>

                        <!-- THE DETAILS BOX -->
                        <div class="tabBox" id="tabBoxDetails">
                            <div class="card">
                                <label>Model: </label>
                                <span id="exifModel">
                                    <?= $exif['make'] ?>
                                </span>
                            </div>
                            <div class="card">
                                <label>Exposure: </label>
                                <span id="exifExposure">
                                    <?= $exif['exposure_time'] ?>
                                </span>
                            </div>
                            <div class="card">
                                <label>Aperture: </label>
                                <span id="exifAperture">
                                    <?= $exif['aperture'] ?>
                                </span>
                            </div>
                            <div class="card">
                                <label>Focal Length: </label>
                                <span id="exifFocal">
                                    <?= $exif['focal_length'] ?>
                                </span>
                            </div>
                            <div class="card">
                                <label>Iso: </label>
                                <span id="exifIso">
                                    <?= $exif['iso'] ?>
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
                                foreach ($colors as $c) {
                                    echo "<div id='colorContainer'>";
                                    echo "<span id='spanColor' style=\"background-color: " . $c . "\">" . $c . " <span>";
                                    echo "</div>";
                                }
                                ?>
                            </div>
                        </div>

                        <!-- THE MAP BOX -->
                        <div class="tabBox" id="tabBoxMap">
                            <div id='map'></div>
                        </div>

                    </div>
                </div>


            </div>
        </section>
    </main>

    <script>
        // Script in creating the map
        var map;
        let Nlat = parseFloat("<?= $latitude ?>"); //passing the latitude from php into JS
        let Nlong = parseFloat("<?= $longitude ?>"); //passing the longitude from php into JS
        console.log(Nlat, Nlong);

        function initMap() {
            // Using Nlat and Nlong for the coordinates for both map location and  marker
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: Nlat,
                    lng: Nlong
                },
                mapTypeId: 'satellite',
                zoom: 18
            });

            // Creating the marker
            var marker = new google.maps.Marker({
                position: {
                    lat: Nlat,
                    lng: Nlong
                },
                map: map
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN-iHgrz6nMd7h7OzV3Y5XCHLm7e1doP0&callback=initMap" async defer></script>
</body>

</html>