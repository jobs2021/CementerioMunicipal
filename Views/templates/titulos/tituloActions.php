<?php


// validar session
if (!isset($_COOKIE['user_session'])) {
    header("location:{$server}/login/");
    exit();
}

switch (@$_POST['actionId']) {
    case '1': // registra un nuevo ciudadano para y luego CREA UN titulo
        CrearCiudadanoTitulo($_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['dui'], $_POST['profesion'], $_POST['fecha'], $_POST['tipo'], $_POST['numero'], $_POST['idParcela']);
        break;
    case '2': // update
        UpdateCementerio($_POST['idCiudadano'], $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['dui'], $_POST['profesion'], $_POST['fecha']);
        break;
    case '3': // delete
        CancelarTitulo($_POST['idTitulo'], $_POST['Observaciones']);
        break;
    case '4': // Selecciona la parcela en finalizartitulo
        ObtenerParcela($_POST['idParcela']);
        break;
    case '6': //obtiene la parcela y redirecciona a arrendamientocrear
        ObtenerParcelaArrandamiento($_POST['idParcela']);
        break;
    case '7': //crea un arrendamiento
        CrearArrendamiento($_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['fecha'], $_POST['f1sam'], $_POST['anios'], $_POST['idParcela']);
        break;

    case '8': //reponer titulo
        ReponerTitulo($_POST['numeroTitulo'], $_POST['idTitulo']);
        break;
    case '9':
        addCiudadanoBeneficiario($_POST['idTitulo'], $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['fecha'], $_POST['dui'], $_POST['profesion']);
        break;

    case '10': //poner en estado cero al beneficiario
        ocultarBeneficiario($_POST['idBeneficiario'], $_POST['idTitulo']);
        break;
    case '11':
        completarBeneficiario();//retorno titulos
        break;
    case '12':
        EyeTitulo($_POST['idTitulo']);
        break;
    case '13':
        TraspasarTitulo($_POST['idTitulo']);
        break;
    case '14': //obtendra un JSON de Un Ciudadano con DUI registrado
        ObtenerDUI($_POST['searchCiudadano']);
        break;
    case '15': //cargaremos un autocomplete de un titular a travez del DUI
        GuardarTitulo($_POST['idPersona'],$_POST['idParcela'],$_POST['tipo'],$_POST['numero']);
        break;
    case '16':
        addBeneficiarios($insert = new ConexionDB(), $_POST['idCiudadano'], $_POST['idTitulo']);
        break;
    case '17':
        tesoreriaRecepcion($_POST['operacion']);
        break;

}


switch (@$_POST['actv']) {
    case 1:

        BuscarTitulo("titulo");
        break;
    case 2:

        BuscarTitulo("repoTrasTitulo");
        break;
}

#********************************TESORERIA******************************

function tesoreriaRecepcion($operacion){
    if (isset($operacion)){
        $consulta = new ConexionDB();
        if ($operacion == 1){
            $query = "SELECT t1.idTitulo, t1.NumeroTitulo, t1.Proceso, t3.Tipo, t4.NombresCiudadano, 
                t4.ApellidosCiudadano, t2.Numero FROM Titulos t1 INNER JOIN Parcelas t2 
                ON t1.idParcela=t2.idParcela INNER JOIN TipoTitulos t3 ON t1.idTipoTitulo=t3.idTipoTitulo INNER JOIN 
                Ciudadanos t4 ON t1.idCiudadanoTitular=t4.idCiudadano INNER JOIN Cementerios t5 ON 
                t2.idCementerio=t5.idCementerio WHERE t1.Estado=1  AND t1.Proceso=0
                ORDER BY t1.idTitulo DESC ";
            @$TitulosCount = $consulta->Query("SELECT COUNT(*) FROM Titulos WHERE Proceso=0");
        } elseif ($operacion == 2){
            $query = "SELECT t1.idTitulo, t1.NumeroTitulo, t1.Proceso, t1.Observaciones, t3.Tipo, t4.NombresCiudadano, 
                t4.ApellidosCiudadano, t2.Numero, t5.Nombre, t1.Estado FROM Titulos t1 INNER JOIN Parcelas t2 
                ON t1.idParcela=t2.idParcela INNER JOIN TipoTitulos t3 ON t1.idTipoTitulo=t3.idTipoTitulo INNER JOIN 
                Ciudadanos t4 ON t1.idCiudadanoTitular=t4.idCiudadano INNER JOIN Cementerios t5 ON 
                t2.idCementerio=t5.idCementerio WHERE t1.Estado=1 AND t1.Proceso=1
                ORDER BY t1.idTitulo DESC ";
        }

        @$Titulos = $consulta->Query($query);



        if ($Titulos != -1) {
            echo '{ "data" : ' . json_encode($Titulos) . ', "spop" : ' . json_encode($TitulosCount) .'}';

        } else {
            echo "Ningun registro previo";
        }



        exit();
    }
}



