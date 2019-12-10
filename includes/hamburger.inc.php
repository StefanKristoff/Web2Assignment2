<?php

function createHamburger()
{
    $pages = ["about"=>"About", "index"=>"Home", "browser"=>"Browser", "favourites"=>"Favourites", "single-city"=>"Cities", "single-country"=>"Countries", "signup"=>"Signup", "login"=>"Login", "logout"=>"Logout"];
    echo "<div class='hamburgerNav'>";
    foreach($pages as $key => $value){
        echo "<a href='http://localhost/Web2Assignment2/$key.php'>$value</a>";
    }
    echo "</div>";
}
?>
