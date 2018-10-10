<?php

switch ($_POST['actionId']) {
    case '1': // registra un nuevo ciudadano para luego ser titular
        CrearCiudadanoTitulo($_POST['nombre'],$_POST['apellido'],$_POST['direccion'],$_POST['dui'],$_POST['profesion'],$_POST['fecha'],$_POST['tipo'],$_POST['numero'],$_POST['idParcela']);
        break;
   case '2': // update
        UpdateCementerio($_POST['idCiudadano'],$_POST['nombre'],$_POST['apellido'],$_POST['direccion'],$_POST['dui'],$_POST['profesion'],$_POST['fecha']);
        break;
   case '3': // delete
        DeleteCementerio($_POST['idCiudadano']);
        break;
    case '4': // Selecciona la parcela en finalizartitulo
        ObtenerParcela($_POST['idParcela']);
        break;
    case '5': //registra un nuevo titulo
        CrearTitulo($_POST['tipo'],$_POST['numero'],$_POST['idCiudadano'],$_POST['idParcela']);
}


function CrearCiudadanoTitulo($nombre,$apellido,$direccion,$dui,$profesion,$fecha,$tipo,$numero,$idParcela){
    if (isset($nombre) && isset($apellido) && isset($direccion) && isset($dui) && isset($profesion) && isset($fecha) && isset($tipo) && isset($numero) && isset($idParcela)) {
            $insert = new ConexionDB();
            $insert->Query("insert into ciudadanos (NombresCiudadano,ApellidosCiudadano,FechaNacimiento,Profesion,Domicilio,DUI) values ('{$nombre}','{$apellido}','{$fecha}','{$profesion}','{$direccion}','{$dui}');");
            
            $idCiudadano=$insert->Query("select idCiudadano from Ciudadanos order by idCiudadano desc limit 1");

            $insert->Query("insert into titulos (idParcela,idTipoTitulo,NumeroTitulo,idCiudadanoTitular) values ({$idParcela},{$tipo},'{$numero}',{$idCiudadano[0]['idCiudadano']})");
        
        header("location:".$server.'/titulos');
            exit();
    } else {
        echo "error en datos";
    }
}

function ObtenerParcela($idParcela){
    $insert = new ConexionDB();
    
    header("location:".$server.'/creartitulo/'.$idParcela);
            exit();
    }

function CrearTitulo($tipo,$numero,$idCiudadano,$idParcela){
    if (isset($tipo) && isset($numero) && isset($idCiudadano) && isset($idParcela)) {
        $insert = new ConexionDB();
        $insert->Query("insert into titulos (idParcela,idTipoTitulo,NumeroTitulo,idCiudadanoTitular) values ({$idParcela},{$tipo},'{$numero}',{$idCiudadano})");
        
        header("location:".$server.'/titulos/');
            exit();
    }
}
/*function UpdateCementerio($id,$nombre,$direccion,$tipo,$area,$legalidad,$panteonero){
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
*/
?>
