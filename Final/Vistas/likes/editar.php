<?php
// ob_start(); //buffering trick
require_once('../../config/cargador.php');
use Controladores\Router;
use Modelos\Artist;
use Modelos\Artwork;
use Modelos\Like;
include Router::direccion('/plantillas/header.php');

if(!empty($usuarioIdSesion)){
    $likes = Like::consultar($usuarioIdSesion);
}
?>

<div class="container mt-4 rounded">
    <h2>Favorited</h2>
    <table class="table card">
        <tbody>
            <?php
                foreach ($likes as $like) {
                    $artwork = Artwork::consultar($like);
                    $artist = Artist::consultar($artwork->artistID);
                    echo "<tr class='text-center align-middle'>";

                        ?><td> <i class="bi bi-heart-fill likeIcon" data-artwork-id="<?php echo $artwork->artworkID;?>"></i> </td><?php

                        ?><td> <img src="<?php Router::rutaImagenWeb($artwork->imageURL);?>" class="img-thumbnail previewable-image zoomable-image" data-artwork-id="<?php echo $week['artwork_id'];?>" alt="<?php Router::rutaImagenWeb($artwork->imageURL);?>"></td><?php

                        ?><td> <a href="../index.php#artwork-<?php echo $artwork->artworkID;?>" class="card-link"> <?php echo $artwork->title;?> </a> </td><?php

                        ?><td> <?php echo $artist->artistName;?> </td><?php
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>
