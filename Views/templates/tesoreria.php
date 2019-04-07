<?php
$titulo = 'Tesoreria';

$query = "SELECT t1.idTitulo, t1.NumeroTitulo, t1.Proceso, t1.Observaciones, t3.Tipo, t4.NombresCiudadano, 
                t4.ApellidosCiudadano, t2.Numero, t5.Nombre, t1.Estado FROM Titulos t1 INNER JOIN Parcelas t2 
                ON t1.idParcela=t2.idParcela INNER JOIN TipoTitulos t3 ON t1.idTipoTitulo=t3.idTipoTitulo INNER JOIN 
                Ciudadanos t4 ON t1.idCiudadanoTitular=t4.idCiudadano INNER JOIN Cementerios t5 ON 
                t2.idCementerio=t5.idCementerio WHERE t1.Estado=1 
                ORDER BY t1.idTitulo DESC ";
$consulta = new ConexionDB();
$TitulosCount = $consulta->Query("SELECT COUNT(*) FROM Titulos WHERE Proceso=0");
$CementeriosCount = 12;
$ArrendamientosCount = 0;
$OperacionesCount = 9;
$Titulos = $consulta->Query($query);

require_once('Views/default/header.php');
?>

<!--suppress CssInvalidFunction -->
<style>
    .dataTables_filter {
        display: block;
    }

    .header {
        display: flex;
        margin: 0;
        height: 55px;
        background: white;
        width: 100%;
        color: #4285F4;
    }

    .activo {
        border-bottom: 2.5px solid #4285F4;
        background: rgb(22, 22, 22, 0.05);
    }

    .pad {
        padding-top: 10px;
        margin-left: -115px;
        width: 100%;
    }
    .grr:hover{
        background: rgb(22, 22, 22, 0.05);
        cursor: pointer;
    }
    .span {
        color: white;
        background: rgb(210, 0, 0, .8);
        border-radius: 50%;
        font-size: .7rem;
        display: inline-block;
        width: 20px;
        height: 20px;
        font-weight: 700;
        margin-left: -115px;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: .1rem .22rem;
        line-height: 1.2;
    }

</style>
<div class="container-fluid">
    <div class="row">
        <div class="header">

        <div class="text-center col-12 col-sm-6 col-lg-3 grr">
            <a class="btn pad" href="#">RECEPCION</a><?php
        if ($CementeriosCount == 0) {
            echo "";
        } elseif ($CementeriosCount <= 9) {
            echo "<span class=\"span\">{$CementeriosCount}</span>";
        } elseif ($CementeriosCount > 9) {
            echo "<span class=\"span\">9+</span>";
        }
        ?>
        </div>
        <div class="text-center col-12 col-sm-6 col-lg-3 activo grr">
            <a class="btn pad">RECIBIDOS</a><?php
        if ($TitulosCount[0]['COUNT(*)'] == 0) {
            echo "";
        } elseif ($TitulosCount[0]['COUNT(*)'] <= 9) {
            echo "<span class=\"span\">{$TitulosCount[0]['COUNT(*)']}</span>";
        } elseif ($TitulosCount[0]['COUNT(*)'] > 9) {
            echo "<span class=\"span\">9+</span>";
        }

        ?>
        </div>
        <div class="text-center col-12 col-sm-6 col-lg-3 grr">
            <a class="btn pad">OBSERVADOS</a><?php
        if ($ArrendamientosCount == 0) {
            echo "";
        } elseif ($ArrendamientosCount <= 9) {
            echo "<span class=\"span\">{$ArrendamientosCount}</span>";
        } elseif ($ArrendamientosCount > 9) {
            echo "<span class=\"span\">9+</span>";
        }
        ?>
        </div>
        <div class="text-center col-12 col-sm-6 col-lg-3 grr">
            <a class="btn pad">APROBADOS</a><!--<?php
        if ($OperacionesCount == 0) {
            echo "";
        } elseif ($OperacionesCount <= 9) {
            echo "<span class=\"span\">{$OperacionesCount}</span>";
        } elseif ($OperacionesCount > 9) {
            echo "<span class=\"span\">9+</span>";
        }
        ?>-->
        </div>
        </div>

        <div class="col-12">
            <h1 style="text-align: center">Titulos en proceso</h1>
            <div class="table-responsive">
                <table class="table table-hover mt-4">
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($Titulos != -1){
                        $i=0;
                        foreach ($Titulos as $fila){
                            $i++;
                            echo "<tr class=\"row-hover\">
                                    <td>{$i}</td>
                                    <td>{$fila['NombresCiudadano']}</td>
                                    <td>{$fila['ApellidosCiudadano']}</td>
                                    <td>{$fila['NumeroTitulo']}</td>
                                    <td>{$fila['Tipo']}</td>
                                    <td>{$fila['Nombre']}</td>
                                    <td>{$fila['Numero']}</td>
                                    ";
                            if ($fila['Estado'] == 1) {
                                echo "<td>Activa</td>
                                      ";
                            }
                             else {
                                echo "<td>Desactivada</td>                      
                                ";
                            }
                             if ($fila['Proceso'] == 0){
                                 echo "<td>Recepcion</td>";
                             }elseif ($fila['Proceso'] == 1){
                                 echo "<td>Recibida</td>";
                             }elseif ($fila['Proceso'] == 2){
                                echo "<td>Observada</td>";
                             }elseif ($fila['Proceso'] == 0){
                                echo "<td>Aprobada</td>";
                             }
                             echo "</tr>";
                        }
                    }

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php require_once('Views/default/footer.php'); ?>

<script>

</script>

<script type="text/javascript">
    $(document).ready(function () {
        var table = $('table').DataTable(tableLanguage);
    });
</script>
