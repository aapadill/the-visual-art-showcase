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
<header class="art-header sticky-top">
  <nav class="navbar navbar-expand navbar-light bg-light">
    <div class="container-fluid">
      <!-- Left menu -->
      <div class="navbar-collapse collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              WEEK
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <?php foreach ($filteredDayIDs as $weekID) { 
                $selectedWeek = (isset($_GET['week-select']) && $_GET['week-select'] == $weekID) ? 'selected' : '';
                echo "<li><a class='dropdown-item' href='?week-select=$weekID'>$weekID</a></li>";
              } ?>
            </ul>
          </li>
          <li class="nav-item">
            <form method="GET" action="">
              <select class="form-select" name="technique-select" id="technique-select" onchange="this.form.submit()">
                <option value="0"> all </option>
                <?php 
                foreach ($categorias as $c) {
                  $selected = (isset($_GET['technique-select']) && $_GET['technique-select'] == $c['category_id']) ? 'selected' : '';
                  echo '<option value="' . $c['category_id'] . '" ' . $selected . '>' . $c['category_name'] . '</option>';
                }
                ?>
              </select>
            </form>
          </li>
        </ul>
      </div>

      <!-- Toggler for extra small screens -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Right menu -->
      <div class="navbar-nav ms-auto">
        <!-- Radio buttons for free/guided -->
        <div class="d-flex align-items-center">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="free" name="mode" value="free" />
            <label class="form-check-label" for="free">F</label>
          </div>

          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="guided" name="mode" value="guided" />
            <label class="form-check-label" for="guided">G</label>
          </div>
        </div>

        <!-- Search form (hidden on extra small screens) -->
        <form class="d-flex d-none d-sm-block">
          <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
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