<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdministradorController
 *
 * @author jcaperap
 */
class AdministradorController extends Controller {

    //Responsabilidad:
    //Registrar los entes que participan en el sistema, asignar pedidos, y crearlos si es necesario
    private $usuario;
    private $medicamento;
    private $tipoMedicamento;
    private $empresa;
    private $bodega;
    private $pedido;
    private $detallesPedido;
    

    public function __construct() {
        parent::__construct();
        if (!$this->sesionIniciada()) {

            header("Location:" . BASE . DS . 'index' . DS);
        }
//        var_dump($this->getSesionVar());
//        die();
        if ($this->getRol() != ROL_ADMINISTRADOR) {
            header("Location:" . BASE . DS . 'index' . DS);
            exit;
        } else {
            $this->usuario = $this->loadModel('Usuario');
            $this->medicamento = $this->loadModel("Medicamento");
            $this->tipoMedicamento = $this->loadModel("TipoMedicamento");
            $this->empresa = $this->loadModel("Empresa");
            $this->bodega = $this->loadModel("Bodega");
            $this->pedido = $this->loadModel("Pedido");
            $this->detallesPedido=$this->loadModel("DetallesPedido");
        }
    }

    public function index() {
        $this->view->renderize('index');
    }

    ///Tipos de medicamentos:
    //Registrar:
    public function registrarTipoMedicamento() {
        $this->view->setJs(array ("validate"));
        
        echo "en construcción";
        if ($_POST) {
            extract($_POST);

            $this->tipoMedicamento->setCodigoBarras($codigoBarras);
            $this->tipoMedicamento->setDescripcion($descripcion);

            if ($this->tipoMedicamento->insertTipoMedicamento()) {
                $this->view->setMensaje("Registro éxitoso");
            } else {
                $this->view->setError("Error");
            }
        } else {
            
        }
        $this->crearMenu($menu2, "administrador/registrarTipoMedicamento", 'Registrar tipo medicamento');
        $this->view->setMenu2($menu2);
        $this->view->setTitle("Registrar tipo medicamento");
//				$this->view->setJs(array('validate'));
        $this->view->renderize('registrarTipoMedicamento');
    }

    //Consultar
    public function consultarTipoMedicamentos() {
        echo "en construcción";
        
//        registrarTipoMedicamento
        $this->crearMenu($menu2, "administrador/registrarTipoMedicamento", 'Registrar tipo medicamento');
        $this->view->setMenu2($menu2);
//        $this->tipoMedicamento->selectTipoMedicamentos();
         $this->view->setTitle("Consultar tipo medicamentos");
//         $this->view->setParams($this->tipoMedicamento->selectTipoMedicamentos(), 'TIPO_MEDICAMENTOS');
         $this->view->setParams($this->tipoMedicamento->selectTipoMedicamentosPDO(), 'TIPO_MEDICAMENTOS');
//				$this->view->setJs(array('validate'));
        $this->view->renderize('consultarTipoMedicamento');
    }
    public function desactivarTipoMedicamento() {
        $this->showConstructMsg();
    }
    //Medicamentos (Páquetes)
    public function registrarMedicamento() {
        $this->view->setJs(array("validate"));
        if ($_POST) {
            extract($_POST);

            $this->medicamento->setIdMedicamento($idMedicamento);
            $this->medicamento->setIdTipoMedicamento($idTipoMedicamento);
            $this->medicamento->setFechaFabricacion($fechaFabricacion);
            $this->medicamento->setFechaVencimiento($fechaVencimiento);
            $this->medicamento->setCantidad($cantidad);
            $this->medicamento->setBodega($bodega);


            if ($this->medicamento->insertMedicamento()) {
                $this->view->setMensaje("Registro exitoso");
            } else {
                $this->view->setError("Error");
            }
        } else {
            
        }
        $this->crearMenu($menu2, "administrador/registrarMedicamento", 'Registrar medicamento');
        $this->view->setMenu2($menu2);

        $this->view->setParams($this->tipoMedicamento->selectTipoMedicamentos(), 'TIPO_MEDICAMENTO_DATA');
        $this->view->setParams($this->bodega->selectBodegas(), 'BODEGAS');
        $this->view->setTitle("Registrar medicamento");
//				$this->view->setJs(array('validate'));
        $this->view->renderize('registrarMedicamento');
    }

