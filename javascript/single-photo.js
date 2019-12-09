var map;

function initMap() {
    map = new google.maps.Map(document.getElementById('gMap'), {
        center: {
            lat: 41.8474,
            lng: 12.4839
        }, 
        mapTypeId: 'satellite',
        zoom: 11
    });
}
document.addEventListener("DOMContentLoaded", function(){
    console.log("hello World");

    let imgId = document.getElementsByTagName('img')[0].getAttribute('id');
    console.log(imgId);
    let url = 'localhost/web2Assignment2/api-imageDetails.php?ImageID=' + imgId;

    // Retrieve Local Storage
    let image = retrieveImageStorage();

    //Fetch
    fetchImage();

    //call funcitons
    hideAllTabs();
    boxTabEventListener();
    updateCityMapLocation(0,0);

    // STORAGE FUNCTIONS FOR THE IMAGES
    function updateImageStorage(){
        localStorage.setItem("image");
    }
    function retrieveImageStorage(){
        return JSON.parse(localStorage.getItem("image")) || [];
    }


    function fetchImage() {
        console.log(url);
        fetch(url)
        .then(response => response.json())
        .then(data => {
            console.table(data);
            updateImageStorage();
        })
        .catch(error => console.error(error));
        
    }

    function hideAllTabs() {       
        let tabBoxDescription = document.querySelector("#tabBoxDescription");
        let tabBoxDetails = document.querySelector("#tabBoxDetails");
        let tabBoxMap = document.querySelector("#tabBoxMap"); 
        
        tabBoxDescription.style.display = "none";
        tabBoxDetails.style.display = "none";
        tabBoxMap.style.display = "none";
    }

    function boxTabEventListener(){
        document.querySelector('#tabDescription').addEventListener('click', function(){
            if(tabBoxDescription.style.display == 'none'){
                tabBoxDescription.style.display = "block";
                tabBoxDetails.style.display = "none";
                tabBoxMap.style.display = "none";                
            }
            else{
                tabBoxDescription.style.display = "none";
            }
        })

        document.querySelector('#tabDetails').addEventListener('click', function(){
            if(tabBoxDetails.style.display == 'none'){
                tabBoxDetails.style.display = "block";
                tabBoxDescription.style.display = "none";
                tabBoxMap.style.display = "none";
            }
            else{
                tabBoxDetails.style.display = "none";
            }
        })
        document.querySelector('#tabMap').addEventListener('click', function(){
            if(tabBoxMap.style.display == 'none'){
                tabBoxMap.style.display = "block";
                tabBoxDescription.style.display = "none";
                tabBoxDetails.style.display = "none";
                
            }
            else{
                tabBoxMap.style.display = "none";
            }
        })
    }


       // Updates the map location to the city lat and long
       function updateCityMapLocation(lat, long) {
        if (document.querySelector("#mapSection img")) {
            document.querySelector('#mapSection img').remove();
        }

        let key = 'AIzaSyCzfsApaIX__OKGpFiPr59K6OuSfoVxKJI';
        let map = document.createElement("img");
        // let height = document.querySelector("div.c").clientHeight;
        // let width = document.querySelector("div.c").clientWidth;

        map.src = `https://maps.googleapis.com/maps/api/staticmap?center=${lat},${long}&zoom=11&size=640x640&markers=${lat},${long}&key=${key}`;
        document.querySelector("#mapSection").appendChild(map);
    }


})