document.addEventListener("DOMContentLoaded", function () {
console.log("hello World");
// // fetch URL for the city data
// const cityEndpoint = 'http://localhost/web2Assignment2/api-cities.php'
// let cities = retieveCityStorage();
// let citiesWithImages = retrieveCityWithImagesStorage();

// // Fetch from url and call function
// fetchCities();
// fetchCitiesWithImage();

// // Calls to create country list, create listener, etc
// setCityOnClickListener();
// setCityHasImagesListener();

// //More event listener
// document.querySelector("#resetCityFilter").addEventListener("click", resetCityFilters);
// document.querySelector("#citySearch").addEventListener("keyup", displayCityMatches);

// function updateCityStorage() {
//     localStorage.setItem("cities", JSON.stringify(cities));
// }

// function retieveCityStorage(){
//     return JSON.parse(localStorage.getItem(" ")) || [];
// }

// function updateCityWithImageStorage(){
//     localStorage.setItem("citiesWithImages",  JSON.stringify(citiesWithImages));
// }
// function retrieveCityWithImagesStorage(){
//     return JSON.parse(localStorage.getItem("citiesWithImages")) || [];
// }

// // Fetch the cities from the endPoint
// function fetchCities(){
//     let search = cityEndpoint + "?id=ALL";
    
//     if (cities.length < 1){
//         fetch(search)
//             .then(response => response.json())
//             .then(data => {
//                 for (let c of data){
//                     cities.push(c);
//                 }
//                 updateCityStorage();
//             })
//             .catch(error => console.error(error));
//     }
// }

// function fetchCitiesWithImage(){
//     if(citiesWithImages.length < 1){
//         fetch(cityEndPoint)
//             .then(response => response.json())
//             .then(date => {
//                 for (let c of data ){
//                     citiesWithImages.push(c)
//                 }
//                 updateCityWithImageStorage();
//             })
//             .catch(error => console.error(error))
//     }
// }

// function setCityOnClickListener() {
//     const list = document.querySelector("#citylist");
//     list.addEventListener("click", e => {
//         if (e.target && e.target.nodeName == "LI"){
//             pupulateCityDetails(e.target.textContent);
//             populateCityListImages(e.target.textContent);
//         }
//     });
// }

// function populateCityList(countryName){
//     emptyCityList();
//     let countrySelected = countries.find(c => c.name == countryName);
//     selectedCountry = countryName;

//     const suggested = document.querySelector("#filteredCity");

//     suggested.innerHTML = "";

//     selectedCities = cities.filter(obj => {
//         const regex = new RegExp(countrySelected.iso, "gi");
//         return obj.iso.match(regex);
//     })

//     selectedCities = selectedCities.sort((a, b) => {
//         return a.name < b.name ? -1 : 1;
//     })

//     selectedCities.forEach(city => {
//         var option = document.createElement('li');
//         option.textContent = city.name;
//         suggestions.appendChild(option);
//     });

//     if (selectedCities.length == 0){
//         suggestions.textContent = "NO cities found";
//     }
// }

// function populateCityListImages(){
//     const suggestions = document.querySelector("#filteredCity");
//         emptyCityList();
//         let countrySelected = countries.find(c => c.name == countryName);
//         selectedCountry = countryName;

//         let imageCities = citiesWithImages.filter(obj => {
//             const regex = new RegExp(countrySelected.iso, "gi");
//             return obj.iso.match(regex);
//         });


//         imageCities = imageCities.sort((a, b) => {
//             return a.name < b.name ? -1 : 1;
//         })

//         imageCities.forEach(city => {
//             var option = document.createElement('li');
//             option.textContent = city.name;
//             suggestions.appendChild(option);
//         });
// }
//     // Shows cities that have name matching what is typed by users
//     function displayCityMatches() {
//         const suggestions = document.querySelector("#filteredCity");
//         const cityMatches = findCityNameMatches(this.value, selectedCities);

//         suggestions.innerHTML = "";

//         cityMatches.forEach(city => {
//             var option = document.createElement('li');
//             option.textContent = city.name;
//             suggestions.appendChild(option);
//         });
//     }

//     // Sets the click listener for the "Only have Images" button for cities
//     function setCityHasImagesListener() {
//         const btn = document.querySelector("#cityHasImages");
//         btn.addEventListener("click", function () {
//             let text = document.querySelector(".city .search");
//             text.textContent = "";
//             text.value = "";
//             populateCityListHasImages(selectedCountry);
//         });
//     }

//     // Resets the filters so no input is given
//     function resetCityFilters() {
//         let text = document.querySelector(".city .search");
//         text.textContent = "";
//         text.value = "";
//         populateCityList(selectedCountry);
//     }

// function emptyCityList(){
//     document.querySelector("#filteredCity").innerHTML = "";
// }

// The url for the city data
const cityEndpoint = 'http://localhost/web2Assignment2/api-cities.php'

// Retrieve local Storage
let cities = retrieveCityStorage();

// Fetch from Url and call function
fetchCities();

// Calls to create city list, create listener, etc
populateCity();
setCityOnClickListener();

// CITY Storage
function updateCityStorage() {
    localStorage.setItem("cities", JSON.stringify(cities));
}
function retrieveCityStorage(){
    return JSON.parse(localStorage.getItem("cities")) || [];
}

// // Fetch the cities from the endPoint
function fetchCities(){
    let search = cityEndpoint;
    
    if (cities.length < 1){
        fetch(search)
            .then(response => response.json())
            .then(data => {
                for (let c of data){
                    cities.push(c);
                    console.log(c);
                }
                updateCityStorage();
            })
            .catch(error => console.error(error));
    }
}


function populateCity(){
    const suggestions = document.querySelector(".filteredCity");
    cities.sort((a, b) => {
        if (a.name < b.name){
            return -1;
        }else if (a.name > b.name){
            return 1;
        }
        else{
            return 0;
        }
    });

    cities.forEach(city =>{
        var option = document.createElement('li');
        option.textContent = city.AsciiName;
        suggestions.appendChild(option);
    })
}

function setCityOnClickListener(){
    const list = document.querySelector(".b");
    list.addEventListener("click", e => {
        console.log("HEy");
        if (e.target && e.target.nodeName.toLowerCase() == 'li'){
            console.log(e.target.textContent);
            populateCityDetails(e.target.textContent);
            populateCityDetails(e.target.textContent);
        }
    })
}

function  populateCityDetails(cityName){
    let citySelected = cities.find(c => c.AsciiName == cityName);
    const h2 = document.querySelector("#cityName");
    const population = document.querySelector("#cityPopulation");
    const elevation = document.querySelector("#cityElevation");
    const timeZone = document.querySelector("#cityTimeZone");
    
    cityMap(citySelected.Latitude, citySelected.Longitude);

    h2.innerHTML = "";
    population.innerHTML = "";
    elevation.innerHTML = "";
    timeZone.innerHTML = "";

    h2.textContent = citySelected.AsciiName;
    population.textContent = citySelected.Population;
    elevation.textContent = citySelected.Elevation;
    timeZone.textContent = citySelected.TimeZone;

}
function cityMap(lat, long){
    
}

})