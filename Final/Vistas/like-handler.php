<?php
ob_start(); //buffering trick
require_once('../config/cargador.php');
use Controladores\Router;
use Modelos\Like;
use Modelos\Usuario;

include Router::direccion('/plantillas/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['imageId']) && isset($usuarioIdSesion)) {
    $userId = $usuarioIdSesion; //usuario
    $imageId = $_POST['imageId']; // Get the image ID from POST data

    if (Like::likeExists($userId, $imageId)) {
        //if the like exists, remove it
        Like::removeLike($userId, $imageId);
        $response = ['liked' => false, 'message' => 'Like removed'];
    } else {
        //if the like doesn't exist, insert it
        Like::insertLike($userId, $imageId);
        $response = ['liked' => true, 'message' => 'Like added'];
    }
    // Send JSON response back to the front end
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Handle invalid requests
    header("HTTP/1.1 400 Bad Request");
    echo "Invalid request or missing parameters.";
}
ob_end_flush();
?>