    public function actualizarMedicamento() {
        if ($_POST) {
            extract($_POST);

            $this->medicamento->setIdMedicamento($idMedicamento);
            $this->medicamento->setIdTipoMedicamento($idTipoMedicamento);
            $this->medicamento->setFechaFabricacion($fechaFabricacion);
            $this->medicamento->setFechaVencimiento($fechaVencimiento);
            $this->medicamento->setCantidad($cantidad);
            $this->medicamento->setBodega($bodega);


            if ($this->medicamento->actualizarMedicamento()) {
                $this->view->setMensaje("Registro exitoso");
            } else {
                $this->view->setError("Error");
            }
        } else {
            
        }
        $this->view->setTitle("actualizar medicamento");
//				$this->view->setJs(array('validate'));
        $this->view->renderize('actualizarMedicamento');
    }

    public function consultarMedicamentos() {
        $this->crearMenu($menu2, "administrador/registrarMedicamento", 'Registrar medicamento');
        $this->view->setMenu2($menu2);
        $this->view->setParams($this->medicamento->selectMedicamentosPDO(), 'MEDICAMENTOS');

        $this->view->setTitle("Consultar medicamentos");
//				$this->view->setJs(array('validate'));
        $this->view->renderize('consultarMedicamentos');
    }

    public function consultarMedicamento($idMedicamento) {

        $this->view->setParams($this->medicamento->selectMedicamento($idMedicamento), 'MEDICAMENTO');

        $this->view->setTitle("Consultar medicamento");
//				$this->view->setJs(array('validate'));
        $this->view->renderize('consultarMedicamento');
    }
    public function desactivarMedicamento() {
        $this->showConstructMsg();
    }
    ///Usuario
    //registrar
    public function registrar() {
        $this->view->setJs(array("validate"));
        if ($_POST) {
            extract($_POST);

            $this->usuario->setNombre($nombre);
            $this->usuario->setApellido($apellido);
            $this->usuario->setId($id);
            $this->usuario->setContrasena($contrasena);
            $this->usuario->setTelefono($telefono);

            if ($this->usuario->validar(1)) {
                if ($this->usuario->insertar()) {
                    $this->view->setTitle("Su registro ha sido exitoso");
                    $this->view->renderize('registrado');
                } else {
                    echo "Ha ocurrido un error al insertar";
                }
            } else {
                foreach ($this->usuario->getErrores() as $key => $value) {
                    echo "Error en '$key' por  $value <br/>";
                }
            }
        } else {

            $this->crearMenu($menu2, "administrador/registrar", "Crear usuario");
            $this->view->setMenu2($menu2);
            $this->view->setTitle("Registrar usuario");
//				$this->view->setJs(array('validate'));
            $this->view->renderize('registrar');
        }
    }

    //actualizar :
    //Consultar usuarios:
    public function consultarUsuarios() {

        if ($this->getRol() != ROL_ADMINISTRADOR) {
            echo "NO TIENE ACCESO A ESTA OPCIÓN";
        } else {
            $this->crearMenu($menu2, "administrador/registrar", "Crear usuario");
            $this->view->setMenu2($menu2);

            $this->view->setParams($this->usuario->getUsuarios(), 'ALL_USERS');
            $this->view->setTitle("CONSULTAR TODOS LOS USUARIOS");
            $this->view->setJs(array("switch"));
            $this->view->renderize("consultarUsuarios");
        }
    }

    //cambiar estado de usuarios (ajax):
    public function cambiarEstadoUsuario() {
        if ($_POST) {
            extract($_POST);
            if (is_numeric($usuario) && is_numeric($estado)) {
                die(($this->usuario->cambiarEstadoUsuario($usuario, $estado) ? "Éxito al " . (($estado) ? "activar" : "desactivar") . "  el usuario '$usuario'" : "No se pudo actualizar el usuario"));
            }
        }
    }

    //Empresa:
    //registrar
    public function registrarEmpresa() {
        $this->view->setJs(array("validate"));
        $this->crearMenu($menu2, "administrador/registrarEmpresa", "Crear empresa");
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
        $this->view->setMenu2($menu2);
        $this->view->setTitle("Registrar empresa");
        $this->view->renderize("registrarEmpresa");
    }

