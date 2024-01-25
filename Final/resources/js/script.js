document.addEventListener("DOMContentLoaded", () => {
    // const image = document.getElementById("image");
    // const img = document.querySelectorAll("img");
    const previewPage = document.getElementById("preview-page");
    const previewImage = document.getElementById("preview-image");

    let previewTimeout;
    let clickStartTime = 0;

    let currentElement;
    let isZoomActive = false;
    let isZoomable = false;
    
    //zoom
        document.addEventListener("mousemove", (mouse) => { //verificar si elemento es zoomable
            const themouseX = mouse.clientX;
            const themouseY = mouse.clientX;
            currentElement = mouse.target;

            if (currentElement.classList.contains("zoomable-image")){
                isZoomable = true;
            }
            else{
                isZoomable = false;
            }
            console.log(isZoomable);
        });

        document.addEventListener("keydown", (tecla) => {
            const container = currentElement.parentNode;
            const magnifier = document.getElementById("magnifier");

            if (tecla.key === "z" && isZoomable == true) {
                //console.log("z");
                isZoomActive = true;
                magnifier.style.display = "block";
                const magnifierSize = 100;

                container.addEventListener("mousemove", (zoomReference) => {
                    const mainImage = currentElement;

                    const mouseX = zoomReference.clientX - container.getBoundingClientRect().left;
                    const mouseY = zoomReference.clientY - container.getBoundingClientRect().top;
        
                    //calculo incorrecto
                    //const imageX = (mouseX / container.clientWidth) * mainImage.width;
                    //const imageY = (mouseY / container.clientHeight) * mainImage.height;
        
                    //magnifier.style.transform = "translate(-50%, -50%)"; //se deja fijo por ahora, este no funciona como lo esperado
                    
                    const offsetX = mouseX - magnifierSize / 2;
                    const offsetY = mouseY - magnifierSize / 2;

                    // magnifier.style.left = ""+mouseX+"px";
                    // magnifier.style.top = ""+mouseY+"px";
        
                    magnifier.style.backgroundImage = "url("+mainImage.src+")";
                    magnifier.style.backgroundSize = ""+mainImage.width*2+"px "+mainImage.height*2+"px "; //arreglar, aun no esta perfecto
                    magnifier.style.backgroundPosition = "-"+offsetX*2+"px -"+offsetY*2+"px";
                });
            }
            // if (tecla.key === "Escape") { //&& previewPage open //hardcoreado
            //     console.log("cerraste previewPage"); 
            //     clearTimeout(previewTimeout);
            //     clickStartTime = 0;
            //     previewPage.style.display = "none";
            // }
            else{
                magnifier.style.display = "none";
            }
        });

        document.addEventListener("keyup", (tecla) => {
            if (tecla.key === "z") {
                isZoomActive = false;
                magnifier.style.display = "none";
            }
        });
    

    //preview
    document.addEventListener("mousedown", (e) => { //e: clicked element
        if (e.target.classList.contains("previewable-image")) {
            const imgsrc = e.target.src;
            previewImage.src = imgsrc;

            clickStartTime = new Date().getTime();
            previewTimeout = setTimeout(() => {
                const clickEndTime = new Date().getTime();
                const clickDuration = clickEndTime - clickStartTime;
                if (clickDuration >= 500) { // 500 milliseconds = 0.5 seconds
                    previewPage.style.display = "flex";

                    console.log("duracion de click: " +clickDuration +"ms, mostrando previewPage");
                }
            }, 500);
        }
    });

    document.addEventListener("mouseup", () => {
        console.log("soltaste mouse");
        clearTimeout(previewTimeout);
        clickStartTime = 0;
        //previewPage.style.display = "none";
    });

    previewPage.addEventListener("click", (e) => {
        if (e.target.id != "preview-image"){ //click en background
            console.log("cerraste previewPage"); 
            clearTimeout(previewTimeout);
            clickStartTime = 0;
            previewPage.style.display = "none";
        }
        else{
            //abrir img en nueva pestana?
        }
    });
    //full
    
    //search bar
    const searchIcon = document.querySelector('.search-icon');
    const searchInput = document.querySelector('.search-input');
    const searchSubmit = document.querySelector('.search-submit');

    searchIcon.addEventListener('click', () => {
        searchInput.classList.toggle('active');
        if (searchInput.classList.contains('active')) {
            searchInput.focus();
            // searchInput.style.display = 'block';
            // searchSubmit.style.display = 'block';
        }
    });

    window.addEventListener('scroll', handleScroll);
});

document.addEventListener('DOMContentLoaded', function() {
    console.log("cargo");
    var likeButtons = document.querySelectorAll('.likeButton');
    likeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var artworkId = this.getAttribute('data-artwork-id');
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'like-handler.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                
                // This block of code is executed when the request is successful
                if (xhr.status >= 200 && xhr.status < 400) {
                    // Handle the response here
                    console.log('Response from server:', this.responseText);
                    // Example: Update the like button appearance based on the response
                    var response = JSON.parse(this.responseText);
                    if (response.liked) {
                        document.getElementById('likeButton').classList.add('liked');
                    } else {
                        document.getElementById('likeButton').classList.remove('liked');
                    }
                } else {
                    // We reached our target server, but it returned an error
                    console.error('Server reached, but it returned an error');
                }
            };
            xhr.onerror = function() {
                //connection error of some sort
                console.error('Connection error');
            };
            xhr.send('imageId=' + artworkId); // Send POST data with the artwork ID
        });
    });
});        