<?php
include('includes/header.inc.php');
include('includes/hamburger.inc.php');
require_once 'api-cities-helper.inc.php';
require_once 'config.inc.php';

$pdo = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
session_start();
if(isset($_SESSION['add'])){
    $ids = $_SESSION['add'];
    foreach($ids as $id){
        $singleImage = getImageByID($pdo, $id);
        foreach($singleImage as $e){
            $path = $e['Path'];
            echo $path;
        }
        
        $info[] = $path;
    }
}
if(isset($_POST['remove'])){
    unset($_SESSION['add']);
}

print_r($info);


// for ($i = 0; $i < sizeof($info); $i++) {
//     print_r($info[$i]); 
//     echo "</br>";
//     echo "</br>";
//     echo "</br>";
// }

    // foreach($info as $e => $value){
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
            for ($i = 0; $i < 10; $i++) {
                echo "<img height='250px' width='250px' src='fakeimg.jpg'/>";
            }
            

            ?>
            
        </section>
</body>

</html>