<?php

// el modelo es quien genera los datos o hace la consulta 
// No extendera de Base Model por que no tiene base de datos para las consultas
class ModelNumeros 
{
    public function getAleatorios($n)
    {
        $data = [];
        for ($i=0; $i < $n; $i++) { 
            $data[] = mt_rand(0,100);
        }
        return $data;
    }

}//ModelNumeros


?>