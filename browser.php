<?php
include('includes/header.inc.php');
include('includes/hamburger.inc.php');

// Does this function go into the an include-php file?
function createResultRow($photo, $title) {
    echo "<div class='resultrow card'>";
    echo "<img src='$photo' width='100px' height='100px'/>";
    echo "<p>$title</p>";
    echo "<button>View</button>";
    echo "<button>Add to Favourites</button>";
    echo "</div>";
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