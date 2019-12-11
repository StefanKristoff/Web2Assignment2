<?php
include('includes/header.inc.php');
include('includes/hamburger.inc.php');
require_once 'api-cities-helper.inc.php';


if (isset($_GET['cityCode'])) {
    $cityCode = $_GET["cityCode"];
    $city = getCityById(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $cityCode);
    $imagelist = getCityImg(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $cityCode);
    $lat = $city[0]['Latitude'];
    $long = $city[0]['Longitude'];
} else {
    $cityCode = '';
}

function createCityImages($imagelist)
{
    if (count($imagelist) > 0) {
        foreach ($imagelist as $i) {
            $imgId = $i['ImageID'];
            $jpg = strtolower($i['Path']);
            echo "<li><a href='single-photo.php?id={$imgId}'><img height='150px' width='150px' src='images\case-travel-master\images\square150\\$jpg'></a></li>";
        }
    } else {
        echo "<p>No Favourited Photos Found.</p>";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Single City</title>
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\city-stylesheet.css">
    <script src="javascript/single-city.js"></script>
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
                <p>
                    <input type="text" class="search" placeholder="Search Cities" list="filterCity">
                    <datalist id="filterCity"></datalist>
                </p>
                <button type="button" class="cityImg" list="cityImg">Only have Images</button>
                <dataList id="cityPic"></dataList>

                <button type="button" class="resetButton" list="reset">Reset Filters</button>
                <datalist id="resetCity"></datalist>

            </div>

            <div class='box b card'>
                <h3>City List</h3>
                <ul class="filteredCity"></ul>
            </div>

            <section>
                <div class='box c card'>
                    <ul id="countryDetails">
                        <?php
                        if ($cityCode != '') {
                            foreach ($city as $c) {
                                ?>
                                <h2 id="cityName"><?php echo $city[0]["AsciiName"] ?></h2>
                                <li>TimeZone: <?php echo $c["TimeZone"] ?></li>
                                <li>Population: <?php echo $c["Population"] ?></li>
                                <li>Latitude: <?php echo $c["Latitude"] ?></li>
                                <li>Longitude: <?php echo $c["Longitude"] ?></li>
                                <li>Elevation: <?php echo $c["Elevation"] ?></li>

                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class='box d card'>
                    <h3>City Map</h3>
                    <div id='map'>
                        <?php
                        if ($cityCode != '') {
                            ?>
                            <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?= $lat ?>,<?= $long ?>&zoom=12&size=600x600&maptype=roadmap
                                &key=AIzaSyAN-iHgrz6nMd7h7OzV3Y5XCHLm7e1doP0" />
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class='box e card'>
                    <h3>City Photos</h3>
                    <ul id="pictureList">
                        <?php
                        if ($cityCode != '') {
                            createCityImages($imagelist);
                        }
                        ?>
                    </ul>
                </div>
            </section>

        </main>

    </div>
</body>


</html>