<?php

// validar session
if (!isset($_COOKIE['user_session'])) {
    header("location:{$server}/login/");
    exit();
}


switch (@$_POST['actionId']) {
    case '1': // registra un nuevo ciudadano para y luego CREA UN titulo
        CrearInhumacion($_POST['NombresFallecido'],$_POST['ApellidosFallecido'],$_POST['TipoInhumacion'],$_POST['FechaInicio'],$_POST['FechaFin'],$_POST['F1SAM'],$_POST['Observaciones']);
        break;
}
if ($_GET['action']){
    BuscarTitulo();
}


function CrearInhumacion($NombresFallecido,$ApellidosFallecido,$TipoInhumacion,$FechaInicio,$FechaFin,$F1SAM,$Observaciones){

	if (isset($NombresFallecido) && isset($ApellidosFallecido) && isset($TipoInhumacion) && isset($FechaInicio) && isset($FechaFin) && isset($F1SAM)) {

            $insert = new ConexionDB();
            $insert->Query("insert into Parcelas (idTipoParcela,idCementerio,Poligono,CoordenadaX,CoordenadaY,Numero) values ('{$tipo}','{$idCementerio}','{$poligono}','{$coordenadaX}','{$coordenadaY}','{$numero}')");

            header("location:".$server.'/'.$came.'/'.$idCementerio);
            exit();
    }

}

?>