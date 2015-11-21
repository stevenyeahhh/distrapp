<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoMedicamentoModel
 *
 * @author jcaperap
 */
class TipoMedicamentoModel extends Model{
    private $idTipoMedicamentoModel;
    private $codigoBarras;
    private $descripcion;
    private $costo;
    function setCosto($costo) {
        $this->costo = $costo;
    }

        private $estado;
    public function __construct() {
        $this->campos = "CODIGO_BARRAS,DESCRIPCION,COSTO";
    }
    public function setIdTipoMedicamentoModel($idTipoMedicamentoModel) {
        $this->idTipoMedicamentoModel = $idTipoMedicamentoModel;
    }

    public function setCodigoBarras($codigoBarras) {
        $this->codigoBarras = $codigoBarras;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setEstado($estado) {
        $this->estado   = $estado;
    }
    
    public function insertTipoMedicamento() {
        return $this->getDb()->insertQuery("TIPO_MEDICAMENTO", $this->campos, 
                "'$this->codigoBarras','$this->descripcion'.'$this->costo'");
    }
    public function selectTipoMedicamentos() {
        return $this->getDb()->selectQuery("TIPO_MEDICAMENTO", "*", "")->fetchAll(PDO::FETCH_BOTH);        
    }
    public function selectTipoMedicamentosPDO() {
        return $this->getDb()->selectQuery("TIPO_MEDICAMENTO", "*", "");        
    }
    public function getTipoMedicamentoCountEstado() {
        return $this->getDb()->selectQuery("TIPO_MEDICAMENTO", "COUNT(*) CNT , descripcion", " 1 GROUP BY ESTADO")->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
