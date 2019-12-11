<?php
include('includes/header.inc.php');
require_once 'includes/browser.inc.php';
require_once 'config.inc.php';



$images = getAllImage(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
$pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);


if(isset($_GET['cities']) && $_GET['cities'] != ''){// getting image by City name 
    $cityCode = $_GET['cities']; 
    $cityImages = getCityImg($pdo, $cityCode);
    $images = $cityImages;
}else if(isset($_GET['countries']) && $_GET['countries'] != ''){ // getting image by counntry name
    $countryISO = $_GET['countries'];
    $countryImage = getCountryImg($pdo, $countryISO);
    $images = $countryImage;
}else if(isset($_GET['ImgName']) && $_GET['ImgName'] != ''){ // getting image from the name inputted from the search box 
    $name = $_GET['ImgName'];
    $tempArray = []; // a temporary array to hold the the matched the image title

    foreach($images as $image){
        $imgFound = $image['Title'];
        if (strpos(strtoupper($imgFound), strtoupper($name)) !== false){// FINDING A WORD MATCH FROM ALL IMAGE TITLES 
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

// getting the images one by one getting JPG, Title, and ImageID
function showImages($images){

    foreach($images as $image ){

            $img = $image['Path'];
            $imgTitle = $image['Title'];
            $imgID = $image['ImageID'];
            // passing it to a function in the browser.inc.php for formatting
            createResultRow($img, $imgTitle, $imgID);
        }

}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Browse Photos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\browser.css">
</head>

<body>
    <main class='grid-container'>
        <?php 
        createHeader(); 
        // createHamburger();
        ?>
        <?php include('includes/hamburger.inc.php'); ?>
        <div class='box a card'>
            <h3>Photo Filter</h3>
            <?= createFilters()?>
        </div>

        <section class="box b card">
            <?php
            // print the images in rows
                showImages($images); 
            ?>
        </section>

    </main>
</body>

</html>