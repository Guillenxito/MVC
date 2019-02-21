<?php 

// ORM: Elementos del MVC que te permite un mapeo de la DB
//     Object 
//     Relational 
//     Maping

// Los ORMs simplifican las consultas de manera que almacenan las 
// consultas mas frecuentes en funciones que se podran llamar cuando
// el cliente las pida por url
// EJ:
//     ModelNoticia::getNoticia();
//     ModelNoticia::getNoticiaDesde('2019/01/01',2);
//     ModelNoticia::getById();

//     $noticia->getTitulo();
//     $noticia->setTexto('lorem...');

//     $noticia->save();

class ModelNoticia extends BaseModel 
{
    private $id;
    private $titulo;
    private $texto;
    private $fecha;
    
    public function __construct($data_row = []) {
        parent::__construct();
        if (count($data_row) > 0) {
            $this->setId($data_row["id"]);
            $this->setTitulo($data_row["titulo"]);
            $this->setTexto($data_row["texto"]);
            $this->setFecha($data_row["fecha"]);
        }
    }
    public function getId()
    {
        return $this->id;
    }//getTitulo
    public function getTitulo()
    {
        return $this->titulo;
    }//getTitulo

    public function getTexto()
    {
        return $this->texto;
    }//getTexto

    public function getFecha()
    {
        return $this->fecha;
    }//getFecha

    public function setId($id)
    {
        $this->titulo = $id;
    }//setTitulo
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }//setTitulo

    public function setTexto($texto)
    {
        $this->texto = $texto;
    }//setTexto

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }//setFecha

    public function save()
    {
        if ($this->id == null) {
            $resultado = $this->db->ejecutar("insert into noticias (titulo, texto, fecha) 
                                values (?,?,?)", 
                                $this->titulo, $this->texto, $this->fecha);
            if (is_array($resultado)) {
                $this->setId($this->db->getLastId());
                $resultado []= $this->getId();
            }
            return $resultado;
            
        }else{
            $resultado = $this->db->ejecutar("update noticias 
                                set titulo = ?,
                                texto = ?,
                                fecha = ?
                                where id = ?",
                                $this->titulo,
                                $this->texto,
                                $this->fecha,
                                $this->id
                              );
            if (is_array($resultado)) {
                $this->setId($this->db->getLastId());
                $resultado []= $this->getId();
            }
            return $resultado;
        }//else
    }//save
    
    public static function getAllNoticias($page = 0, $num = 10)
    {
        $db = App::getDB();//Solo devuelve la DB
        $resultado = $db->ejecutar("select id, titulo, texto, fecha from noticias");
        $resultado = array_map(function($datos) {
            return new ModelNoticia($datos);
        },$resultado);
        return $resultado;
    }//getAllNoticias
}//ModelNoticia



?>