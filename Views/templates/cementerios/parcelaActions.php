<?php

if (isset($_POST['actionId'])) {
	switch ($_POST['actionId']) {
	    case '1': // add
	        CrearParcela($_POST['poligono'],$_POST['tipo'],$_POST['coordenadaX'],$_POST['coordenadaY'],$_POST['idCementerio']);

	        break;
	   case '2': // update
	        UpdateCementerio($_POST['idCementerio'],$_POST['nombre'],$_POST['direccion'],$_POST['tipo'],$_POST['area'],$_POST['legalidad'],$_POST['panteonero']);
	        break;
	   case '3': // delete
	        DeleteCementerio($_POST['idCementerio']);
	        break;
	} 
}else{
	   	@$idParcela=explode('/',$_GET['action'])[1];
	     ReturnParcela($idParcela);
}

  


//add parcela
function CrearParcela($poligono,$tipo,$coordenadaX,$coordenadaY,$idCementerio){
    if (isset($idCementerio) && isset($poligono) && isset($tipo) && isset($coordenadaX) && isset($coordenadaY)) {
            $insert = new ConexionDB();
            $insert->Query("insert into Parcelas (idTipoParcela,idCementerio,Poligono,CoordenadaX,CoordenadaY) values ('{$tipo}','{$idCementerio}','{$poligono}','{$coordenadaX}','{$coordenadaY}')");

            header("location:".$server.'/admincementerio/'.$idCementerio);
            exit();
    }
}
// update parcela

// delete parcela

//return parcela
function ReturnParcela($id){
	$db = new ConexionDB();
    $datos = $db->Query("select * from Parcelas where idParcela={$id}");
   	echo json_encode($datos);
    return json_encode($datos);
}

?>