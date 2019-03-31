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
                <button type="button" class="btn btn-outline-dark float-right" data-toggle="modal" data-target="#modalNuevaInhumacion">Nueva Inhumacion</button>
            </div>
        </li>
    </ul>
    <div class="row justify-content-center clear-fix">
        <div class="col-12 padding-top-15 padding-bottom-15">
            <form class="form-inline justify-content-center">
                <div class="input-group col-sm-4">
                    <input id="searchInhumacion" type="text" class="form-control" placeholder="Buscar" autocomplete="off">
                    <div class="input-group-prepend rounded">
                        <a class="btn btn-dark rounded-right text-white"><i class="fas fa-search icon margin-right-5 margin-left-0"></i></a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 col-sm-12 col-md-11 col-lg-11 padding-0">
            <div class="table-responsive">
                <table class="table table-hover margin-top-15">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fallecido</th>
                            <th scope="col">Interesado</th>
                            <th scope="col">Parentesco</th>
                            <th scope="col">Fecha</th>
                            <th scope="col" class="col-hidden">Ubicacion</th>
                            <th scope="col" class="col-hidden">Observaciones</th>
                            <th scope="col" style="width: 125px;"><a class="hidden">Acciones___</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row-hover row-overflow">
                            <td class=" details-control" scope="row">1</td>
                            <td>xxxxxxx xxxxxxx xxxxxxx xx </td>
                            <td>xxxxxxx xxxxxxx xxxxxxx xx </td>
                            <td>xxxxxxx xxxxxxx </td>
                            <td>xx/xx/xxxx</td>
                            <td class="col-hidden">Ubicacion</td>
                            <td class="col-hidden">Observaciones</td>
                            <td class="text-right" style="width: 170px!important;">
                                <div class="row-btn">
                                    <!--a href="<?php echo $server;?>/inhumacion"><i class="fas fa-eye icon" title="Ver Inhumacion"></i></a-->
                                    <a href="#" data-toggle="modal" data-target="#modalAgregarParcela" data-slide-to="0"><i class="fa fa-edit icon" title="Editar"></i></a>
                                    <a href="<?php echo $server;?>/inhumacion"><i class="fas fa-exchange-alt icon" title="Trasladar"></i></a>
                                    <a href="<?php echo $server;?>/inhumacion" class="text-danger"><i class="fas fa-external-link-alt icon" title="Exhumar"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#modalEliminar" class="text-danger"><i class="fas fa-trash icon" title="Eliminar"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr class="row-hover">
                            <td class=" details-control" scope="row">2</td>
                            <td>002</td>
                            <td>008</td>
                            <td>2</td>
                            <td>2</td>
                            <td class="col-hidden">2</td>
                            <td class="col-hidden">2</td>
                            <td class="text-right">
                                <div class="row-btn">
                                    <a href="<?php echo $server;?>/inhumacion"><i class="fas fa-eye icon" title="Ver Inhumacion"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#modalAgregarParcela" data-slide-to="0"><i class="fa fa-edit icon" title="Editar"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#modalEliminar" class="text-danger"><i class="fas fa-minus-circle icon" title="Exhumar"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr class="row-hover">
                            <td class=" details-control" scope="row">3</td>
                            <td>007</td>
                            <td>002</td>
                            <td>1</td>
                            <td>1</td>
                            <td class="col-hidden">1</td>
                            <td class="col-hidden">1</td>
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



<!-- The Modal --
<div class="modal fade" id="modalNueva">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            -- Modal Header --
            <div class="modal-header">
                <h4 class="modal-title">Nueva Inhumacion</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            -- Modal body --
            <div class="modal-body">

   
            <ul class="list-group list-group-flush">
               
                <li class="list-group-item">
                    <form action="<?php echo $server;?>/inhumacionesAction" method="POST">
                        <input type="hidden" name="actionId" value="1">
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-6">
                                <label for="nombre">Nombres Fallecido:</label>
                                <input type="text" class="form-control" id="nombre" name="NombresFallecido">
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-6">
                                <label for="txt1">Apellidos Fallecido:</label>
                                <input type="text" class="form-control" id="txt1" name="ApellidosFallecido">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-6">
                                <label for="txt2" :>Tipo Inhumación:</label>
                                <select class="form-control" id="txt2" name="TipoInhumacion">
                                    <option value="0">Normal</option>
                                    <option value="1">Permiso Abrir y Cerrar</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="txt3">Fecha Inicio:</label>
                                <input type="date" class="form-control" id="txt3" value="<?php echo date('Y-m-d'); ?>" name="FechaInicio">
                            </div>
                            <div class="form-group col-6">
                                <label for="txt5">Fecha Fin:</label>
                                <input type="date" class="form-control" id="txt5" value="<?php echo (date('Y')+7).date('-m-d'); ?>" name="FechaFin">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txt4">F1SAM:</label>
                            <input type="text" class="form-control" id="txt4" name="F1SAM">
                        </div>
                        <div class="form-group">
                            <label for="txt4">Observaciones:</label>
                            <textarea class="form-control" id="txt4" rows="2" name="Observaciones"></textarea>
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

