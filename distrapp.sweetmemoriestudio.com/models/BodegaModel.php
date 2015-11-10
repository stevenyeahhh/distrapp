<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BodegaModel
 *
 * @author jcaperap
 */
class BodegaModel extends Model {

    //put your code here
    private $idBodega;
    private $direccion;
    private $telefono;
    private $idPersonaEncargada;
    private $estado;
    
    public function __construct() {
        parent::__construct();
        $this->campos="DIRECCION,TELEFONO,ID_PERSONA_ENCARGADA";
    }


    public function setIdBodega($idBodega) {
        $this->idBodega = $idBodega;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setIdPersonaEncargada($idPersonaEncargada) {
        $this->idPersonaEncargada = $idPersonaEncargada;
    }
    public function insertBodega() {
        return $this->getDb()->insertQuery("BODEGA", $this->campos, "'$this->direccion','$this->telefono','$this->idPersonaEncargada'");
    }
    public function selectBodegas() {
        return $this->getDb()->query("SELECT B.ID_BODEGA \"ID BODEGA\",B.DIRECCION,B.TELEFONO,U.NOMBRE \"USUARIO ENCARGADO\",B.ESTADO FROM BODEGA B LEFT JOIN USUARIO U ON (U.IDENTIFICADOR=B.ID_PERSONA_ENCARGADA)");
    }


}
