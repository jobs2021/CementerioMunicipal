<?php

if (isset($_POST['actionId'])) {
	switch ($_POST['actionId']) {
	    case '1': // add
	    @$nichos=explode(',',$_POST['nichos']);
	    CrearParcela($_POST['poligono'],$_POST['tipo'],$_POST['coordenadaX'],$_POST['coordenadaY'],$_POST['idCementerio'],$_POST['numero'],$nichos);

	        break;
	   case '2': // update
	       @$idParcela=explode('/',$_GET['action'])[1];
	       $nichosNew=explode(',', $_POST['nichosNew']);
	       $nichosDelete=explode(',', $_POST['nichosDelete']);
	        UpdateParcela($idParcela,$_POST['poligono'],$_POST['tipo'],$_POST['coordenadaX'],$_POST['coordenadaY'],$_POST['idCementerio'],$_POST['numero'],$nichosNew,$nichosDelete,$_POST['vista']);
	        break;
	   case '3': // delete
	        DeleteParcela($_POST['idParcela'],$_POST['idCementerio']);
	        break;

        case '4': // restore
        RestoreParcela($_POST['idParcela'],$_POST['idCementerio'],$_POST['Came']);
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
function UpdateParcela($idParcela,$poligono,$tipo,$coordenadaX,$coordenadaY,$idCementerio,$numero,$nichosNew,$nichosDelete,$vista){

    if (isset($idParcela) && isset($idCementerio) && isset($poligono) && isset($tipo) && isset($coordenadaX) && isset($coordenadaY) && isset($numero)) {
            $db = new ConexionDB();
            $db->Query("update Parcelas set idTipoParcela='{$tipo}',Poligono='{$poligono}',CoordenadaX='{$coordenadaX}',CoordenadaY='{$coordenadaY}',Numero='{$numero}' where idParcela='{$idParcela}'");

            if (isset($nichosNew) && $nichosNew[0]!='') {
                $fecha=date('Y').'-'.date('m').'-'.date('d');
                foreach ($nichosNew as $nicho) {
                    $db->Query("insert into Nichos (idParcela,idCtlestadosNicho,NumeroOrden,Fecha,Estado) values ('{$idParcela}','1','{$nicho}','{$fecha}','1')");
                }
            }

            if (isset($nichosDelete) && $nichosDelete[0]!='') {
                foreach ($nichosDelete as $numero) {
                    $db->Query("update Nichos set Estado='0' where idParcela='{$idParcela}' and NumeroOrden='{$numero}'");
                }
            }


            if ($vista=='1') {
                header("location:".$server.'/verparcela/'.$idParcela);
            }else{
                header("location:".$server.'/parcelas/'.$idCementerio);
                
            }

           exit();
    }
}

// delete parcela
function DeleteParcela($idParcela,$idCementerio){
    if (isset($idParcela)) {
            $insert = new ConexionDB();
            $insert->Query("update Parcelas set Estado='0' where idParcela='{$idParcela}'");

            header("location:".$server.'/parcelas/'.$idCementerio);
            exit();
    }
}

//return parcela
function ReturnParcela($id){
	$db = new ConexionDB();
    $datos = $db->Query("select * from Parcelas where idParcela={$id} and Estado='1'");
    if($datos==-1){
        echo "NO se puede mostrar";
    }else{
        $datos2 = $db->Query("select t1.NumeroOrden from Nichos t1 where t1.idParcela={$id} and t1.Estado='1'");
        $nichos=[];
        foreach ($datos2 as $nicho) {
            array_push($nichos, $nicho['NumeroOrden']);
        }
        $datos[0]['Nichos']=$nichos;
       echo json_encode($datos);    
    }
    
}

function RestoreParcela($id,$idCementerio,$came){
        if (isset($id)) {
            $update = new ConexionDB();
            foreach ($id as $key) {
            $update->Query("update Parcelas set Estado='1' where idParcela='{$key}';");
            }

            header("location:".$server.'/'.$came.'/'.$idCementerio);
            exit();
    }else{
        header("location:".$server.'/'.$came.'/'.$idCementerio);
            exit();
    }
}

?>