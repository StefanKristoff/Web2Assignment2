<?php
require_once 'api-cities-helper.inc.php';
require_once 'api-countries-helper.inc.php';
require_once 'config.inc.php';






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
