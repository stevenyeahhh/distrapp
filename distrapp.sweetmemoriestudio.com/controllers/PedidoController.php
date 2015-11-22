<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidoController
 *
 * @author jcaperap
 */
class PedidoController extends Controller{
    private $pedido;
    private $tipoMedicamento;
    private $empresa;
    private $usuario;
    private $detallesPedido;
    public function __construct() {
        parent::__construct();    
        if (!$this->sesionIniciada()) {

            header("Location:" . BASE . DS . 'index' . DS);
        }
        $this->pedido= $this->loadModel("Pedido");
        $this->tipoMedicamento= $this->loadModel("TipoMedicamento");
        $this->empresa= $this->loadModel("Empresa");
        $this->usuario= $this->loadModel("Usuario");
        $this->detallesPedido= $this->loadModel("DetallesPedido");
        $this->crearMenu($menu2, "pedido/consultarPedidos", "Consultar pedidos");
        $this->crearMenu($menu2, "pedido/registrarPedido", "Crear Pedido");
        $this->view->setMenu2($menu2);
    }

    public function registrarPedido() {
        $this->view->setJs(array("validate"));
        
        if($_POST){

            extract($_POST);

            $this->pedido->setIdEmpresa($idEmpresa);
            $this->pedido->setIdRepartidor($idRepartidor);
            $this->pedido->setIdUsuarioRegistro($this->getSesionVar("IDENTIFICADOR"));
            $this->pedido->setIdUsuarioAsigna($this->getSesionVar("IDENTIFICADOR"));

            
            if($this->pedido->insertPedido()){
//               $this->view->setMensaje("Regitro correcto". $this->pedido->getDb()->lastInsertId()); 
               $this->view->setMensaje("Regitro correcto"); 
               //+++
                $this->detallesPedido->setIdPedido($this->pedido->getDb()->lastInsertId());
                for($i=0;$i<count($tipoMedicamentos);$i++){
                    $this->detallesPedido->setIdTipoMedicamento($tipoMedicamentos[$i]);
                    $this->detallesPedido->setCantidad($cantidad[$i]);
    //                echo $tipoMedicamentos[$i]."=>".$cantidad[$i];
                    $this->detallesPedido->insertDetallesPedido();
                }
            }
        }
        
        $this->view->setParams($this->tipoMedicamento->selectTipoMedicamentos(),"TIPO_MEDICAMENTOS");
        $this->view->setParams($this->empresa->selectEmpresas(),"EMPRESAS");
        $this->view->setParams($this->usuario->getUsuariosRepartidor(),"REPARTIDORES");
//        $this->view->setMenu2($menu2);
        $this->view->setTitle("Registrar pedido");
        $this->view->renderize("registrarPedido");
    }

    //actualizar:
    public function actualizarPedido() {
        
    }

    //consultar pedidos
    public function consultarPedidos() {
//        selectPedido
//        $this->pedido
        
        
//        $this->view->setJs(array("switch"));
        $this->view->setTitle("Consultar Pedidos:");
        
        $this->view->setParams($this->pedido->selectPedido(), 'PEDIDOS');

        
//        $this->view->agregarTabla($tabla,array(),"BODEGA",1);
        $this->view->renderize("consultarPedidos");
    }
    
    public function consultarPedido($idPedido) {  
//        $this->crearMenu($menu2, "pedido/registrarPedido", "Crear pedido");
        $this->crearMenu($menu2, "pedido/consultarPedido/$idPedido", "Consultar pedido '$idPedido'");
        $this->crearMenu($menu2, "pedido/actualizarPedido/$idPedido", "Actualizar pedido '$idPedido'");
        $this->view->setMenu2($menu2);
        $this->view->setParams($this->pedido->getPedidoPorId($idPedido)->fetch(PDO::FETCH_ASSOC ),'DATA');
        $this->view->setParams($this->pedido->getDetallesPedido($idPedido),'DETALLES_PEDIDO');
        $this->view->renderize("consultarPedido");
    }
    public function desactivarPedido() {
        $this->showConstructMsg();
    }
    //asignar pedidos
    public function asignarPedido() {
    }

    public function index() {
        
    }

}
