<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoMedicamentoModel
 *
 * @author jcaperap
 */
class TipoMedicamentoController extends Controller { 
    private $tipoMedicamento;
    public function __construct() {
        
        parent::__construct();
        if (!$this->sesionIniciada()) {

            header("Location:" . BASE . DS . 'index' . DS);
        }
        $this->tipoMedicamento=$this->loadModel("TipoMedicamento");
        $this->crearMenu($menu2, "tipoMedicamento/registrarTipoMedicamento", 'Registrar tipo medicamento');
        $this->crearMenu($menu2, "tipoMedicamento/consultarTipoMedicamentos", 'Consultar tipo medicamentos');
        $this->crearMenu($menu2, "tipoMedicamento/reporteTipoMedicamentos", 'Reporte tipo medicamentos');
        $this->view->setMenu2($menu2);
    }
    public function index() {
        
    }
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
        $this->view->setTitle("Registrar tipo medicamento");
//				$this->view->setJs(array('validate'));
        $this->view->renderize('registrarTipoMedicamento');
    }

    //Consultar
    public function consultarTipoMedicamentos() {
        echo "en construcción";
        
//        registrarTipoMedicamento

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
    public function reporteTipoMedicamentos() {
        
        $this->view->setTitle("Reporte tipo medicamentos");
//        ECHO "<PRE>";
//        var_dump();
        $this->view->setParams(json_encode($this->tipoMedicamento->getTipoMedicamentoCountEstado()), 'json_tipo_medicamento'); 
//        ECHO "</PRE>";
        $this->view->renderize('reporteTipoMedicamentos');
    
    }
//put your code here
}
