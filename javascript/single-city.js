document.addEventListener("DOMContentLoaded", function () {
    console.log("Hihihi");

    // The url for the city data
    const cityEndpoint = 'https://uplifted-scout-261201.appspot.com/api-cities.php';
    const imgAPI = 'https://uplifted-scout-261201.appspot.com/api-imageDetails.php';

    // Retrieve local Storage
    let cities = retrieveCityStorage();
    let img = retrieveImgStorage();

    // Fetch from Url and call function
    fetchCities();
    fetchImg();

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

    //fetches images
    function fetchImg() {
        if (img.length < 1) {
            fetch(imgAPI)
                .then(response => response.json())
                .then(data => {
                    for (let d of data) {
                        img.push(d);
                    }
                    updateImgStorage();
                })
                .catch(error => console.error(error))
        }
    }

    // update local storage
    function updateCityStorage() {
        localStorage.setItem("cities", JSON.stringify(cities));
    }
    function updateImgStorage() {
        localStorage.setItem("img", JSON.stringify(img));
    }


    function retrieveCityStorage() {
        return JSON.parse(localStorage.getItem("cities")) || [];
    }
    function retrieveImgStorage() {
        return JSON.parse(localStorage.getItem("img")) || [];
    }


    //Sorts and populates the list of cities
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
            link.href = "https://uplifted-scout-261201.appspot.com/single-city.php?cityCode=" + city.CityCode;
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
                link.href = "https://uplifted-scout-261201.appspot.com/single-city.php?cityCode=" + m.CityCode;
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
    const resetBut = document.querySelector('.resetButton');
    const resetCity = document.querySelector('.filteredCity');
    const resetDetails = document.querySelector('#countryDetails');
    const resetMap = document.querySelector('#map');
    const imgList = document.querySelector('#pictureList');
    resetBut.addEventListener('click', resetPage);
    function resetPage() {
        resetDataId.innerHTML = "";
        resetCity.innerHTML = "";
        resetMap.innerHTML = "";
        resetDetails.innerHTML = "";
        imgList.innerHTML = "";

        cities.forEach(c => {
            let rList = document.createElement('li');
            let rLink = document.createElement('a');
            rLink.textContent = c.AsciiName;
            rLink.href = "https://uplifted-scout-261201.appspot.com/single-city.php?cityCode=" + c.CityCode;
            rList.appendChild(rLink);
            resetCity.appendChild(rList);

        });
    }

    //Filters through the img array and prints the cities that have images
    const cityImg = document.querySelector('#cityPic');
    const imgbutton = document.querySelector('.cityImg');
    const list = document.querySelector('.filteredCity');
    imgbutton.addEventListener('click', imgFilterCity);
    function imgFilterCity() {
        list.innerHTML = "";
        cityImg.innerHTML = "";
        let imgCity = cities.filter(c => {
            for (let images of img) {
                if (images.CityCode == c.CityCode) {
                    return c;
                }
            }
        });

        imgCity.forEach(i => {
            let clist = document.createElement('li');
            let clink = document.createElement('a');
            clink.textContent = i.AsciiName;
            clink.href = "https://uplifted-scout-261201.appspot.com/single-city.php?cityCode=" + i.CityCode;
            clist.appendChild(clink);
            list.appendChild(clist);

        });
    }
});