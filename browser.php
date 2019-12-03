<?php
include('includes/header.inc.php');
include('includes/hamburger.inc.php');
include('includes/browser.inc.php');

function createCityFilterMode(){
    echo "<select name='cityImg' id='cityImg' placeHolder='Filter By...'>";
        echo "<option value=''>Filter By... </option>";

        $cityImg = getCityWithImages(setConnectionInfo(DBCONNECTION,DBUSER,DBPASS));
        $countryImg = getCountryWithImages(setConnectionInfo((DBCONNECTION,DBUSER,DBPASS));

                

    
    echo '</select>';

    
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