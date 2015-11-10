<?php

class IndexController extends Controller {

    public function __construct() {
        
//        echo "Hola";
        parent::__construct();
        if ($this->sesionIniciada()) {
            header("Location:" . BASE . DS . 'usuario' . DS);
        }
    }

    public function index() {


        $this->view->setTitle("Ingrese sus datos para iniciar sesión");
        $this->view->setJs(array('validate'));
        if ($_POST) {
            extract($_POST);
            $u = $this->loadModel("Usuario");
            $u->setId($usuario);
            $u->setContrasena($contrasena);
            if ($u->validar(2)) {
                if ($u->iniciarSesion() == 1) {
                    header("Location:" . BASE . DS . 'usuario' . DS);
                } else {

                    $this->view->setError("El USUARIO NO SE ENCUENTRA REGISTRADO, FAVOR REGÍSTRESE O VALIDE LOS DATOS E INGRESE NUEVAMENTE.");
                    $this->view->renderize('index');
                }
            } else {
                foreach ($u->getErrores() as $key => $value) {
                    echo "Error en '$key' por  $value<br/>";
                }
            }
        } else {
            $this->view->renderize('index');
        }
    }

    public function iniciar() {
        var_dump($_POST);
    }

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
            $this->view->setTitle("Regístrate");
            $this->view->setJs(array('validate'));
            $this->view->renderize('registrar');
        }
    }

    public function recordarContrasena() {
//        echo "sdasldj";
        $u = $this->loadModel("Usuario");
        if (isset($_POST["tipo"])) {
            if ($_POST["tipo"] == "1") {
                $_SESSION["identificador_temporal_olvido_contrasena"] = 0;

                extract($_POST);


                $p = $this->loadModel("Preguntas");

                $identificador = $u->getUsuarioById($id)["IDENTIFICADOR"];
                $preguntasRamdom = $p->selectRespuestasRamdom($identificador);


                $_SESSION["identificador_temporal_olvido_contrasena"] = $identificador;

                if (count($preguntasRamdom) < 3) {
                    $this->view->setError("Usted no ha respondido las preguntas, contacte con el administrador.");
                } else {
                    var_dump($preguntasRamdom);
                    $this->view->setParams($preguntasRamdom, 'USER_DATA');
                    $this->view->setParams($u->getUsuarioById($id)["IDENTIFICADOR"], 'USER_ID');
                }
            } elseif ($_POST["tipo"] == "2") {
                $contenedor = "(";
                foreach ($_POST as $key => $value) {
                    if (substr($key, 0, 9) == "preguntas") {
                        $idPregunta = substr($key, 9, strlen($key));

                        $contenedor.="(R.ID_PREGUNTA='$idPregunta' AND R.RESPUESTA='$value') OR ";
                    }
                }
                $r = $this->loadModel("Respuestas");

                $condicional = substr($contenedor, 0, strlen($contenedor) - 4) . ") AND ID_USUARIO='$_SESSION[identificador_temporal_olvido_contrasena]'";

                if ($r->consultarRespuestas($condicional) == "3") {
//                    echo "aquí";
                    $this->view->setParams($_SESSION["identificador_temporal_olvido_contrasena"], 'usuario');
                } else {
                    $this->view->setError("Usted no respondió correctamente las preguntas");
                }
            } elseif ($_POST["tipo"] == "3") {
                if ($u->cambiarContrasena($_SESSION["identificador_temporal_olvido_contrasena"], $_POST["contrasena"]) == "1") {
                    $this->view->setMensaje("Cambio de contraseña exitoso");
                }
            }
        }
        $this->view->setTitle("Recordar contraseña");
        $this->view->renderize("recordarContrasena");
    }

    public function logout() {
        require ROOT . '/config/fbApi/facebook.php';

        $facebook = new Facebook(array(
            'appId' => '1681772598704166',
            'secret' => '4b6804fc91280077edf58ebb3a55a4e2'
        ));

        $facebook->destroySession();
        echo "<script>window.location.href='" . BASE . "'</script>";
        die();
    }

}
?>