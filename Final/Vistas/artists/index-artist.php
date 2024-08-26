<?php
ob_start(); //buffering trick
require_once('../../config/cargador.php');
use Controladores\Router;
use Modelos\Usuario;
use Modelos\Artist;

include('../plantillas/header.php');

if(empty($usuarioSesion)){
    Router::direccionWeb('login.php');
}

$resultados = Usuario::consultar($usuarioIdSesion);

if($rolSesion == '2'){
    $infoArtista = Artist::consultar($usuarioIdSesion);
}

$registro = $_POST;
if (Router::esPost() && !$registro['is_subscribed']) {
    $checkboxUnchecked = !($registro['is_subscribed']);
    var_dump($checkboxUnchecked);
    if ($checkboxUnchecked && $usuarioSesion->isSubscribed) {
        $usuarioOBJ = Usuario::consultar($usuarioIdSesion);
        if ($usuarioOBJ && $usuarioOBJ->isSubscribed) {

            $usuarioOBJ->isSubscribed = 0; // Set subscribed to false in obj
            $usuarioOBJ->actualizarSuscripcion(); // Update subscription status in DB
            $usuarioSesion->isSubscribed = 0; // Update current session
            // Consider redirecting to a confirmation page or displaying a message
            echo "Unsubscription successful.";
            Router::redireccionar('index.php');
        }
    }
}
//Listado Usuarios
// echo "<pre>";
// var_dump($resultados);
?>

<div class="container mt-5">
    <h2>Hi <?php echo $infoArtista->artistName; ?></h2>
    
    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="adminProfileTabs" role="tablist">
        <?php if($resultados->roleID == '2'){?>
        <li class="nav-item">
            <a class="nav-link active" id="artist-tab" data-bs-toggle="tab" href="#artist" role="tab" aria-controls="artist" aria-selected="false">Artist profile</a>
        </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">User Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="subscription-tab" data-bs-toggle="tab" href="#subscription" role="tab" aria-controls="subscription" aria-selected="false">Subscription</a>
        </li>
    </ul>

    <!-- all tabs -->
    <div class="tab-content" id="adminProfileTabsContent">
        <!-- user tab -->
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">User Information</h3>
                    <p><strong>Profile picture: </strong> <?php echo $resultados->profilePicture; ?></p>
                    <p><strong>Name: </strong><?php echo $resultados->name; ?></p>
                    <p><strong>Email: </strong> <?php echo $resultados->email; ?></p>
                    <p><strong>Password: </strong> (hidden) </p>
                    <p><strong>Bio: </strong> <?php echo $resultados->bio; ?></p>
                    <p><strong>Country: </strong> <?php echo $resultados->location; ?></p>
                    <!-- more profile information -->

                    <!-- edit Button -->
                    <a href="<?php Router::direccionWeb("users/edit.php")?>" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>

        <?php if($resultados->roleID == '2'){?>
        <!-- artist tab -->
        <div class="tab-pane fade show active" id="artist" role="tabpanel" aria-labelledby="artist-tab">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Artist Information</h3>
                    <p><strong>Artist name: </strong><?php echo $infoArtista->artistName; ?></p>
                    <p><strong>Artist bio: </strong> <?php echo $infoArtista->bio; ?></p>
                    <p><strong>Website: </strong> <?php echo $infoArtista->website; ?></p>
                    <p><strong>Social media: </strong> <?php echo $infoArtista->socialMedia; ?></p>

                    <!-- edit button -->
                    <a href="<?php Router::direccionWeb("artists/edit-artist.php")?>" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
        <?php } ?>

        <!-- subscribe Tab -->
        <div class="tab-pane fade" id="subscription" role="tabpanel" aria-labelledby="subscription-tab">
        <?php if($subscribed == '1'){?>
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Subscription</h3>
                    <p>It's so cool to have you on board! </p>
                    <!-- subscribe form -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-check">
                            <input type="hidden" name="is_subscribed" value="0">
                            <input class="form-check-input" type="checkbox" value="1" name="is_subscribed" checked>
                            <label class="form-check-label" for="defaultCheck1">Subscription</label>
                        </div>
                        <!-- unsub Button -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
        <?php if($subscribed == '0'){?>
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Subscription</h3>
                    <p>Please subscribe first here </p>
                    <!--sub button -->
                    <a href="<?php Router::direccionWeb("subscribe.php")?>" class="btn btn-primary">Subscribe</a>
                </div>
            </div>
        <?php } ?>
        </div>
        
    </div>
</div>

<?php
include('../plantillas/footer.php');
?>
