<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MedicamentoController
 *
 * @author jcaperap
 */
class MedicamentoController extends Controller {
    //put your code here
    private $medicamento;
    private $tipoMedicamento;
    private $bodega;
    public function __construct() {
        parent::__construct();
        if (!$this->sesionIniciada()) {

            header("Location:" . BASE . DS . 'index' . DS);
        }
        $this->medicamento= $this->loadModel("Medicamento");
        $this->tipoMedicamento= $this->loadModel("TipoMedicamento");
        $this->bodega= $this->loadModel("Bodega");
                $this->crearMenu($menu2, "medicamento/registrarMedicamento", 'Registrar medicamento');
                $this->crearMenu($menu2, "medicamento/consultarMedicamentos", 'Consultar medicamentos');
        $this->view->setMenu2($menu2);
    }
    public function index() {
        
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
//        $this->crearMenu($menu2, "administrador/registrarMedicamento", 'Registrar medicamento');
//        $this->view->setMenu2($menu2);

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
//        $this->crearMenu($menu2, "administrador/registrarMedicamento", 'Registrar medicamento');
//        $this->view->setMenu2($menu2);
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
}
