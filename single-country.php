<?php
include('includes/header.inc.php');
include('includes/hamburger.inc.php');
require_once 'api-countries-helper.inc.php';
require_once 'api-cities-helper.inc.php';
require_once 'language.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Single Country</title>
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\country-stylesheet.css">
    <script src="javascript/single-country.js"></script>
</head>

<?php
if (isset($_GET['iso'])) {
    $iso = $_GET["iso"];
    $sCountry = getCountriesById(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $_GET['iso']);
    $sCity = getCitiesById(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $_GET['iso']);
    $img = getCountryImg(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS), $_GET['iso']);
} else {
    $iso = '';
}
$lang = getLang(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
$allCountry = getAllCountries(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
?>

<body>
    <div class='grid-container'>

        <main class='main'>
            <?php
            createHeader();
            createHamburger();
            ?>
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
                    <h3>Country Details</h3>
                    <ul id="countryDetails">
                        <?php
                        if ($iso != '') {
                            foreach ($sCountry as $s) {
                                ?>
                                <li><?php echo $s["CountryName"] ?></li>
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
                                <li><a href="http://localhost/Web2Assignment2/single-city.php?cityCode=<?= $c["CityCode"] ?>"><?php echo $c["AsciiName"] ?></a></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class='box e card'>
                    <h3>Country Photos</h3>
                    <ul id="pictureList">
                        <?php
                        if ($iso != '') {
                            foreach ($img as $i) {
                                ?>
                                <img src="images/case-travel-master/images/medium800/<?= $i['Path'] ?>" alt="<?= $i['Title'] ?>" height="100px" width="100px">
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </section>

        </main>

    </div>

</body>

</html>