<?php

class UsuarioController extends Controller {

    private $usuario;

    public function __construct() {



        parent::__construct();

        if (!$this->sesionIniciada()) {

            header("Location:" . BASE . DS . 'index' . DS);
        }

        $this->usuario = $this->loadModel("Usuario");

        $this->view->setParams($this->usuario->getUsuario($this->getSesionVar('IDENTIFICADOR')), 'USER_DATA');
        
        $this->crearMenu($menu2, "usuario/registrar", "Crear usuario");
        $this->crearMenu($menu2, "usuario/crearReporteUsuariosActivos", "Usuario activos");
        $this->crearMenu($menu2, "usuario/crearReporteUsuariosPorRoles", "Usuarios por roles");
        $this->crearMenu($menu2, "usuario/consultarUsuarios", "Consultar usuarios");
        $this->view->setMenu2($menu2);
    }

    public function index() {

//			$this->view->setJs(array('validate'));

        $this->view->renderize('herramientas');
    }

    public function consultar() {

        $this->view->setTitle("Consulta de datos");

        $this->view->renderize('index');
    }

    public function cerrarSesion() {

        $this->usuario->cerrarSesion();

        header("Location:" . BASE . DS . 'index' . DS . 'index');
    }

    public function modificar() {

        $this->view->setJs(array('validate'));

        if ($_POST) {



            $controlador = false;

            extract($_POST);

            $this->usuario->setNombre($nombre);

            $this->usuario->setApellido($apellido);

            $this->usuario->setId($id);

            $this->usuario->setContrasena($contrasena);

            $this->usuario->setTelefono($telefono);

            $this->usuario->setIdentificador($this->getSesionVar('IDENTIFICADOR'));

            if ($this->usuario->validar(1)) {

                if ($this->usuario->actualizar()) {

                    $controlador = true;
                }
            }

            header("Location:" . BASE . DS . 'usuario' . DS . 'modificar');
        } else {

            $this->view->setTitle("Modificar");

            $this->view->renderize('modificar');
        }
    }

