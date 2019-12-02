document.addEventListener("DOMContentLoaded", function () {
console.log("hello World");

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

    const populationLabel = document.querySelector(".popLabel");
    const elevationLabel = document.querySelector(".eleLabel");
    const timeZoneLabel = document.querySelector(".timeLabel");
    cityMap(citySelected.Latitude, citySelected.Longitude);
    // title the lables
    populationLabel.innerHTML = "";
    elevationLabel.innerHTML = "";
    timeZoneLabel.innerHTML = "";

    //The detailes
    h2.innerHTML = "";
    population.innerHTML = "";
    elevation.innerHTML = "";
    timeZone.innerHTML = "";


    // printing out city details + labels
    populationLabel.innerHTML = "Population: ";
    elevationLabel.innerHTML = "Elevation: ";
    timeZoneLabel.innerHTML = "Time Zone: ";

    h2.textContent = citySelected.AsciiName;
    population.textContent = citySelected.Population;
    elevation.textContent = citySelected.Elevation;
    timeZone.textContent = citySelected.TimeZone;

}

function cityMap(lat, long){
    
}

})