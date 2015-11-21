<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DetallesPedidoModel
 *
 * @author jcaperap
 */
class DetallesPedidoModel extends Model {
    private $idDetallesPedido;
    private $idPedido;
    private $idTipoMedicamento;
    private $cantidad;
    
    private $campos;
    public function __construct() {
        parent::__construct();
        $this->campos="ID_PEDIDO,ID_TIPO_MEDICAMENTO,CANTIDAD";
    }
    public function setIdDetallesPedido($idDetallesPedido) {
        $this->idDetallesPedido = $idDetallesPedido;
    }

    public function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    public function setIdTipoMedicamento($idTipoMedicamento) {
        $this->idTipoMedicamento = $idTipoMedicamento;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
    public function insertDetallesPedido() {
        return $this->getDb()->insertQuery("DETALLES_PEDIDO", $this->campos, "'$this->idPedido','$this->idTipoMedicamento','$this->cantidad'");
    }

    
}
