<?php
include('includes/header.inc.php');
include('includes/hamburger.inc.php');

?>
<!DOCTYPE html>
<html>

<head>
    <title>Single City</title>
    <link rel="stylesheet" href="css\stylesheet.css">
    <link rel="stylesheet" href="css\city-stylesheet.css">
    <script type="module" src="javascript\get-countries.js"></script>
    <script type="module" src="javascript\single-city.js"></script>
</head>

<body>
    <div class='grid-container'>

        <main class='main'>
            <?php
            createHeader();
            createHamburger();
            ?>
            <div class='box a card'> 
            
                    <h3>City Filter</h3>
                    <p>
                        <input type="text" id="citySearch" class="search" placeholder="Search Cities" list="filteredCity">
                    </p>
                    <button type="button" class="filterBtn" id="cityHasImages" list="filteredCity">Only have Images</button>
                    <button type="button" class="filterBtn" id="resetCityFilter" list="filteredCity">Reset Filters</button>
            
            </div>

            <div class='box b card'>
                <h3>City List</h3>
                <ul class="filteredCity"></ul>
            </div>

            <section>
                <div class='box c card'>
                    <h2 id="cityName"></h2>
                    <section>
                        <div>
                            <label class="popLabel"> </label>
                            <span id="cityPopulation"></span>
                        </div>
                        <div>
                            <label class="eleLabel"> </label>
                            <span id="cityElevation"></span>
                        </div>
                        <div>
                            <label class="timeLabel"> </label>
                            <span id="cityTimeZone"></span>
                        </div>
                    </section>
                </div>
                <div class='box d card'>
                    <h3>City Map</h3>
                </div>
                <div class='box e card'>
                    <h3>City Photos</h3>
                </div>
            </section>

        </main>

    </div>
</body>


</html>