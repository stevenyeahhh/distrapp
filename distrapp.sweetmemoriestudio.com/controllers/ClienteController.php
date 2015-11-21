<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClienteController
 *
 * @author jcaperap
 */
class ClienteController extends Controller{
    //Responsabilidad:
    //Registrar pedidos, aceptarlos
    private $pedido;
    private $empresa;
    private $tipoMedicamento;
    private $detallesPedido;
    
    public function __construct() {
        parent::__construct();
        if (!$this->sesionIniciada()) {

            header("Location:" . BASE . DS . 'index' . DS);
        }
        $this->pedido= $this->loadModel("Pedido");
        $this->empresa=  $this->loadModel("Empresa");
        $this->tipoMedicamento=  $this->loadModel("TipoMedicamento");
        $this->detallesPedido=$this->loadModel("DetallesPedido");
    }
    public function index() {
        
    }
    public function consultarPedidos() {
//        selectPedido
//        $this->pedido
        $this->crearMenu($menu2, "cliente/registrarPedido", "Crear pedido");
        $this->view->setMenu2($menu2);
//        $this->view->setJs(array("switch"));
        $this->view->setTitle("Consultar Pedidos:");
        $idEmpresa=$this->empresa->getEmpresaPorIdCliente($this->getSesionVar("IDENTIFICADOR"));
//        var_dump($epc);
        $idEmpresa=$idEmpresa->fetch();
        $this->view->setParams($this->pedido->selectPedidoPorIdEmpresa($idEmpresa["ID_EMPRESA"]), 'PEDIDOS_POR_EMPRESA');

        
//        $this->view->agregarTabla($tabla,array(),"BODEGA",1);
        $this->view->renderize("consultarPedido");
    }
    
    public function registrarPedido() {
        $this->view->setJs(array("validate"));
        $this->crearMenu($menu2, "administrador/registrarPedido", "Crear Pedido");
//        $empresaUsuario=;
//        var_dump($empresaUsuario->fetch()["ID_EMPRESA"]);
        
//        echo "<hr/>";
        if($_POST){

            extract($_POST);

            $this->pedido->setIdEmpresa($this->empresa->getEmpresaPorIdCliente($this->getSesionVar("IDENTIFICADOR"))->fetch()["ID_EMPRESA"]);
            $this->pedido->setIdRepartidor(0);
            $this->pedido->setIdUsuarioRegistro($this->getSesionVar("IDENTIFICADOR"));
            $this->pedido->setIdUsuarioAsigna(0);

            
            if($this->pedido->insertPedido()){
//               $this->view->setMensaje("Regitro correcto". $this->pedido->getDb()->lastInsertId()); 
               $this->view->setMensaje("Registro correcto"); 
               //+++
                $this->detallesPedido->setIdPedido($this->pedido->getDb()->lastInsertId());
                for($i=0;$i<count($tipoMedicamentos);$i++){
                    $this->detallesPedido->setIdTipoMedicamento($tipoMedicamentos[$i]);
                    $this->detallesPedido->setCantidad($cantidad[$i]);
                    $this->detallesPedido->insertDetallesPedido();
                }
            }
        }
//        var_dump();
        $this->view->setParams($this->tipoMedicamento->selectTipoMedicamentos(),"TIPO_MEDICAMENTOS");
        $this->view->setParams($this->empresa->getEmpresaPorIdCliente($this->getSesionVar("IDENTIFICADOR")),"EMPRESAS");
//        $this->view->setParams($this->usuario->getUsuariosRepartidor(),"REPARTIDORES");
        $this->view->setMenu2($menu2);
        $this->view->setTitle("Registrar pedido");
        $this->view->renderize("registrarPedido");
    }
    public function desactivarPedido() {
        $this->showConstructMsg();
    }
//put your code here
}
