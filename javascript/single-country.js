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
                    populateCountry();
                    updateCountryStorage();
                })
                .catch(error => console.error(error))
        }
    }

    //Update Local storage function for countries
    function updateCountryStorage() {
        localStorage.setItem("countries", JSON.stringify(countries));
    }
    //Storage for country
    function retrieveCountryStorage() {
        return JSON.parse(localStorage.getItem("countries")) || [];
    }

    //Fill country list, sorted
    function populateCountry() {
        const suggestions = document.querySelector("#filteredCountry");
        suggestions.innerHTML = "";
        console.log(countries);
        countries.sort((a, b) => {
            if (a.name < b.name) {
                return -1;
            } else if (a.name > b.name) {
                return 1;
            }
            else {
                return 0;
            }
        });

        countries.forEach(country => {
            let option = document.createElement('li');
            option.textContent = country.CountryName;
            suggestions.appendChild(option);
        })
    }
}); 