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

    // alfa: scroll changes size and position of headers
    //get the header element
    const header = document.querySelector('header');

    //initial scroll position
    let lastScroll = 0;

    //function to handle scroll events
    function handleScrollA() {
        const currentScroll = window.scrollY;

        // ignores the scroll if currentScroll is below 108px
        if (currentScroll < 108) {
            return; // Termina la función prematuramente
        }
        if (currentScroll > lastScroll) {
            //scrolling down, hide the header
            header.classList.add('hide-header');
        } else {
            //scrolling up, show the header
            header.classList.remove('hide-header');
        }
        lastScroll = currentScroll;
    }
    // alfa: scroll changes size and position of headers

    // beta: scroll changes size and position of headers
    // const mainHeader = document.querySelector('.main-header');
    // const artHeader = document.querySelector('.art-header');
    // let lastScrollTop = 0;
    // let headerHeight = 108;

    // // Firefox: This may not work well with asynchronous panning
    // window.addEventListener('scroll', () => {
    //     let currentScrollTop = window.scrollY || document.documentElement.scrollTop;
    //     if (currentScrollTop > lastScrollTop) {
    //         // Scroll hacia abajo
    //         headerHeight = Math.max(54, headerHeight - (currentScrollTop - lastScrollTop));
    //     } else {
    //         // Scroll hacia arriba
    //         headerHeight = Math.min(108, headerHeight + (lastScrollTop - currentScrollTop));
    //     }
    //     mainHeader.style.height = headerHeight + 'px';
    //     artHeader.style.top = headerHeight + 'px';
    //     lastScrollTop = currentScrollTop;
    // });
    // beta: scroll changes size and position of headers

    // Función throttle: Limita la frecuencia de ejecución de la función
    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    let lastScrollTop = 0;
    document.documentElement.style.setProperty('--main-header-height', '108px');
    document.documentElement.style.setProperty('--art-header-top', '54px');
    document.documentElement.style.setProperty('--logo-reduction-h', '90px');
    document.documentElement.style.setProperty('--logo-reduction-w', '90px');
    document.documentElement.style.setProperty('--reduced-size', '100%');
    document.documentElement.style.setProperty('--padding-size', '100%');

    const handleScroll = () => {
        let currentScrollTop = window.scrollY || document.documentElement.scrollTop;

        // ignores the scroll if currentScroll is below 108px
        if (currentScrollTop < 12) {
            return; // Termina la función prematuramente
        }

        let newHeight = Math.max(54, Math.min(108, parseInt(getComputedStyle(document.documentElement).getPropertyValue('--main-header-height')) + (lastScrollTop - currentScrollTop)));
        let reductionPercentage = (newHeight/108);
        console.log(reductionPercentage); //cuanto se ha reducido la barra respecto a si misma, va de 1 a 0.5
        document.documentElement.style.setProperty('--main-header-height', newHeight + 'px');
        document.documentElement.style.setProperty('--art-header-top', newHeight + 'px');
        document.documentElement.style.setProperty('--logo-reduction-h', reductionPercentage*90 + 'px');
        document.documentElement.style.setProperty('--logo-reduction-w', reductionPercentage*90 + 'px');
        document.documentElement.style.setProperty('--reduced-size', reductionPercentage*100 + '%');
        document.documentElement.style.setProperty('--padding-size', reductionPercentage*5 + 'px');

        lastScrollTop = currentScrollTop;
    };

    // throttle to limit exec frequency of handleScroll, which reduces main-header
    const throttledHandleScroll = throttle(handleScroll, 10); //10ms
    window.addEventListener('scroll', throttledHandleScroll);

    //listen for the scroll event to hide or show the header
    window.addEventListener('scroll', handleScrollA);

    // function toggleSearch() {
    //     var searchBar = document.getElementById('searchBar');
    //     searchBar.style.width = (searchBar.style.width === '0px' || searchBar.style.width === '') ? '150px' : '0';
    // }

    // function performSearch() {
    //     var searchTerm = document.getElementById('searchBar').value;
    //     // Add logic to handle the search term, e.g., make an API request or update the page content
    //     console.log('Searching for:', searchTerm);
    // }
});