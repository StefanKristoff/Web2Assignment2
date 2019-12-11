<?php
include('includes/header.inc.php');
require_once 'api-cities-helper.inc.php';


if (isset($_GET['cityCode'])) {
    $cityCode = $_GET["cityCode"];
    $city = getCityById(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $cityCode);
    $imagelist = getCityImg(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $cityCode);
    $lat = $city[0]['Latitude'];
    $long = $city[0]['Longitude'];
} else {
    $cityCode = "None";
}
// $lang = getLang(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
// $allCountry = getAllCountries(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));




function createCityImages($imagelist)
{
    if (count($imagelist) > 0) {
        foreach ($imagelist as $i) {
            $imgId = $i['ImageID'];
            $jpg = strtolower($i['Path']);
            // $title = $i['Title'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="module" src="javascript\get-countries.js"></script>
    <script type="module" src="javascript\single-city.js"></script>
</head>

<body>
    <div class='grid-container'>

        <main class='main'>
            <?php createHeader(); ?>
            <?php include('includes/hamburger.inc.php'); ?>

            <div class='box a card'>

                <h3>City Filter</h3>
                <p>
                    <input type="text" id="citySearch" class="search" placeholder="Search Cities" list="filteredCity">
                </p>
                <button type="button" class="filterBtn" id="cityHasImages" list="filteredCity">Only have Images</button>
                <button type="button" class="filterBtn" id="resetCityFilter" list="filteredCity">Reset Filters</button>

            </div>

            <div class='box b card'>
                <h3>City List</h3>
                <ul class="filteredCity"></ul>
            </div>

            <section>
                <div class='box c card'>
                    <h2 id="cityName"><?php echo $city[0]["AsciiName"] ?></h2>
                    <ul id="countryDetails">
                        <?php
                        if ($cityCode != '') {
                            foreach ($city as $c) {
                                ?>
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
                    <!-- <section>
                        <div>
                            <label class="popLabel"></label>
                            <span id="cityPopulation"></span>
                        </div>
                        <div>
                            <label class="eleLabel"> </label>
                            <span id="cityElevation"></span>
                        </div>
                        <div>
                            <label class="timeLabel"> </label>
                            <span id="cityTimeZone"></span>
                        </div>
                    </section> -->
                </div>
                <div class='box d card'>
                    <h3>City Map</h3>
                    <div id='map'>
                        <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?= $lat ?>,<?= $long ?>&zoom=12&size=600x600&maptype=roadmap
                                &key=AIzaSyAN-iHgrz6nMd7h7OzV3Y5XCHLm7e1doP0" />
                    </div>
                </div>
                <div class='box e card'>
                    <h3>City Photos</h3>
                    <ul id="pictureList">
                        <?php
                        createCityImages($imagelist);
                        ?>
                    </ul>
                </div>
            </section>

        </main>

    </div>
</body>


</html>