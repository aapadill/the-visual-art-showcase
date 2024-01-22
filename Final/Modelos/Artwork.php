<?php
namespace Modelos; // belongs to Modelos
// require_once('../config/cargador.php'); // Uncomment for use in views
use Modelos\Conexion;

class Artwork {

    public $artworkID;
    public $artistID;
    public $title;
    public $technicalSheet;
    public $imageURL;
    public $uploadDate;
    public $categoryID;

    public function __construct($artworkData = []) {
        $this->artworkID = $artworkData['artwork_id'] ?? null;
        $this->artistID = $artworkData['artist_id'] ?? null;
        $this->title = $artworkData['title'] ?? '';
        $this->technicalSheet = $artworkData['technical_sheet'] ?? '';
        $this->imageURL = $artworkData['image_url'] ?? '';
        $this->uploadDate = $artworkData['upload_date'] ?? null;
        $this->categoryID = $artworkData['category_id'] ?? null;
    }

    public static function consultar($artworkID) {
        $sql = "
            SELECT *
            FROM
                Artworks
            WHERE
            artwork_id = :artwork_id
        ";
        $parametros = [
            'artwork_id' => $artworkID
        ];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        $artworkData = $resultados->fetch();
        return new Artwork($artworkData);
    }
}
