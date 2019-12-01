document.addEventListener("DOMContentLoaded", function () {
    // URL for the API containing country information
    const countryAPI = 'http://localhost/Web2Assignment2/api-countries.php';

    //Retrieve local storage
    let countries = retrieveCountryStorage();

    //Fetch from API and call the function
    fetchCountries();

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
                    createContinentOptions();
                    updateCountryStorage();
                })
                .catch(error => console.error(error))
        }
    }

    //Local storage function for countries
    function updateCountryStorage() {
        localStorage.setItem("countries", JSON.stringify(countries));
    }
});