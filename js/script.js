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
    //zoom

    //full
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

    // Get the header element
    const header = document.querySelector('header');

    // Get the logo element
    const logo = document.querySelector('.logo');

    // Initial scroll position
    let lastScroll = 0;

    // Function to handle scroll events
    function handleScroll() {
        const currentScroll = window.scrollY;

        if (currentScroll > lastScroll) {
            // Scrolling down, hide the header
            header.classList.add('hide-header');
            // Make the logo smaller
            logo.classList.add('small-logo');
        } else {
            // Scrolling up, show the header
            header.classList.remove('hide-header');
            // Make the logo normal size
            logo.classList.remove('small-logo');
        }

        lastScroll = currentScroll;
    }

    // Listen for the scroll event
    window.addEventListener('scroll', handleScroll);

});