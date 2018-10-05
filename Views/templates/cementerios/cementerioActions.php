<?php

switch ($_POST['actionId']) {
    case '1': // add
        CrearCementerio($_POST['nombre'],$_POST['direccion'],$_POST['tipo'],$_POST['area'],$_POST['legalidad'],$_POST['panteonero']);
        break;
   case '2': // update
        # code...
        break;
   case '3': // delete
        # code...
        break;    
    
    default:
        echo "nada";
        break;
}


function CrearCementerio($nombre,$direccion,$tipo,$area,$legalidad,$panteonero){
    if (isset($nombre) && isset($direccion) && isset($tipo) && isset($area) && isset($legalidad) && isset($panteonero)) {
            $insert = new ConexionDB();
            $insert->Query("insert into Cementerios (Nombre,Direccion,Tipo,Area,Legalizado,Panteonero) values ('{$nombre}','{$direccion}','{$tipo}','{$area}','{$legalidad}','{$panteonero}');");

            $idNuevo=$insert->Query("select idCementerio from Cementerios order by idCementerio desc limit 1");

            header("location:".$server.'/admincementerio/'.$idNuevo[0]['idCementerio']);
            exit();


    }


}

/*
    // Crear cementerio
    if (isset($_POST['nombre']) && isset($_POST['direccion']) && isset($_POST['tipo']) && isset($_POST['area']) && isset($_POST['legalidad']) && isset($_POST['panteonero'])) {
        # code...
    $insert = new ConexionDB();
    $insert->Query("insert into Cementerios (Nombre,Direccion,Tipo,Area,Legalizado,Panteonero) values ('".$_POST['nombre']."','".$_POST['direccion']."','".$_POST['tipo']."',".$_POST['area'].",".$_POST['legalidad'].",'".$_POST['panteonero']."');
        ");
    $idNuevo=$insert->Query("select idCementerio from Cementerios order by idCementerio desc limit 1");
            header("location:".$server.'/admincementerio/'.$idNuevo[0]['idCementerio']);
            exit();


    }else{
        //aignar valores
        $enlacesController = $_GET['action'];
        $enlacesController=explode('/', $enlacesController);

        $conexion = new ConexionDB();
        $values = $conexion->Query("select * from Cementerios where idCementerio='".$enlacesController[1]."'");
        if ($values==-1) {
            header("location:".$server.'/cementerios');
            exit();
        }
        $cementerio = new Cementerio($values[0]);
        $tipoParcela = $conexion->Query("select * from TipoParcela");

    }

*/
?>