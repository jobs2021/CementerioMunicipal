<!-- TITULOS VIGENTES-->
<?php 
$titulo='Titulos Vigentes';

$consulta = new ConexionDB();
$variable= $consulta->Query("SELECT t1.idTitulo, t1.Observaciones, t1.NumeroTitulo, t3.Tipo, t4.NombresCiudadano, t4.ApellidosCiudadano, t2.Numero, t5.Nombre, t1.Estado FROM Titulos t1 INNER JOIN Parcelas t2 ON t1.idParcela=t2.idParcela INNER JOIN TipoTitulos t3 ON t1.idTipoTitulo=t3.idTipoTitulo INNER JOIN Ciudadanos t4 ON t1.idCiudadanoTitular=t4.idCiudadano INNER JOIN Cementerios t5 ON t2.idCementerio=t5.idCementerio WHERE t1.Estado=1 AND t1.Proceso=1");

require_once('Views/default/header.php'); 
?>
<style> 
    .ms{
        width:100%;
        overflow-x: hidden;
    }
    @media screen and (max-width:850px){
        .ms{
        width:100%;
        overflow-x: scroll;
    }
    }
    @media screen and (max-width:728px){
        .ms{
        width:100%;
        overflow-x: scroll;
    }
    }
</style>

<!--BREADCUMB-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $server;?>/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo $server;?>/titulos">Titulos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Operacones</li>
    </ol>
</nav>

<!-- Body -->
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card-body">
            <form class="form-inline" method="GET">
                <div class="col-md-5 mx-auto">
                    <div class="form-group">
                        <p aling="center">
                            Para realizar busquedas, ingrese un Nombre o Numero de Titulo
                        </p>

                        <input class="form-control col-lg-10 mr-sm-1" type="search" name="titulo" placeholder="Nombre o Codigo del Titulo" aria-label="Search">
                        <button class="btn btn-dark my-2 my-sm-0" type="submit">Buscar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 padding-0 mx-auto">
       <div class="float-right">
        <a id="crear" title="Crear" class="btn btn-secondary" style="color: white; margin-right:10px" href="<?php echo $server;?>/inicio">Inicio</a> 
        <a id="crear" title="Crear" style="margin-right:10px" class="btn btn-secondary" href="<?php echo $server;?>/creartitulo">Crear Titulo</a>
        </div>
       
        <div class="table-responsive ms">
            <table class="table table-hover margin-top-15">
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col"># Titulo</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Cementerio</th>
                    <th scope="col">Parcela</th>
                    <th scope="col">observaciones</th>
                    <th scope="col">Estado</th>
                    <th scope="col"></th>
                </tr>
                <?php
                if ($variable != -1){
                    $i=0;
                    foreach ($variable as $value){
                        $i++;
                        echo "
                        <tr class=\"row-hover\">
                        <td>{$i}</td>
                        <td>{$value['NombresCiudadano']}</td>
                        <td>{$value['ApellidosCiudadano']}</td>
                        <td style=\"color: green\">{$value['NumeroTitulo']}</td>
                        <td>{$value['Tipo']}</td>
                        <td>{$value['Nombre']}</td>
                        <td>{$value['Numero']}</td>
                        <td>{$value['Observaciones']}</td>
                        ";
                        if($value['Estado']==1){
                            echo "<td style=\"color: #BD54F5\">Activo</td>";
                        }else{
                            echo "<td style=\"color: #BD54F5\">Inactivo</td>";
                        }
                        echo "
                        <td>
                        <div class=\"row-btn row text-center\">
                        <form method=\"POST\" action=\"http://localhost/tituloActions/\">
                            <input type=\"hidden\" name=\"actionId\" value=\"12\"/>
                            <input type=\"hidden\" name=\"idTitulo\" value=\"{$value['idTitulo']}\"/>
                            <button style=\"color: FORESTGREEN; border:none; background:transparent; cursor:pointer;\" title=\"Ver Titulo\" type=\"submit\" class=\"fas fa-eye\"></button>
                        </form>
                        <form method=\"POST\" action=\"http://localhost/tituloActions/\">
                            <input type=\"hidden\" name=\"actionId\" value=\"13\"/>
                            <input type=\"hidden\" name=\"idTitulo\" value=\"{$value['idTitulo']}\"/>
                            <button style=\"color: DODGERBLUE; border:none; background:transparent; cursor:pointer;\" title=\"Traspasar Titulo\" class=\"fas fa-exchange-alt mx-1\" type=\"submit\"></button>
                        </form>
                            <a data-toggle=\"modal\" data-target=\"#reponerMd\" style=\"color: #2F2F2F\" href=\"#\" title=\"Reponer Titulo\" class=\"fas fa-copy mx-1\" onClick=\"reponerTitulo({$value['idTitulo']});\"></a>
                            <a id=\"eliminar\" style=\"color: #FF4500\" href=\"#\" title=\"Cancelar Titulo\" class=\"fas fa-times-circle mx-1\" data-toggle=\"modal\" data-target=\"#eliminarMd\" onClick=\"selTitulo({$value['NumeroTitulo']},{$value['idTitulo']}, '{$value['Observaciones']}');\"></a>
                        </div>
                        </td>
                        </tr>
                        ";
                    }
                }else{
                    
                }
        ?>
            </table>
        </div>
    </div>
</div>

<!-- Modal Eliminar-->
<div class="modal fade" id="eliminarMd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo $server;?>/tituloActions" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cancelar Titulo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-auto">
                    <p>Esta seguro que desea ELiminar el titulo a nombre de: <h4 style="text-align:center" id="numeroTitulo"></h4>
                    </p>
                    <div form-group>
                        <label>Observaciones:</label>
                        <textarea class="form-control" id="observa" name="Observaciones"></textarea>
                        <input type="hidden" id="idTitulo" name="idTitulo" value="">
                        <input type="hidden" id="actionId" name="actionId" value="3">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Reponer-->
<div class="modal fade" id="reponerMd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo $server;?>/tituloActions" method="post">
                       
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reporner Titulo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                       <label for="Titulo">Nuevo Numero Titulo:</label>
                       <input class="form-control" type="text" name="numeroTitulo" required>                        
                       <input type="hidden" name="idTitulo" id="idTitulo2" value="">   
                       <input type="hidden" name="actionId" value="8">                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-info">Reponer</button>
                    </div>
                </div>
        </form>
    </div>
</div>

<!--END-->
<script>
    selTitulo = function(NumeroTitulo, idTitulo, Observaciones) {
        document.getElementById('observa').value = Observaciones;
        document.getElementById('numeroTitulo').innerHTML = NumeroTitulo;
        id = document.getElementById("idTitulo");
        id.value = idTitulo;
    }
    reponerTitulo = function(idTitulo2) {
        id2 = document.getElementById("idTitulo2");
        id2.value = idTitulo2;
    }
</script>
<!--END-->

<?php require_once('Views/default/footer.php'); ?>