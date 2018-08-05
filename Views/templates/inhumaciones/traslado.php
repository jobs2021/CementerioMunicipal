<?php 
    $titulo='Traslado';
    require_once('Views/default/header.php'); 
?>
<!-- aca ira todo el codigo html de la vista-->
<div class="container-fluid">

    <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row justify-content-center">
                            
                            <div class="col col-lg-8">
                                
                                <h2>Traslados</h2>
                            </div>
                                <button type="button" class="btn btn-outline-dark float-right" data-toggle="modal" data-target="#myModal">Nuevo Traslado</button>
                        </div>

                    </li>
    </ul>




    <div class="row justify-content-center clear-fix">
        <div class="col-12 padding-top-15 padding-bottom-15">
            <form class="form-inline justify-content-center" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="busqueda" placeholder="Nombre del Fallecido">
                    <div class="input-group-prepend rounded">
                        <button type="submit" class="btn btn-dark rounded-right">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="col-12 col-sm-12 col-md-10 col-lg-10 padding-0">
            <div class="table-responsive">
                <table class="table table-hover margin-top-15">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fallecido</th>
                            <th scope="col">Interesado</th>
                            <th scope="col">Parentesco</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Ubicacion</th>
                            <th scope="col">Observaciones</th>
                            <th scope="col" style="width: 125px;"><a class="hidden">Acciones___</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row-hover">
                            <td scope="row">1</td>
                                <td>001</td>
                                <td>004</td>
                                <td>4</td>
                                <td>4</td>
                                <td>4</td>
                                <td>4</td>
                                <td class="text-right">
                                    <div class="row-btn">
                                        <a href="<?php echo $server;?>/verparcela"><i class="fas fa-eye icon" title="Ver Parcela"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#modalAgregarParcela" data-slide-to="0"><i class="fa fa-edit icon" title="Editar"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#modalEliminar" class="text-danger"><i class="fas fa-trash icon" title="Eliminar"></i></a>
                                    </div>
                                </td>
                        </tr>
                        <tr class="row-hover">
                            <td scope="row">2</td>
                                <td>002</td>
                                <td>008</td>
                                <td>2</td>
                                <td>2</td>
                                <td>2</td>
                                <td>2</td>
                                <td class="text-right">
                                    <div class="row-btn">
                                        <a href="<?php echo $server;?>/verparcela"><i class="fas fa-eye icon" title="Ver Parcela"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#modalAgregarParcela" data-slide-to="0"><i class="fa fa-edit icon" title="Editar"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#modalEliminar" class="text-danger"><i class="fas fa-trash icon" title="Eliminar"></i></a>
                                    </div>
                                </td>
                        </tr>
                        <tr class="row-hover">
                            <td scope="row">3</td>
                                <td>007</td>
                                <td>002</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td class="text-right">
                                    <div class="row-btn">
                                        <a href="<?php echo $server;?>/verparcela"><i class="fas fa-eye icon" title="Ver Parcela"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#modalAgregarParcela" data-slide-to="0"><i class="fa fa-edit icon" title="Editar"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#modalEliminar" class="text-danger"><i class="fas fa-trash icon" title="Eliminar"></i></a>
                                    </div>
                                </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!---hasta aca -->
<?php require_once('Views/default/footer.php'); ?>
<!-- modla -->
<!-- Button to Open the Modal -->

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Traslado</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col">
                        <form action="<?php echo $server;?>/admincementerio" method="POST">
                            <!--div class="form-group">
                    <label for="edad">Falecido:</label>
                    <input type="text" class="form-control" id="edad">
                </div-->
                            <div class="form-group dropdown">
                                <label for="edad">Fallecido:</label>
                                <input type="text" class="form-control dropdown-toggle" id="searchFallecido" data-toggle="dropdown" autocomplete="off">
                                <div id="divFallecidos" class="dropdown-menu w-100">
                                    <!-- se llenara con la busqueda -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edad">Interesado:</label>
                                <input type="text" class="form-control" id="edad">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="edad">Parentesco:</label>
                                    <input type="text" class="form-control" id="edad">
                                </div>
                                <div class="form-group col-6">
                                    <label for="edad">Fecha:</label>
                                    <input type="text" class="form-control" id="edad" value="<?php echo date('d/m/Y'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edad">Destino:</label>
                                <input type="text" class="form-control" id="edad">
                            </div>
                            <div class="form-group">
                                <label for="edad">Observaciones:</label>
                                <textarea class="form-control" id="edad" rows="2"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div-->
        </div>
    </div>
</div>
<!--- script -->
<script type="text/javascript">
$(document).ready(function() {
    $('#searchFallecido').keyup(function(event) {

        if ($('#searchFallecido').val() == 'z') {
            $('#divFallecidos').html('<a class="dropdown-item">No existe Z</a>');
        } else {
            $('#divFallecidos').html('<a class="dropdown-item"><div><b>Juanito Perez</b><br>Cementerio #2, Pol35, Nicho 1</div></a><a class="dropdown-item"><div><b>Tomasito Jimenez</b><br>Cementerio #2, Pol35, Nicho 1</div></a><a class="dropdown-item"><div><b>Pancho Lara</b><br>Cementerio #2, Pol35, Nicho 1</div></a><script type="text/javascript">$(".dropdown-item").click(function(event) { $("#searchFallecido").val("Juanito perez");});<\/script>');
        }


    });



    //alert('readde');
});
</script>