<?php
include('includes\header.inc.php');

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
        <?php createHeader(); ?>
        <div class='box a card'>
            <h3>Country Filter</h3>
        </div>

        <section class="box b card">
            <?= createResultRow("FakeImg.jpg", "Title1"); ?>
            <?= createResultRow("FakeImg.jpg", "Title2"); ?>
            <?= createResultRow("FakeImg.jpg", "Title3"); ?>
            <?= createResultRow("FakeImg.jpg", "Title4"); ?>
            <?= createResultRow("FakeImg.jpg", "Title5"); ?>
            <!-- <div class="resultrow">
                <img src='fakeimg.jpg' width='100px' height='100px'/>
                <p>Title</p>
                    <button>View</button>
                    <button>Add to Favourites</button>
            </div> -->
        </section>

    </main>
</body>

</html>