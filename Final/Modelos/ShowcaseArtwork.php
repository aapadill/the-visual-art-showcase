<?php
namespace Modelos;
//require_once('../config/cargador.php'); // Uncomment for use in views
use Modelos\Conexion;

class ShowcaseArtwork {

    public $weeklyShowcaseID;
    public $artworkID;
    public $showcaseDay;

    public function __construct($showcaseArtworkData = []) {
        $this->weeklyShowcaseID = $showcaseArtworkData['weekly_showcase_id'] ?? null;
        $this->artworkID = $showcaseArtworkData['artwork_id'] ?? null;
        $this->showcaseDay = $showcaseArtworkData['showcase_day'] ?? null;
    }

    public static function consultar($weeklyShowcaseID, $artworkID = null) {
        $sql = "
            SELECT *
            FROM ShowcaseArtworks
            WHERE weekly_showcase_id = :weekly_showcase_id
        ";
        $parametros = [
            'weekly_showcase_id' => $weeklyShowcaseID
        ];

        if (!is_null($artworkID)) {
            $sql .= " AND artwork_id = :artwork_id";
            $parametros['artwork_id'] = $artworkID;
        }

        $sql .= " ORDER BY showcase_day DESC";

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        if (!is_null($artworkID)) {
            return $resultados->fetch();
        } else {
            return $resultados->fetchAll();
        }
    }
}
