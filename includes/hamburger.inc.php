<!DOCTYPE html>
<div class="topnav" id="myTopnav">
<img src="https://uplifted-scout-261201.appspot.com/images/logo.png" width='50' height='50' class="logo">
  <a href="https://uplifted-scout-261201.appspot.com/about.php" class="active">About</a>
  <a href="https://uplifted-scout-261201.appspot.com/index.php">Home</a>
  <a href="https://uplifted-scout-261201.appspot.com/browser.php">Browser</a>
  <a href="https://uplifted-scout-261201.appspot.com/favourites.php">Favourites</a>
  <a href="https://uplifted-scout-261201.appspot.com/single-city.php">Cities</a>
  <a href="https://uplifted-scout-261201.appspot.com/single-country.php">Countries</a>
  <a href="https://uplifted-scout-261201.appspot.com/signup.php">Signup</a>
  <a href="https://uplifted-scout-261201.appspot.com/login.php">Login</a>
  <a href="https://uplifted-scout-261201.appspot.com/logout.php">Logout</a>
  <a href="javascript:void(0);" class="icon" onclick="hamburgerOnClick()">
    <i class="fa fa-bars"></i>
  </a>
</div>
<script>
    
function hamburgerOnClick() {
    let nav = document.querySelector("#myTopnav");
    if (nav.className === "topnav") {
        nav.className += " responsive";
    } else {
        nav.className = "topnav";
    }
}
</script>

<?php

// function createHamburger()
// {
//     $pages = ["about"=>"About", "index"=>"Home", "browser"=>"Browser", "favourites"=>"Favourites", "single-city"=>"Cities", "single-country"=>"Countries", "signup"=>"Signup", "login"=>"Login", "logout"=>"Logout"];
//     echo "<div class='hamburgerNav topnav' id=myTopnav>";
//     foreach($pages as $key => $value){
//         echo "<a href='https://uplifted-scout-261201.appspot.com/$key.php'>$value</a>";
//     }
//     echo "<a href='javascript:void(0);' class='icon' onclick=hamburgerOnClick()><i class='fa fa-bars'></i></a>";
//     echo "</div>";
// }
?>
