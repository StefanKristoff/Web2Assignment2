<?php
include('includes/header.inc.php');
include('includes/hamburger.inc.php');
require_once 'includes/browser.inc.php';
require_once 'config.inc.php';


function createCityFilterMode(){
    echo "<form method='get' action='browser.php'>";
        echo "<select name='cityImg' id='cityImg' placeHolder='Filter By...'>";
            echo "<option value=''>Filter By... </option>";
            echo "<option value=''>Country </option>";
            echo "<option value=''>City</option>"; 
        echo "</select>"; 
        echo "<input type='submit' name='submit' value='Search'>";  
    echo "</form>";
}
function cityImageList(){
    $cityImg = getCityWithImages(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
    foreach($cityImg as $ci){
        echo "<option value''> {$ci['AsciiName']} </option>";
    }
}
function countryImageList(){
    $countryImg = getCountryWithImages(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));

    foreach($countryImg as $co){
        echo "<option value''> {$co['CountryName']} </option>";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Browse Photos</title>
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\browser.css">
</head>

<body>
    <main class='grid-container'>
        <?php 
        createHeader(); 
        createHamburger();
        ?>
        <div class='box a card'>
            <h3>Photo Filter</h3>
            <?= createCityFilterMode()?>
            <div class='cityWithImg'>
                <ul>
                    <?= cityImageList()?>
                </ul>
            </div>
            <div class='countryWithImg'>
                <ul>
                    <?= countryImageList()?>
                </ul>
            </div>
        </div>

        <section class="box b card">
            <?= createResultRow("FakeImg.jpg", "Title1"); ?>
            <?= createResultRow("FakeImg.jpg", "Title2"); ?>
            <?= createResultRow("FakeImg.jpg", "Title3"); ?>
            <?= createResultRow("FakeImg.jpg", "Title4"); ?>
            <?= createResultRow("FakeImg.jpg", "Title5"); ?>
        </section>

    </main>
</body>

</html>