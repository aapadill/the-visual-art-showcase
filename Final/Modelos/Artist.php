<?php
namespace Modelos; // belongs to Modelos
// require_once('../config/cargador.php'); // Uncomment for use in views
use Modelos\Conexion;

class Artist {

    public $artistID;
    public $userID;
    public $artistName;
    public $bio;
    public $website;
    public $socialMedia;
    public $roleID;

    public function __construct($artistData = []) {
        $this->artistID = $artistData['artist_id'] ?? null;
        $this->userID = $artistData['user_id'] ?? null;
        $this->artistName = $artistData['artist_name'] ?? '';
        $this->bio = $artistData['bio'] ?? '';
        $this->website = $artistData['website'] ?? '';
        $this->socialMedia = $artistData['social_media'] ?? '';
        $this->roleID = $artistData['role_id'] ?? null;
    }

    public static function consultar($artistID) {
        $sql = "
            SELECT *
            FROM
                Artists
            WHERE
            artist_id = :artist_id
        ";
        $parametros = [
            'artist_id' => $artistID
        ];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        $artistData = $resultados->fetch();
        return new Artist($artistData);
    }

    public function actualizar() {
        $sql = "
            UPDATE Artists
            SET
                user_id = :user_id,
                artist_name = :artist_name,
                bio = :bio,
                website = :website,
                social_media = :social_media,
                role_id = :role_id
            WHERE
                artist_id = :artist_id
            ";
        $parametros = [
            ':artist_id' => $this->artistID,
            ':user_id' => $this->userID,
            ':artist_name' => $this->artistName,
            ':bio' => $this->bio,
            ':website' => $this->website,
            ':social_media' => $this->socialMedia,
            ':role_id' => $this->roleID,
        ];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        return $resultados;
    }
}
