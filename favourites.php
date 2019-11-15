<?php
include('includes\header.inc.php');
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
        <?php createHeader(); ?>
        <section class="favouriteImages">
            <?php
            for ($i = 0; $i < 10; $i++) {
                echo "<img height='250px' width='250px' src='fakeimg.jpg'/>";
            }

            ?>
        </section>
</body>

</html>