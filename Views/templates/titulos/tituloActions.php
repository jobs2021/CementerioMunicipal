<?php

switch ($_POST['actionId']) {
    case '1': // registra un nuevo ciudadano para luego ser titular
        CrearCiudadanoTitulo($_POST['nombre'],$_POST['apellido'],$_POST['direccion'],$_POST['dui'],$_POST['profesion'],$_POST['fecha'],$_POST['tipo'],$_POST['numero'],$_POST['idParcela']);
        break;
   case '2': // update
        UpdateCementerio($_POST['idCiudadano'],$_POST['nombre'],$_POST['apellido'],$_POST['direccion'],$_POST['dui'],$_POST['profesion'],$_POST['fecha']);
        break;
   case '3': // delete
        CancelarTitulo($_POST['idTitulo'], $_POST['Observaciones']);
        break;
    case '4': // Selecciona la parcela en finalizartitulo
        ObtenerParcela($_POST['idParcela']);
        break;
    case '5': //registra un nuevo titulo
        CrearTitulo($_POST['tipo'],$_POST['numero'],$_POST['idCiudadano'],$_POST['idParcela']);
        break;
    case '6': //obtiene la parcela y redirecciona a arrendamientocrear
        ObtenerParcelaArrandamiento($_POST['idParcela']);
        break;
    case '7': //crea un arrendamiento
        CrearArrendamiento($_POST['nombre'],$_POST['apellido'],$_POST['direccion'],$_POST['fecha'],$_POST['f1sam'],$_POST['anios'],$_POST['idParcela']);
        break;
    case '8': //reponer titulo
        ReponerTitulo($_POST['numeroTitulo'],$_POST['idTitulo']);
        
        
}


function CrearCiudadanoTitulo($nombre,$apellido,$direccion,$dui,$profesion,$fecha,$tipo,$numero,$idParcela){
    if (isset($nombre) && isset($apellido) && isset($direccion) && isset($dui) && isset($profesion) && isset($fecha) && isset($tipo) && isset($numero) && isset($idParcela)) {
            $insert = new ConexionDB();
            $insert->Query("insert into ciudadanos (NombresCiudadano, ApellidosCiudadano, FechaNacimiento, Profesion, Domicilio, DUI) values ('{$nombre}','{$apellido}','{$fecha}','{$profesion}','{$direccion}','{$dui}');");
            
            $idCiudadano=$insert->Query("select idCiudadano from Ciudadanos order by idCiudadano desc limit 1");

            $insert->Query("insert into titulos (idParcela,idTipoTitulo,NumeroTitulo,idCiudadanoTitular) values ({$idParcela},{$tipo},'{$numero}',{$idCiudadano[0]['idCiudadano']})");
        
        header("location:".$server.'/titulos');
            exit();
    } else {
        echo "error en datos";
    }
}

function ObtenerParcela($idParcela){

    header("location:".$server.'/creartitulo/'.$idParcela);
            exit();
    }

function CrearTitulo($tipo,$numero,$idCiudadano,$idParcela){
    if (isset($tipo) && isset($numero) && isset($idCiudadano) && isset($idParcela)) {
        $insert = new ConexionDB();
        $insert->Query("insert into titulos (idParcela,idTipoTitulo,NumeroTitulo,idCiudadanoTitular) values ({$idParcela},{$tipo},'{$numero}',{$idCiudadano})");
        
        header("location:".$server.'/titulos');
            exit();
    }
}
function CancelarTitulo($idTitulo, $Observaciones){
    $insert = new ConexionDB();
    if (isset($Observaciones)){
        $insert->Query("UPDATE titulos SET Observaciones = '{$Observaciones}', Estado=0 WHERE idTitulo={$idTitulo}");
        
        header("location:".$server.'/repotrastitulo');
    }else{
        $insert->Query("UPDATE titulos SET estado=0 WHERE idTitulo={$idTitulo}");
        
        header("location:".$server.'/repotrastitulo');
    }
}
function ReponerTitulo($numeroTitulo,$idTitulo){
    if ( isset($numeroTitulo) && isset($idTitulo) ){
        $insert = new ConexionDB();
        $value = $insert->Query("SELECT * FROM titulos where idTitulo={$idTitulo}");
        $insert->Query("INSERT INTO titulos (idParcela,idTipoTitulo,NumeroTitulo,idCiudadanoTitular,FechaExpedido,NumeroRecibo,FechaRecibo,Imagen,Observaciones,Estado,Proceso) VALUES ({$value[0]['idParcela']},{$value[0]['idTipoTitulo']},'{$numeroTitulo}',{$value[0]['idCiudadanoTitular']},'{$value[0]['FechaExpedido']}','{$value[0]['NumeroRecibo']}','{$value[0]['FechaRecibo']}','{$value[0]['Imagen']}','{$value[0]['Observaciones']}',{$value[0]['Estado']},{$value[0]['Proceso']})") ;
        
        $insert->Query("UPDATE titulos SET Estado=0 where idTitulo={$idTitulo}");
        
        header("location:".$server.'/repotrastitulo');
    }else{
        
    }
}


function ObtenerParcelaArrandamiento($idParcela){    
    header("location:".$server.'/arrendamientocrear/'.$idParcela);
            exit();
    }
function CrearArrendamiento($nombre,$apellido,$direccion,$fecha,$f1sam,$anios,$idParcela){
    if (isset($nombre) && isset($apellido) && isset($direccion) && isset($fecha) && isset($f1sam) && isset($anios) && isset($idParcela)){
        $insert = new ConexionDB();
        $insert->Query("INSERT INTO pagosarrendamientos (Nombres, Apellidos, Direccion, FechaPago, F1ISAM, Anios, idParcela) VALUES ('{$nombre}', '{$apellido}', '{$direccion}', '{$fecha}', '{$f1sam}', '{$anios}', {$idParcela})");
        
        header("location:".$server.'/arrendamientos');
    }
}




//Traspasar Titulo
function TraspasarTitulo(){
    if ( isset($numeroTitulo) && isset($idTitulo) ){
        $insert = new ConexionDB();
        $value = $insert->Query("SELECT * FROM titulos where idTitulo={$idTitulo}");
        $insert->Query("INSERT INTO titulos (idParcela,idTipoTitulo,NumeroTitulo,idCiudadanoTitular,FechaExpedido,NumeroRecibo,FechaRecibo,Imagen,Observaciones,Estado,Proceso) VALUES ({$value[0]['idParcela']}, 3 ,'{$numeroTitulo}',{$value[0]['idCiudadanoTitular']},'{$value[0]['FechaExpedido']}','{$value[0]['NumeroRecibo']}','{$value[0]['FechaRecibo']}','{$value[0]['Imagen']}','{$value[0]['Observaciones']}',{$value[0]['Estado']},0)") ;
        
        $insert->Query("UPDATE titulos SET Estado=0 where idTitulo={$idTitulo}");
        
        header("location:".$server.'/repotrastitulo');
    }else{
        
    }
}
?>
