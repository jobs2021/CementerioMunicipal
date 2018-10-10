<?php 
$titulo='Crear Titulo';

$consulta = new ConexionDB();
$variable= $consulta->Query("select idTipoTitulo, Tipo from tipotitulos");
$parcelas = $consulta->Query("select * from parcelas");

require_once('Views/default/header.php'); 
?>



<!--BREADCUMB-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $server;?>/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo $server;?>/titulos">Titulos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Crear Titulo</li>
    </ol>
</nav>



<!-- aca ira todo el codigo html de la vista-->

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="card card-register col-md-6 col-md-pull-9 mx-auto mt-4">
                <div class="card-header">
                    <h4>Informacion del Titular</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo $server;?>/tituloActions" method="POST">
                        <input type="hidden" name="actionId" value="1">
                        <div class=" col-sm-12 col-md-12 col-lg-12 padding-0">
                            <div class="row padding-bottom-15">
                                <div class="col-sm-12 col-md-10 col-lg-10 padding-top-15 mx-auto">
                                    <?php
                                        if (isset(explode('/',$_GET['action'])[1])){
                                            $idta=explode('/',$_GET['action'])[1];
                                            $tablaParcela = $consulta->Query("SELECT t1.Numero, t1.Poligono, t2.Descripcion, t3.Nombre FROM parcelas t1  INNER JOIN tipoparcela t2 ON t1.idTipoParcela = t2.idTipoParcela INNER JOIN cementerios t3 ON t1.idCementerio = t3.idCementerio where t1.idParcela={$idta}");
                                            if ($tablaParcela!=-1){
                                                foreach ($tablaParcela as $value) {
                                                    echo "
                                                    <div class=\"card text-center\">
                                                        <div class=\"card-header bg-principal text-light\">Cementerio: <strong>{$value['Nombre']}</strong></div>
                                                            <div class=\"card-body\">
                                                                <p>Parcela: {$value['Numero']}</p>
                                                                <p>Tipo: {$value['Descripcion']}</p>
                                                                <p>Poligono: {$value['Poligono']}</p>
                                                            </div>
                                                        <div class=\"col-sm-4 col-md-2 col-lg-2 padding-top-10 mx-auto\" style=\"min-height: 125px;\">
                                                            <button type=\"button\" class=\"btn btn-outline-dark w-100 h-100 btn-nuevo-cementerio\" data-toggle=\"modal\" data-target=\"#parcela\">
                                                            <i class=\"fas fa-edit icon mx-0\"></i>
                
                                                            </button>
                                                        </div>
                                                    </div>
                                        
                                                ";}
                                                
                                            }
                                            } else {
                                                    echo "
                                                    <div class=\"col-sm-4 col-md-2 col-lg-2 padding-top-15\" style=\"min-height: 125px;\">
                                                        <button type=\"button\" class=\"btn btn-outline-dark w-100 h-100 btn-nuevo-cementerio\" data-toggle=\"modal\" data-target=\"#parcela\">
                                                        <i class=\"fas fa-plus icon mx-0\"></i>
                                                        <span class=\"mx-4\">Agregar Parcela</span></button>
                                                    </div>";
                                                }
                    
                                                ?>

                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Nombres">Nombres</label>
                                <input name="nombre" type="text" class="form-control" id="Nombres" placeholder="Nombres">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Apellidos">Apellidos</label>
                                <input name="apellido" type="text" class="form-control" id="Apellidos" placeholder="Apellidos">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="Direccion">Direccion</label>
                            <input name="direccion" type="text" class="form-control" id="Direccion" placeholder="Direccion de domicilio">
                        </div>
                        <div class="form-group">
                            <label for="Dui">DUI</label>
                            <input name="dui" type="text" class="form-control" id="Dui" placeholder="Numero Unico de Identidad">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Profesion">Profesion</label>
                                <input name="profesion" type="text" class="form-control" id="Profesion" placeholder="Profesion u Ocupacion">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Fecha_Nacimiento">Fecha de Nacimiento</label>
                                <input name="fecha" class="form-control" id="Fecha_Nacimiento" type="text">
                            </div>
                        </div>

                        
                        <div class="col-sm-12 col-md-12 col-lg-12 padding-0 mx-auto">
                            <div class="form-row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="Numero_Titulo">Numero de Titulo</label>
                                    <input class="form-control" type="text" name="numero" id="Numero_Titulo" placeholder="Numero del titulo (opcional)">
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="select">Tipo de titulo</label>
                                    <select class="custom-select" name="tipo" id="inputGroupSelect01">
                                        <option selected>Seleccione el tipo de titulo</option>
                                        <?php
                                                    // listar cementerios
                                                    if ($variable!=-1) {
                                                        foreach ($variable as $value) {
                                                            echo "
                                                            <option value=\"{$value['idTipoTitulo']}\">{$value['Tipo']}</option>" ;
                                                        }
                                                    }
                                                ?>
                                    </select>
                                </div>
                            </div>
                            <input hidden type="number" name="idParcela" value="<?php if (isset(explode('/',$_GET['action'])[1])){
                                                                            echo explode('/',$_GET['action'])[1];
                                                                            } else{
                                                                            echo " 0"; } ?>">
                        </div>
                    <button class="btn btn-primary mt-4 float-right" type="submit">Registrar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal Parcela-->
<div class="modal fade bd-example-modal-lg" id="parcela" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Parcela</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col col-lg-12">
                    <form class="form-inline">
                        <input class="form-control col-lg-9 mr-sm-1 mx-4" type="search" placeholder="Numero de Parcela" aria-label="Search">
                        <button class="btn btn-dark my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </div>
                <div class="col-lg-12 mx-auto">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Sel</th>
                                    <th>Parcela</th>
                                    <th>Tipo</th>
                                    <th>Cementerio</th>
                                    <th>Poligono</th>
                                    <th>Coord X</th>
                                    <th>Coord Y</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                        </div>
                                    </td>
                                    <td>129876</td>
                                    <td>Perpetuidad</td>
                                    <td>Sn. José</td>
                                    <td>P04</td>
                                    <td>14.0818567</td>
                                    <td>-88.9014130</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        </div>
                                    </td>
                                    <td>129877</td>
                                    <td>Arrendamiento</td>
                                    <td>Central</td>
                                    <td>P101</td>
                                    <td>15.0818567</td>
                                    <td>-86.9014130</td>
                                </tr>
                            </table>
                        </div>
                        <form method="post" action="<?php echo $server;?>/tituloActions">
                            <input type="hidden" name="actionId" value="4">
                            <select class="custom-select" name="idParcela" id="inputGroupSelect01">
                                <option selected>Seleccione el tipo de titulo</option>
                                <?php
                    // listar parcelas
                    if ($parcelas!=-1) {
                        foreach ($parcelas as $value) {
                            echo "
                            <option value=\"{$value['idParcela']}\">{$value['Numero']}</option>" ;
                            }
                        }
                    ?>
                            </select>
                            <button class="btn btn-default mt-2" type="submit">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>

        </div>
    </div>
</div>


<!---hasta aca -->

<?php require_once('Views/default/footer.php'); ?>