#*********************** TIUTLOS ACCION ****************************

function GuardarTitulo($id, $idParcela, $tipo, $numero){
    if (isset($id) && isset($idParcela) && isset($tipo) && isset($numero)){
        $insert = new ConexionDB();
        $query = "SELECT * FROM Ciudadanos WHERE idCiudadano = {$id}";
        $consulta = $insert->Query($query);

        $idCiudadano= $consulta[0]["idCiudadano"];



        CrearTitulo($tipo, $numero, $idParcela, $idCiudadano, $estado=1);
        exit();
    }
}


function CrearCiudadanoTitulo($nombre, $apellido, $direccion, $dui, $profesion, $fecha, $tipo, $numero, $idParcela)
{
    if (isset($nombre) && isset($apellido) && isset($direccion) && isset($dui) && isset($profesion) && isset($fecha) && isset($tipo) && isset($numero) && isset($idParcela))
    {
        $insert = new ConexionDB();
        $insert->Query("INSERT INTO Ciudadanos (NombresCiudadano, ApellidosCiudadano, FechaNacimiento, Profesion, Domicilio, DUI) VALUES('{$nombre}','{$apellido}','{$fecha}','{$profesion}','{$direccion}','{$dui}');");

        $idCiudadano = $insert->Query("SELECT idCiudadano FROM Ciudadanos ORDER BY idCiudadano DESC LIMIT 1");

        CrearTitulo($tipo, $numero, $idParcela, $idCiudadano, $estado=1);
        exit();
    } else {
        echo "error en datos";
    }
}


function CrearTitulo($tipo, $numero, $idParcela, $idCiudadano, $estado)
{
    if (isset($tipo) && isset($numero) && isset($idParcela) && isset($idCiudadano) && isset($estado)) {
        $insert = new ConexionDB();
        $insert->Query("INSERT INTO Titulos (idParcela,idTipoTitulo,NumeroTitulo,idCiudadanoTitular,Estado,Proceso) VALUES ({$idParcela},{$tipo},'{$numero}',{$idCiudadano[0]["idCiudadano"]},$estado,0)");
        $idTitulo = $insert->Query("SELECT idTitulo FROM Titulos ORDER BY idTitulo DESC LIMIT 1");
        $insert->Query("UPDATE Parcelas SET Titulado=1 WHERE idParcela={$idParcela}");


        header("location:" . $server . '/beneficiarios/' . $idTitulo[0]['idTitulo']);
        exit();
    }
}

function ObtenerParcela($idParcela)
{
    header("location:" . $server . '/creartitulo/' . $idParcela);
    exit();
}


function CancelarTitulo($idTitulo, $Observaciones)
{
    $insert = new ConexionDB();
    if (isset($Observaciones)) {
        $insert->Query("UPDATE Titulos SET Observaciones = '{$Observaciones}', Estado=0 WHERE idTitulo={$idTitulo}");

        header("location:" . $server . '/repotrastitulo');
    } else {
        $insert->Query("UPDATE Titulos SET Estado=0 WHERE idTitulo={$idTitulo}");

        header("location:" . $server . '/repotrastitulo');
        exit();
    }
}


