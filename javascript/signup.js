document.addEventListener("DOMContentLoaded", function () {
    let countries = [];
    let cities = [];

    //Get countries
    const countryAPI = 'https://uplifted-scout-261201.appspot.com/api-countries.php';

    countries = retrieveCountryStorage();
    if (countries.length < 1) {
        fetch(countryAPI)
            .then(response => response.json())
            .then(data => {
                for (let c of data) {
                    countries.push(c);
                }
                updateCountryStorage();
                // return countries;
            })
            .catch(error => console.error(error))
    }
    let filteredCountry = document.querySelector("#filteredCountry");
    countries.forEach(country => {
        let item = document.createElement("option");
        item.value = country.CountryName;
        filteredCountry.appendChild(item);
    });

    //Update Local storage function for countries
    function updateCountryStorage() {
        localStorage.setItem("countries", JSON.stringify(countries));
    }
    //Storage for country
    function retrieveCountryStorage() {
        return JSON.parse(localStorage.getItem("countries")) || [];
    }




    //  CITIES

    // // Fetch the cities from the endPoint
    const cityEndpoint = 'https://uplifted-scout-261201.appspot.com/api-cities.php'

    cities = retrieveCityStorage();
    if (cities.length < 1) {
        fetch(cityEndpoint)
            .then(response => response.json())
            .then(data => {
                for (let c of data) {
                    cities.push(c);
                    console.log(c);
                }
                updateCityStorage();
            })
            .catch(error => console.error(error));
    }

    let filteredCity = document.querySelector("#filteredCity");
    cities.forEach(city => {
        let item = document.createElement("option");
        item.value = city.AsciiName;
        filteredCity.appendChild(item);
    });


    // CITY Storage
    function updateCityStorage() {
        localStorage.setItem("cities", JSON.stringify(cities));
    }
    function retrieveCityStorage() {
        return JSON.parse(localStorage.getItem("cities")) || [];
    }



    // ONCLICK VERIFICATION
    document.querySelector("#submitbtn").addEventListener("click", e => {
        let countryIn = document.querySelector("#countrySearch");
        let cityIn = document.querySelector("#citySearch");

        let countryExist = countries.find(country => country.CountryName === countryIn.value);
        if (countryExist === undefined) {
            e.preventDefault();
            alert("Country entered not found.");
        }

        console.log(cities);
        let cityExist = cities.find(city => city.AsciiName === cityIn.value);
        console.log(cityExist);
        if (cityExist === undefined) {
            e.preventDefault();
            alert("City entered not found.");
        }

        let password = document.querySelector("#password").value;
        let confirmpass = document.querySelector("#confirmPassword").value;
        
        if (password !== confirmpass) {
            e.preventDefault();
            alert("Passwords don't match.");
        }

    })

})