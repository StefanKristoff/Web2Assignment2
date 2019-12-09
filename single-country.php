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
} else {
    $iso = '';
}
$img = getAllImage(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
$lang = getLang(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
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
            </div>
            <div class='box b card'>
                <h3>Country List</h3>
                <ul id="filteredCountry"></ul>
            </div>

            <section>
                <div class='box c card'>
                    <h3>Country Details</h3>
                    <ul>
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
                                                        echo $s["Languages"];
                                                        // foreach ($lang as $l) {
                                                        //     if ($l["iso"] == $s["Languages"]) {
                                                        //         echo $l["name"];
                                                        //     }
                                                        // }
                                                        ?></li>

                                <li>Neighbours: <?php echo $s["Neighbours"] ?></li>
                                <li>Description: <?php echo $s["CountryDescription"] ?></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class='box d card'>
                    <h3>City List</h3>
                    <ul>
                        <?php
                        if ($iso != '') {

                            foreach ($sCity as $c) {
                                ?>
                                <li><?php echo $c["AsciiName"] ?></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class='box e card'>
                    <h3>Country Photos</h3>
                    <ul>
                        <?php
                        foreach ($img as $i) {
                            ?>
                            <img src="images/case-travel-master/images/medium800/<?=$i['Path']?>" alt="<?=$i['Title']?>" height="100px" width="100px">




                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </section>

        </main>

    </div>

</body>

</html>