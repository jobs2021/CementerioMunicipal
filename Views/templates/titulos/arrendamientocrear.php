<?php 
$titulo='Arrendamientos';

$consulta = new ConexionDB();
$parcelas = $consulta->Query("select * from Parcelas");

require_once('Views/default/header.php'); 
?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card col-sm-12 col-md-8 col-lg-8 mx-auto">
            <div class="card-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Arrendamiento</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo $server;?>/tituloActions" method="POST">
                    <input type="hidden" name="actionId" value="7">
                    <div class=" col-sm-12 col-md-12 col-lg-12 padding-0">
                        <div class="row padding-bottom-15">
                            <div class="col-sm-12 col-md-6 col-lg-6 padding-top-15 mx-auto">
                                <?php
                                        if (isset(explode('/',$_GET['action'])[1])){
                                            $idta=explode('/',$_GET['action'])[1];
                                            $tablaParcela = $consulta->Query("SELECT t1.Numero, t1.Poligono, t3.Nombre FROM Parcelas t1  INNER JOIN TipoParcela t2 ON t1.idTipoParcela = t2.idTipoParcela INNER JOIN Cementerios t3 ON t1.idCementerio = t3.idCementerio where t1.idParcela={$idta}");
                                            if ($tablaParcela!=-1){
                                                foreach ($tablaParcela as $value) {
                                                    echo "
                                                    <div class=\"card text-center\">
                                                        <div class=\"card-header bg-principal text-light\">Cementerio: <strong>{$value['Nombre']}</strong></div>
                                                            <div class=\"card-body\">
                                                                <p>Parcela: {$value['Numero']}</p>
                                                                <p>Poligono: {$value['Poligono']}</p>
                                                            </div>
                                                        <div class=\"col-sm-4 col-md-3 col-lg-3 padding-top-10 mx-auto\" style=\"min-height: 65px;\">
                                                            <button type=\"button\" class=\"btn btn-outline-dark w-100 h-100 btn-nuevo-cementerio\" data-toggle=\"modal\" data-target=\"#parcela\">
                                                            <i class=\"fas fa-edit icon mx-0\"></i>
                
                                                            </button>
                                                        </div>
                                                    </div>
                                        
                                                ";}
                                                
                                            }
                                            } else {
                                                    echo "
                                                    <div class=\"col-sm-4 col-md-8 col-lg-8 mx-auto padding-top-15\" style=\"min-height: 80px;\">
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
                        <div class="form-group col-6 col-md-4 col-lg-4">
                            <label for="Nombre">Nombres:</label>
                            <input type="text" class="form-control" id="Nombre" name="nombre" placeholder="Nombres">
                        </div>
                        <div class="form-group col-6 col-md-4 col-lg-4">
                            <label for="Apellido">Apellidos:</label>
                            <input type="text" class="form-control" id="Apellido" name="apellido" placeholder="Apellidos">
                        </div>
                        <div class="form-group col-12 col-md-4 col-lg-4">
                            <label for="Direccion">Direccion:</label>
                            <input type="text" class="form-control" name="direccion" id="Direccion" placeholder="Direccion">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6 col-md-4 col-lg-4">
                            <label for="Fecha" :>Fecha de Pago:</label>
                            <input class="form-control" id="Fecha" type="text" name="fecha">
                        </div>
                        <div class="form-group col-6 col-md-4 col-lg-4">
                            <label for="F1SAM">F1SAM:</label>
                            <input type="text" class="form-control" name="f1sam" id="F1SAM" placeholder="PDF3456">
                        </div>
                        <div class="form-group col-12 col-md-4 col-lg-4">
                            <label for="anios">Años de Arrendamiento:</label>
                            <input type="number" class="form-control" id="anios" name="anios" placeholder="Años">
                        </div>
                    </div>
                    <input hidden type="number" name="idParcela" required value="<?php if (isset(explode('/',$_GET['action'])[1])){
                                                                            echo explode('/',$_GET['action'])[1];
                                                                            } else{
                                                                            echo "          
                                                                                "; 
                                                                            } 
                                                                            ?>">
                    <div class="form-row ">
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-primary float-right mx-2">Crear</button>
                            <a href="<?php echo $server;?>/arrendamientos" class="btn btn-secondary float-right ">Cancelar</a>
                        </div>
                    </div>
                </form>
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
                            <input type="hidden" name="actionId" value="6">
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


<?php require_once('Views/default/footer.php'); ?>
