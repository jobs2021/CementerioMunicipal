<?php

switch ($_POST['actionId']) {
    case '1': // add
        CrearCementerio($_POST['nombre'],$_POST['direccion'],$_POST['tipo'],$_POST['area'],$_POST['legalidad'],$_POST['panteonero']);
        break;
   case '2': // update
        UpdateCementerio($_POST['idCementerio'],$_POST['nombre'],$_POST['direccion'],$_POST['tipo'],$_POST['area'],$_POST['legalidad'],$_POST['panteonero']);
        break;
   case '3': // delete
        DeleteCementerio($_POST['idCementerio']);
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

function UpdateCementerio($id,$nombre,$direccion,$tipo,$area,$legalidad,$panteonero){
    if (isset($id) && isset($nombre) && isset($direccion) && isset($tipo) && isset($area) && isset($legalidad) && isset($panteonero)) {
            $update = new ConexionDB();
            $update->Query("update Cementerios set Nombre='{$nombre}',Direccion='{$direccion}',Tipo='{$tipo}',Area='{$area}',Legalizado='{$legalidad}',Panteonero='{$panteonero}' where idCementerio='{$id}';");

            header("location:{$server}/admincementerio/{$id}");
            exit();
    }
}

function DeleteCementerio($id){
    if (isset($id)) {
            $update = new ConexionDB();
            $update->Query("delete from Cementerios where idCementerio='{$id}';");

            header("location:".$server.'/cementerios/');
            exit();
    }
}

?>