<?php

switch (@$_POST['actionId']) {
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
if ($_GET['action']){
    BuscarTitulo();
}


function CrearCiudadanoTitulo($nombre,$apellido,$direccion,$dui,$profesion,$fecha,$tipo,$numero,$idParcela){
    if (isset($nombre) && isset($apellido) && isset($direccion) && isset($dui) && isset($profesion) && isset($fecha) && isset($tipo) && isset($numero) && isset($idParcela)) {
            $insert = new ConexionDB();
            $insert->Query("insert into Ciudadanos (NombresCiudadano, ApellidosCiudadano, FechaNacimiento, Profesion, Domicilio, DUI) values ('{$nombre}','{$apellido}','{$fecha}','{$profesion}','{$direccion}','{$dui}');");
            
            $idCiudadano=$insert->Query("select idCiudadano from Ciudadanos order by idCiudadano desc limit 1");

            $insert->Query("insert into Titulos (idParcela,idTipoTitulo,NumeroTitulo,idCiudadanoTitular,Estado) values ({$idParcela},{$tipo},'{$numero}',{$idCiudadano[0]['idCiudadano']},1)");

        //session para enviar notificacion
        session_start();
        $_SESSION['JsonNotification'] = '{ "msg":"Titulo '.$numero.' en Proceso...", "title":"Titulo Nuevo" }';
        
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
        $insert->Query("insert into Titulos (idParcela,idTipoTitulo,NumeroTitulo,idCiudadanoTitular) values ({$idParcela},{$tipo},'{$numero}',{$idCiudadano})");

        //session para enviar notificacion
        session_start();
        $_SESSION['JsonNotification'] = '{ "msg":"Titulo 20381 en Proceso", "title":"Titulo Nuevo" }';

        
        header("location:".$server.'/titulos');
        exit();
    }
}
function CancelarTitulo($idTitulo, $Observaciones){
    $insert = new ConexionDB();
    if (isset($Observaciones)){
        $insert->Query("UPDATE Titulos SET Observaciones = '{$Observaciones}', Estado=0 WHERE idTitulo={$idTitulo}");
        
        header("location:".$server.'/repotrastitulo');
    }else{
        $insert->Query("UPDATE Titulos SET Estado=0 WHERE idTitulo={$idTitulo}");
        
        header("location:".$server.'/repotrastitulo');
    }
}
function ReponerTitulo($numeroTitulo,$idTitulo){
    if ( isset($numeroTitulo) && isset($idTitulo) ){
        $insert = new ConexionDB();
        $value = $insert->Query("SELECT * FROM Titulos where idTitulo={$idTitulo}");
        $insert->Query("INSERT INTO Titulos (idParcela,idTipoTitulo,NumeroTitulo,idCiudadanoTitular,FechaExpedido,NumeroRecibo,FechaRecibo,Imagen,Observaciones,Estado,Proceso) VALUES ({$value[0]['idParcela']},{$value[0]['idTipoTitulo']},'{$numeroTitulo}',{$value[0]['idCiudadanoTitular']},'{$value[0]['FechaExpedido']}','{$value[0]['NumeroRecibo']}','{$value[0]['FechaRecibo']}','{$value[0]['Imagen']}','{$value[0]['Observaciones']}',{$value[0]['Estado']},{$value[0]['Proceso']})") ;
        
        $insert->Query("UPDATE Titulos SET Estado=0 where idTitulo={$idTitulo}");
        
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
        $insert->Query("INSERT INTO PagosArrendamientos (Nombres, Apellidos, Direccion, FechaPago, F1ISAM, Anios, idParcela) VALUES ('{$nombre}', '{$apellido}', '{$direccion}', '{$fecha}', '{$f1sam}', '{$anios}', {$idParcela})");
        
        header("location:".$server.'/arrendamientos');
    }
}




//Traspasar Titulo
function TraspasarTitulo(){
    if ( isset($numeroTitulo) && isset($idTitulo) ){
        $insert = new ConexionDB();
        $value = $insert->Query("SELECT * FROM Titulos where idTitulo={$idTitulo}");
        $insert->Query("INSERT INTO Titulos (idParcela,idTipoTitulo,NumeroTitulo,idCiudadanoTitular,FechaExpedido,NumeroRecibo,FechaRecibo,Imagen,Observaciones,Estado,Proceso) VALUES ({$value[0]['idParcela']}, 3 ,'{$numeroTitulo}',{$value[0]['idCiudadanoTitular']},'{$value[0]['FechaExpedido']}','{$value[0]['NumeroRecibo']}','{$value[0]['FechaRecibo']}','{$value[0]['Imagen']}','{$value[0]['Observaciones']}',{$value[0]['Estado']},0)") ;
        
        $insert->Query("UPDATE Titulos SET Estado=0 where idTitulo={$idTitulo}");
        
        header("location:".$server.'/repotrastitulo');
    }else{
        
    }
}
function BuscarTitulo(){
    $insert = new ConexionDB();

    $salida= "";

    if(isset($_POST['valor'])){
        $q = ($_POST['valor']);
        $query = "SELECT t1.NumeroTitulo, t1.Proceso, t3.Tipo, t4.NombresCiudadano, t4.ApellidosCiudadano, t2.Numero, t5.Nombre, t1.Estado FROM Titulos t1 INNER JOIN Parcelas t2 ON t1.idParcela=t2.idParcela INNER JOIN TipoTitulos t3 ON t1.idTipoTitulo=t3.idTipoTitulo INNER JOIN Ciudadanos t4 ON t1.idCiudadanoTitular=t4.idCiudadano INNER JOIN Cementerios t5 ON t2.idCementerio=t5.idCementerio WHERE t1.NumeroTitulo LIKE '%{$q}%' OR t4.NombresCiudadano LIKE '%{$q}%' OR t4.ApellidosCiudadano LIKE '%{$q}%' OR t2.Numero LIKE '%{$q}%' OR t5.Nombre LIKE '%{$q}%' ORDER BY t1.idTitulo DESC ";
    }
    @$resultado = $insert->query($query);
    $i=0;
    if($resultado != -1){
        $salida.="<div class='table-responsive'>
                            <table class='table'>
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Titulo</th>
                                    <th>Tipo</th>
                                    <th>Cementerio</th>
                                    <th>Parcela</th>
                                    <th>Estado</th>
                                    <th>Proceso</th>
                                    <th></th>
                                </tr>
                            </thead>
                        <tbody>";
       foreach ($resultado as $fila) {
           $i++;
            $salida.="<tr>
                        <td>{$i}</td>
                        <td>{$fila['NombresCiudadano']}</td>
                        <td>{$fila['ApellidosCiudadano']}</td>
                        <td>{$fila['NumeroTitulo']}</td>
                        <td>{$fila['Tipo']}</td>
                        <td>{$fila['Nombre']}</td>
                        <td>{$fila['Numero']}</td>";
                        if($fila['Estado']==1){
                            $salida.= "<td style=\"color: \">Activo</td>";
                        }else{
                            $salida.= "<td style=\"color: \">Inactivo</td>";
                        }
                        if($fila['Proceso']==0){
                            $salida .= "<td style=\"color: forestgreen\">Procesando...</td>";
                        } else if($fila['Proceso']==1){
                            $salida .= "<td >Aprobado</td>";
                        } else if($fila['Proceso']==2){
                            $salida .= "<td style=\"color: coral\">Rechazado</td>";
                        } else {
                             $salida .= "<td style=\"color: orangered\">Desconocido</td>";
                        }
                    $salida .="</tr>";
                        
        }
        $salida.="</tbody></table>";

    } else {
        $salida.="No hay resultados";

    }

    echo $salida;
    }
?>
