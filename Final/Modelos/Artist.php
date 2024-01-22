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
}
