<?php 

class Router  
{
    // Elmentos que se buscaran de la URI
    private $uri;
    private $controlador;
    private $accion;
    private $params;

    public function __construct($uri) 
    {
        $this->uri = $uri;

        if ($uri == "/") {
            $this->redirect(Config::get("ruta.defecto"));
        }

        // Quitamos la "/" de inicio o de final
        // $url_procesada = trim($uri,"/");
        // Al seperar con "?" se olvida de las variables ya que las cogera luego por GET
        $url_procesada = explode("?",$uri);
        $url_procesada = trim($url_procesada[0],"/");
        $url_partes = explode("/",$url_procesada);
        
        // Si la ruta no es la root, proceso la url, si no, no hago nada
        if (count($url_partes) != 0) {
            // Obtengo en controlador si hay
            // EStablece que los primeros elementos de la URL seran las "carpetas padre"
            // por eso usa el shift para establecer las carpetas y establece
            // que el resto de "carpeta" son los parametros, pero no son params por GET
            if (current($url_partes)) {
                $this->controlador = array_shift($url_partes);
            }
            // Obtengo accion si hay
            if (current($url_partes)) {
                $this->accion = array_shift($url_partes);
            }
            $this->params = $url_partes;

        }//if
    }//construct

    public function getUri()
    {
        return $this->uri;
    }
    public function getControlador()
    {
        return $this->controlador;
    }
    public function getAccion()
    {
        return $this->accion;
    }
    public function getParams()
    {
        return $this->params;
    }
    public static function redirect($url)
    {
        header("location:$url");
        die();
    }
    
}//Router


?>