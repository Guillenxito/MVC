<?php

class DB {

    private $connection;

    public function __construct(
                                $db_user,
                                $db_password,
                                $db_name,
                                $db_host="localhost",
                                $db_type="mysql"
                                ) 
    {
        try {
            // el localhost podria cambiar para conectarse a un servidor remoto
            $this->connection = new PDO("$db_type:host=$db_host;dbname=$db_name",$db_user,$db_password);
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }//catch
    }//construct

    // $db->execute("select * from articulos where id = ?");
    public function ejecutar($sql, ...$params)
    {
        if (!$this->connection) {
            return false;
        }
        try {

            $sentenciaSQL = $this->connection->prepare($sql);
            $sentenciaEjecutada = $sentenciaSQL->execute($params);
            
            if (!$sentenciaEjecutada) {
                // echo "<pre>";
                // echo print_r($this->connection->errorInfo());
                var_dump($this->connection->errorInfo());
                // echo "</pre>";
                return null;
            }else{
                $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }

        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            return false;
        }
    }//execute
    public function getLastId()
    {
        return $this->connection->lastInsertId();
    }

    public function escape($str) {
        return mysqli_escape_string($this->connection, $str);
    }

    public function __destruct()
    {
        $this->connection = null;
    }

}

?>
