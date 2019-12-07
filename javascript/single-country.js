document.addEventListener("DOMContentLoaded", function () {
    // URL for the API containing country information
    console.log("Enter page");
    // const countryAPI = 'http://localhost/Web2Assignment2/api-countries.php';
    const countryAPI = 'https://uplifted-scout-261201.appspot.com/api-countries.php';
    console.log("Hi");

    localStorage.removeItem('countries');
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
                    console.log(data);
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