<?php 

class BaseModel  
{
    protected $db;
    protected static $lista_info;
    private $data;

    private function estaEnLaListaDatos($nombre){
    	return in_array($nombre, static::$lista_info);
    }

	public function __construct($data_row = []) {
        $this->db = App::getDB();

        if (count($data_row) == 0) {
        	$this->data = array_fill_keys(static::$lista_info, null);
        }else{
        	$this->data = array_combine(static::$lista_info, $data_row);
        }
    }

    public function __call($nombre,$dato){
    	$dato_pedido = strtolower(substr($nombre, 3));
    	$accion = substr($nombre, 0,3);
    	if (!$this->estaEnLaListaDatos($dato_pedido)) {
    		return "Error";
    	}

    	if ($accion == "get") {
    		return $this->data[$dato_pedido];
    	}else if($accion == "set"){
			$this->data[$dato_pedido] = $dato[0];
    	}
    }

    public static function getAll($page = 0, $num = 10)
    {

        $db = App::getDB();//Solo devuelve la DB

        $nombre_clase = get_called_class();
        $nombre_table = strtolower(substr($nombre_clase, 5));
        $camposSelect = implode(', ', static::$lista_info);
        $resultado = $db->ejecutar("SELECT $camposSelect FROM $nombre_table");
        $resultado = array_map(function($datos) {
            return new ModelNoticia($datos);
        },$resultado);
        return $resultado;
    }//getAllNoticias

    public static function getById($id)
    {
        $db = App::getDB();//Solo devuelve la DB

        $nombre_clase = get_called_class();
        $nombre_table = strtolower(substr($nombre_clase, 5));
        $camposSelect = implode(',', static::$lista_info);

        $resultado = $db->ejecutar("SELECT $camposSelect FROM $nombre_table WHERE id = ?",$id);
        // return $resultado;
        return new $nombre_clase($resultado[0]);
    }//getById

       public function save()
    {
        $db = App::getDB();//Solo devuelve la DB

        $nombre_clase = get_called_class();
        $nombre_table = strtolower(substr($nombre_clase, 5));
        $camposSelect = implode(',', static::$lista_info);
        $camposInsert = implode(',', array_slice(static::$lista_info, 1) );
        $parametrosInsert = implode(',',array_fill(0, count(static::$lista_info)-1,"?"));
        $id = $this -> data['id'];

        if ($this->getId() == null) {
            echo "INSSERT";
            $resultado = "INSERT INTO $nombre_table ($camposInsert)  VALUES ($parametrosInsert)";

            $resultado = $this->db->ejecutar($resultado, ...array_values(array_slice($this->data,1)));

            if (is_array($resultado)) {
                $this->setId($this->db->getLastId());
                $resultado []= $this->getId();
            }
            return $resultado;

            
        }
        else{
            
            $campos_up_completos = "";
            $campos_up = array_slice(static::$lista_info,1);

            foreach ($campos_up as $value) {
                $campos_up_completos  .= "$value=?,";
            }//forE
            $campos_up_completos = substr($campos_up_completos,0, strlen($campos_up_completos) - 1);

            $sql_update = "UPDATE $nombre_table set $campos_up_completos where id = ".$this->getId();

            $resultado = $this->db->ejecutar($sql_update,...array_values(array_slice($this->data,1)));
            
            if (is_array($resultado)) {
                $this->setId($this->db->getLastId());
                $resultado []= $this->getId();
            }
            return $resultado;
        }//else
    }//save

    public function toArray(){
        return $this->data;
    }

}//BaseModel


?>