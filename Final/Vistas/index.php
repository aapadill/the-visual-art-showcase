<?php
require_once('../config/cargador.php');
use Controladores\Router;
use Modelos\WeeklyShowcase;
use Modelos\Artist;
use Modelos\Artwork;
use Modelos\ShowcaseArtwork;
use Modelos\Category;

include Router::direccion('/plantillas/header.php');

$busqueda = htmlentities($_GET['buscar'] ?? ''); //texto a buscar
$techniqueSelected = htmlentities($_GET['technique-select'] ?? 0); //technique chosen
$selectedWeek = htmlentities($_GET['week-select'] ?? ''); //week chosen
$categorias = Category::consultar(); //traer todas las categorias

//$busquedaSemana = WeeklyShowcase::buscar($busqueda); regresa coincidencia

$filteredDayIDs = []; //days to display, affected by filter [alpha]

//loop starts
$day = WeeklyShowcase::convertToDate("3 March 2023"); //"now" //starting day
$dayID = WeeklyShowcase::whichID($day); // which week is $day

//[alpha] filtering days depending on technique selection..
while ($dayID > 0) {
    $includeDay = false; //check if day should be included
    if ($techniqueSelected > 0) {
        $showcaseArtworks = ShowcaseArtwork::consultar($dayID);
        foreach ($showcaseArtworks as $week) {
            $artwork = Artwork::consultar($week['artwork_id']);
            if ($artwork->categoryID == $techniqueSelected) {
                $includeDay = true; //include this day as it has a matching artwork
                break; //no need to check further artworks for this day
            }
        }
    } else {
        $includeDay = true; //if no technique is selected, include all days
    }
    if ($includeDay) {
        array_push($filteredDayIDs, $dayID);
    }
    $dayID--; //previous week
}
?>

<!-- preview page, hidden: hold click to enable -->
<div id="preview-page" class="hidden">
    <img id="preview-image" class="show-preview" src="" alt="Preview Image">
</div>

 <!-- magnifier, hidden: hold z to enable -->
<div id="magnifier" class="zoomable-image">
</div>

<!-- toolbar -->
<!-- hacerlo div -->
<header class="art-header">
    <!-- left menu -->
    <nav class="corner center-left">
        <!-- week | technique -->
        <ul class="menu" id="week-technique">
            <li>
                <label>WEEK</label>
                <select name="week-select" id="week-select" onchange="this.form.submit()">
                <?php 
                foreach ($filteredDayIDs as $weekID) { 
                    $selectedWeek = (isset($_GET['week-select']) && $_GET['week-select'] == $weekID) ? 'selected' : '';
                    echo "<option value='$weekID' $selectedWeek>$weekID</option>";
                } 
                ?>
                </select>
            </li>
            <li>
            <form method="GET" action="">
                <select name="technique-select" id="technique-select" onchange="this.form.submit()">
                    <option value="0"> all </option>
                    <?php 
                    foreach ($categorias as $c) {
                        $selected = (isset($_GET['technique-select']) && $_GET['technique-select'] == $c['category_id']) ? 'selected' : '';
                        echo '<option value="' . $c['category_id'] . '" ' . $selected . '>' . $c['category_name'] . '</option>';
                    }
                    ?>
                </select>
                <label>TECHNIQUE</label>
            </form>
            </li>
        </ul>
    </nav>

    <!-- right menu -->
    <nav class="corner center-right">
        <ul class="menu" id="search-free-guided">
            <!-- search -->
            <li>
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

<div class="week" id="week-<?php echo $dayID; ?>">
    <?php
    // var_dump($techniqueSelected);
    foreach ($filteredDayIDs as $dayID) {
        $weeklyShowcase = WeeklyShowcase::consultar($dayID); // WeeklyShowcase of a specific week
    ?>
    <div class="info">
        <h1 class="week-intro">Featuring on week <b> <?php echo $dayID;?> </b> </h1>
    </div>
    <?php
        $showcaseArtworks = ShowcaseArtwork::consultar($dayID); // ShowcaseArtworks of a specific week
        $weekArtistID = $weeklyShowcase->featuredArtistID; // Week's artistID
        $weekArtist = Artist::consultar($weekArtistID); // Week's artist info
    ?>
    <!-- antes, class="contenedor-artista" id="seppe-borde" -->
    <div class="artist" id="">
        <div class="info">
            <h2 class="artist-name"><b> <?php echo $weekArtist->artistName;?> </b></h2>
            <!-- antes, class="descripcion-artista" -->
            <div class="info">
                <p> <?php echo $weekArtist->bio;?> </p>
            </div>
        </div>
    <?php
        foreach ($showcaseArtworks as $week) {
            $artwork = Artwork::consultar($week['artwork_id']);
            // var_dump($artwork->categoryID);
    ?>
        <!-- antes, class="arte" -->
        <div class="artwork" id=""> 
            <div class="info">
                <h3> <?php echo $artwork->title;?> </h3>
                <p> <?php echo $artwork->technicalSheet;?> </p>
            </div>
            <img src="<?php Router::rutaImagenWeb($artwork->imageURL);?>" class="img-fluid previewable-image zoomable-image" alt="<?php Router::rutaImagenWeb($artwork->imageURL);?>"> 
        </div>
        <br>
        <br>
        <br>
    <?php
        }
    }
    ?>
    </div>
</div>

<?php
include Router::direccion('/plantillas/footer.php');