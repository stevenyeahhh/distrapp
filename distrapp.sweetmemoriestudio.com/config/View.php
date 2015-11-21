<?php

class View {

    private $controller;
    private $title;
    private $jsScripts;
    private $viewPath;
    private $controllerPath;
    private $error;
    private $params;
    private $mensaje;
    private $barmenu;
    private $barmenu2;
    private $tablas;
    private $msgBienvenida;

    public function __construct($controller) {
        $this->controller = strtolower($controller);
        $this->jsScripts = array();
        $this->barmenu2= array();
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }
    public function setMsgBienvenida($msgBienvenida) {
        $this->msgBienvenida=$msgBienvenida;
    }
    public function setError($error) {
        $this->error = $error;
    }

    public function renderize($view) {

        $this->controllerPath = BASE . DS . $this->controller . DS;
        $this->viewPath = BASE . 'views' . DS . $this->controller . DS;
        $paramsPath = ROOT . 'views/layout/' . DEFAULT_LAYOUT . '/';
        $layout = array(
            'css' => $paramsPath . 'css/',
            'img' => $paramsPath . 'img/',
            'js' => $paramsPath . 'js/'
        );

        $viewPath = ROOT . 'views' . DS . $this->controller . DS . $view . '.phtml';
//        echo $viewPath;

        if (is_readable($viewPath)) {
            include_once ROOT . 'views' . DS . 'layout' . DS . 'header.phtml';
            include_once $viewPath;
            include_once ROOT . 'views' . DS . 'layout' . DS . 'footer.phtml';
        }
    }

    public function setJs(array $js) {
        $this->jsScripts = $js;
    }

    public function setParams($param, $name) {
        $this->params[$name] = $param;
    }

    public function setMenu($menu) {
        $this->barmenu = $menu;
    }
    public function setMenu2($menu) {
//        var_dump($this->barmenu2 );
//        echo "<hr/>";
//        var_dump($menu);
        $this->barmenu2 = $menu;
        
//        array_push($this->barmenu2, $menu);
//        var_dump($this->barmenu2);
    }
    public function agregarTabla($tabla,array $columnas,$nombreTabla,$both){
        $this->tablas[]=array("tabla"=>$tabla,"columnas"=>$columnas,"NOMBRE_TABLA"=>$nombreTabla,"ENC"=>$both);
    }
    public function crearTabla($pdoStatement,array  $columnas,$nombreTabla,$urlConsultar,$urlAjax) {
        echo '<script>$(document).ready(function() {
                crearBootstrapSwitch(".slider-tabla", "'.$urlAjax.'")
            })</script>';
        echo "<div class='table-responsive'>";
        echo "<table class='table table-hover '>";
        $tablaDatos = $pdoStatement;
        $columnasNumero = count($tablaDatos, COUNT_RECURSIVE);
        $totalColumnas=$tablaDatos->columnCount();

        for ($j = 0; $j < $totalColumnas; $j++) {
            echo "<th>";
            if (isset($columnas[$j])) {
                echo $columnas[$j];
            } else {
//                echo "-";
                echo $tablaDatos->getColumnMeta($j)["name"];
            }
            echo "</th>";
        }
        $tablaDatos=$tablaDatos->fetchAll(PDO::FETCH_NUM);
        $totalFilas=count($tablaDatos);
        for ($p = 0; $p < count($tablaDatos); $p++): 
            echo "<tr>";
            for ($h = 0; $h < $totalColumnas; $h++):
                echo "<td>";
                if($h==0){
                    echo "<a href='$urlConsultar/".$tablaDatos[$p][0]."'>".$tablaDatos[$p][0]."</a>";
                }else{
                    if($h === ($totalColumnas-1)){

                       echo "<input type='checkbox' class='slider-tabla'  ".(( $tablaDatos[$p][$h]==1)?"checked":"")." value='".$tablaDatos[$p][0]."'/>";
                    }else{                    
                        echo $tablaDatos[$p][$h];                    
                    }
                }
                echo "</td>";                
            endfor;
            echo "</tr>";
        endfor;
        

        echo "</table>";
        echo "</div>";
    }
    

}

?>