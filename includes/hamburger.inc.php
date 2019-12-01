<?php
function createHamburger()
{
    $pages = ["about", "browser", "favourites", "index-logged-in", "index", "single-city", "single-country", "single-photo"];
    echo "<div class='hamburgerNav'>";
    foreach($pages as $p){
        echo "<a href='http://localhost/Web2Assignment2/$p.php'>$p page</a>";
        echo "</br>";
    }
    echo "</div>";
}
?>
