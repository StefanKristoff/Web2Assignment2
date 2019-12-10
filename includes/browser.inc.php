<?php
require_once 'api-cities-helper.inc.php';
require_once 'api-countries-helper.inc.php';
require_once 'config.inc.php';

session_start();
if (isset($_POST['favorite'])){
    $ID = $_POST['imgId'];
    echo $ID;
    if(isset($_SESSION['add'])){
        $addFav = $_SESSION['add'];
    }else{
        $addFav = [];
    }
    // add img to favorites
    $addFav[] = $ID;
    $_SESSION['add'] = $addFav;
}





function createResultRow($photo, $title, $imgID) {
    echo "<div class='resultrow card'>";
    echo "<img src='images/case-travel-master/images/medium800/$photo' width='100px' height='100px'/>";
    echo "<p>$title</p>";

    $str = "id={$imgID}";
    
        echo "<a href='single-photo.php?$str'> <button>View</button> </a>";
        echo "<form method='post'>";
            echo "<input type='hidden' id='imgId' name='imgId' value='$imgID'>";
            echo "<input type='submit' getId='$imgID' name='favorite' value='favorite'>";
        echo "</form>";
    echo "</div>";  
}










// creating the Filters for the browser/search photo page
function createFilters(){
    echo "<form method='get' action='browser.php'>";
        echo "<select name='cities' id='cities' placeHolder='Filter By...'>";
            echo "<option value=''>City</option>";
            $cityImg = getCityWithImagesSQL(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));
            foreach($cityImg as $ci){
                echo "<option value='{$ci['CityCode']}'> {$ci['AsciiName']} </option>";
            }
        echo "</select>";

        
    
        echo "<select name='countries' id='countries' placeHolder='Filter By...'>";
            echo "<option value=''>Country</option>";
            $countryImg = getCountryWithImages(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS));

            foreach($countryImg as $co){
                echo "<option value='{$co['ISO']}'> {$co['CountryName']} </option>";
            }
        echo "</select>"; 
        echo "<input type='text' value='' name='ImgName' placeHolder='Seach Image by name'>";
        echo "<button type='submit' name='submit' value=''>Filter</button>";
        echo "<button type='submit' name='Clear' value=''>Clear Filter</button>";
    echo "</form>";
}



?>
