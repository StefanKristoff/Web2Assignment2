<?php
function createRecommendedImages($imagelist, $clean)
{
    // Initialize variables used
    $cityCount = [];
    $countryCount = [];
    $userCount = [];
    $recommended = [];

    // Count how many of each city or country or userid there are. This lets us choose which user favourites most
    foreach ($imagelist as $img) {
        array_push($cityCount, $img['CityCode']);
        array_push($countryCount, $img['CountryCodeISO']);
        array_push($userCount, $img['UserID']);
    }

    // Count the values we pushed above
    $cityCount = array_count_values($cityCount);
    $countryCount = array_count_values($countryCount);
    $userCount = array_count_values($userCount);
    arsort($cityCount);
    arsort($countryCount);
    arsort($userCount);
    $mostCity = key($cityCount);
    $mostCountry = key($countryCount);
    $mostUser = key($userCount);

    // Select what to fill recommended list with based on counted variables above
    $selectedFilter = "";

    // Selects the city
    if (isset($cityCount[$mostCity])) {
        if ($cityCount[$mostCity] >= $countryCount[$mostCountry] && $cityCount[$mostCity] >= $userCount[$mostUser]) {
            $selectedFilter = $mostCity;
            unset($mostCity); // Reduce memory usage, remove when done with it.
            unset($cityCount);
            $recommended = citySelectedFilter($selectedFilter, $recommended, $clean);

            // Selects the Country
        } else if ($countryCount[$mostCountry] >= $cityCount[$mostCity] && $countryCount[$mostCountry] >= $userCount[$mostUser]) {
            $selectedFilter = $mostCountry;
            unset($mostCountry);
            unset($countryCount);
            $recommended = countrySelectedFilter($selectedFilter, $recommended, $clean);

            // Selects the user
        } else {
            $selectedFilter = $mostUser;
            unset($mostUser);
            unset($userCount);
            $recommended = userSelectedFilter($selectedFilter, $recommended, $clean);
        }
    }
    $recommended = fixTooManyTooLittlePhotos($recommended, $imagelist);

    return $recommended;
}

function citySelectedFilter($selectedFilter, $recommended, $clean)
{
    $cityImg = getCityImg(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $selectedFilter);
    foreach ($cityImg as $i) {
        if (!in_array($i['ImageID'], $clean)) {
            array_push($recommended, $i);
        }
    }
    return $recommended;
}

function countrySelectedFilter($selectedFilter, $recommended, $clean)
{
    $countryImg = getCountryImg(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $selectedFilter);
    //Basic format is >>> array_push(array_name, value1, value2...)
    foreach ($countryImg as $i) {
        if (!in_array($i['ImageID'], $clean)) {
            array_push($recommended, $i);
        }
    }
    return $recommended;
}

function userSelectedFilter($selectedFilter, $recommended, $clean)
{
    $userImg = getUserImg(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS), $selectedFilter);
    //Basic format is >>> array_push(array_name, value1, value2...)
    foreach ($userImg as $i) {
        if (!in_array($i['ImageID'], $clean)) {
            array_push($recommended, $i);
        }
    }
    return $recommended;
}

function fixTooManyTooLittlePhotos($recommended, $imagelist)
{
    if (count($recommended) < 12) {
        $singleImage = getAllImage(setConnectionInfo(DBCONNECTION, DBUSER, DBPASS));
        //Basic format is >>> array_push(array_name, value1, value2...)
        $i = 1;
        while (count($recommended) < 12) {
            $new = array_rand($singleImage);
            $new = $singleImage[$new];
            foreach ($recommended as $key => $value) {
                if ($value['ImageID'] == $new['ImageID']) {
                    unset($recommended[$key]);
                }
                foreach ($imagelist as $i) {
                    if ($i['ImageID'] == $new['ImageID']) {
                        $new = array_rand($singleImage);
                        $new = $singleImage[$new];
                    }
                }
            }

            array_push($recommended, $new);
            $i++;
        }
    } else if (count($recommended) > 12) {
        array_splice($recommended, count($recommended) - (count($recommended) - 12), count($recommended) - 12);
    }
    return $recommended;
}