    public function eliminar() {

        $this->usuario->setIdentificador($this->getSesionVar('IDENTIFICADOR'));

        $this->usuario->inhabilitar();

        $this->usuario->cerrarSesion();

        header("Location:" . BASE . DS . 'index' . DS . 'index');
    }
//////////////////
    public function consultarUsuarios() {

        if ($this->getRol() != ROL_ADMINISTRADOR) {
            echo "NO TIENE ACCESO A ESTA OPCIÓN";
        } else {
//            $this->crearMenu($menu2, "administrador/registrar", "Crear usuario");
//            $this->view->setMenu2($menu2);

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

    public function preguntas() {
        $this->view->setTitle("Preguntas de seguridad");
        $this->view->renderize("preguntas");
    }

    /* Registrar */

    public function registrar() {
        if ($_POST) {
            extract($_POST);
            $usuario = $this->loadModel('Usuario');
            $usuario->setNombre($nombre);
            $usuario->setApellido($apellido);
            $usuario->setId($id);
            $usuario->setContrasena($contrasena);
            $usuario->setTelefono($telefono);

            if ($usuario->validar(1)) {
                if ($usuario->insertar()) {
                    $this->view->setTitle("Su registro ha sido exitoso");
                    $this->view->renderize('registrado');
                } else {
                    echo "Ha ocurrido un error al insertar";
                }
            } else {
                foreach ($usuario->getErrores() as $key => $value) {
                    echo "Error en '$key' por  $value <br/>";
                }
            }
        } else {
            $this->view->setTitle("Registrar usuario");
//				$this->view->setJs(array('validate'));
            $this->view->renderize('registrar');
        }
    }

    public function registrarMedicamento() {
        $this->view->setJs(array("validate"));
        if ($_POST) {
            extract($_POST);
            $medicamento = $this->loadModel("Medicamento");
            $medicamento->setIdMedicamento($idMedicamento);
            $medicamento->setIdTipoMedicamento($idTipoMedicamento);
            $medicamento->setFechaFabricacion($fechaFabricacion);
            $medicamento->setFechaVencimiento($fechaVencimiento);
            $medicamento->setCantidad($cantidad);
            $medicamento->setBodega($bodega);


            if ($medicamento->insertMedicamento()) {
                $this->view->setMensaje("Registro exitoso");
            } else {
                $this->view->setError("Error");
            }
        } else {
            
        }
        $tipoMedicamento=  $this->loadModel("TipoMedicamento");
        $this->view->setParams($tipoMedicamento->selectTipoMedicamentos(), 'TIPO_MEDICAMENTO_DATA');
        $this->view->setTitle("Registrar medicamento");
//				$this->view->setJs(array('validate'));
        $this->view->renderize('registrarMedicamento');
    }

    public function actualizarMedicamento() {
        if ($_POST) {
            extract($_POST);
            $medicamento = $this->loadModel("Medicamento");
            $medicamento->setIdMedicamento($idMedicamento);
            $medicamento->setIdTipoMedicamento($idTipoMedicamento);
            $medicamento->setFechaFabricacion($fechaFabricacion);
            $medicamento->setFechaVencimiento($fechaVencimiento);
            $medicamento->setCantidad($cantidad);
            $medicamento->setBodega($bodega);


            if ($medicamento->actualizarMedicamento()) {
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
        $medicamento = $this->loadModel("Medicamento");
        $this->view->setParams($medicamento->selectMedicamentos(), 'MEDICAMENTOS');

        $this->view->setTitle("Consultar medicamentos");
//				$this->view->setJs(array('validate'));
        $this->view->renderize('consultarMedicamentos');
    }

    public function consultarMedicamento($idMedicamento) {
        $medicamento = $this->loadModel("Medicamento");
        $this->view->setParams($medicamento->selectMedicamento($idMedicamento), 'MEDICAMENTO');

        $this->view->setTitle("Consultar medicamento");
//				$this->view->setJs(array('validate'));
        $this->view->renderize('consultarMedicamento');
    }

    public function consultarTipoMedicamentos() {
        echo "en construcción";
    }

    public function registrarTipoMedicamento() {
        echo "en construcción";
        ////////////7777
//        $this->view->setJs(array("validate"));
        if ($_POST) {
            extract($_POST);
            $tipoMedicamento = $this->loadModel("TipoMedicamento");
            $tipoMedicamento->setCodigoBarras($codigoBarras);
            $tipoMedicamento->setDescripcion($descripcion);            

            if ($tipoMedicamento->insertTipoMedicamento()) {
                $this->view->setMensaje("Registro éxitoso");
            } else {
                $this->view->setError("Error");
            }
        } else {
            
        }
        $this->view->setTitle("Registrar tipo medicamento");
//				$this->view->setJs(array('validate'));
        $this->view->renderize('registrarTipoMedicamento');
    }
    
    public function crearReporteUsuariosActivos() {
        $this->view->setTitle("Reporte usuarios activos");
//        ECHO "<PRE>";
//        var_dump();
        $this->view->setParams(json_encode($this->usuario->getUsuariosCountPorEstado()), 'json_usuarios'); 
//        ECHO "</PRE>";
        $this->view->renderize('reporteUsuariosActivos');
    }
    public function crearReporteUsuariosPorRoles() {
        $this->view->setTitle("Reporte usuarios roles");
//        ECHO "<PRE>";
//        var_dump();
        $this->view->setParams(json_encode($this->usuario->getUsuariosCountPorRoles()), 'json_usuarios_roles'); 
//        ECHO "</PRE>";
        $this->view->renderize('reporteUsuariosRoles');
    }
    public function consultarUsuario($idUsuario) {
        $this->crearMenu($menu2, "usuario/consultarUsuario/$idUsuario", "Consulta usuario '$idUsuario'");
        $this->crearMenu($menu2, "usuario/actualizarUsuario/$idUsuario", "Actualizar usuario '$idUsuario'");
        $this->view->setMenu2($menu2);
        
        $usuario=$this->usuario->getUsuarioPorId($idUsuario)->fetch(PDO::FETCH_ASSOC);
        $this->view->setTitle("Consultar Usuario '$idUsuario'");
        $this->view->setParams($usuario,'DATA');
        $this->view->renderize("consultarUsuario");
       
    }
    public function actualizarUsuario($idUsuario) {
        $this->crearMenu($menu2, "usuario/consultarUsuario/$idUsuario", "Consulta usuario '$idUsuario'");
        $this->crearMenu($menu2, "usuario/actualizarUsuario/$idUsuario", "Actualizar usuario '$idUsuario'");
        $this->view->setMenu2($menu2);
        if($_POST){
            extract($_POST);
            $this->usuario->setIdentificador($idUsuario);
            $this->usuario->setNombre($nombre);
            $this->usuario->setApellido($apellido);
            $this->usuario->setTelefono($telefono);
            if($this->usuario->actualizarRolAdministrador()){
                $this->view->setMensaje("Actualización exitosa");
            }else{
                $this->view->setError("Error");                
            }
        }        
        $usuario=$this->usuario->getUsuarioPorId($idUsuario)->fetch(PDO::FETCH_ASSOC);
        $this->view->setTitle("Actualizar Usuario '$idUsuario'");
        $this->view->setParams($usuario,'DATA');
        $this->view->renderize("actualizarUsuario");
       
    }
//////////////////////////////
}

?>