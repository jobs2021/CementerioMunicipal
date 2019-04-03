<?php 
    $titulo='Traslado';
    require_once('Views/default/header.php'); 

    $query = "SELECT idTraslado, (select concat(t2.NombresFallecido,' ',t2.ApellidosFallecido) from Enterramientos t2 where t1.idEnterramiento=t2.idEnterramiento) as 'Fallecido',Interesado,Parentesco,Destino,Fecha,Observaciones from Traslados t1 where t1.Estado='1';";

    $db = new ConexionDB();
    @$DataResult=$db->Query($query);
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
                <div class="input-group col-sm-4">
                    <input id="searchTraslado" type="text" class="form-control" name="busqueda" placeholder="Buscar...">
                    <div class="input-group-prepend rounded">
                        <a class="btn btn-dark rounded-right text-white"><i class="fas fa-search icon margin-right-5 margin-left-0"></i></a>
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
                            <th scope="col" class="col-hidden">Destino</th>
                            <th scope="col" class="col-hidden">Observaciones</th>
                            <th scope="col" style="width: 125px;"><a class="hidden">Acciones___</a></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i=1;
                        if($DataResult!=-1){
                            foreach ($DataResult as $key) {
                                $Fecha = date_format(date_create($key['Fecha']),'d/m/Y');
                               echo "<tr class=\"row-hover\">
                            <td class=\" details-control\" scope=\"row\">{$i}<i class=\"fa fa-chevron-down icon ml-2 full-info-down\" title=\"Mostrar Mas Información\"></i></td>
                            <td>{$key['Fallecido']}</td>
                            <td>{$key['Interesado']}</td>
                            <td>{$key['Parentesco']}</td>
                            <td>{$Fecha}</td>
                            <td class=\"col-hidden\">{$key['Destino']}</td>
                            <td class=\"col-hidden\">{$key['Observaciones']}</td>
                            <td class=\"text-right\">
                                <div class=\"row-btn\">
                                    <a href=\"#\" data-toggle=\"modal\" data-target=\"#modalAgregarParcela\" data-slide-to=\"0\"><i class=\"fa fa-edit icon\" title=\"Editar\"></i></a>
                                    <a idTraslado=\"{$key['idTraslado']}\" numero=\"{$i}\" href=\"#\" data-toggle=\"modal\" data-target=\"#modalEliminar\" class=\"text-danger btn-eliminar-traslado \"><i class=\"fas fa-trash icon\" title=\"Eliminar\"></i></a>
                                </div>
                            </td>
                        </tr>";
                        $i++;
                            }
                        }


                        
                        

                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- The Modal -->

<div class="modal fade" id="modalEliminar">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Elminar Registro</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <p id="idTextoDelete">Esta Seguro que quiere eliminar el registro 005?</p>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <form action="<?php echo "{$server}/inhumacionesActions"?>" method="POST">
                    <input type="hidden" name="actionId" value="9">
                    <input id="idTrasladoSend" type="hidden" name="idTraslado" value="">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- end -->

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
                        <form action="<?php echo $server;?>/inhumacionesActions" method="POST">
                            <input type="hidden" name="actionId" value="7">
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
                                <label for="txt1">Interesado:</label>
                                <input type="text" class="form-control" id="txt1" name="Interesado">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="txt2">Parentesco:</label>
                                    <input type="text" class="form-control" id="txt2" name="Parentesco">
                                </div>
                            <div class="form-group col-6">
                                <label for="txt3">Fecha:</label>
                                <input type="date" class="form-control" id="txt3" value="<?php echo date('Y-m-d'); ?>" name="Fecha">
                            </div>
                            </div>
                            <div class="form-group">
                                <label for="txt4">Destino:</label>
       
                                <input type="text" class="form-control" id="txt4" name="Destino">
                            </div>
                            <div class="form-group">
                                <label for="txt5">Observaciones:</label>
                                <textarea class="form-control" id="txt5" rows="2" name="Observaciones"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <input type="hidden" id="idFallecidoSend" name="idFallecido" value="">
                                    <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--- end modal -->




<!---hasta aca -->
<?php require_once('Views/default/footer.php'); ?>
<!-- modla -->

<script type="text/javascript">
    $(document).ready(function(){

        $('.btn-eliminar-traslado').click(function(event) {
           var id=$(this).attr('idTraslado');
           $('#idTrasladoSend').attr('value',id);
           $('#idTextoDelete').text('Esta seguro que desea eliminar el registro '+($(this).attr('numero'))+'?');
        });

    })
</script>


<!--- script -->
<script type="text/javascript">
$(document).ready(function() {



    var table = $('.table').DataTable(tableLanguage);

    $('#searchTraslado').on( 'keyup', function () {
        table.search( this.value ).draw();
    } );

     /* Formatting function for row details - modify as you need */
            function formatTraslado ( d ) {
                return '<div style="margin: 0px -12px!important;padding: 10px 15px;">'+
                    '<p>Fallecido: '+d[1]+'</p>'+
                    '<p>Interesado: '+d[2]+'</p>'+
                    '<p>Parentesco: '+d[3]+'</p>'+
                    '<p>Fecha: '+d[4]+'</p>'+
                    '<p>Destino: '+d[5]+'</p>'+
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
                    row.child( formatTraslado(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );


    function formatSearching(data){
        return('<a class="dropdown-item" dataId="'+data.idEnterramiento+'" dataFallecido="'+data.Fallecido+'"><div><b>'+data.Fallecido+'</b><br>'+data.Ubicacion+'</div></a>')
        
    }


    function listaSearch(data){
        var listado = '';
        data.forEach(function(element){
            listado +=formatSearching(element);
        })

        return listado+'<script type="text/javascript">$(".dropdown-item").click(function(event) { var id = $(this).attr("dataId"); $("#searchFallecido").val($(this).attr("dataFallecido")); $("#idFallecidoSend").val(id)});<\/script>' 
    }

    $('#searchFallecido').keyup(function(event) {

        var dataSend = { actionId: "8", searchFallecido: $('#searchFallecido').val() };

        $.ajax({
                url:   '<?php echo $server;?>/inhumacionesActions/',
                data:  dataSend,
                type:  'post',
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    console.log(response);
                    if (response == 'Sin Resultados' || response == '' || response == '-1') {
                        $('#divFallecidos').html('<a class="dropdown-item">Sin Resultados</a>');

                    } else if(response!="") {
                        var resultado = JSON.parse(response);
                            $('#divFallecidos').html(listaSearch(resultado.data));
                            
                    }
                }
        });



    });



});
</script>