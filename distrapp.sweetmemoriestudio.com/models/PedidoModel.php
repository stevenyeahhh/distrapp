<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidoModel
 *
 * @author jcaperap
 */
class PedidoModel extends Model{
    //put your code here
    private $idPedido;
    private $idEmpresa;
    private $idRepartidor;
    private $idUsuarioRegistro;
    private $idUsuarioAsigna;
    private $entregado;
    private $estado;
    
    private $campos;
    public function __construct() {
        parent::__construct();
        $this->campos="ID_EMPRESA,ID_REPARTIDOR,ID_USUARIO_REGISTRO,ID_USUARIO_ASIGNA,ENTREGADO";
    }
    public function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    public function setIdEmpresa($idEmpresa) {
        $this->idEmpresa = $idEmpresa;
    }

    public function setIdRepartidor($idRepartidor) {
        $this->idRepartidor = $idRepartidor;
    }

    public function setIdUsuarioRegistro($idUsuarioRegistro) {
        $this->idUsuarioRegistro = $idUsuarioRegistro;
    }

    public function setIdUsuarioAsigna($idUsuarioAsigna) {
        $this->idUsuarioAsigna = $idUsuarioAsigna;
    }

    public function setEntregado($entregado) {
        $this->entregado = $entregado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
    public function selectPedido() {
//        return $this->getDb()->selectQuery("PEDIDO", "*", "");
        return  $this->getDb()->query("SELECT P.ID_PEDIDO \"ID PEDIDO\", E.NOMBRE \"NOMBRE EMPRESA\", concat(U1.NOMBRE,concat(' ',U1.APELLIDO)) \"USUARIO REPARTIDOR\", concat(U2.NOMBRE,concat(' ',U2.APELLIDO)) \"USUARIO QUE REGISTRA\", concat(U3.NOMBRE,concat(' ',U3.APELLIDO)) \"USUARIO QUE ASIGNA\", P.FECHA_REGISTRO \"FECHA REGISTRO\", P.FECHA_ENTREGA \"FECHA ENTREGA\", (CASE P.ENTREGADO WHEN 0 THEN 'NO' ELSE 'SI' END ) \"ENTREGADO\", P.ESTADO FROM PEDIDO P JOIN EMPRESA E ON (E.ID_EMPRESA=P.ID_EMPRESA) LEFT JOIN USUARIO U1 ON (U1.IDENTIFICADOR=P.ID_REPARTIDOR) LEFT JOIN USUARIO U2 ON (U2.IDENTIFICADOR=P.ID_USUARIO_REGISTRO) LEFT JOIN USUARIO U3 ON (U3.IDENTIFICADOR=P.ID_USUARIO_ASIGNA)");
    }
    public function insertPedido() {
        return $this->getDb()->insertQuery("PEDIDO", $this->campos, "'$this->idEmpresa','$this->idRepartidor','$this->idUsuarioRegistro','$this->idUsuarioAsigna','$this->entregado'");
    }
    public function selectPedidoPorIdEmpresa($idEmpresa) {
        return  $this->getDb()->query("SELECT P.ID_PEDIDO \"ID PEDIDO\", E.NOMBRE \"NOMBRE EMPRESA\", concat(U1.NOMBRE,concat(' ',U1.APELLIDO)) \"USUARIO REPARTIDOR\", concat(U2.NOMBRE,concat(' ',U2.APELLIDO)) \"USUARIO QUE REGISTRA\", concat(U3.NOMBRE,concat(' ',U3.APELLIDO)) \"USUARIO QUE ASIGNA\", P.FECHA_REGISTRO \"FECHA REGISTRO\", P.FECHA_ENTREGA \"FECHA ENTREGA\", (CASE P.ENTREGADO WHEN 0 THEN 'NO' ELSE 'SI' END ) \"ENTREGADO\", P.ESTADO FROM PEDIDO P JOIN EMPRESA E ON (E.ID_EMPRESA=P.ID_EMPRESA) LEFT JOIN USUARIO U1 ON (U1.IDENTIFICADOR=P.ID_REPARTIDOR) LEFT JOIN USUARIO U2 ON (U2.IDENTIFICADOR=P.ID_USUARIO_REGISTRO) LEFT JOIN USUARIO U3 ON (U3.IDENTIFICADOR=P.ID_USUARIO_ASIGNA) WHERE P.ID_EMPRESA='$idEmpresa'");
    }
    public function getPedidosPorRepartidor($idRepartidor) {
        return  $this->getDb()->query("SELECT P.ID_PEDIDO \"ID PEDIDO\", E.NOMBRE \"NOMBRE EMPRESA\", concat(U1.NOMBRE,concat(' ',U1.APELLIDO)) \"USUARIO REPARTIDOR\", concat(U2.NOMBRE,concat(' ',U2.APELLIDO)) \"USUARIO QUE REGISTRA\", concat(U3.NOMBRE,concat(' ',U3.APELLIDO)) \"USUARIO QUE ASIGNA\", P.FECHA_REGISTRO \"FECHA REGISTRO\", P.FECHA_ENTREGA \"FECHA ENTREGA\", (CASE P.ENTREGADO WHEN 0 THEN 'NO' ELSE 'SI' END ) \"ENTREGADO\", P.ESTADO FROM PEDIDO P JOIN EMPRESA E ON (E.ID_EMPRESA=P.ID_EMPRESA) LEFT JOIN USUARIO U1 ON (U1.IDENTIFICADOR=P.ID_REPARTIDOR) LEFT JOIN USUARIO U2 ON (U2.IDENTIFICADOR=P.ID_USUARIO_REGISTRO) LEFT JOIN USUARIO U3 ON (U3.IDENTIFICADOR=P.ID_USUARIO_ASIGNA) WHERE P.ID_REPARTIDOR='$idRepartidor'");
    }
    public function getPedidoPorId($idPedido) {
        return  $this->getDb()->query("SELECT P.ID_PEDIDO \"ID PEDIDO\", E.NOMBRE \"NOMBRE EMPRESA\", concat(U1.NOMBRE,concat(' ',U1.APELLIDO)) \"USUARIO REPARTIDOR\", concat(U2.NOMBRE,concat(' ',U2.APELLIDO)) \"USUARIO QUE REGISTRA\", concat(U3.NOMBRE,concat(' ',U3.APELLIDO)) \"USUARIO QUE ASIGNA\", P.FECHA_REGISTRO \"FECHA REGISTRO\", P.FECHA_ENTREGA \"FECHA ENTREGA\", (CASE P.ENTREGADO WHEN 0 THEN 'NO' ELSE 'SI' END ) \"ENTREGADO\", P.ESTADO FROM PEDIDO P JOIN EMPRESA E ON (E.ID_EMPRESA=P.ID_EMPRESA) LEFT JOIN USUARIO U1 ON (U1.IDENTIFICADOR=P.ID_REPARTIDOR) LEFT JOIN USUARIO U2 ON (U2.IDENTIFICADOR=P.ID_USUARIO_REGISTRO) LEFT JOIN USUARIO U3 ON (U3.IDENTIFICADOR=P.ID_USUARIO_ASIGNA) WHERE P.ID_PEDIDO='$idPedido'");
    }
}
