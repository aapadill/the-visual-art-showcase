<?php
require_once('../config/cargador.php');
use Controladores\Router;
use Modelos\Artist;
use Modelos\Usuario;

include('./plantillas/header.php');

$artistID = $_GET['artistID'] ?? null;
if ($artistID) {
    $artist = Artist::consultar($artistID); // Fetch artist data based on the artistID
    $user = Usuario::consultar($artist->userID);
    $profilePic = $user->profilePicture;
    $websiteURL = $artist->website;
    if ($artist && $user) {
?>
    <h1 class="mt-3"> <?php echo $artist->artistName ?> </h1>
    <div class="card w-50" style="width: 18rem;">
        <img class="card-img-top" src="<?php Router::rutaImagenWeb($profilePic);?>" alt="Artist profile picture">
        <div class="card-body">
            <h5 class="card-title"><?php echo $artist->artistName ?></h5>
            <p class="card-text stretched-link"><?php echo $artist->bio ?></p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="<?php echo $artist->socialMedia; ?>" target="_blank" rel="noopener">  <i class="bi bi-instagram" style="color: black"></i> </a></li>
        </ul>
        <div class="card-body">
        <a href="<?php echo $artist->website; ?>" target="_blank" rel="noopener">Artist's website</a></li>
        </div>
    </div>
    <br>
    <a href="<?php Router::direccionWeb("index.php")?>" class="btn btn-primary">Return home</a>
<?php
    }
}

include ('./plantillas/footer.php');
?>