function ReponerTitulo($numeroTitulo, $idTitulo)
{
    if (isset($numeroTitulo) && isset($idTitulo)) {
        $insert = new ConexionDB();
        $value = $insert->Query("SELECT * FROM Titulos where idTitulo={$idTitulo}");
        $insert->Query("INSERT INTO Titulos (idParcela,idTipoTitulo,NumeroTitulo,idCiudadanoTitular,FechaExpedido,NumeroRecibo,FechaRecibo,Imagen,Observaciones,Estado,Proceso) VALUES ({$value[0]['idParcela']},{$value[0]['idTipoTitulo']},'{$numeroTitulo}',{$value[0]['idCiudadanoTitular']},'{$value[0]['FechaExpedido']}','{$value[0]['NumeroRecibo']}','{$value[0]['FechaRecibo']}','{$value[0]['Imagen']}','{$value[0]['Observaciones']}',{$value[0]['Estado']},{$value[0]['Proceso']})");

        $insert->Query("UPDATE Titulos SET Estado=0 where idTitulo={$idTitulo}");

        header("location:" . $server . '/repotrastitulo');
        exit();
    } else {

    }
}


function TraspasarTitulo($idTitulo)
{
    if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['direccion']) &&
        isset($_POST['dui']) && isset($_POST['profesion']) && isset($_POST['fecha']) && isset($_POST['tipo']) &&
        isset($_POST['numero']) && isset($_POST['idParcela'])) {

        //llamo a la funcion que realizara el nuevo traspaso
        TraspasarTituloReal($idTitulo, $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['dui'],
            $_POST['profesion'], $_POST['fecha'], $_POST['tipo'], $_POST['numero'], $_POST['idParcela']);

    } else {

        //retorna el formulario con la parcela seleccionada
        $insert = new ConexionDB();
        $idParce = $insert->Query("SELECT idParcela FROM Titulos WHERE idTitulo=$idTitulo");
        header("location:" . $server . '/traspasartitulo/' . $idTitulo . '/traspaso/' . $idParce[0]['idParcela']);
        exit();
    }

}

