<?php
session_start();
include('includes/header.inc.php');
include('includes/hamburger.inc.php');
require_once 'api-cities-helper.inc.php';
require_once 'config.inc.php';

$pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
$info = [];
$imagelist = [];

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
if(isset($_GET['removeBtn']) && $_GET['removeBtn'] !== null){ // got this from https://stackoverflow.com/questions/2231332/how-to-remove-a-variable-from-a-php-session-array
    unset($_GET['removeBtn']);
    $key = array_search($_GET['imgId'], $_SESSION['add']);//checks to see of the Id exists in session add, if it oes it stores it in the varable key
    
    if($key!==false){ // as long as the key isnt false, it removes the found id and re-pushes the new array back to the oridinal array to update it
        unset($_SESSION['add'][$key]);
        $_SESSION['add'] = array_values($_SESSION['add']);
    }
}

//printing error message when There is nor favorites added.
function errorMessage(){
    echo "<div id='errorMesage'>";
        echo "NO FAVORITES FOUND!";
    echo "</div>";
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
                // print error message
                errorMessage();
            }else{
                // loop to find image information
                foreach($imagelist as $img) {
                    foreach($img as $i) {
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