<?php
// ob_start(); //buffering trick
require_once('../config/cargador.php');
use Controladores\Router;
use Controladores\Sesion;
use Modelos\Like;

$sesion = new Sesion(); 
$usuarioSesion = $sesion->obtener('usuario') ?? [];
$usuarioIdSesion = $usuarioSesion->userID ?? 0; //we can't bring this from the header, json hates it

if (Router::esPost() && isset($_POST['imageId']) && isset($usuarioIdSesion)) {
    $userId = $usuarioIdSesion; //user //redundant
    $imageId = $_POST['imageId']; //get the image ID from POST data

    if (Like::likeExists($userId, $imageId)) {
        //if the like exists, remove it
        Like::removeLike($userId, $imageId);
        $response = ['liked' => false, 'message' => 'like removed'];
    } else {
        //if the like doesn't exist, insert it
        Like::insertLike($userId, $imageId);
        $response = ['liked' => true, 'message' => 'like added'];
    }
    //send JSON response back to the front end
    Router::contentType('application/json');
    echo json_encode($response);
} else {
    //handle invalid requests
    header("HTTP/1.1 400 Bad Request");
    echo "invalid request or missing parameters unu";
}
// ob_end_flush();
?>
