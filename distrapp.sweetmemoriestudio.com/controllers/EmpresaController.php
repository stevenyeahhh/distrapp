<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmpresaController
 *
 * @author jcaperap
 */
class EmpresaController extends Controller{
    private $empresa;
    private $usuario;
    public function __construct() {
        parent::__construct();
        if (!$this->sesionIniciada()) {

            header("Location:" . BASE . DS . 'index' . DS);
        }
        $this->empresa= $this->loadModel("Empresa");
        $this->usuario= $this->loadModel("Usuario");
        $this->crearMenu($menu2, "empresa/registrarEmpresa", "Crear empresa");
        $this->crearMenu($menu2, "empresa/consultarEmpresas", "Consultar empresa");
        $this->view->setMenu2($menu2);
    }
    public function index() {
        
    }
    public function registrarEmpresa() {
        $this->view->setJs(array("validate"));
//        $this->crearMenu($menu2, "administrador/registrarEmpresa", "Crear empresa");
        if($_POST){
            extract($_POST);
            $this->empresa->setNombre($nombre);
            $this->empresa->setTelefono($telefono);
            $this->empresa->setDireccion($direccion);
            $this->empresa->setIdPersonaEncargada($idPersonaEncargada);
            
            if($this->empresa->insertEmpresa()){
               $this->view->setMensaje("Regitro correcto"); 
            }
        }
        $this->view->setParams($this->usuario->getUsuariosCliente(),"USUARIOS_CLIENTE");
//        $this->view->setMenu2($menu2);
        $this->view->setTitle("Registrar empresa");
        $this->view->renderize("registrarEmpresa");
    }

    //actualizar
    public function actualizarEmpresa($param) {
        
    }

    //consultar
    public function consultarEmpresas() {
//        $this->crearMenu($menu2, "administrador/registrarEmpresa", "Crear empresa");
//        $this->view->setMenu2($menu2);
        $this->view->setJs(array("switch"));
        $this->view->setTitle("Consultar empresas:");
        
        $this->view->setParams($this->empresa->selectEmpresas(), 'EMPRESAS');

        
//        $this->view->agregarTabla($tabla,array(),"BODEGA",1);
        $this->view->renderize("consultarEmpresas");
//        selectEmpresas
    }
    public function desactivarEmpresa() {
        $this->showConstructMsg();
    }

//put your code here
}
