<?php
include('includes/header.inc.php');
require_once 'includes/api-countries-helper.inc.php';
require_once 'includes/api-cities-helper.inc.php';
require_once 'language.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Single Country</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\country-stylesheet.css">
    <script src="javascript/single-country.js"></script>
</head>

<?php
if (isset($_GET['iso'])) {
    $iso = $_GET["iso"];
    $sCountry = getCountriesById(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $_GET['iso']);
    $sCity = getCitiesById(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $_GET['iso']);
    $img = getCountryImg(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $_GET['iso']);
} else {
    $iso = '';
}
$lang = getLang(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS));
$allCountry = getAllCountries(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS));
// $lang = getLang(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
// $allCountry = getAllCountries(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));

function createCountryImg($img)
{
    if (count($img) > 0) {
        foreach ($img as $i) {
            $imageId = $i['ImageID'];
            $path = strtolower($i['Path']);
            echo "<a href='single-photo.php?id={$imageId}'><img height='100px' width='100px' src='images\case-travel-master\images\square150\\$path'></a>";
        }
    } else {
        echo "<p>No Favourited Photos Found.</p>";
    }
}
?>

<body>
    <div class='grid-container'>

        <main class='main'>
            <?php createHeader(); ?>
            <?php include('includes/hamburger.inc.php'); ?>
            <div class='box a card'>
                <h3>Country Filter</h3>
                <fieldset>
                    <input type="text" class="search" placeholder="Search Countries" list="filterList">
                    <dataList id="filterList"></dataList>

                    <select id="Continents">
                        <option value="0">Select Continent</option>
                        <option value="AF">Africa</option>
                        <option value="AN">Antarctica</option>
                        <option value="AS">Asia</option>
                        <option value="EU">Europe</option>
                        <option value="NA">North America</option>
                        <option value="OC">Oceania</option>
                        <option value="SA">South America</option>
                    </select>

                    <input type="button" class="searchImg" value="Countries w/ images" list="countryPic">
                    <datalist id="countryPic"></datalist>

                    <input type="reset" class="resetButton" value="Reset">
                    <datalist id="resetCountry"></datalist>
                </fieldset>
            </div>
            <div class='box b card'>
                <h3>Country List</h3>
                <ul id="filteredCountry"></ul>
            </div>

            <section>
                <div class='box c card'>
                    <ul id="countryDetails">
                        <?php
                        if ($iso != '') {
                            foreach ($sCountry as $s) {
                                ?>
                                <h2 id="countryName"><?php echo $s["CountryName"] ?></h2>
                                <li>Area: <?php echo $s["Area"] ?></li>
                                <li>Population: <?php echo $s["Population"] ?></li>
                                <li>Capital: <?php echo $s["Capital"] ?></li>
                                <li>Currency: <?php echo $s["CurrencyName"] ?></li>
                                <li>Domain: <?php echo $s["TopLevelDomain"] ?></li>

                                <li>Languages: <?php
                                                        foreach ($lang as $l) {
                                                            $split = $s["Languages"];
                                                            $array1 = explode(",", $split);
                                                            foreach ($array1 as $arr) {
                                                                if (strlen($arr) > 3) {
                                                                    $array2 = substr($arr, 0, -3);
                                                                } else {
                                                                    $array2 = $arr;
                                                                }
                                                                if ($array2 == $l["iso"]) {
                                                                    echo $l["name"];
                                                                    echo ", ";
                                                                }
                                                            }
                                                        }

                                                        ?></li>

                                <li>Neighbours: <?php
                                                        $neigh = $s["Neighbours"];
                                                        $neighArr = explode(",", $neigh);
                                                        foreach ($allCountry as $a) {
                                                            foreach ($neighArr as $n) {
                                                                if ($n == $a["ISO"]) {
                                                                    echo $a["CountryName"];
                                                                    echo ", ";
                                                                }
                                                            }
                                                        }

                                                        ?></li>
                                <li>Description: <?php echo $s["CountryDescription"] ?></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class='box d card'>
                    <h3>City List</h3>
                    <ul id="cityList">
                        <?php
                        if ($iso != '') {
                            foreach ($sCity as $c) {
                                ?>
                                <li><a href="https://uplifted-scout-261201.appspot.com/single-city.php?cityCode=<?= $c["CityCode"] ?>"><?php echo $c["AsciiName"] ?></a></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class='box e card'>
                    <h3>Country Photos</h3>
                    <div id="pictureList">
                        <?php
                        if ($iso != '') {
                            foreach ($img as $i) {
                                createCountryImg($img);
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>

        </main>

    </div>

</body>

</html>