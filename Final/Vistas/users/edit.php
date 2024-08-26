<?php
require_once('../../config/cargador.php');
use Controladores\Router;
use Modelos\Usuario;
use Modelos\Artist;

include('../plantillas/header.php');

if(empty($usuarioIdSesion)){
    Router::redireccionar('login.php');
}

$userOBJ = Usuario::consultar($usuarioIdSesion);
?>

    <h3 class="card-title">User Information</h3>
    <form action="save.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="role_id" value="<?php echo $userOBJ->roleID?>">
        <input type="hidden" name="is_subscribed" value="<?php echo $userOBJ->isSubscribed?>">
        <input type="hidden" name="user_id" value="<?php echo $userOBJ->userID?>">

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="name" class="form-control" id="name" aria-describedby="name" value="<?php echo $userOBJ->name?>" name="name">
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="username" class="form-control" id="username" aria-describedby="username" value="<?php echo $userOBJ->username?>" name="username">
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Profile pic</label>
            <input class="form-control" type="file" id="profile_picture" value="<?php echo $userOBJ->profilePicture?>" name="profile_picture">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?php echo $userOBJ->email?>" name="email">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <!-- type="password" -->
            <input class="form-control" id="password" value="<?php echo $userOBJ->password?>" name="password"> 
            <div id="passwordInfo" class="form-text">
            Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emojis.
            </div>
        </div>

        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <input class="form-control" id="bio" name="bio" value="<?php echo $userOBJ->bio?>">
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="location" class="form-control" id="location" aria-describedby="location" value="<?php echo $userOBJ->location?>" name="location">
        </div>

        <?php
        if (isset($_GET['error'])) {
        ?>
        <div class="form-group">
            <div class="col-md-8 offset-md-2 text-danger text-center">
                <p class="error-message">
                <?php echo htmlspecialchars(urldecode($_GET['error']));?>
                </b>
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