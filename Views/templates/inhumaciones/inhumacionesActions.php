<?php

// validar session
if (!isset($_COOKIE['user_session'])) {
    header("location:{$server}/login/");
    exit();
}

if (!isset($_POST['actionId'])) {
    header("location:{$server}/inhumacion/");
    exit();
}

switch (@$_POST['actionId']) {
    case '1': //
        CrearInhumacion($_POST['NombresFallecido'],$_POST['ApellidosFallecido'],$_POST['Interesado'],"Normal",$_POST['FechaInicio'],$_POST['FechaFin'],$_POST['F1SAM'],$_POST['Observaciones'],$_POST['idNicho']);
        break;

    case '2':
        ObtenerTitulos($_POST['TituloSearch']);
        break;

    case '3':
        ObtenerNichos($_POST['idParcela']);
        break;

    case '4':
        EliminarInhumacion($_POST['idInhumacion']);
        break;

    //------------------ traslados ----------------


    case '7':
        CrearTraslado($_POST['idFallecido'],$_POST['Interesado'],$_POST['Parentesco'],$_POST['Destino'],$_POST['Fecha'],$_POST['Observaciones']);
        break;

    case '8':
        ObtenerInhumaciones($_POST['searchFallecido']);
        break;

    case '9':
        EliminarTraslado($_POST['idTraslado']);
        break;


    //------------------ exhumaciones ----------------


    case '11':
        CrearExhumacion($_POST['idFallecido'],$_POST['ViaJudicial'],$_POST['Fecha'],$_POST['Observaciones']);
        break;

    case '12':
        EliminarExhumacion($_POST['idTraslado']);
        break;

}


function CrearInhumacion($NombresFallecido,$ApellidosFallecido,$Interesado,$TipoInhumacion,$FechaInicio,$FechaFin,$F1SAM,$Observaciones,$nicho){

	if (isset($nicho) && isset($NombresFallecido) && isset($ApellidosFallecido) && isset($Interesado) && isset($TipoInhumacion) && isset($FechaInicio) && isset($FechaFin) && isset($F1SAM)) {

            $insert = new ConexionDB();
            $insert->Query("INSERT into Enterramientos (idNicho, FechaInicio, FechaFin, NombresFallecido, ApellidosFallecido, Interesado, FUnoISAM, TipoInhumacion, Observaciones, Estado) values ('{$nicho}','{$FechaInicio}','{$FechaFin}','{$NombresFallecido}','{$ApellidosFallecido}', '{$Interesado}', '{$F1SAM}','{$TipoInhumacion}','{$Observaciones}','1');");

            header("location:".$server.'/inhumacion/');
            exit();
    }

}


function ObtenerTitulos($match){
    $db = new ConexionDB();
    $query = "SELECT t1.idTitulo, t1.NumeroTitulo, t3.Tipo, concat(t4.NombresCiudadano,' ',
        t4.ApellidosCiudadano) as 'Ciudadano', t2.Numero as 'Parcela', t2.idParcela as 'idParcela', t5.Nombre as 'Cementerio', t1.Proceso, t1.Estado FROM Titulos t1 INNER JOIN Parcelas t2 
        ON t1.idParcela=t2.idParcela INNER JOIN TipoTitulos t3 ON t1.idTipoTitulo=t3.idTipoTitulo INNER JOIN 
        Ciudadanos t4 ON t1.idCiudadanoTitular=t4.idCiudadano INNER JOIN Cementerios t5 ON 
        t2.idCementerio=t5.idCementerio WHERE t1.NumeroTitulo LIKE '%{$match}%' OR t4.NombresCiudadano LIKE '%{$match}%' OR 
        t4.ApellidosCiudadano LIKE '%{$match}%' ORDER BY t1.idTitulo DESC limit 10";

    if ($match!="") {
        
        $datos = $db->Query($query);
        if ($datos!=-1) {
            echo '{ "data" : '.json_encode($datos).' }';

        }else{
            echo "Sin Resultados";
        }
    }else{
        echo "Sin Resultados";
    }

    

}

