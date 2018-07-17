<?php 
	$titulo='Parcelas';
	require_once('Views/default/header.php'); 
?>
<!-- aca ira todo el codigo html de la vista-->
<div class="container-fluid">
    <ul class="breadcrumb rounded-0 margin-l-r-15">
        <li class="breadcrumb-item"><a href="<?php echo $server;?>/cementerios">Cementerios</a></li>
        <li class="breadcrumb-item active">
            <a href="<?php echo $server;?>/admincementerio">Monte Piedad</a>
        </li>
        <li class="breadcrumb-item active">Parcelas</li>
    </ul>
    <div class="row justify-content-center">
        <div class="col-12 padding-top-15 padding-bottom-15">
            <form class="form-inline justify-content-center" action="/action_page.php">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Numero o Poligono">
                    <div class="input-group-prepend rounded">
                        <button type="submit" class="btn btn-primary rounded-right">Buscar</button>
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
                            <th scope="col">Numero</th>
                            <th scope="col">Poligono</th>
                            <th scope="col">Nichos</th>
                            <th scope="col" style="width: 125px;"><a class="hidden">Acciones___</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row-hover">
                            <td scope="row">1</th>
                            <td>001</td>
                            <td>004</td>
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
                            <td scope="row">2</th>
                            <td>002</td>
                            <td>008</td>
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
                            <td scope="row">3</th>
                            <td>007</td>
                            <td>002</td>
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
<!-- The Modal -->
<div class="modal fade" id="modalAgregarParcela">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Editar Parcela</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="carruselAgregarNicho" class="carousel slide" data-pause="true">
                    <!-- The slideshow -->
                    <div class="carousel-inner w-100 h-100">
                        <div class="carousel-item active">
                            <div class="card">
                                <div class="card-body">
                                    <form action="<?php echo $server;?>/admincementerio" method="POST">
                                        <div class="form-group">
                                            <label for="nombre">Número:</label>
                                            <input type="text" class="form-control" id="nombre">
                                        </div>
                                        <div class="form-group">
                                            <label for="edad">Poligono:</label>
                                            <input type="text" class="form-control" id="edad">
                                        </div>
                                        <div class="form-group">
                                            <label for="sel2" :>Tipo:</label>
                                            <select class="form-control" id="sel2">
                                                <option>Tipo 1</option>
                                                <option>Tipo 2</option>
                                            </select>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-6">
                                                <label for="edad">Coordenadas X:</label>
                                                <input type="text" class="form-control" id="edad">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="edad">Coordenadas Y:</label>
                                                <input type="text" class="form-control" id="edad">
                                            </div>
                                        </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary btn-block" data-target="#carruselAgregarNicho" data-slide-to="1">Continuar</button>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card">
                                <div class="card-header">Selecciona los nichos para activarlos</div>
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col">
                                            <div>
                                                <svg version="1.1" id="nicho" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="300px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve">
                                                    <g class="nicho3">
                                                        <rect class="btn-hover3" x="100.666" y="124.698" fill="rgba(0,0,0,0)" stroke="#007bff" stroke-width="1" stroke-miterlimit="10" width="99.776" height="32" />
                                                        <text class="text-hover3" transform="matrix(1 0 0 1 143.5537 145.0308)" fill="#007bff" font-family="'Arial'" font-size="15">3</text>
                                                    </g>
                                                    <g class="nicho2">
                                                        <rect class="btn-hover2" x="100.666" y="163.838" fill="rgba(0,0,0,0)" stroke="#007bff" stroke-width="1" stroke-miterlimit="10" width="99.776" height="32" />
                                                        <text class="text-hover2" transform="matrix(1 0 0 1 143.5537 183.0313)" fill="#007bff" font-family="'Arial'" font-size="15">2</text>
                                                    </g>
                                                    <g class="nicho1">
                                                        <rect class="btn-hover1" x="100.666" y="202.15" fill="rgba(0,0,0,0)" stroke="#007bff" stroke-width="1" stroke-miterlimit="10" width="99.776" height="32" />
                                                        <text class="text-hover1" transform="matrix(1 0 0 1 143.5537 221.6973)" fill="#007bff" font-family="'Arial'" font-size="15">1</text>
                                                    </g>
                                                    <g class="nicho0">
                                                        <rect class="btn-hover0" x="100.666" y="259.414" fill="rgba(0,0,0,0)" stroke="#007bff" stroke-width="1" stroke-miterlimit="10" width="99.776" height="32" />
                                                        <text class="text-hover0" transform="matrix(1 0 0 1 144.8867 280.0605)" fill="#007bff" font-family="'Arial'" font-size="15">0</text>
                                                    </g>
                                                    <path fill="#B1B1B1" d="M235.761,240.162V110.478c0.177-0.626,0.31-1.27,0.383-1.933h8.85c8.512,0,15.412-5.373,15.412-12v-6.435
                        c0-6.628-6.9-12-15.412-12h-21.735v-3.144c0-6.208-4.701-11.241-10.501-11.241h-11.769c-1.27-9.64-22.542-17.378-49.104-17.884
                        V20.328h11.712c0.961,0,1.738-1.217,1.738-2.718s-0.777-2.718-1.738-2.718h-11.712V2.717c0-1.5-1.217-2.717-2.717-2.717
                        c-1.501,0-2.718,1.217-2.718,2.717v12.175h-11.712c-0.96,0-1.738,1.217-1.738,2.718s0.778,2.718,1.738,2.718h11.712v25.511
                        c-26.61,0.488-47.934,8.235-49.205,17.887H84.91c-5.8,0-10.501,5.032-10.501,11.241v3.144H57.34c-8.512,0-15.412,5.372-15.412,12
                        v6.435c0,6.627,6.9,12,15.412,12h7.769v131.617H0v13.596h300v-13.596H235.761z M95.543,119.219h109.783v120.943H95.543V119.219z" />
                                                    <polygon fill="#C99D66" points="205.326,253.758 205.326,296.526 95.543,296.526 95.543,253.758 0,253.758 0,300.361 
                        85.543,300.361 85.543,300 195.326,300 195.326,300.361 300,300.361 300,253.758 " />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row margin-top-15">
                                        <div class="col-6">
                                            <input id="checkbox0" type="checkbox" name="nicho0" value="nicho0" hidden="true">
                                            <input id="checkbox1" type="checkbox" name="nicho1" value="nicho1" hidden="true">
                                            <input id="checkbox2" type="checkbox" name="nicho2" value="nicho2" hidden="true">
                                            <input id="checkbox3" type="checkbox" name="nicho3" value="nicho3" hidden="true">
                                            <button type="button" class="btn btn-primary btn-block" data-target="#carruselAgregarNicho" data-slide-to="0">Volver</button>
                                        </div>
                                        <div class="col-6">
                                            <button id="btnSave" type="button" class="btn btn-primary btn-block">Guardar</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- The Modal -->

<div class="modal fade" id="modalEliminar">
    - 115 -
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Elminar Parcela</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Esta Seguro que quiere eliminar la parcela 005?
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
            </div>
        </div>
    </div>
</div>







<?php require_once('Views/default/footer.php'); ?>
