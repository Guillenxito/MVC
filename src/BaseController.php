<?php

/** 
 * Controlador base que heredaran el resto de controladores
*/
class BaseController  
{
    protected $data;
    protected static $requiere_autentificacion = [];
    public function __construct() {
        $this->data = [];
    }
    // Esta funcion rellenara los datos
    public function procesaAccion($metodo, $parametros)
    {
        if(
            in_array($metodo, static::$requiere_autentificacion) &&
            (Session::getInstance())->get('AUTH') != true
          ) {
            App::getRouter()::redirect('/usuario/login');
        }
        // Al poner los "..." al principio, hace que los parametros
        // sean variables que se iran pasando 1 a 1
        $this->$metodo(...$parametros);
        $vista = new View();
        return $vista->render($this->data);
        
    }//procesaAccion
    
}//BaseController


?>