function ObtenerNichos($match){
    $db = new ConexionDB();
    $query = "SELECT t1.idNicho, t1.NumeroOrden, (select (if(date(now()) >= t2.FechaFin,true,false)) from Enterramientos t2 inner join Nichos t3 on t3.idNicho=t2.idNicho where t2.idNicho=t1.idNicho and t2.Estado='1') as 'Allow' from Nichos t1 where t1.idParcela='{$match}';";

    if ($match!="") {

        $datos = $db->Query($query);
        if ($datos!=-1) {
            echo '{ "data" : '.json_encode($datos).' }';

        }else{
            echo "-1";
        }
    }

}

function EliminarInhumacion($id){
    if(isset($id)){    
        $db = new ConexionDB();
        $query = "UPDATE Enterramientos set Estado='0' where idEnterramiento='{$id}'";
        $db->Query($query);

        header("location:".$server.'/inhumacion/');
        exit();

    }

}




//-------------------- traslados

function CrearTraslado($id,$Interesado,$Parentesco,$Destino,$Fecha,$Observaciones){
    if(isset($id)){    
        $db = new ConexionDB();
        $query = "INSERT into Traslados (idEnterramiento,Interesado,Parentesco,Destino,Fecha,Observaciones) values ('{$id}','{$Interesado}','{$Parentesco}','{$Destino}','{$Fecha}','{$Observaciones}');";
        $query2 = "UPDATE Enterramientos set Estado='0' where idEnterramiento='{$id}';";

        if (isset($id) && isset($Interesado) && isset($Parentesco) && isset($Destino) && isset($Fecha) && isset($Observaciones)) {
            $db->Query($query);
            $db->Query($query2);
        }

        header("location:".$server.'/traslado/');
        exit();

    }

}


function ObtenerInhumaciones($match){
    $db = new ConexionDB();
    $query = "SELECT t1.idEnterramiento, concat(NombresFallecido,' ',ApellidosFallecido) as Fallecido,( select concat(t4.Nombre,', Parcela: ',t3.Numero,', Nicho: ',t2.NumeroOrden) from Nichos t2 inner join Parcelas t3 on t2.idParcela=t3.idParcela inner join Cementerios t4 on t3.idCementerio=t4.idCementerio where t2.idNicho=t1.idNicho ) as 'Ubicacion' FROM Enterramientos t1 where t1.Estado='1' and ( t1.NombresFallecido Like '%{$match}%' or t1.ApellidosFallecido like '%{$match}%') limit 10;";

    if ($match!="") {

        $datos = $db->Query($query);
        if ($datos!=-1) {
            echo '{ "data" : '.json_encode($datos).' }';

        }else{
            echo "Sin Resultados";
        }
    }

}

function EliminarTraslado($id){
    if(isset($id)){    
        $db = new ConexionDB();
        $query = "UPDATE Traslados set Estado='0' where idTraslado='{$id}'";
        $db->Query($query);

        header("location:".$server.'/traslado/');
        exit();

    }

}


//-------------------- exhumaciones

function CrearExhumacion($id,$ViaJudicial,$Fecha,$Observaciones){
    if(isset($id)){    
        $db = new ConexionDB();
        $query = "INSERT into Exhumaciones (idEnterramiento,ViaJudicial,Fecha,Observaciones,Estado) values ('{$id}','{$ViaJudicial}','{$Fecha}','{$Observaciones}','1');";

        if (isset($id) && isset($ViaJudicial) && isset($Fecha) && isset($Observaciones)) {
            $db->Query($query);
        }

        header("location:".$server.'/exhumacion/');
        exit();

    }

}


function EliminarExhumacion($id){
    if(isset($id)){    
        $db = new ConexionDB();
        $query = "UPDATE Exhumaciones set Estado='0' where idExhumacion='{$id}'";
        $db->Query($query);

        header("location:".$server.'/exhumacion/');
        exit();

    }

}

?>