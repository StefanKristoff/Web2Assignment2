<?php
include('includes/header.inc.php');
include('includes/hamburger.inc.php');
require_once 'includes/browser.inc.php';
require_once 'config.inc.php';



$images = getAllImage(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
$pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);



if(isset($_GET['cities']) && $_GET['cities'] != ''){
    $cityCode = $_GET['cities']; 
    $cityImages = getCityImg($pdo, $cityCode);
    $images = $cityImages;
}else if(isset($_GET['countries']) && $_GET['countries'] != ''){
    $countryISO = $_GET['countries'];
    $countryImage = getCountryImg($pdo, $countryISO);
    $images = $countryImage;
}else if(isset($_GET['ImgName']) && $_GET['ImgName'] != ''){
    $name = $_GET['ImgName'];
    $tempArray = [];

    foreach($images as $image){
        $imgFound = $image['Title'];
        if (strpos(strtoupper($imgFound), strtoupper($name)) !== false){
            $tempArray[] = $image;
        }
    }
    $images = $tempArray;

}
else{
    foreach($images as $image){
        $img = $image['Path'];
        $imgTitle = $image['Title'];
    }
}

function showImages($images){

    foreach($images as $image ){

            $img = $image['Path'];
            $imgTitle = $image['Title'];
            $imgID = $image['ImageID'];
            
            createResultRow($img, $imgTitle, $imgID);
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
            <?= createFilters()?>
        </div>

        <section class="box b card">
            <?php
                showImages($images); 
            ?>
        </section>

    </main>
</body>

</html>