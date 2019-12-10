
document.addEventListener("DOMContentLoaded", function(){
    console.log("hello World");

    // let imgId = document.getElementsByTagName('img')[0].getAttribute('id');
    // console.log(imgId);
    
    hideAllTabs();
    boxTabEventListener();
    

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

})