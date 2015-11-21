<?php

class RespuestasModel extends Model {

    private $idRespuestas;
    private $idPreguntas;
    private $idUsuario;
    private $respuesta;
    private $campos;

    public function __construct() {
        $this->campos = "ID_PREGUNTA,ID_USUARIO,RESPUESTA";
    }

    public function setIdRespuestas($idRespuestas) {
        $this->idRespuestas = $idRespuestas;
    }

    public function setIdPreguntas($idPreguntas) {
        $this->idPreguntas = $idPreguntas;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setRespuesta($respuesta) {
        $this->respuesta = $respuesta;
    }

    public function insertPreguntas() {
        return $this->getDb()->insertQuery("RESPUESTA", $this->campos, "'$this->idPreguntas','$this->idUsuario','$this->respuesta'");
    }

    public function consultarRespuestas($condicion) {
        return count($this->getDb()->selectQuery("RESPUESTA R", "*", $condicion)->fetchAll(PDO::FETCH_ASSOC));
    }

}

?>