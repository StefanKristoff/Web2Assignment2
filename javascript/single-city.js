document.addEventListener("DOMContentLoaded", function () {

    // The url for the city data
    const cityEndpoint = 'http://localhost/web2Assignment2/api-cities.php'

    // Retrieve local Storage
    let cities = retrieveCityStorage();

    // Fetch from Url and call function
    fetchCities();

    //Populates city list
    populateCity();
    // // Fetch the cities from the endPoint
    function fetchCities() {
        if (cities.length < 1) {
            fetch(cityEndpoint)
                .then(response => response.json())
                .then(data => {
                    for (let c of data) {
                        cities.push(c);
                    }
                    populateCity();
                    updateCityStorage();
                })
                .catch(error => console.error(error));
        }
    }


    // CITY Storage
    function updateCityStorage() {
        localStorage.setItem("cities", JSON.stringify(cities));
    }
    function retrieveCityStorage() {
        return JSON.parse(localStorage.getItem("cities")) || [];
    }
    function populateCity() {
        const suggestions = document.querySelector(".filteredCity");
        suggestions.innerHTML = "";
        cities.sort((a, b) => {
            if (a.name < b.name) {
                return -1;
            } else if (a.name > b.name) {
                return 1;
            }
            else {
                return 0;
            }
        });

        cities.forEach(city => {
            let option = document.createElement('li');
            let link = document.createElement('a');
            link.textContent = city.AsciiName;
            link.href = "http://localhost/Web2Assignment2/single-city.php?cityCode=" + city.CityCode;
            option.appendChild(link);
            suggestions.appendChild(option);
        })
    }

    //Filter through the countries 
    const search = document.querySelector('.search');
    const sug = document.querySelector('#filterCity');
    const li = document.querySelector(".filteredCity");

    search.addEventListener('keyup', cityFilter);
    function cityFilter() {
        if (this.value.length >= 0) {
            sug.innerHTML = "";
            li.innerHTML = "";
            const match = findMatch(this.value, cities);
            match.forEach(m => {
                let list = document.createElement('li');
                let link = document.createElement('a');
                link.textContent = m.AsciiName;
                link.href = "http://localhost/Web2Assignment2/single-city.php?cityCode=" + m.CityCode;
                list.appendChild(link);
                li.appendChild(list);
            });
        }
    }

    function findMatch(m, c) {
        return c.filter(obj => {
            const cRegex = new RegExp(m, 'gi');
            return obj.AsciiName.match(cRegex);
        });
    }

    //Resets the city page
    const resetDataId = document.querySelector('#resetCity');
    const resetBut = document.querySelector('.reset'):

})