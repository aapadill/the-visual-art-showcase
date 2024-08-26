<?php
require_once('../../config/cargador.php');
use Controladores\Router;
use Modelos\Usuario;
use Modelos\Artist;

include('../plantillas/header.php');

if(empty($usuarioIdSesion) || $rolSesion != '2'){
    Router::redireccionar('login.php');
}

$artistOBJ = Artist::consultar($usuarioIdSesion);
?>

<h3 class="card-title">Artist Information</h3>
<form action="save-artist.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="artist_id" value="<?php echo $artistOBJ->artistID?>">
    <input type="hidden" name="user_id" value="<?php echo $artistOBJ->userID?>">
    <input type="hidden" name="role_id" value="<?php echo $artistOBJ->roleID?>">

    <div class="mb-3">
        <label for="artist_name" class="form-label">Artist Name</label>
        <input type="text" class="form-control" id="artist_name" value="<?php echo $artistOBJ->artistName?>" name="artist_name">
    </div>

    <div class="mb-3">
        <label for="bio" class="form-label">Bio</label>
        <textarea class="form-control" id="bio" name="bio"><?php echo $artistOBJ->bio?></textarea>
    </div>

    <div class="mb-3">
        <label for="website" class="form-label">Website</label>
        <input type="url" class="form-control" id="website" value="<?php echo $artistOBJ->website?>" name="website">
    </div>

    <div class="mb-3">
        <label for="social_media" class="form-label">Social Media</label>
        <input type="text" class="form-control" id="social_media" value="<?php echo $artistOBJ->socialMedia?>" name="social_media">
    </div>

    <?php
    if (isset($_GET['error'])) {
    ?>
    <div class="form-group">
        <div class="col-md-8 offset-md-2 text-danger text-center">
            <p class="error-message">
            <?php echo htmlspecialchars(urldecode($_GET['error']));?>
            </p>
        </div>
    </div>
    <br>
    <?php
    }
    ?>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
include('../plantillas/footer.php');
?>