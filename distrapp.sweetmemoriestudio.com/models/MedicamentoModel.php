<?php

class MedicamentoModel extends Model {

    private $idMedicamento;
    private $idTipoMedicamento;
    private $fechaFabricacion;
    private $fechaVencimiento;
    private $cantidad;
    private $bodega;
    private $estado;
    private $campos;

    public function __construct() {
        $this->estado = '1';
        $this->campos = "ID_TIPO_MEDICAMENTO,FECHA_FABRICACION,FECHA_VENCIMIENTO,CANTIDAD,BODEGA,ESTADO";
    }

    public function setIdMedicamento($idMedicamento) {
        $this->idMedicamento = $idMedicamento;
    }

    public function setIdTipoMedicamento($idTipoMedicamento) {
        $this->idTipoMedicamento = $idTipoMedicamento;
    }

    public function setFechaFabricacion($fechaFabricacion) {
        $this->fechaFabricacion = $fechaFabricacion;
    }

    public function setFechaVencimiento($fechaVencimiento) {
        $this->fechaVencimiento = $fechaVencimiento;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function setBodega($bodega) {
        $this->bodega = $bodega;
    }

    public function insertMedicamento() {
        return $this->getDb()->insertQuery("MEDICAMENTO", $this->campos, "'$this->idTipoMedicamento','$this->fechaFabricacion','$this->fechaVencimiento','$this->cantidad','$this->bodega','$this->estado'");
    }

    public function actualizarMedicamento() {
        
    }

    public function selectMedicamentos() {
        return $this->getDb()->selectQuery("MEDICAMENTO", "*", "")->fetchAll(PDO::FETCH_ASSOC);
        
    }
    public function selectMedicamentosPDO() {
        return $this->getDb()->selectQuery("MEDICAMENTO", "*", "");
        
    }

    public function selectMedicamento($idMedicamento) {
        return $this->getDb()->selectQuery("MEDICAMENTO", "*", "ID_MEDICAMENTO='$idMedicamento'")->fetch(PDO::FETCH_ASSOC);
    }

}

?>