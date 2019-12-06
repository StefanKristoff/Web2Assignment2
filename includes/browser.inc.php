<?php
require_once 'api-cities-helper.inc.php';
require_once 'api-countries-helper.inc.php';
require_once 'config.inc.php';


// function printCityImages(){
//     $cityImg = compareCityImg(setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS),$_POST['cities']);
//     foreach($cityImg as $image){
//         echo "<img src=/images/case-travel-master/images/medium800/{$image['Path']}>";
//         // echo '<a class="ui small image" href="single-painting.php?id='.$r['PaintingID'].'"><img src="images/art/works/square-medium/' . $r['ImageFileName'].'.jpg"></a>';
//     }
// }

function createResultRow($photo, $title) {
    echo "<div class='resultrow card'>";
    echo "<img src='images/case-travel-master/images/medium800/$photo' width='100px' height='100px'/>";
    echo "<p>$title</p>";
    echo "<button>View</button>";
    echo "<button>Add to Favourites</button>";
    echo "</div>";
}

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
        echo "<input type='submit' name='submit'>";
    echo "</form>";
}



?>
