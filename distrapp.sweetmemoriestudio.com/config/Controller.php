<?php

abstract class Controller {

    protected $view;

    abstract public function index();

    public function __construct() {
        session_start();
        $this->view = new View(Singleton::getInstance()->r->getController());
        $menu = array();
        if ($this->sesionIniciada()) {
            $this->view->setMsgBienvenida($this->getSesionVar("ROL") . " : " . $this->getSesionVar("NOMBRE") . " " . $this->getSesionVar("APELLIDO"));
            switch ($this->getRol()) {
                case ROL_ADMINISTRADOR:

                    $this->crearMenu($menu, "usuario/consultarUsuarios", 'Usuarios');
                    $this->crearMenu($menu, "preguntas/crearPreguntas", 'Preguntas');
                    $this->crearMenu($menu, "tipoMedicamento/consultarTipoMedicamentos", 'Tipos de Medicamentos');
                    $this->crearMenu($menu, "bodega/consultarBodegas", 'Bodega');
                    $this->crearMenu($menu, "medicamento/consultarMedicamentos", 'Medicamentos');
                    $this->crearMenu($menu, "empresa/consultarEmpresas", 'Empresas');
                    $this->crearMenu($menu, "pedido/consultarPedidos", 'PEDIDOS');
                    break;
                case ROL_REPARTIDOR:
                    $this->crearMenu($menu, "repartidor/consultarPedidosAsignados", 'Pedidos asignados');

                    break;
                case ROL_CLIENTE:
                    $this->crearMenu($menu, "cliente/consultarPedidos", 'PEDIDOS');
                    break;
                default:
                    break;
            }
//            $menu[] = array('url' => BASE . "usuario/consultar",
//                'descripcion' => 'Consulta de datos');
//            $menu[] = array('url' => BASE . "usuario/modificar",
//                'descripcion' => 'Modificar datos');
//            $menu[] = array('url' => BASE . "usuario/eliminar",
//                'descripcion' => 'Eliminar cuenta');
//            $menu[] = array('url' => BASE . "usuario/cerrarSesion",
//                'descripcion' => 'Cerrar sesión ');
//                ----Todo el menú
//                
            $this->crearMenu($menu, "usuario/consultar", 'Consulta de datos');
            $this->crearMenu($menu, "usuario/modificar", 'Modificar datos');
            $this->crearMenu($menu, "usuario/eliminar", 'Eliminar cuenta');
            $this->crearMenu($menu, "usuario/cerrarSesion", 'Cerrar sesión ');


            $this->view->setMenu($menu);
        }
    }

    public function loadModel($model) {

        $model = $model . 'Model';

        //echo $controllerPath=ROOT.'models'.DS.$model.'.php';

        if (is_readable($controllerPath = ROOT . 'models' . DS . $model . '.php')) {

            include_once $controllerPath = ROOT . 'models' . DS . $model . '.php';

            return new $model;
        }
    }

    public function sesionIniciada() {

        return isset($_SESSION['IDENTIFICADOR']);
    }

    public function getSesionVar($name) {
        return $_SESSION[$name];
    }

    public function cerrarSesion() {
        session_destroy();
    }

    public function getRol() {
        return $_SESSION["ID_ROL"];
    }

    public function crearMenu(&$menu, $url, $descripcion) {
        $menu[] = array('url' => BASE . $url,
            'descripcion' => $descripcion);
    }

    public function showConstructMsg() {
        die("En construcción");
    }


}

?>