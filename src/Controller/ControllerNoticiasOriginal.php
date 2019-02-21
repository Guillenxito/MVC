<?php 

class ControllerNoticias extends BaseController
{
    public function list()
    {
        // Trabajo con modelos
        // Aqui se asignan los datos obtenidos de ls BBDD
        $this->data = [
            "noticia1",
            "noticia2",
            "noticia3",
        ];
    }//list
    // Funcion que mostrara una noticia en concreto con el ID pasado
    public function show($id)
    {
        $datos_modelo = [
            "Noticia 1:<br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic eaque dolor vero perspiciatis, corrupti est officia beatae nisi? Voluptatibus nostrum commodi accusamus expedita iure quod non voluptates iste aliquam distinctio.",
            "Noticia 2:<br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic eaque dolor vero perspiciatis, corrupti est officia beatae nisi? Voluptatibus nostrum commodi accusamus expedita iure quod non voluptates iste aliquam distinctio.",
            "Noticia 3:<br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic eaque dolor vero perspiciatis, corrupti est officia beatae nisi? Voluptatibus nostrum commodi accusamus expedita iure quod non voluptates iste aliquam distinctio.",
        ];
        
        // Se vuelve a castear los $datos_modelo, ya que antes eran una cadena

        // El id se le pasa como param dentro de noticias: http://mvc-todo.io/noticias/show/0
        // Al ser un array, se usan los ids de arrays
        $this->data["titulo"] = "algo";
        $this->data["id"] = $id;
        $this->data["contenido"] = $datos_modelo[$id];
    }//show
}//ControllerDWES


?>
