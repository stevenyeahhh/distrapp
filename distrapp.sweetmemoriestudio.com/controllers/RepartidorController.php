<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RepartidorController
 *
 * @author jcaperap
 */
class RepartidorController extends Controller{
    //Responsabilidad:
    //Consultar información de pedidos asignados a él.
    private $pedido;
    public function __construct() {
        parent::__construct();
        if (!$this->sesionIniciada()) {

            header("Location:" . BASE . DS . 'index' . DS);
        }
        $this->pedido=$this->loadModel("Pedido");
    }
    public function index() {
        
    }
    public function consultarPedidosAsignados() {
        $this->view->setParams($this->pedido->getPedidosPorRepartidor($this->getSesionVar("IDENTIFICADOR")),'PEDIDOS');
        $this->view->setTitle("Pedidos asignados");
        $this->view->renderize("consultarPedidosAsignados");
        
    }
    public function desactivarPedido () {
        die("No tiene permitido desactivar pedidos");
    }

//put your code here
}
