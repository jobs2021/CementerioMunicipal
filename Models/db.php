<?php

class ConexionDB{

    private $Server = "localhost";
    private  $User="root";

    private  $Password="cementerio123";
    private  $DataBaseName="cementerio";


    function Query($query){
        $conexion = mysqli_connect($this->Server,$this->User,$this->Password) or die("no se pudo conectar");
        mysqli_select_db($conexion,$this->DataBaseName) or die("no se puede seleccionar la base");
        mysqli_query($conexion,"SET NAMES 'UTF8'");
      
        @$result=mysqli_query($conexion,$query) or die("no se puede ejecutar la consulta");
        @$datos=array();
        
        while (@$dato=mysqli_fetch_assoc($result)){
            array_push($datos, $dato);
        }
        mysqli_close($conexion);

        if (empty($datos)) {
            return -1;
        }
        return $datos;

    }

}

?>