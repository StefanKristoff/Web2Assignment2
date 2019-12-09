document.addEventListener("DOMContentLoaded", function () {
    // URL for the API containing country information
    const countryAPI = 'http://localhost/Web2Assignment2/api-countries.php';

    //Retrieve local storage
    let countries = retrieveCountryStorage();

    //Fetch from API and call the function
    fetchCountries();

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
                    stringifyArray();
                })
                .catch(error => console.error(error))
        }
    }

    function stringifyArray() {
        JSON.stringify(countries);
    }
    //Update Local storage function for countries
    function updateCountryStorage() {
        localStorage.setItem("countries", JSON.stringify(countries));
    }
    //Storage for country
    function retrieveCountryStorage() {
        return JSON.parse(localStorage.getItem("countries")) || [];
    }

    //Fill country list
    function populateCountry() {
        const suggestions = document.querySelector("#filteredCountry");
        suggestions.innerHTML = "";
        console.log(countries);
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

    
}); 