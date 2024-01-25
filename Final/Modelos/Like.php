<?php
namespace Modelos;
use Modelos\Conexion;

class Like {

    public $userId;
    public $artworkId;
    public $likeDate;

    public function __construct($likeData = []) {
        $this->userId = $likeData['user_id'] ?? null;
        $this->artworkId = $likeData['artwork_id'] ?? null;
        $this->likeDate = $likeData['like_date'] ?? null;
    }

    public static function likeExists($userId, $artworkId) {
        $sql = "SELECT * FROM Likes WHERE user_id = :user_id AND artwork_id = :artwork_id";
        $parametros = [
            ':user_id' => $userId,
            ':artwork_id' => $artworkId,
        ];
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        return $resultados->rowCount() > 0;
    }

    public static function insertLike($userId, $artworkId) {
        $sql = "INSERT INTO Likes (user_id, artwork_id, like_date) VALUES (:user_id, :artwork_id, NOW())";
        $parametros = [
            ':user_id' => $userId,
            ':artwork_id' => $artworkId,
        ];
        $conexion = new Conexion();
        $conexion->correrQuery($sql, $parametros);
        return $conexion->lastInsertId();
    }

    public static function removeLike($userId, $artworkId) {
        $sql = "DELETE FROM Likes WHERE user_id = :user_id AND artwork_id = :artwork_id";
        $parametros = [
            ':user_id' => $userId,
            ':artwork_id' => $artworkId,
        ];
        $conexion = new Conexion();
        $conexion->correrQuery($sql, $parametros);
    }
}
?>
