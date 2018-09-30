<?php 
    $titulo='Inhumacion';
    require_once('Views/default/header.php'); 
?>
<!-- aca ira todo el codigo html de la vista-->
<div class="container-fluid">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="row justify-content-center">
                <div class="col col-lg-8">
                    <h2>Inhumaciones</h2>
                </div>
                <button type="button" class="btn btn-outline-dark float-right" data-toggle="modal" data-target="#modalNueva">Nueva Inhumacion</button>
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
                                    <a href="<?php echo $server;?>/inhumacion"><i class="fas fa-eye icon" title="Ver Inhumacion"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#modalAgregarParcela" data-slide-to="0"><i class="fa fa-edit icon" title="Editar"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#modalEliminar" class="text-danger"><i class="fas fa-minus-circle icon" title="Exhumar"></i></a>
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
                                    <a href="<?php echo $server;?>/inhumacion"><i class="fas fa-eye icon" title="Ver Inhumacion"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#modalAgregarParcela" data-slide-to="0"><i class="fa fa-edit icon" title="Editar"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#modalEliminar" class="text-danger"><i class="fas fa-minus-circle icon" title="Exhumar"></i></a>
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
                                    <a href="<?php echo $server;?>/inhumacion"><i class="fas fa-eye icon" title="Ver Inhumacion"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#modalAgregarParcela" data-slide-to="0"><i class="fa fa-edit icon" title="Editar"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#modalEliminar" class="text-danger"><i class="fas fa-minus-circle icon" title="Exhumar"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- The Modal -->
<div class="modal fade" id="modalNueva">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Nueva Inhumacion</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">

                



   
            <ul class="list-group list-group-flush">
               
                <li class="list-group-item">
                    <form action="<?php echo $server;?>/admincementerio" method="POST">
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-6">
                                <label for="nombre">Nombres Fallecido:</label>
                                <input type="text" class="form-control" id="nombre">
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-6">
                                <label for="edad">Apellidos Fallecido:</label>
                                <input type="text" class="form-control" id="edad">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-6">
                                <label for="sel2" :>Tipo Inhumación:</label>
                                <select class="form-control" id="sel2">
                                    <option>Tipo 1</option>
                                    <option>Tipo 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="edad">Fecha Inicio:</label>
                                <input type="text" class="form-control" id="edad" value="<?php echo date('d/m/Y'); ?>">
                            </div>
                            <div class="form-group col-6">
                                <label for="edad">Fecha Fin:</label>
                                <input type="text" class="form-control" id="edad" value="<?php echo date('d/m/').(date(Y)+7); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edad">F1SAM:</label>
                            <input type="text" class="form-control" id="edad">
                        </div>
                        <div class="form-group">
                            <label for="edad">Observaciones:</label>
                            <textarea class="form-control" id="edad" rows="2"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-3">
                                <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
 
   







            </div>
        </div>
    </div>
</div>


<!---hasta aca -->
<?php require_once('Views/default/footer.php'); ?>
