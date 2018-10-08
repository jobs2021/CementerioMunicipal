<?php

if (isset($_POST['actionId'])) {
	switch ($_POST['actionId']) {
	    case '1': // add
	    @$nichos=explode(',',$_POST['nichos']);
	    CrearParcela($_POST['poligono'],$_POST['tipo'],$_POST['coordenadaX'],$_POST['coordenadaY'],$_POST['idCementerio'],$_POST['numero'],$nichos);

	        break;
	   case '2': // update
	       @$idParcela=explode('/',$_GET['action'])[1];
	        UpdateParcela($idParcela,$_POST['poligono'],$_POST['tipo'],$_POST['coordenadaX'],$_POST['coordenadaY'],$_POST['idCementerio'],$_POST['numero']);
	        break;
	   case '3': // delete
	        DeleteParcela($_POST['idParcela'],$_POST['idCementerio']);
	        break;
	} 
}else{
	   	@$idParcela=explode('/',$_GET['action'])[1];
	     ReturnParcela($idParcela);
}

  


//add parcela
function CrearParcela($poligono,$tipo,$coordenadaX,$coordenadaY,$idCementerio,$numero,$nichos){
    if (isset($idCementerio) && isset($poligono) && isset($tipo) && isset($coordenadaX) && isset($coordenadaY) && isset($numero)) {
            $fecha=date('Y').'-'.date('m').'-'.date('d');
            $insert = new ConexionDB();
            $insert->Query("insert into Parcelas (idTipoParcela,idCementerio,Poligono,CoordenadaX,CoordenadaY,Numero) values ('{$tipo}','{$idCementerio}','{$poligono}','{$coordenadaX}','{$coordenadaY}','{$numero}')");
            if (isset($nichos) && $nichos[0]!='') {
            	$nueva=$insert->Query("select idParcela from Parcelas order by idParcela desc limit 1")[0]['idParcela'];
            	
            	foreach ($nichos as $nicho) {
            		$insert->Query("insert into Nichos (idParcela,idCtlestadosNicho,NumeroOrden,Fecha,Estado) values ('{$nueva}','1','{$nicho}','{$fecha}','1')");
            	}
            }

            header("location:".$server.'/admincementerio/'.$idCementerio);
            exit();
    }
}
// update parcela
function UpdateParcela($idParcela,$poligono,$tipo,$coordenadaX,$coordenadaY,$idCementerio,$numero){
    if (isset($idParcela) && isset($idCementerio) && isset($poligono) && isset($tipo) && isset($coordenadaX) && isset($coordenadaY) && isset($numero)) {
            $db = new ConexionDB();
            $db->Query("update Parcelas set idTipoParcela='{$tipo}',Poligono='{$poligono}',CoordenadaX='{$coordenadaX}',CoordenadaY='{$coordenadaY}',Numero='{$numero}' where idParcela='{$idParcela}'");

           header("location:".$server.'/parcelas/'.$idCementerio);
           exit();
    }
}

// delete parcela
function DeleteParcela($idParcela,$idCementerio){
    if (isset($idParcela)) {
            $insert = new ConexionDB();
            $insert->Query("delete from Parcelas where idParcela='{$idParcela}'");

            header("location:".$server.'/parcelas/'.$idCementerio);
            exit();
    }
}

//return parcela
function ReturnParcela($id){
	$db = new ConexionDB();
    $datos = $db->Query("select * from Parcelas where idParcela={$id}");
   	echo json_encode($datos);
    return json_encode($datos);
}

?>