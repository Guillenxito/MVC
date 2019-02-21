<?php 
/**Es una clase Singleotn, se instancia un array de rutas */
class Config 
{
    private static $configuracion = array();

    // Obtiene valores de la configuracion
    public static function  get($key)
    {
        if(self::$configuracion[$key]){
            return self::$configuracion[$key];
        }else{
            return null;
        }
    }//get
    // EStablece valores de configuracion
    public static function set($key, $val)
    {
        self::$configuracion[$key] = $val;
    }

}//Config


?>