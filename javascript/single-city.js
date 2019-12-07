document.addEventListener("DOMContentLoaded", function () {
    //fetch URL for the city data
    // const cityEndpoint = 'http://localhost/web2Assignment2/api-cities.php'
    const cityEndpoint = 'https://uplifted-scout-261201.appspot.com/api-cities.php';
    let cities = retieveCityStorage();
    let citiesWithImages = retrieveCityWithImagesStorage();
    console.log("Hihi");

    // Fetch from url and call function
    fetchCities();
    fetchCitiesWithImage();

    // Calls to create country list, create listener, etc
    setCityOnClickListener();
    setCityHasImagesListener();

    //More event listener
    document.querySelector("#resetCityFilter").addEventListener("click", resetCityFilters);
    document.querySelector("#citySearch").addEventListener("keyup", displayCityMatches);

    function updateCityStorage() {
        localStorage.setItem("cities", JSON.stringify(cities));
    }

    function retieveCityStorage() {
        return JSON.parse(localStorage.getItem(" ")) || [];
    }

    function updateCityWithImageStorage() {
        localStorage.setItem("citiesWithImages", JSON.stringify(citiesWithImages));
    }
    function retrieveCityWithImagesStorage() {
        return JSON.parse(localStorage.getItem("citiesWithImages")) || [];
    }

    // Fetch the cities from the endPoint
    function fetchCities() {
        let search = cityEndpoint + "?id=ALL";

        if (cities.length < 1) {
            fetch(search)
                .then(response => response.json())
                .then(data => {
                    for (let c of data) {
                        cities.push(c);
                    }
                    updateCityStorage();
                })
                .catch(error => console.error(error));
        }
    }

    function fetchCitiesWithImage() {
        if (citiesWithImages.length < 1) {
            fetch(cityEndpoint)
                .then(response => response.json())
                .then(data => {
                    for (let c of data) {
                        citiesWithImages.push(c)
                    }
                    updateCityWithImageStorage();
                })
                .catch(error => console.error(error))
        }
    }

    function setCityOnClickListener() {
        const list = document.querySelector("#citylist");
        list.addEventListener("click", e => {
            if (e.target && e.target.nodeName == "LI") {
                pupulateCityDetails(e.target.textContent);
                populateCityListImages(e.target.textContent);
            }
        });
    }

    function populateCityList(countryName) {
        emptyCityList();
        let countrySelected = countries.find(c => c.name == countryName);
        selectedCountry = countryName;

        const suggested = document.querySelector("#b");

        suggested.innerHTML = "";

        selectedCities = cities.filter(obj => {
            const regex = new RegExp(countrySelected.iso, "gi");
            return obj.iso.match(regex);
        })

        selectedCities = selectedCities.sort((a, b) => {
            return a.name < b.name ? -1 : 1;
        })

        selectedCities.forEach(city => {
            var option = document.createElement('li');
            option.textContent = city.name;
            suggestions.appendChild(option);
        });

        if (selectedCities.length == 0) {
            suggestions.textContent = "NO cities found";
        }
    }

    function populateCityListImages() {
        const suggestions = document.querySelector("#filteredCity");
        emptyCityList();
        let countrySelected = countries.find(c => c.name == countryName);
        selectedCountry = countryName;

        let imageCities = citiesWithImages.filter(obj => {
            const regex = new RegExp(countrySelected.iso, "gi");
            return obj.iso.match(regex);
        });


        imageCities = imageCities.sort((a, b) => {
            return a.name < b.name ? -1 : 1;
        })

        imageCities.forEach(city => {
            var option = document.createElement('li');
            option.textContent = city.name;
            suggestions.appendChild(option);
        });
    }
    // Shows cities that have name matching what is typed by users
    function displayCityMatches() {
        const suggestions = document.querySelector("#filteredCity");
        const cityMatches = findCityNameMatches(this.value, selectedCities);

        suggestions.innerHTML = "";

        cityMatches.forEach(city => {
            var option = document.createElement('li');
            option.textContent = city.name;
            suggestions.appendChild(option);
        });
    }

    // Sets the click listener for the "Only have Images" button for cities
    function setCityHasImagesListener() {
        const btn = document.querySelector("#cityHasImages");
        btn.addEventListener("click", function () {
            let text = document.querySelector(".city .search");
            text.textContent = "";
            text.value = "";
            populateCityListHasImages(selectedCountry);
        });
    }

    // Resets the filters so no input is given
    function resetCityFilters() {
        let text = document.querySelector(".city .search");
        text.textContent = "";
        text.value = "";
        populateCityList(selectedCountry);
    }

    function emptyCityList() {
        document.querySelector("#filteredCity").innerHTML = "";
    }

})