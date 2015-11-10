<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmpresaModel
 *
 * @author jcaperap
 */
class EmpresaModel extends Model {

    private $nombre;
    private $telefono;
    private $direccion;
    private $idPersonaEncargada;
    private $campos;
    

    public function __construct() {
        parent::__construct();
        $this->campos="NOMBRE,TELEFONO,DIRECCION,ID_PERSONA_ENCARGADA";
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
        
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setIdPersonaEncargada($idPersonaEncargada) {
        $this->idPersonaEncargada = $idPersonaEncargada;
    }

    public function insertEmpresa() {
        return $this->getDb()->insertQuery("EMPRESA", $this->campos, "'$this->nombre','$this->telefono','$this->direccion','$this->idPersonaEncargada'");
    }
    public function selectEmpresas() {
//        return $this->getDb()->selectQuery("EMPRESA", "*", "");
        return $this->getDb()->query("SELECT E.ID_EMPRESA,E.NOMBRE,E.TELEFONO,E.DIRECCION,concat(U.NOMBRE,concat(' ',U.APELLIDO)) \"USUARIO ENCARGADO\" ,E.ESTADO FROM EMPRESA E LEFT JOIN USUARIO U ON(E.ID_PERSONA_ENCARGADA=U.IDENTIFICADOR)");
    }
    public function getEmpresaPorIdCliente($idCliente) {
        return $this->getDb()->query("SELECT E.ID_EMPRESA,E.NOMBRE,E.TELEFONO,E.DIRECCION,concat(U.NOMBRE,concat(' ',U.APELLIDO)) \"USUARIO ENCARGADO\" ,E.ESTADO FROM EMPRESA E LEFT JOIN USUARIO U ON(E.ID_PERSONA_ENCARGADA=U.IDENTIFICADOR) WHERE E.ID_PERSONA_ENCARGADA='$idCliente'");
    }

}
