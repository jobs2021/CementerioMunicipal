<?php

class ConexionDB{
    private  $Server="192.168.43.39";
    private  $User="root_";
    private  $Password="cementerio123";
    private  $DataBaseName="cementerio";


    function Query($query){
        $conexion = mysqli_connect($this->Server,$this->User,$this->Password) or die("no se pudo conectar");
        mysqli_select_db($conexion,$this->DataBaseName) or die("no se puede seleccionar la base");
        mysqli_query($conexion,"SET NAMES 'UTF8'");
        
        $result=mysqli_query($conexion,$query) or die("no se pueded ejecuatar la consulta");
        $datos=array();
        while ($dato=mysqli_fetch_assoc($result)){
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