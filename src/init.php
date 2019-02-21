<?php 

function startsWith($haystack, $needle)
{
    $lenght = strlen($needle);
    return (substr($haystack, 0, $lenght) === $needle);
}//startsWith

// Esta funcion buscara nombres de clases que tengan
// el nombre buscado, lo buscara e intentara incluirlo.
// SOLO vale para clases

// Esta funcion sustituye al require de cada pagina, 
// primero ira buscando si es un "Controller", si no,
// buscar un "model", si no, carga desde la ruta raiz el archivo
// con el nombre de la clase

// Esta funcion ira buscando el nombre de la clase que hayas usado
// e ira comprobando hata que la encuentre, si no existe 
// la app fallara

// Las CONSTANTES SE PODRAN USAR EN TODO EL PROYECTO
spl_autoload_register(function ($nombre_clase) {
    $ruta_a_clase = ROOT.DS."src".DS;
    // Si comienza por "Cotroller"
    //     /src/controller/<nombre>    
    
    if (startsWith($nombre_clase, "Controller")) {
        $ruta_a_clase .= "Controller".DS.$nombre_clase;
    }else if (startsWith($nombre_clase, "Model")) {
        $ruta_a_clase .= "Model".DS.$nombre_clase;
    }else if (startsWith($nombre_clase, "Field")) {
        $ruta_a_clase .= "Field".DS.$nombre_clase;
    }else{
        $ruta_a_clase .= $nombre_clase;
    }
    $ruta_a_clase .=".php";
    
    require($ruta_a_clase);

});

require(ROOT.DS."config".DS."config.php");
?>