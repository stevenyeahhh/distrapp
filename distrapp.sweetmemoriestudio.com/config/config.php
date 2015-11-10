<?php 
	define('DS',DIRECTORY_SEPARATOR);
	define('DEFAULT_CONTROLLER', 'Index');
//	define('ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'proyectoInicioSesion'.DS);
	define('ROOT', $_SERVER['DOCUMENT_ROOT'].DS);
	define('DEFAULT_LAYOUT', 'default');
	//define('BASE', 'http://localhost/proyectoInicioSesion/');
//	define('BASE', 'http://'.$_SERVER['SERVER_NAME'].'/proyectoInicioSesion/');
	define('BASE', 'http://'.$_SERVER['SERVER_NAME'].'/');
        define("ROL_ADMINISTRADOR", "1");
        define("ROL_REPARTIDOR", "2");
        define("ROL_CLIENTE", "3");
?>