<?php
ob_start(); //buffering trick
require_once('../../config/cargador.php');
use Controladores\Router;
use Modelos\Artist;
use Modelos\Artwork;
use Modelos\Like;
include Router::direccion('/plantillas/header.php');

if(!empty($usuarioIdSesion)){
    $likes = Like::consultar($usuarioIdSesion);
}
var_dump($likes);
?>

<div class="container mt-4">
    <h2>Your favorite art so far</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Favourite</th>
                <th scope="col">Artwork</th>
                <th scope="col">Details</th>
                <th scope="col">Artist</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($likes as $like) {
                    $artwork = Artwork::consultar($like);
                    $artist = Artist::consultar($artwork->artistID);
                    var_dump($artist);
                    echo "<tr>";
                    echo "<td>{}</td>";
                    echo "<td><img src='{$artwork->imageURL}' alt='{$artwork->title}' class='thumbnail'></td>";
                    echo "<td>{$artwork->title}</td>";
                    echo "<td>{$artist->artistName}</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>
