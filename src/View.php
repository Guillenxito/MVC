<?php

class View  
{
    private $template;

    public function __construct() {
        $enrutador = App::getRouter();


        $this->template = VIEW_ROOT.$enrutador->getControlador().DS.$enrutador->getAccion().".phtml";
        if (!file_exists($this->template)) {
            throw new Exception("Error template no encontrado: $this->template");
            
        }//if
    }//contruct
    public function renderContenido($data = [])
    {
        // Es un buffer de cache, toda la salida se queda en ob_Start
        ob_start();
        include($this->template);
        // Esta funcion devolvera el contenido
        $html_content = ob_get_clean();
        return $html_content;
    }//render
    public function render($data = [])
    {
        $html = $this->renderContenido($data);
        $data = [];
        $data["contenido"] = $html;
        $data["title"] = Config::get("site.name");
        ob_start();
        include(VIEW_ROOT.'base.phtml');
        $html_content = ob_get_clean();
        return $html_content;
    }//render
    
}//View

?>