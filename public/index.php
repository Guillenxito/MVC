<?php 

define('DS',DIRECTORY_SEPARATOR); // Permite que la app funcione en windows y linux
// sera la ruta actual de nuestro proyecto
define('ROOT',dirname(dirname(__FILE__))); //File = Fichero actual
define('VIEW_ROOT',ROOT.DS."resources".DS);
require(ROOT.DS."src".DS."init.php");

App::run($_SERVER['REQUEST_URI']);
?>