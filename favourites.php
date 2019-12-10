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
    foreach($ids as $id){
        $singleImage = getImageByID($pdo, $id);
        $index= $singleImage;
        array_push($imagelist, $singleImage);
    }
}
if(isset($_POST['remove'])){
    unset($_SESSION['add']);
}
$info[] = $index;
// print($info);


// for ($i = 0; $i < sizeof($info); $i++) {
//     print_r($info[$i]); 
//     echo "</br>";
//     echo "</br>";
//     echo "</br>";
// }

    // foreach($info as $e){
    //     // print_r($e);
    //     $img = $e['Path'];
    //     echo $img;
    // }


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
            print_r($ids);
            print_r(sizeof($ids));
            // for ($i = 0; $i < 10; $i++) {
            //     echo "<img height='250px' width='250px' src='fakeimg.jpg'/>";
            // }
            // print_r($imagelist);
            foreach($imagelist as $img) {
                // print_r($img[0]['ImageID']);
                foreach($img as $i) {
                    print_r($i['ImageID']);
                    $idWant = $i['Path'];
                    ?>
                    <img height='150px' width='150px' src='images\case-travel-master\images\square150\<?php echo strtolower($idWant); ?>'>
                    <?php 
                }
            }

            ?>
            
        </section>
</body>

</html>