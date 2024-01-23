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

    //scroll
    // let lastScrollTop = 0;
    // const header = document.querySelector('.main-header');
    // // throttle to limit exec frequency of handleScroll, which reduces main-header
    // // const throttledHandleScroll = throttle(handleScroll, 1000); //10ms

    // document.documentElement.style.setProperty('--main-header-height', '108px');
    // document.documentElement.style.setProperty('--art-header-top', '54px');
    // document.documentElement.style.setProperty('--logo-reduction-h', '90px');
    // document.documentElement.style.setProperty('--logo-reduction-w', '90px');
    // document.documentElement.style.setProperty('--reduced-size', '100%');
    // document.documentElement.style.setProperty('--padding-size', '5px');

    // // Función throttle: limita la frecuencia de ejecución de la función
    // function throttle(func, limit) {
    //     let inThrottle;
    //     return function() {
    //         const args = arguments;
    //         const context = this;
    //         if (!inThrottle) {
    //             func.apply(context, args);
    //             inThrottle = true;
    //             setTimeout(() => inThrottle = false, limit);
    //         }
    //     };
    // }

    // function handleScroll() {
    // let currentScrollTop = window.scrollY || document.documentElement.scrollTop;

    // // Handling header visibility
    // if (currentScrollTop > lastScrollTop && currentScrollTop > 108) {
    //     // Scrolling down, hide the header
    //     header.classList.add('hide-header');
    // } else if (currentScrollTop < lastScrollTop) {
    //     // Scrolling up, show the header
    //     header.classList.remove('hide-header');
    // }

    // // Handling header resizing
    // if (currentScrollTop >= 12) {
    //     let newHeight = Math.max(54, Math.min(108, parseInt(getComputedStyle(document.documentElement).getPropertyValue('--main-header-height')) + (lastScrollTop - currentScrollTop)));
    //     let reductionPercentage = newHeight / 108;
    //     console.log(reductionPercentage); // Log the reduction percentage
        
    //     document.documentElement.style.setProperty('--main-header-height', newHeight + 'px');
    //     document.documentElement.style.setProperty('--art-header-top', newHeight + 'px');
    //     document.documentElement.style.setProperty('--logo-reduction-h', reductionPercentage * 90 + 'px');
    //     document.documentElement.style.setProperty('--logo-reduction-w', reductionPercentage * 90 + 'px');
    //     document.documentElement.style.setProperty('--reduced-size', reductionPercentage * 100 + '%');
    //     document.documentElement.style.setProperty('--padding-size', reductionPercentage * 5 + 'px');
    // }

    // lastScrollTop = currentScrollTop;
    // }

    // Add the event listener for the scroll event
    window.addEventListener('scroll', handleScroll);
    // window.addEventListener('scroll', throttledHandleScroll);

    //listen for the scroll event to hide or show the header
    // window.addEventListener('scroll', transparentBackground);
    
    //colors
        // function invertColor(hex) {
        //     // Invert a hex color
        //     var color = hex.substring(1); // Remove the hash
        //     color = parseInt(color, 16); // Convert to integer
        //     color = 0xFFFFFF ^ color; // Invert the color
        //     color = color.toString(16); // Convert back to hex
        //     color = ("000000" + color).slice(-6); // Add leading zeros
        //     return "#" + color; // Return the inverted color
        // }
        
        // function getPredominantColor(img) {
        //     const canvas = document.createElement('canvas');
        //     const context = canvas.getContext('2d');
        //     canvas.width = img.width;
        //     canvas.height = img.height;
        //     context.drawImage(img, 0, 0, img.width, img.height);
        
        //     // Get the image data
        //     const data = context.getImageData(0, 0, canvas.width, canvas.height).data;
        
        //     // Analyze the image data...
        //     // This is a complex task. For simplicity, you might just average the colors.
        //     // More advanced color analysis would require additional logic.
        
        //     let r = 0, g = 0, b = 0, count = 0;
        //     for (let i = 0; i < data.length; i += 4) {
        //         r += data[i];
        //         g += data[i + 1];
        //         b += data[i + 2];
        //         count++;
        //     }
        
        //     // Calculate average color
        //     r = Math.floor(r / count);
        //     g = Math.floor(g / count);
        //     b = Math.floor(b / count);
        
        //     return `#${r.toString(16).padStart(2, '0')}${g.toString(16).padStart(2, '0')}${b.toString(16).padStart(2, '0')}`;
        // }
        
        // window.onload = function() {
        //     const img = document.getElementById('backgroundImage');
        //     const textColorElement = document.getElementById('textElement');
        
        //     img.onload = function() {
        //         const predominantColor = getPredominantColor(img);
        //         const invertedColor = invertColor(predominantColor);
        //         textColorElement.style.color = invertedColor;
        //     };
        // };
});