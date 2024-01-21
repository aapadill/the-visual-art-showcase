<?php
require_once('../config/cargador.php');
use Modelos\Producto;
use Controladores\Router; 

include Router::direccion('/plantillas/header.php');

$busqueda = htmlentities($_GET['buscar'] ?? ''); //texto a buscar
// $productos = Producto::buscar($busqueda); //3.b.i) regresa coincidencia

// $productosSesion = $sesion->obtener('productos') ?? []; //cualquier producto en sesion

//aqui andaba el Router::direccion
?>

<!-- preview page, hidden: hold click to enable -->
<div id="preview-page" class="hidden">
    <img id="preview-image" class="show-preview" src="" alt="Preview Image">
</div>

 <!-- magnifier, hidden: hold z to enable -->
<div id="magnifier" class="zoomable-image">
</div>

<!-- class="row row-cols-md-3" id="productos" -->
<!-- toolbar -->
<!-- hacerlo div -->
<header class="art-header">
    <!-- left menu -->
    <nav class="corner center-left">
        <!-- week | technique -->
        <ul class="menu" id="week-technique">
            <li>
                <label>WEEK</label>
                <select name="week-select" id="week-select">
                    <option value="all"> all </option>
                    <option value="1"> 1 </option>
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                </select>
            </li>
            <li>
                <select name="technique-select" id="technique-select">
                    <option value="all"> all </option>
                    <option value="painting"> PAINTING </option>
                    <option value="drawing"> DRAWING </option>
                    <option value="sculpture"> SCULPTURE </option>
                </select>
                <label>TECHNIQUE</label>
            </li>
        </ul>
    </nav>

    <!-- right menu -->
    <nav class="corner center-right">
        <ul class="menu" id="search-free-guided">
            <!-- search -->
            <li id="search">
                <!-- <div> -->
                    <div class="search-icon">&#128269;</div>
                    <input type="text" class="search-input" placeholder="Search...">
                    <button class="search-submit">Go</button>
                <!-- </div> -->
            </li>

            <!-- free | guided -->
            <li id="free-guided">
                <!-- <legend>Select a mode:</legend> -->
                <div>
                    <input type="radio" id="free" name="free" value="free" />
                    <label for="free">F</label>
                </div>
                
                <div>
                    <input type="radio" id="guided" name="guided" value="guided" />
                    <label for="guided">G</label>
                </div>
            </li>
        </ul>
    </nav>
</header>

<div class="week">
    <div class="info">
        <h1 class="week-intro">Featuring now on week <b>week</b></h1>
    </div>
    
    <!-- antes, class="contenedor-artista" id="seppe-borde" -->
    <div class="artist" id="">
        <div class="info">
            <h2 class="artist-name"><b>Seppe De Meyere</b></h2>
            <!-- antes, class="descripcion-artista" -->
            <div class="info">
                <p>A selection of paintings by Belgium-based artist Seppe De Meyere, which he describes as “provoked by atmospheres of unease, gloom and stasis” and “a slow digestion of the human form over time”. The works feel foreign and familiar at the same time and this tension draws the viewer in.
                <br>
                <br>
                De Meyere is part of 404 Collective and the art community they’ve started called Cane Yo. See more of his work below.
                </p>
            </div>
        </div>
        <!-- up to seven -->
        <!-- antes, class="arte" -->
        <div class="artwork" id=""> 
            <div class="info"></div>
            <img src="<?php Router::rutaImagenWeb('seppe-de-meyere-2.jpeg');?>" class="image previewable-image zoomable-image" alt="<?php Router::rutaImagenWeb('seppe-de-meyere-2.jpeg');?>"> 
        </div>
    </div>
</div>

<?php
include Router::direccion('/plantillas/footer.php');