-- End Modal -->

<!-- The Modal -->
<div class="modal fade" id="modalNuevaInhumacion">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Nueva Inhumacion</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="carruselNuevaInhumacion" class="carousel slide" data-pause="true">
                    <!-- The slideshow -->
                    <div class="carousel-inner w-100 h-100">
                        <div class="carousel-item active">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <form action="<?php echo $server;?>/inhumacionesAction" method="POST">
                                        <input type="hidden" name="actionId" value="1">
                                        <div class="form-row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label for="nombre">Nombres Fallecido:</label>
                                                <input type="text" class="form-control" id="nombre" name="NombresFallecido">
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label for="txt1">Apellidos Fallecido:</label>
                                                <input type="text" class="form-control" id="txt1" name="ApellidosFallecido">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label for="txt2" :>Tipo Inhumación:</label>
                                                <select class="form-control" id="txt2" name="TipoInhumacion">
                                                    <option value="0">Normal</option>
                                                    <option value="1">Permiso Abrir y Cerrar</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-6">
                                                <label for="txt3">Fecha Inicio:</label>
                                                <input type="date" class="form-control" id="txt3" value="<?php echo date('Y-m-d'); ?>" name="FechaInicio">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="txt5">Fecha Fin:</label>
                                                <input type="date" class="form-control" id="txt5" value="<?php echo (date('Y')+7).date('-m-d'); ?>" name="FechaFin">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txt4">F1SAM:</label>
                                            <input type="text" class="form-control" id="txt4" name="F1SAM">
                                        </div>
                                        <div class="form-group">
                                            <label for="txt4">Observaciones:</label>
                                            <textarea class="form-control" id="txt4" rows="2" name="Observaciones"></textarea>
                                        </div>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-primary btn-block" data-target="#carruselNuevaInhumacion" data-slide-to="1">Continuar</button>

                                </li>
                            </ul>
                        </div>

                        <div class="carousel-item">


                            <ul class="list-group list-group-flush" style="min-height: 400px">
                                <li class="list-group-item">
                                    <div class="form-group dropdown">
                                        <label for="edad">Titulo:</label>
                                        <input type="text" class="form-control dropdown-toggle" id="searchFallecido" data-toggle="dropdown" autocomplete="off" placeholder="Codigo del Titulo">
                                        <div id="divFallecidos" class="dropdown-menu w-100">
                                            <!-- se llenara con la busqueda -->
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="row">
                                <div class="col-6" style="padding-right: 15px;">
                                    <button type="button" class="btn btn-primary btn-block" data-target="#carruselNuevaInhumacion" data-slide-to="0">Volver</button>
                                    
                                </div>
                                <div class="col-6" style="padding-left: 15px;">
                                    <button id="btnSave" type="submit" class="btn btn-primary btn-block">Guardar</button>
                                    
                                </div>
                            </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->






<!---hasta aca -->
<?php require_once('Views/default/footer.php'); ?>

<script type="text/javascript">
    $(document).ready( function () {

        var table = $('.table').DataTable(tableLanguage);


        /* Formatting function for row details - modify as you need */
            function formatInhumacion ( d ) {
                return '<div style="margin: 0px -12px!important;padding: 10px 15px;">'+
                    '<p>Fallecido: '+d[1]+'</p>'+
                    '<p>Interesado: '+d[2]+'</p>'+
                    '<p>Parentesco: '+d[3]+'</p>'+
                    '<p>Fecha: '+d[4]+'</p>'+
                    '<p>Ubicacion: '+d[5]+'</p>'+
                    '<p>Observaciones: '+d[6]+'</p>'+
                '</table></div>';
            }


            // Add event listener for opening and closing details
            $('.table').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );
         
                console.log(row.data());

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( formatInhumacion(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );


    } );
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#searchFallecido').keyup(function(event) {

        if ($('#searchFallecido').val() == 'z') {
            $('#divFallecidos').html('<a class="dropdown-item">No existe Z</a>');
        } else {
            $('#divFallecidos').html('<a class="dropdown-item"><div><b>Juanito Perez</b><br>Cementerio #2, Pol35, Nicho 1</div></a><a class="dropdown-item"><div><b>Tomasito Jimenez</b><br>Cementerio #2, Pol35, Nicho 1</div></a><a class="dropdown-item"><div><b>Pancho Lara</b><br>Cementerio #2, Pol35, Nicho 1</div></a><script type="text/javascript">$(".dropdown-item").click(function(event) { $("#searchFallecido").val("Juanito perez");});<\/script>');
        }


    });

});
</script>
<script type="text/javascript">

$('#searchInhumacion').on( 'keyup', function () {
    table.search( this.value ).draw();
} );
</script>