function TraspasarTituloReal($idTitulo, $nombre, $apellido, $direccion, $dui, $profesion, $fecha, $tipo, $numero, $idParcela)
{
    $insert = new ConexionDB();
    //crea un ciudadano Existente
    $insert->Query("insert into Ciudadanos (NombresCiudadano, ApellidosCiudadano, FechaNacimiento, Profesion, Domicilio, DUI) values ('{$nombre}','{$apellido}','{$fecha}','{$profesion}','{$direccion}','{$dui}');");
    //id Ciudadano       
    $idCiudadano = $insert->Query("select idCiudadano from Ciudadanos order by idCiudadano desc limit 1");
    //Crea el nuevo Titulo
    $insert->Query("insert into Titulos (idParcela,idTipoTitulo,NumeroTitulo,idCiudadanoTitular) values 
    ({$idParcela},{$tipo},'{$numero}',{$idCiudadano[0]['idCiudadano']})");

    //Selecciona el id del Titulo
    $idTitulo1 = $insert->Query("select idTitulo from Titulos order by idTitulo desc limit 1");
    //modifica el titulo anterior y lo pone en cero 
    $insert->Query("UPDATE Titulos SET Estado=0 WHERE idTitulo={$idTitulo}");

    //obtinemos todos lo beneficiario
    $insert->Query("SELECT * FROM Beneficiarios WHERE idTitulo={$idTitulo} AND Estado=1");

    //recorremos a los beneficiarios poniendolos desactivados para dicho titulo
    foreach ($insert as $beneficiario) {
        $insert->Query("UPDATE Beneficiarios SET Estado=0 WHERE idBeneficiario={$beneficiario[0]['idBeneficiario']}");
    }


    header("location:" . $server . '/beneficiarios/' . $idTitulo1[0]['idTitulo']);
    exit();
}


function EyeTitulo($idTitulo)
{
    if (isset($idTitulo)) {
        header("location:" . $server . '/eyetitulo/' . $idTitulo);
        exit();
    }
}


#********************** ARRENDAMIENTOS **********************
function ObtenerParcelaArrandamiento($idParcela)
{
    header("location:" . $server . '/arrendamientocrear/' . $idParcela);
    exit();
}


function CrearArrendamiento($nombre, $apellido, $direccion, $fecha, $f1sam, $anios, $idParcela)
{
    if (isset($nombre) && isset($apellido) && isset($direccion) && isset($fecha) && isset($f1sam) && isset($anios) && isset($idParcela)) {
        $insert = new ConexionDB();
        $insert->Query("INSERT INTO PagosArrendamientos (Nombres, Apellidos, Direccion, FechaPago, F1ISAM, Anios, idParcela) VALUES ('{$nombre}', '{$apellido}', '{$direccion}', '{$fecha}', '{$f1sam}', '{$anios}', {$idParcela})");

        header("location:" . $server . '/arrendamientos');
        exit();
    }
}


#************* crear beneficiarios titulo********************
function addCiudadanoBeneficiario($idTitulo, $nombre, $apellido, $direccion, $fecha, $dui, $profesion)
{
    if (isset($idTitulo) && isset($nombre) && isset($apellido) && isset($direccion) && isset($fecha) && isset($dui) && isset($profesion)) {
        $insert = new ConexionDB();
        $insert->Query("INSERT INTO Ciudadanos(NombresCiudadano, ApellidosCiudadano, FechaNacimiento, Profesion,Domicilio, DUI) VALUES('{$nombre}', '{$apellido}', '{$fecha}', '{$profesion}','{$direccion}','{$dui}')");
        var_dump($idTitulo);
        $idCiudadano = $insert->Query("select idCiudadano from Ciudadanos order by idCiudadano desc limit 1");
        var_dump($idCiudadano);
        addBeneficiarios($insert, $idCiudadano, $idTitulo);

    }
}

function addBeneficiarios($insert, $idCiudadano, $idTitulo){
    $insert->Query("INSERT INTO Beneficiarios (idTitulo, idCiudadano, Estado) VALUES({$idTitulo}, {$idCiudadano[0]['idCiudadano']}, 1)");

    header("location:" . $server . '/beneficiarios/' . $idTitulo);
    exit();
}

function ocultarBeneficiario($idBeneficiario, $idTitulo)
{
    if (isset($idBeneficiario) && isset($idTitulo)) {
        $insert = new ConexionDB();
        $insert->Query("UPDATE Beneficiarios SET Estado=0 where idBeneficiario={$idBeneficiario}");
        header("location:" . $server . '/beneficiarios/' . $idTitulo);
        exit();
    }
}


function ocultarBeneficiario2($idBeneficiario, $idTitulo)
{
    if (isset($idBeneficiario) && isset($idTitulo)) {
        $insert = new ConexionDB();
        $insert->Query("UPDATE Beneficiarios SET Estado=0  where idBeneficiario={$idBeneficiario}");
        header("location:" . $server . '/beneficiarios/' . $idTitulo);
        exit();
    }
}

function completarBeneficiario()
{
    //session para enviar notificacion
    session_start();
    $_SESSION['JsonNotification'] = '{ "msg":"Titulo ' . $numero . ' en Proceso...", "title":"Titulo Nuevo" }';
    @$rol=$session_data['rol'];
    $_SESSION['JsonNotification'] = '{ "msg":"Titulo ' . $numero . ' en Proceso...", "title":"Titulo Nuevo", "rol" : 1 }';


    header("location:" . $server . '/titulos');
    exit();
}


#************************ BUSQUEDAS *********************************
function BuscarTitulo($act)
{

    $insert = new ConexionDB();
    $salida = "";
    if (isset($_POST['valor'])) {
        $q = ($_POST['valor']);
        $t = 0;
        if ($act === "titulo") {
            $t = 1;
            if ($q == "*"){
                $query = "SELECT t1.idTitulo, t1.NumeroTitulo, t1.Proceso, t3.Tipo, t4.NombresCiudadano, 
                t4.ApellidosCiudadano, t2.Numero, t5.Nombre, t1.Estado FROM Titulos t1 INNER JOIN Parcelas t2 
                ON t1.idParcela=t2.idParcela INNER JOIN TipoTitulos t3 ON t1.idTipoTitulo=t3.idTipoTitulo INNER JOIN 
                Ciudadanos t4 ON t1.idCiudadanoTitular=t4.idCiudadano INNER JOIN Cementerios t5 ON 
                t2.idCementerio=t5.idCementerio WHERE t1.Estado = 0 ORDER BY t1.idTitulo DESC ";
            } else {
                $query = "SELECT t1.idTitulo, t1.NumeroTitulo, t1.Proceso, t3.Tipo, t4.NombresCiudadano, 
                t4.ApellidosCiudadano, t2.Numero, t5.Nombre, t1.Estado FROM Titulos t1 INNER JOIN Parcelas t2 
                ON t1.idParcela=t2.idParcela INNER JOIN TipoTitulos t3 ON t1.idTipoTitulo=t3.idTipoTitulo INNER JOIN 
                Ciudadanos t4 ON t1.idCiudadanoTitular=t4.idCiudadano INNER JOIN Cementerios t5 ON 
                t2.idCementerio=t5.idCementerio WHERE t1.NumeroTitulo LIKE '%{$q}%' OR t4.NombresCiudadano LIKE '%{$q}%' OR 
                t4.ApellidosCiudadano LIKE '%{$q}%' OR t2.Numero LIKE '%{$q}%' OR t5.Nombre LIKE '%{$q}%' WHERE t1.Estado = 0
                ORDER BY t1.idTitulo DESC ";
            }

        } elseif ($act === "repoTrasTitulo") {
            if ($q == "*") {
                $query = "SELECT t1.idTitulo, t1.NumeroTitulo, t1.Proceso, t1.Observaciones, t3.Tipo, t4.NombresCiudadano, 
                t4.ApellidosCiudadano, t2.Numero, t5.Nombre, t1.Estado FROM Titulos t1 INNER JOIN Parcelas t2 
                ON t1.idParcela=t2.idParcela INNER JOIN TipoTitulos t3 ON t1.idTipoTitulo=t3.idTipoTitulo INNER JOIN 
                Ciudadanos t4 ON t1.idCiudadanoTitular=t4.idCiudadano INNER JOIN Cementerios t5 ON 
                t2.idCementerio=t5.idCementerio WHERE t1.Estado=1 
                ORDER BY t1.idTitulo DESC ";
            } else {
                $query = "SELECT t1.idTitulo, t1.NumeroTitulo, t1.Proceso, t1.Observaciones, t3.Tipo, t4.NombresCiudadano, 
                t4.ApellidosCiudadano, t2.Numero, t5.Nombre, t1.Estado FROM Titulos t1 INNER JOIN Parcelas t2 
                ON t1.idParcela=t2.idParcela INNER JOIN TipoTitulos t3 ON t1.idTipoTitulo=t3.idTipoTitulo INNER JOIN 
                Ciudadanos t4 ON t1.idCiudadanoTitular=t4.idCiudadano INNER JOIN Cementerios t5 ON 
                t2.idCementerio=t5.idCementerio WHERE (t1.NumeroTitulo LIKE '%{$q}%' OR t4.NombresCiudadano LIKE '%{$q}%' OR 
                t4.ApellidosCiudadano LIKE '%{$q}%' OR t2.Numero LIKE '%{$q}%' OR t5.Nombre LIKE '%{$q}%') AND t1.Estado=1 
                ORDER BY t1.idTitulo DESC ";
            }
        }
    }

    @$resultado = $insert->query($query);
    $i = 0;
    $table_header = "<div class='table-responsive'>
                        <table id=\"table\" class='table table-hover'>
                            <thead>
                                <tr >
                                    <th>N°</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Titulo</th>
                                    <th>Tipo</th>
                                    <th>Cementerio</th>
                                    <th>Parcela</th>
                                    ";
    if ($t == 0) {
        $table_header .= "<th>Estado</th>
                                    <th>Proceso</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                        <tbody>";
    }else{
        $table_header .= "<th>Accion</th>
                         </tr>
                        </thead>
                      <tbody>";
    }
    if ($resultado != -1) {
        $salida .= $table_header;
        foreach ($resultado as $fila) {
            $i++;
            $salida .= "<tr class=\"row-hover\">
                        <td>{$i}</td>
                        <td>{$fila['NombresCiudadano']}</td>
                        <td>{$fila['ApellidosCiudadano']}</td>
                        <td>{$fila['NumeroTitulo']}</td>
                        <td>{$fila['Tipo']}</td>
                        <td>{$fila['Nombre']}</td>
                        <td>{$fila['Numero']}</td>";
            if ($t == 0) {
                if ($fila['Estado'] == 1) {
                    $salida .= "<td style=\"color: \">Activo</td>";
                } else {
                    $salida .= "<td style=\"color: \">Inactivo</td>";
                }
                if ($fila['Proceso'] == 0) {
                    $salida .= "<td style=\"color: forestgreen\">Peticionando...</td>";
                } else if ($fila['Proceso'] == 1) {
                    $salida .= "<td style=\"color: green\">Procesando...</td>";
                } else if ($fila['Proceso'] == 2) {
                    $salida .= "<td style=\"color: orangered\">Observado</td>";
                } else if ($fila['Proceso'] == 3) {
                    $salida .= "<td style=\"color:dodgerblue\">APROBADO</td>";
                }
                $salida .= "
                        <td>
                        <div class=\"row-btn row text-center\">
                            <form method=\"POST\" action=\"http://localhost/tituloActions/\">
                            <input type = \"hidden\" name = \"actionId\" value = \"12\" />
                            <input type = \"hidden\" name = \"idTitulo\" value = \"{$fila['idTitulo']}\" />
                            <button style = \"color: FORESTGREEN; border:none; background:transparent; cursor:pointer;\" title = \"Ver Titulo\" type = \"submit\" class=\"fas fa-eye\" ></button >
                        </form >
                        <form method = \"POST\" action = \"http://localhost/tituloActions/\" >
                            <input type = \"hidden\" name = \"actionId\" value = \"13\" />
                            <input type = \"hidden\" name = \"idTitulo\" value = \"{$fila['idTitulo']}\" />
                            <button style = \"color: DODGERBLUE; border:none; background:transparent; cursor:pointer;\" title = \"Traspasar Titulo\" class=\"fas fa-exchange-alt mx-1\" type = \"submit\" ></button >
                        </form >
                            <a data-toggle = \"modal\" data-target = \"#reponerMd\" style = \"color: #2F2F2F\" title = \"Reponer Titulo\" class=\"fas fa-copy mx-1\" onClick = \"reponerTitulo({$fila['idTitulo']});\" ></a >
                            <a id = \"eliminar\" style = \"color: #FF4500\"  title = \"Cancelar Titulo\" class=\"fas fa-times-circle mx-1\" data-toggle = \"modal\" data-target = \"#eliminarMd\" onClick = \"selTitulo({$fila['NumeroTitulo']},{$fila['idTitulo']}, '{$fila['Observaciones']}');\" ></a >
                        </div>
                        </td>
                    </tr>";
            }
            else{
                $salida .= "
                        <td>
                        <div class=\"row-btn\">
                            <form method=\"POST\" action=\"http://localhost/tituloActions/\">
                                <input type=\"hidden\" name=\"actionId\" value=\"12\"/>
                                <input type=\"hidden\" name=\"idTitulo\" value=\"{$fila['idTitulo']}\"/>
                                <button style=\"color: FORESTGREEN; border:none; background:transparent; cursor:pointer;\" title=\"Ver Titulo\" type=\"submit\" class=\"fas fa-eye\"></button>
                            </form>
                        </div>
                        </td>
                    </tr>";
            }

        }
        $salida .= "</tbody></table> 
        <script type=\"text/javascript\">
        $(document).ready(function() {
            var table = $('#table').DataTable(tableLanguage);
        });
    </script>";
    } else {
        $salida .= 'no se puede ejecutar la consulta';
    }
    echo $salida;
}


function ObtenerDUI($match)
{
    $db = new ConexionDB();
    $query = "SELECT * FROM Ciudadanos WHERE DUI LIKE '{$match}%' LIMIT 10;";

    if ($match != "") {

        $datos = $db->Query($query);
        if ($datos != -1) {
            echo '{ "data" : ' . json_encode($datos) . ' }';

        } else {
            echo "Ningun registro previo";
        }
    }

}


?>