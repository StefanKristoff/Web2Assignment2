<?php
include('includes/header.inc.php');
include('includes/hamburger.inc.php');
require_once 'api-cities-helper.inc.php';
require_once 'config.inc.php';

$pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
$info = [];
$imagelist = [];
session_start();
if(isset($_SESSION['add'])){
    $ids = $_SESSION['add'];
    //removing duplicates id's from array
    $clean = array_unique($ids); 
    foreach($clean as $id){
        $singleImage = getImageByID($pdo, $id);
        //Basic format is >>> array_push(array_name, value1, value2...)
        array_push($imagelist, $singleImage);
    }
}

if(isset($_POST['remove'])){
    unset($_SESSION['add']);
}
if(isset($_GET['removeBtn'])){ // got this from https://stackoverflow.com/questions/2231332/how-to-remove-a-variable-from-a-php-session-array
    unset($_GET['removeBtn']);
    $key = array_search($_GET['imgId'], $_SESSION['add']);
    
    if($key!==false){
        unset($_SESSION['add'][$key]);
        $_SESSION['add'] = array_values($_SESSION['add']);
        unset($_GET['imgId']);
    }

    
    // $_SESSION['add'] =  $_GET['removeBtn'];
    // unset($_SESSION['add']);
}

function errorMessage(){

}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Favourites</title>
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\favourites.css">
</head>

<body>
    <main class='grid-container'>
        <?php 
        createHeader(); 
        createHamburger();
        ?>
        <section class="favouriteImages">
            <form method="post">
                <input type="submit" name="remove" value="Remove">
            </form>
            <?php
            if($imagelist == null){
                echo "NO IMAGES FAVORITED";
            }else{
                // print_r($clean);
                // print_r(sizeof($clean));
                foreach($imagelist as $img) {
                    // print_r($img[0]['ImageID']);
                    foreach($img as $i) {
                        // print_r($i['ImageID']);
                        $imgId = $i['ImageID'];
                        $jpgWant = $i['Path'];
                        $titleWant = $i['Title'];
                        ?> 
                        <figure class="favCard">
                            <figcaption> <?= strtoupper($titleWant); ?></figcaption>
                            <!-- Link favorite photos to single photo, passing ImageID to s -->
                            <a href='single-photo.php?id=<?= $imgId ?>'> <img height='250px' width='270px' src='images\case-travel-master\images\medium800\<?= strtolower($jpgWant); ?>'> </a>
                            <form method="get" action="favourites.php">
                                <input type='hidden' id='imgId' name='imgId' value='<?= $imgId ?>'>
                                <input type='submit' name='removeBtn' value='Remove'>
                                <!-- <button type='submit' name="removeBtn" value="<?= $imgId ?>">Remove</button> -->
                            </form>
                        </figure>
                        
                        
                        
                        <?php 
                    }
                }
            }
            ?>
            
        </section>
</body>

</html>