    //actualizar
    public function actualizarEmpresa($param) {
        
    }

    //consultar
    public function consultarEmpresas() {
        $this->crearMenu($menu2, "administrador/registrarEmpresa", "Crear empresa");
        $this->view->setMenu2($menu2);
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
    //Pedidos:
    //registrar
    public function registrarPedido() {
        $this->view->setJs(array("validate"));
        $this->crearMenu($menu2, "administrador/registrarPedido", "Crear Pedido");
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
        $this->view->setMenu2($menu2);
        $this->view->setTitle("Registrar pedido");
        $this->view->renderize("registrarPedido");
    }

    //actualizar:
    public function actualizarPedido($idPedido) {
        $this->crearMenu($menu2, "administrador/registrarPedido", "Crear pedido");
        $this->crearMenu($menu2, "administrador/consultarPedido/$idPedido", "Consultar pedido");
        $this->crearMenu($menu2, "administrador/actualizarPedido/$idPedido", "Actualizar pedido");
        $this->view->setMenu2($menu2);
    }

    //consultar pedidos
    public function consultarPedidos() {
//        selectPedido
//        $this->pedido
        $this->crearMenu($menu2, "administrador/registrarPedido", "Crear pedido");
        $this->view->setMenu2($menu2);
//        $this->view->setJs(array("switch"));
        $this->view->setTitle("Consultar Pedidos:");
        
        $this->view->setParams($this->pedido->selectPedido(), 'PEDIDOS');

        
//        $this->view->agregarTabla($tabla,array(),"BODEGA",1);
        $this->view->renderize("consultarPedidos");
    }
    
    public function consultarPedido($idPedido) {  
        $this->crearMenu($menu2, "administrador/registrarPedido", "Crear pedido");
        $this->crearMenu($menu2, "administrador/consultarPedido/$idPedido", "Consultar pedido");
        $this->crearMenu($menu2, "administrador/actualizarPedido/$idPedido", "Actualizar pedido");
        $this->view->setMenu2($menu2);
        $this->view->setParams($this->pedido->getPedidoPorId($idPedido),'PEDIDO');
        $this->view->renderize("consultarPedido");
    }
    public function desactivarPedido() {
        $this->showConstructMsg();
    }
    //asignar pedidos
    public function asignarPedido() {
        
    }

    //Socios-> esto no es tan importante, realmente parece inútil
    public function registrarSocio() {
        
    }

    public function actualizarSocio($param) {
        
    }

    public function consultarSocios() {
        
    }

    /* Revisar */

    public function preguntas() {
        $this->view->setTitle("Preguntas de seguridad");
        $this->view->renderize("preguntas");
    }

    //Bodega
    public function consultarBodegas() {
        
        $this->crearMenu($menu2, "administrador/registrarBodega", "Crear bodega");
        $this->view->setMenu2($menu2);
        $this->view->setJs(array("switch"));
        $this->view->setTitle("Consultar Bodegas:");
        
        $this->view->setParams($this->bodega->selectBodegas(), 'BODEGAS');

        
//        $this->view->agregarTabla($tabla,array(),"BODEGA",1);
        $this->view->renderize("consultarBodegas");
    }
    
    
    
    
    public function registrarBodega() {
        $this->view->setJs(array("validate"));
        $this->crearMenu($menu2, "administrador/registrarBodega", "Crear bodega");
        if($_POST){
            extract($_POST);
            $this->bodega->setDireccion($direccion);
            $this->bodega->setTelefono($telefono);
            $this->bodega->setIdPersonaEncargada($idPersonaEncargada);
            
            if($this->bodega->insertBodega()){
               $this->view->setMensaje("Regitro correcto"); 
            }
        }
        //por el momento toca traer todos los usuarios
        $this->view->setParams($this->usuario->getUsuariosCliente(),"USUARIOS_CLIENTE");
        $this->view->setMenu2($menu2);
        $this->view->setTitle("Registrar bodega");
        $this->view->renderize("registrarBodegas");
    }
    public function desactivarBodega() {
        $this->showConstructMsg();
    }
}
