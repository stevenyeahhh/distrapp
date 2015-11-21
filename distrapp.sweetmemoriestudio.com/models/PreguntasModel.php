<?php

class PreguntasModel extends Model {

    private $idPreguntas;
    private $descripcion;
    private $campos;

    public function __construct() {
        $this->campos = "descripcion";
    }

    public function setIdPreguntas($idPreguntas) {
        $this->idPreguntas;
        $this->campos = "descripcion";
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function insertPreguntas() {
        return $this->getDb()->insertQuery("PREGUNTA", $this->campos, "'$this->descripcion'");
    }

    public function selectPreguntas() {
        return $this->getDb()->selectQuery("PREGUNTA", "*", "")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectRespuestas($idUsuario) {
        return $this->getDb()->selectQuery("PREGUNTA P LEFT JOIN RESPUESTA R ON(P.ID_PREGUNTA=R.ID_PREGUNTA AND  R.ID_USUARIO='$idUsuario')", "P.*, R.RESPUESTA", "")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectRespuestasRamdom($idUsuario) {
        return $this->getDb()->selectQuery("PREGUNTA P JOIN RESPUESTA R ON(P.ID_PREGUNTA=R.ID_PREGUNTA ) ", "P.*, R.RESPUESTA", "ID_USUARIO='$idUsuario' ORDER BY RAND() LIMIT 0,3")->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>