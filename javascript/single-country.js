document.addEventListener("DOMContentLoaded", function () {
    // URL for APIs containing information
    const countryAPI = 'http://localhost/Web2Assignment2/api-countries.php';
    const imagedetailAPI = 'http://localhost/Web2Assignment2/api-imageDetails.php';
    //Retrieve local storage
    let countries = retrieveCountryStorage();
    let images = retrieveImageStorage();

    //Fetch from API and call the function
    fetchCountries();
    fetchImages();

    //Calls the function to create list
    populateCountry();

    //Get countries
    function fetchCountries() {
        let search = countryAPI;

        if (countries.length < 1) {
            fetch(search)
                .then(response => response.json())
                .then(data => {
                    for (let c of data) {
                        countries.push(c);
                    }
                    sortCountryArray();
                    populateCountry();
                    updateCountryStorage();
                })
                .catch(error => console.error(error))
        }
    }

    //gets images
    function fetchImages() {
        let search = imagedetailAPI;

        if (images.length < 1) {
            fetch(search)
                .then(response => response.json())
                .then(data => {
                    for (let i of data) {
                        images.push(i);
                    }
                    updateImageStorage();
                })
                .catch(error => console.error(error))
        }
    }

    //Update Local storage functions
    function updateCountryStorage() {
        localStorage.setItem("countries", JSON.stringify(countries));
    }

    function updateImageStorage() {
        localStorage.setItem("images", JSON.stringify(images));
    }
    //Storage for country and images
    function retrieveCountryStorage() {
        return JSON.parse(localStorage.getItem("countries")) || [];
    }

    function retrieveImageStorage() {
        return JSON.parse(localStorage.getItem("images")) || [];
    }

    //Fill country list
    function populateCountry() {
        const suggestions = document.querySelector("#filteredCountry");
        suggestions.innerHTML = "";
        countries.forEach(country => {
            let option = document.createElement('li');
            let link = document.createElement('a');

            link.textContent = country.CountryName;
            link.href = "http://localhost/Web2Assignment2/single-country.php?iso=" + country.ISO;

            option.appendChild(link);
            suggestions.appendChild(option);
        })
    }

    //Sort Country Array
    function sortCountryArray() {
        countries.sort((c1, c2) => {
            if (c1.name < c2.name) { return -1; }
            if (c1.name > c2.name) { return 1; }
            return 0;
        })
    }

    const searchBox = document.querySelector('.search');
    const suggestions = document.querySelector('#filterList');
    const list = document.querySelector('#filteredCountry');

    //Filters through the countries
    searchBox.addEventListener('keyup', countryFilter);
    function countryFilter() {
        if (this.value.length >= 0) {
            list.innerHTML = "";
            suggestions.value = "";
            const matches = find(this.value, countries);
            matches.forEach(pic => {
                let newList = document.createElement('li');
                let link1 = document.createElement('a');
                link1.textContent = pic.CountryName;
                link1.href = "http://localhost/Web2Assignment2/single-country.php?iso=" + pic.ISO;
                newList.appendChild(link1);
                list.appendChild(newList);
            })
        }
    }
    //A function that takes in what the user types along with the array of countries and finds a match.
    function find(matches, country) {
        return country.filter(obj => {
            const countryRegex = new RegExp(matches, 'gi');
            return obj.CountryName.match(countryRegex);
        })
    }
    //Filters the countries depending on the continent selected
    const conSuggestions = document.querySelector("#filterList");
    const conList = document.querySelector('#filteredCountry');
    const conSelect = document.querySelector('#Continents');

    conSelect.addEventListener("change", filterContinent);
    function filterContinent() {

        let sValue = conSelect.options[conSelect.selectedIndex].value;
        if (sValue == "0") {
            populateCountry();
        }
        else {
            conList.innerHTML = "";
            conSuggestions.innterHTML = "";
            const matches = findCon(sValue, countries);

            matches.forEach(country => {
                let opt = document.createElement('li');
                let link2 = document.createElement('a');
                link2.textContent = country.CountryName;
                link2.href = "http://localhost/Web2Assignment2/single-country.php?iso=" + country.ISO;
                opt.appendChild(link2);
                conList.appendChild(opt);
            })
        }
    }
    //Function to match the continent selected with the continents in the DB
    function findCon(match, con) {
        return con.filter(obj => {
            const continentRegex = new RegExp(match, 'gi');
            return obj.Continent.match(continentRegex);
        })
    }

    //filters through countries with images
    const countryImgSug = document.querySelector('#countryPic');
    const searchImg = document.querySelector('.searchImg');
    const filterCountryImg = document.querySelector('#filteredCountry');
    searchImg.addEventListener('click', function countryImgFilters() {
        filterCountryImg.innerHTML = "";
        countryImgSug.innerHTML = "";
        let countriesWithImages = countries.filter(c => {
            for (let i of images) {
                if (c.ISO.toLowerCase() == i.CountryCodeISO.toLowerCase()) {
                    return c;
                }
            }
        });
        console.log(countriesWithImages);

        for (let c of countriesWithImages) {
            let countryWithImg = document.createElement("li");
            let link4 = document.createElement('a');
            link4.textContent = c.CountryName;
            link4.href = "http://localhost/Web2Assignment2/single-country.php?iso=" + c.ISO;
            countryWithImg.appendChild(link4);
            filterCountryImg.appendChild(countryWithImg);
        }
    });

    // country reset Button, resets the list of countries when clicked
    const resetDataId = document.querySelector('#resetCountry');
    const resetButton = document.querySelector('.resetButton');
    const resetCountry = document.querySelector('#filteredCountry');
    const resetCity = document.querySelector('#countryDetails');
    const resetList = document.querySelector('#cityList');
    const resetPic = document.querySelector('#pictureList');
    resetButton.addEventListener('click', function () {
        resetCountry.innerHTML = "";
        resetDataId.innerHTML = "";
        resetCity.textContent = "";
        resetList.textContent = "";
        resetPic.textContent = "";

        for (let c of countries) {
            let resetList = document.createElement("li");
            let link3 = document.createElement('a');
            link3.textContent = c.CountryName;
            link3.href = "http://localhost/Web2Assignment2/single-country.php?iso=" + c.ISO;
            resetList.appendChild(link3);
            resetCountry.appendChild(resetList);
        }
    });


}); 