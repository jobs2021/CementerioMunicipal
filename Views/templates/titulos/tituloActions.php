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
    case '9':
        addBeneficiario($_POST['idTitulo'],$_POST['nombre'],$_POST['apellido'],$_POST['direccion'],$_POST['fecha'],$_POST['dui'],$_POST['profesion']);
    case '10': //poner en estado cero al beneficiario
        ocultarBeneficiario($_POST['idBeneficiario'],$_POST['idTitulo']);
    
}
if ($_GET['action']){
    BuscarTitulo();
}
function CrearCiudadanoTitulo($nombre,$apellido,$direccion,$dui,$profesion,$fecha,$tipo,$numero,$idParcela){
    if (isset($nombre) && isset($apellido) && isset($direccion) && isset($dui) && isset($profesion) && isset($fecha) && isset($tipo) && isset($numero) && isset($idParcela)) {
            $insert = new ConexionDB();
            $insert->Query("insert into Ciudadanos (NombresCiudadano, ApellidosCiudadano, FechaNacimiento, Profesion, Domicilio, DUI) values ('{$nombre}','{$apellido}','{$fecha}','{$profesion}','{$direccion}','{$dui}');");
            
            $idCiudadano=$insert->Query("select idCiudadano from Ciudadanos order by idCiudadano desc limit 1");
            $insert->Query("insert into Titulos (idParcela,idTipoTitulo,NumeroTitulo,idCiudadanoTitular) values ({$idParcela},{$tipo},'{$numero}',{$idCiudadano[0]['idCiudadano']})");
        
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
        $idTitulo=$insert->Query("select idTitulo from Titulos order by idTitulo desc limit 1");
        header("location:".$server.'/beneficiarios/'.$idTitulo[0]['idTitulo']);
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
#************* crear beneficiarios titulo********************
function addBeneficiario($idTitulo, $nombre,$apellido,$direccion,$fecha,$dui,$profesion){
    if (isset($idTitulo) && isset($nombre) && isset($apellido) && isset($direccion) && isset($fecha) && isset($dui) && isset($profesion)){
        $insert = new ConexionDB();
        $value = $insert->Query("INSERT INTO Ciudadanos(NombresCiudadano, ApellidosCiudadano, FechaNacimiento, Profesion,Domicilio, DUI) VALUES('{$nombre}', '{$apellido}', '{$fecha}', '{$profesion}','{$direccion}','{$dui}')");
        var_dump($idTitulo);
        $idCiudadano=$insert->Query("select idCiudadano from Ciudadanos order by idCiudadano desc limit 1");
        var_dump($idCiudadano);
        $insert->Query("INSERT INTO Beneficiarios (idTitulo, idCiudadano, Estado) VALUES({$idTitulo}, {$idCiudadano[0]['idCiudadano']}, 1)");
        header("location:".$server.'/beneficiarios/'.$idTitulo);
    }
}
function ocultarBeneficiario($idBeneficiario, $idTitulo){
    if (isset($idBeneficiario) && isset($idTitulo)){
        $insert = new ConexionDB();
        $insert->Query("UPDATE Beneficiarios SET Estado=0 where idBeneficiario={$idBeneficiario}");
        header("location:".$server.'/beneficiarios/'.$idTitulo);
    }
}
function ocultarBeneficiario2($idBeneficiario, $idTitulo){
    if (isset($idBeneficiario) && isset($idTitulo)){
        $insert = new ConexionDB();
        $insert->Query("UPDATE Beneficiarios SET Estado=0  where idBeneficiario={$idBeneficiario}");
        header("location:".$server.'/beneficiarios/'.$idTitulo);
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
                            <table class='table table-hover'>
                            <thead>
                                <tr >
                                    <th>N°</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Titulo</th>
                                    <th>Tipo</th>
                                    <th>Cementerio</th>
                                    <th>Parcela</th>
                                    <th>Estado</th>
                                    <th>Proceso</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                        <tbody>";
       foreach ($resultado as $fila) {
           $i++;
            $salida.="<tr class=\"row-hover\">
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
                        $salida .= "
                        <td>
                        <div class=\"row-btn\">
                            <a style=\"color: FORESTGREEN\" title=\"Ver Titulo\" href=\"#\" class=\"fas fa-eye\"></a>
                        </div>
                        </td>
                    </tr>";
                   
        }
        $salida.="</tbody></table>";
    } else {
        $salida.="No hay resultados";
    }
    echo $salida;
}
    
?>