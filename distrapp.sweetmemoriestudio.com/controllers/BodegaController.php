<?php

class BodegaController extends Controller  {
    private $bodega;
    private $usuario;
    public function __construct() {
        parent::__construct();
        if (!$this->sesionIniciada()) {

            header("Location:" . BASE . DS . 'index' . DS);
        }
        $this->bodega= $this->loadModel("Bodega");
        $this->usuario= $this->loadModel("Usuario");
        $this->crearMenu($menu2, "bodega/registrarBodega", "Crear bodega");
        $this->crearMenu($menu2, "bodega/consultarBodegas", "Consultar bodegas");
        $this->view->setMenu2($menu2);
    }
    public function index() {
        
    }
    public function consultarBodegas() {
        
        
        $this->view->setJs(array("switch"));
        $this->view->setTitle("Consultar Bodegas:");
        
        $this->view->setParams($this->bodega->selectBodegas(), 'BODEGAS');

        
//        $this->view->agregarTabla($tabla,array(),"BODEGA",1);
        $this->view->renderize("consultarBodegas");
    }
    
    
    
    
    public function registrarBodega() {
        $this->view->setJs(array("validate"));
//        $this->crearMenu($menu2, "administrador/registrarBodega", "Crear bodega");
        if($_POST){
            extract($_POST);
            $this->bodega->setDireccion($direccion);
            $this->bodega->setTelefono($telefono);
//            $this->bodega->setIdPersonaEncargada($idPersonaEncargada);
            
            if($this->bodega->insertBodega()){
               $this->view->setMensaje("Regitro correcto"); 
            }
        }
        //por el momento toca traer todos los usuarios
        $this->view->setParams($this->usuario->getUsuariosCliente(),"USUARIOS_CLIENTE");
//        $this->view->setMenu2($menu2);
        $this->view->setTitle("Registrar bodega");
        $this->view->renderize("registrarBodegas");
    }
    public function desactivarBodega() {
        $this->showConstructMsg();
    }

//put your code here
}
