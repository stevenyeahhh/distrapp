<?php

class PreguntasController extends Controller {

    private $p;

    public function __construct() {
        parent::__construct();
//        if (!$this->sesionIniciada()) {
//
//            header("Location:" . BASE . DS . 'index' . DS);
//        }
        $this->p = $this->loadModel("Preguntas");
    }

    public function index() {
        
    }

    public function crearPreguntas() {
        $validar=$this->validar(array_merge(array('descripcion'=>array('required'=>true))));
        $this->view->setValidacion($validar->getCamposJSON());
//        echo 
        if ($_POST) {
            $validar->setValores($_POST);
            $validar->validarServidor();
//            extract($_POST);
//            $this->p->setDescripcion($descripcion);
//            if ($this->p->insertPreguntas()) {
//                $this->view->setMensaje("Insertó correctamente");
//            } else {
//                $this->view->setError("Ocurrió un error");
//            }
        } else {
            
        }
        $this->view->setJs(array("validate"));
        $this->view->setParams($this->p->selectPreguntas(), "PREGUNTAS");
        $this->view->setTitle("Crear Preguntas");
        $this->view->renderize("crearPreguntas");
    }

    public function responder() {
        if (!$this->sesionIniciada()) {

            header("Location:" . BASE . DS . 'index' . DS);
        }
        $usuario = $this->getSesionVar('IDENTIFICADOR');

        if ($_POST) {
            $respuesta = $this->loadModel("Respuestas");

            $respuesta->setidUsuario($usuario);

            $controlador = true;
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 8) == "pregunta") {
                    $idPregunta = substr($key, 8, strlen($key));
                    if (trim($value) != "") {
                        $respuesta->setIdPreguntas($idPregunta);
                        $respuesta->setRespuesta($value);
                        if (!$respuesta->insertPreguntas()) {
                            $controlador = false;
                        }
                    }
                }
            }
            if ($controlador) {
                $this->view->setMensaje("Insertó correctamente");
            } else {
                $this->view->setError("Ocurrio un error");
            }
        } else {
            
        }
        $this->view->setParams($this->p->selectRespuestas($usuario), "PREGUNTAS");
        $this->view->setTitle("Crear Preguntas");
        $this->view->renderize("responder");
    }

}

?>
