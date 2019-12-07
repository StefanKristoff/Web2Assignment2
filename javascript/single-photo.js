document.addEventListener("DOMContentLoaded", function(){
    console.log("hello World");
    function hideAllTabs() {
        let tabDescription = document.querySelector("#tabBoxDescription");
        let tabDetails = document.querySelector("#tabBoxDetails");
        let tabMap = document.querySelector("#tabBoxMap");
        tabDescription.style.display = "none";
        tabDetails.style.display = "none";
        tabMap.style.display = "none";
    }
})