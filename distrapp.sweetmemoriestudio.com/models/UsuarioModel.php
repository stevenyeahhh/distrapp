<?php

class UsuarioModel extends Model {

    private $id;
    private $nombre;
    private $apellido;
    private $contrasena;
    private $telefono;
    private $identificador;
    private $estado;
    private $idRol;
    private $errores;
    private $campos;

    public function setIdRol($idRol) {
        $this->idRol = $idRol;
    }

        public function __construct() {

        $errores = array();

        $this->campos = "nombre,apellido,id,contrasena,telefono,id_rol";
    }

    public function setNombre($nombre) {

        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {

        $this->apellido = $apellido;
    }

    public function setId($id) {

        $this->id = $id;
    }

    public function setContrasena($contrasena) {

        $this->contrasena = $contrasena;
    }

    public function setTelefono($telefono) {

        $this->telefono = $telefono;
    }

    public function validar($tipo) {

        if ($tipo == 1) {

            $controlador = true;

            if (empty($this->nombre)) {

                $this->errores['nombre'] = "Campo vacio";

                $controlador = false;
            }

            if (empty($this->apellido)) {

                $this->errores['apellido'] = "Campo vacio";

                $controlador = false;
            }

            if (empty($this->id)) {

                $this->errores['id'] = "Campo vacio";

                $controlador = false;
            }

            if (empty($this->contrasena)) {

                $this->errores['contrasena'] = "Campo vacio";

                $controlador = false;
            }

            if (empty($this->telefono)) {

                $this->errores['telefono'] = "Campo vacio";

                $controlador = false;
            }
        } elseif ($tipo == 2) {

            $controlador = true;

            if (empty($this->id)) {

                $this->errores['id'] = "Campo vacio";

                $controlador = false;
            }

            if (empty($this->contrasena)) {

                $this->errores['contrasena'] = "Campo vacio";

                $controlador = false;
            }
        }



        return $controlador;
    }

    public function getSQL($var) {

        return $var == 1 ? "'$this->nombre','$this->apellido','$this->id','$this->contrasena','$this->telefono','$this->idRol'" :
                "nombre='$this->nombre',apellido='$this->apellido',id='$this->id',contrasena='$this->contrasena',telefono ='$this->telefono'";
    }

    public function insertar() {

        return Singleton::getInstance()->db->insertQuery("USUARIO", $this->campos, self::getSQL(1));
    }

    public function getCampos() {

        return $this->campos;
    }

    public function getErrores() {

        return $this->errores;
    }

    public function setIdentificador($identificador) {

        $this->identificador = $identificador;
    }

    public function iniciarSesion() {

        $usuario = Singleton::getInstance()->db->query(" SELECT U.IDENTIFICADOR,U.NOMBRE,U.APELLIDO,U.ID,U.CONTRASENA,U.TELEFONO,U.ESTADO,U.ID_ROL,R.DESCRIPCION FROM USUARIO U JOIN ROL R ON (R.ID_ROL=U.ID_ROL) WHERE U.ID='$this->id' AND U.CONTRASENA='$this->contrasena' AND U.ESTADO='1'");




        $data = $usuario->fetch();


        $this->identificador = $data['IDENTIFICADOR'];



        $_SESSION['NOMBRE'] = $data['NOMBRE'];

        $_SESSION['APELLIDO'] = $data['APELLIDO'];

        $_SESSION['ID'] = $data['ID'];

        $_SESSION['IDENTIFICADOR'] = $data['IDENTIFICADOR'];

        $_SESSION['ID_ROL'] = $data['ID_ROL'];

        $_SESSION['ROL'] = $data['DESCRIPCION'];

        return $usuario->rowCount();
    }

    public static function cerrarSesion() {

        session_destroy();
    }

    public static function getUsuario($id) {

//        return Singleton::getInstance()->db->selectQuery("USUARIO", "*", "identificador='$id'")->fetch(PDO::FETCH_ASSOC);
        return Singleton::getInstance()->db->query("SELECT U.IDENTIFICADOR,U.NOMBRE,U.APELLIDO,U.ID,U.CONTRASENA,U.TELEFONO,U.ESTADO,U.ID_ROL,R.DESCRIPCION FROM USUARIO U JOIN ROL R ON (R.ID_ROL=U.ID_ROL) WHERE U.IDENTIFICADOR='$id'")->fetch(PDO::FETCH_ASSOC);
    }

    public static function getSesion($variable) {

        return $_SESSION[$variable];
    }

    public function actualizar() {

        return Singleton::getInstance()->db->updateQuery("USUARIO", self::getSQL(2), " identificador ='$this->identificador'");
    }

    public function inhabilitar() {

        return Singleton::getInstance()->db->updateQuery("USUARIO", "estado ='0'", " identificador ='$this->identificador'");
    }

    public function getUsuarios() {
        return Singleton::getInstance()->db->query("SELECT U.IDENTIFICADOR,U.NOMBRE,U.APELLIDO,U.ID,U.CONTRASENA,U.TELEFONO,R.DESCRIPCION,U.ESTADO FROM USUARIO U JOIN ROL R ON (R.ID_ROL=U.ID_ROL) WHERE U.ID_ROL!='".ROL_ADMINISTRADOR."'");
    }
    public function getUsuariosCliente() {
        return Singleton::getInstance()->db->selectQuery("USUARIO", "*", " ID_ROL='".ROL_CLIENTE."'")->fetchAll(PDO::FETCH_BOTH);
    }
    public function getUsuariosRepartidor() {
        return Singleton::getInstance()->db->selectQuery("USUARIO", "*", " ID_ROL='".ROL_REPARTIDOR."'")->fetchAll(PDO::FETCH_BOTH);
    }

    public static function cambiarEstadoUsuario($idusuario, $estado) {

        return Singleton::getInstance()->db->updateQuery("USUARIO", "estado ='$estado'", " identificador ='$idusuario'")->rowCount();
    }

    public static function getUsuarioById($id) {

        return Singleton::getInstance()->db->selectQuery("USUARIO", "*", "ID='$id'")->fetch(PDO::FETCH_ASSOC);
    }

    public static function cambiarContrasena($identificador, $contrasena) { 
        return Singleton::getInstance()->db->updateQuery("USUARIO", "contrasena='$contrasena'", " identificador='$identificador'")->rowCount();
    }
    public function getUsuariosCountPorEstado() { 
        return Singleton::getInstance()->db->selectQuery("USUARIO", "COUNT(*) CNT , (CASE WHEN ESTADO = 1 THEN 'ACTIVO' ELSE 'NO ACTIVO' END) descripcion" , "1 group by (CASE WHEN ESTADO = 1 THEN 'ACTIVO' ELSE 'NO ACTIVO' END)")->fetchAll(PDO::FETCH_ASSOC);
//        return Singleton::getInstance()->db->selectQuery("USUARIO", "SUM(case WHEN ESTADO=1 THEN 1 ELSE 0 END )\"ACTIVOS\", SUM( case WHEN ESTADO=0 THEN 1 ELSE 0 END ) \"NO ACTIVOS\"" , "")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUsuariosCountPorRoles() { 
        return Singleton::getInstance()->db->selectQuery("USUARIO u join ROL r on (u.id_rol=r.id_rol) ", " count(*)CNT , r.descripcion","1 group by r.descripcion" )->fetchAll(PDO::FETCH_ASSOC);
//        return Singleton::getInstance()->db->selectQuery("USUARIO", "SUM(case WHEN id_rol=1 THEN 1 ELSE 0 END )\"ADMINISTRADOR\", SUM( case WHEN id_rol=2 THEN 1 ELSE 0 END ) \"REPARTIDORES\", SUM( case WHEN id_rol=2 THEN 1 ELSE 0 END ) \"CLIENTE\"" , "")->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>