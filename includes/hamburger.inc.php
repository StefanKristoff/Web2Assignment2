<!DOCTYPE html>
<div class="topnav" id="myTopnav">
<img src="http://localhost/Web2Assignment2/images/logo.png" width='50' height='50' class="logo">
  <a href="http://localhost/Web2Assignment2/about.php" class="active">About</a>
  <a href="http://localhost/Web2Assignment2/index.php">Home</a>
  <a href="http://localhost/Web2Assignment2/browser.php">Browser</a>
  <a href="http://localhost/Web2Assignment2/favourites.php">Favourites</a>
  <a href="http://localhost/Web2Assignment2/single-city.php">Cities</a>
  <a href="http://localhost/Web2Assignment2/single-country.php">Countries</a>
  <a href="http://localhost/Web2Assignment2/signup.php">Signup</a>
  <a href="http://localhost/Web2Assignment2/login.php">Login</a>
  <a href="http://localhost/Web2Assignment2/logout.php">Logout</a>
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
//         echo "<a href='http://localhost/Web2Assignment2/$key.php'>$value</a>";
//     }
//     echo "<a href='javascript:void(0);' class='icon' onclick=hamburgerOnClick()><i class='fa fa-bars'></i></a>";
//     echo "</div>";
// }
?>
