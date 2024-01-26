<?php
require_once('../config/cargador.php');
use Controladores\Router;
use Modelos\WeeklyShowcase;
use Modelos\Artist;
use Modelos\Artwork;
use Modelos\ShowcaseArtwork;
use Modelos\Category;
use Modelos\Like;

include Router::direccion('/plantillas/header.php');

$busqueda = htmlentities($_GET['buscar'] ?? ''); //texto a buscar
$techniqueSelected = htmlentities($_GET['technique-select'] ?? 0); //technique chosen
// $selectedWeek = htmlentities($_GET['week-select'] ?? ''); //week chosen //simplificado a #
$categorias = Category::consultar(); //traer todas las categorias
//$busquedaSemana = WeeklyShowcase::buscar($busqueda); regresa coincidencia

if(!empty($usuarioIdSesion)){
  $likes = Like::consultar($usuarioIdSesion);
  // var_dump($likes);
}

$filteredDayIDs = []; //days to display, affected by filter [alpha]

//loop starts
$day = WeeklyShowcase::convertToDate("3 March 2023"); //"now" //starting day
$dayID = WeeklyShowcase::whichID($day); // which week is $day

//filtering days depending on technique selection..
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

<div class="container">
  <!-- toolbar -->
  <div class="art-header navbar fixed-bottom navbar-light bg-light">
    <header class="">
      <nav class="navbar navbar-expand">
        <div class="container-fluid">
          <!-- Left menu -->
          <div class="navbar-collapse collapse" id="navbarNavDropdown">
            <ul class="navbar-nav center">
              <li class="nav-item dropup">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Go to
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <?php 
                    foreach ($filteredDayIDs as $availDay) {
                ?>
                    <li><a class='dropdown-item' href='#week-<?php echo $availDay;?>'>Week <?php echo $availDay;?></a></li>
                <?php
                    }
                ?>
                </ul>
              </li>
              <li class="nav-item">
                <form method="GET" action="">
                  <select class="form-select" name="technique-select" id="technique-select" onchange="this.form.submit()">
                    <option value="0"> all </option>
                    <?php 
                      foreach ($categorias as $c) {
                    ?>

                    <?php
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
          <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> -->

          <!-- Right menu ms-auto -->
          <!-- <div class="navbar-nav"> -->
          <!-- <div class="navbar-nav"> -->
            <!-- wont be ready -->
            <!-- Radio buttons for free/guided --> 
            <!-- <div class="d-flex align-items-center">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="free" name="mode" value="free" />
                <label class="form-check-label" for="free">F</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="guided" name="mode" value="guided" />
                <label class="form-check-label" for="guided">G</label>
              </div>
            </div> -->

            <!-- Search form (hidden on extra small screens) d-none d-sm-flex-->
            <!-- <form class="input-group">
                <input type="text" class="form-control" placeholder="Search..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
          <!-- </div> -->
        </div>
      </nav>
    </header>
  </div>

  <div class="feed">
    <!-- <h1 class="mb-3 text-center">Home</h1> -->
  
    <?php
    // var_dump($techniqueSelected);
    foreach ($filteredDayIDs as $dayID) {
      $weeklyShowcase = WeeklyShowcase::consultar($dayID); // WeeklyShowcase of a specific week
    ?>
      <div class="week row text-center card mb-2" id="week-<?php echo $dayID;?>">
        <div class="week-intro card-header">Featuring on week <?php echo $dayID;?> </div>
        <!-- <p class="card-text"><small class="text-muted">Updated days ago</small></p> -->

        <?php
          $showcaseArtworks = ShowcaseArtwork::consultar($dayID); // ShowcaseArtworks of a specific week
          $weekArtistID = $weeklyShowcase->featuredArtistID; // Week's artistID
          $weekArtist = Artist::consultar($weekArtistID); // Week's artist info
        ?>

        <div class="info-artist card-body ">
            <h2 class="artist-name card-title"><b> <?php echo $weekArtist->artistName;?> </b></h2>
            <!-- antes, class="descripcion-artista" -->
            <div class="bio card-text">
              <p class="card-text"> <?php echo $weekArtist->bio;?> </p>
            </div>

            <!-- <div class="week-artist card" id=""> -->
              <?php
              foreach ($showcaseArtworks as $week) {
                    $artwork = Artwork::consultar($week['artwork_id']);
                    $categoryID = Category::consultar($artwork->categoryID);
              ?>
                <!-- antes, class="arte" -->
                <div class="week-artwork mb-4" id="artwork-<?php echo $week['artwork_id'];?>">
                  <!-- <div class="likeable-zone"> -->
                    <img src="<?php Router::rutaImagenWeb($artwork->imageURL);?>" class="card-img-top img-fluid previewable-image zoomable-image" data-artwork-id="<?php echo $week['artwork_id'];?>" alt="<?php Router::rutaImagenWeb($artwork->imageURL);?>">
                    <?php
                    if(!empty($usuarioIdSesion)){
                      if(!in_array($week['artwork_id'],$likes)){
                    ?>
                    <i class="bi bi-heart likeIcon" data-artwork-id="<?php echo $week['artwork_id'];?>"></i>
                    <?php
                      }
                      if(in_array($week['artwork_id'],$likes)){
                    ?>
                      <i class="bi bi-heart-fill likeIcon" data-artwork-id="<?php echo $week['artwork_id'];?>"></i>
                    <?php
                      }
                    } 
                    ?>
                    
                    <ul class="info-artwork list-group list-group-flush text-end">
                      <li class="list-group-item"><?php echo $artwork->title;?> </li>
                      <li class="list-group-item"><?php echo $artwork->technicalSheet;?> </li>
                      <li class="list-group-item"><?php echo $categoryID['category_name'];?> </li>
                    </ul>
                </div>
              <?php
              }
              ?>
            <!-- </div> -->
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</div>

<?php
include Router::direccion('/plantillas/footer.php');