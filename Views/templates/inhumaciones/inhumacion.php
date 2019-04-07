<?php 
    $titulo='Inhumacion';
    require_once('Views/default/header.php'); 

    $db = new ConexionDB();
    @$DataResult=$db->Query("SELECT t1.idEnterramiento ,concat(NombresFallecido,' ',ApellidosFallecido) as Fallecido, Interesado, FechaInicio, FechaFin,( select concat(t4.Nombre,', Parcela: ',t3.Numero,', Nicho: ',t2.NumeroOrden) from Nichos t2 inner join Parcelas t3 on t2.idParcela=t3.idParcela inner join Cementerios t4 on t3.idCementerio=t4.idCementerio where t2.idNicho=t1.idNicho ) as 'Ubicacion',Observaciones FROM Enterramientos t1 where t1.Estado='1';");
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
                            <th scope="col">Fecha Inicio</th>
                            <th scope="col">Fecha Fin</th>
                            <th scope="col" class="col-hidden">Ubicacion</th>
                            <th scope="col" class="col-hidden">Observaciones</th>
                            <th scope="col" style="width: 125px;"><a class="hidden">Acciones___</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i=1;
                            if ($DataResult!=-1) {
                                foreach ($DataResult as $key) {
                                    $FechaInicio = date_format(date_create($key['FechaInicio']),'d/m/Y');
                                    $FechaFin = date_format(date_create($key['FechaFin']),'d/m/Y');

                                echo "<tr class=\"row-hover row-overflow\">
                            <td class=\" details-control\" scope=\"row\">{$i}<i class=\"fa fa-chevron-down icon ml-2 full-info-down\" title=\"Mostrar Mas Información\"></i></td>
                            <td>{$key['Fallecido']}</td>
                            <td>{$key['Interesado']}</td>
                            <td>{$FechaInicio}</td>
                            <td>{$FechaFin}</td>
                            <td class=\"col-hidden\">{$key['Ubicacion']}</td>
                            <td class=\"col-hidden\">{$key['Observaciones']}</td>
                            <td class=\"text-right\" style=\"width: 170px!important;\">
                                <div class=\"row-btn\">
                                    <a href=\"#\" data-toggle=\"modal\" data-target=\"#modalAgregarParcela\" data-slide-to=\"0\"><i class=\"fa fa-edit icon\" title=\"Editar\"></i></a>
                                    <!--a href=\"{$server}/trasladar\"><i class=\"fas fa-exchange-alt icon\" title=\"Trasladar\"></i></a>
                                    <a href=\"{$server}/exhumacion\" class=\"text-danger\"><i class=\"fas fa-external-link-alt icon\" title=\"Exhumar\"></i></a-->
                                    <a idInhumacion=\"{$key['idEnterramiento']}\" numero=\"{$i}\" href=\"#\" data-toggle=\"modal\" data-target=\"#modalEliminar\" class=\"text-danger btn-eliminar-inhumacion\"><i class=\"fas fa-trash icon\" title=\"Eliminar\"></i></a>
                                </div>
                            </td>
                        </tr> ";

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
            <div class="modal-header pb-2">
                <h4 class="modal-title">Nueva Inhumacion</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-warning alert-dismissible fade show py-2" role="alert" style="margin: -16px -16px 0px -16px;display: none;">
                  <strong>Error!</strong> Debe rellenaar todos los campos.
                  <!--button type="button" class="close py-2" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button-->
                </div>
                <div id="carruselNuevaInhumacion" class="carousel slide" data-pause="true">
                    <!-- The slideshow -->
                    <div class="carousel-inner w-100 h-100">
                        <div class="carousel-item active">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <form class="form-add" action="<?php echo $server;?>/inhumacionesActions" method="POST">
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
                                        <div class="form-group">
                                            <label for="txti">Interesado:</label>
                                            <input type="text" class="form-control" id="txti" name="Interesado">
                                        </div>
                                        <!--div class="form-row">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label for="txt2" :>Tipo Inhumación:</label>
                                                <select class="form-control" id="txt2" name="TipoInhumacion">
                                                    <option value="0">Normal</option>
                                                    <option value="1">Permiso Abrir y Cerrar</option>
                                                </select>
                                            </div>
                                        </div-->
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
                                <li class="list-group-item py-0" style="border-bottom: 0;margin: 0">
                                    
                                    <label for="searchFallecido">Titulo:</label>
                                    <div class="input-group dropdown mb-2">
                                        <input type="text" class="form-control dropdown-toggle" id="searchFallecido" data-toggle="dropdown" autocomplete="nope" placeholder="Codigo del Titulo" style="text-align: center;">
                                        <div class="input-group-prepend rounded">
                                            <a class="btn btn-dark rounded-right text-white"><i class="fas fa-search icon margin-right-5 margin-left-0"></i></a>
                                        </div>
                                        <div id="divFallecidos" class="dropdown-menu w-100">
                                            <!-- se llenara con la busqueda -->
                                        </div>
                                    </div>
                                    
                                    <div id="TituloInhumacion" class="card px-2" style="background-color: rgba(0,0,0,0.05);">
                                        <!--p class="my-1"><b class="mt-1">Juanito Perez</b>,Titulo: 1234567890, Cementerio #2 1234567890, Parcela: 34, Nicho: 1</p-->
                                    </div>
                                </li>
                               
                                
                                <li class="list-group-item" style="border-top: 0; border-bottom: 0">
                                    
                                    <!-- start -->

                                    <div class="card">
                                <div class="card-body p-2">
                                    <div class="row justify-content-center">
                                        <div class="col">
                                            <div>
                                                <svg version="1.1" id="nicho" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="300px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve">
                                                    <g class="nicho3" data-toggle="tooltip" title="" data-placement="right">
                                                        <rect class="btn-hover3" activeOk="false" x="100.666" y="124.698" fill="rgba(0,0,0,0)" stroke="#007bff" stroke-width="1" stroke-miterlimit="10" width="99.776" height="32" />
                                                        <text class="text-hover3" transform="matrix(1 0 0 1 143.5537 145.0308)" fill="#007bff" font-family="'Arial'" font-size="15">3</text>
                                                    </g>
                                                    <g class="nicho2" data-toggle="tooltip" title="" data-placement="right">
                                                        <rect class="btn-hover2" activeOk="false" x="100.666" y="163.838" fill="rgba(0,0,0,0)" stroke="#007bff" stroke-width="1" stroke-miterlimit="10" width="99.776" height="32" />
                                                        <text class="text-hover2" transform="matrix(1 0 0 1 143.5537 183.0313)" fill="#007bff" font-family="'Arial'" font-size="15">2</text>
                                                    </g>
                                                    <g class="nicho1" data-toggle="tooltip" title="" data-placement="right">
                                                        <rect class="btn-hover1" activeOk="false" x="100.666" y="202.15" fill="rgba(0,0,0,0)" stroke="#007bff" stroke-width="1" stroke-miterlimit="10" width="99.776" height="32" />
                                                        <text class="text-hover1" transform="matrix(1 0 0 1 143.5537 221.6973)" fill="#007bff" font-family="'Arial'" font-size="15">1</text>
                                                    </g>
                                                    <g class="nicho0" data-toggle="tooltip" title="" data-placement="right">
                                                        <rect class="btn-hover0" activeOk="false" x="100.666" y="259.414" fill="rgba(0,0,0,0)" stroke="#007bff" stroke-width="1" stroke-miterlimit="10" width="99.776" height="32" />
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
                                
                            </div>

                                    <!-- end -->

                                            <input id="checkbox0" type="radio" name="nichoInhumar" value="0" hidden="true">
                                            <input id="checkbox1" type="radio" name="nichoInhumar" value="1" hidden="true">
                                            <input id="checkbox2" type="radio" name="nichoInhumar" value="2" hidden="true">
                                            <input id="checkbox3" type="radio" name="nichoInhumar" value="3" hidden="true">
                                            <input id="idNichoSend" type="hidden" name="idNicho" value="" required>


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
                    <input type="hidden" name="actionId" value="4">
                    <input id="idInhumacion" type="hidden" name="idInhumacion" value="0">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- end -->







<!---hasta aca -->
<?php require_once('Views/default/footer.php'); ?>


<script type="text/javascript">
    $(document).ready(function(){

        $('.btn-eliminar-inhumacion').click(function(event) {
           var id=$(this).attr('idInhumacion');
           $('#idInhumacion').attr('value',id);
           $('#idTextoDelete').text('Esta seguro que desea eliminar el registro '+($(this).attr('numero'))+'?');
        });

    })
</script>



<script type="text/javascript">
    $(document).ready( function () {

        $('rect').attr('rx','1');
        $('rect').attr('ry','1');

        for (var i = 0; i < 4; i++) {
            $('.btn-hover' + i).css('fill', 'rgba(0,0,0,0)');
            $('.btn-hover' + i).attr('stroke','rgba(0,0,0,0)');
            $('.text-hover' + i).css('fill', 'rgba(0,0,0,0)');
            $('.btn-hover' + i).attr('activeok',false);
            document.getElementById("checkbox" + i).checked = false;
            $('.nicho'+i).attr('data-original-title',"");
        }

        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })

        var table = $('.table').DataTable(tableLanguage);

        $('#searchInhumacion').on( 'keyup', function () {
            table.search( this.value ).draw();
        } );


        /* Formatting function for row details - modify as you need */
            function formatInhumacion ( d ) {
                return '<div style="margin: 0px -12px!important;padding: 10px 15px;">'+
                    '<p>Fallecido: '+d[1]+'</p>'+
                    '<p>Interesado: '+d[2]+'</p>'+
                    '<p>Fecha Inicio: '+d[3]+'</p>'+
                    '<p>Fecha Fin: '+d[4]+'</p>'+
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

<!--script type="text/javascript">
$(".dropdown-item").click(function(event) { $("#searchFallecido").val("Juanito perez");});
</script-->





<script type="text/javascript">

$(document).ready(function(){




        class nichoBtn {
            constructor(n) {
                this.activo = false;
                this.clase = '.nicho' + n;
                this.posicion = n;
                this.off = true;
            }

            nichoHover(n) {
                if (!this.off) {
                    $(".btn-hover" + n).css("fill", "#28a745");
                    $(".text-hover" + n).css("fill", "#fff");
                }
            }

            nichoLeave(n) {
                if (!this.off) {
                   // if (this.activo == false) {
                        $(".btn-hover" + n).css("fill", "#fff");
                        $(".text-hover" + n).css("fill", "#28a745");
                    //}
                }
            }

            toggleActivador() {
                if (!this.off) {
                    console.log("cli");

                    /*if (this.activo == false) {
                        this.activo = true;
                        this.nichoHover(this.posicion);
                        document.getElementById("checkbox" + this.posicion).checked = true;
                        console.log("act");

                    } else {
                        this.activo = false;
                        this.nichoLeave(this.posicion);
                        document.getElementById("checkbox" + this.posicion).checked = false;
                        console.log("unact");
                    }*/


                    if (!document.getElementById("checkbox" + this.posicion).checked) {
                        this.nichoHover(this.posicion);
                        document.getElementById("checkbox" + this.posicion).checked = true;
                        console.log("act");

                    } else {
                        this.nichoLeave(this.posicion);
                        document.getElementById("checkbox" + this.posicion).checked = false;
                        console.log("unact");
                    }


                    for (var i = 0; i < 4; i++) {
                        if (!(document.getElementById("checkbox" + i).checked) && $('.btn-hover' + i).attr('activeok')=='true') {
                            $('.btn-hover' + i).css('fill', 'rgba(0,0,0,0)');
                            $('.text-hover' + i).css('fill', '#28a745');
                            $('.btn-hover' + i).attr('stroke','#28a745');                            
                        }
                    }
                }
            }
        }

        function crearEvent(obj) {
            //$(obj.clase).mouseover(function() { obj.nichoHover(obj.posicion); });
            //$(obj.clase).mouseleave(function() { obj.nichoLeave(obj.posicion); });
            $(obj.clase).click(function() { obj.toggleActivador(); });
        }
        var nicho0 = new nichoBtn('0');
        var nicho1 = new nichoBtn('1');
        var nicho2 = new nichoBtn('2');
        var nicho3 = new nichoBtn('3');

        crearEvent(nicho0);
        crearEvent(nicho1);
        crearEvent(nicho2);
        crearEvent(nicho3);

        $('#btnSave').click(function() {
            var resultado = [];

            for (var i = 0; i <= 3; i++) {
                if (document.getElementById("checkbox" + i).checked == true) {
                    resultado.push(document.getElementById("checkbox" + i).value);

                }
            }
            var ResultadoSend = $('#checkbox'+resultado).attr('idNicho');
            $('#idNichoSend').attr('value',ResultadoSend);
            //alert(resultado);
        });













function clearNichos(){
    for (var i = 0; i < 4; i++) {
        $('.btn-hover' + i).css('fill', 'rgba(0,0,0,0)');
        $('.btn-hover' + i).attr('stroke','rgba(0,0,0,0)');
        $('.text-hover' + i).css('fill', 'rgba(0,0,0,0)');
        $('.btn-hover' + i).attr('activeok',false);
        document.getElementById("checkbox" + i).checked = false;
        $('.nicho'+i).attr('data-original-title',"");
    }
}









    function loadNichos(id){

        var NichosControl =[nicho0,nicho1,nicho2,nicho3];

        var dataSend = { actionId: "3", idParcela: id };

        $.ajax({
                url:   '<?php echo $server;?>/inhumacionesActions/',
                data:  dataSend,
                type:  'post',
                success:  function (response) {
                    var datos = JSON.parse(response);
                    console.log(datos);

                    for (var i = 0; i < 4; i++) {
                        $('.btn-hover' + i).css('fill', 'rgba(0,0,0,0)');
                        $('.btn-hover' + i).attr('stroke','rgba(0,0,0,0)');
                        $('.text-hover' + i).css('fill', 'rgba(0,0,0,0)');
                        $('.btn-hover' + i).attr('activeok',false);
                        document.getElementById("checkbox" + i).checked = false;
                        $('.nicho'+i).attr('data-original-title',"");
                        NichosControl[i].off=true;
                    }

                    datos.data.forEach(function(element){
                        if (element.Allow=="1" || element.Allow==null) {
                            $('.btn-hover' + element.NumeroOrden).css('fill', 'rgba(0,0,0,0)');
                            $('.btn-hover' + element.NumeroOrden).attr('stroke','#28a745');
                            $('.text-hover' + element.NumeroOrden).css('fill', '#28a745');
                             $('.btn-hover' + element.NumeroOrden).attr('activeok',true);
                            $('#checkbox' + element.NumeroOrden).attr('idNicho',element.idNicho);

                             $('.nicho'+element.NumeroOrden).attr('data-original-title',"Disponible");
                            NichosControl[element.NumeroOrden].off=false;
                            
                        }else if(element.Allow=="0"){

                            $('.btn-hover' + element.NumeroOrden).css('fill', '#dc3545');
                            $('.btn-hover' + element.NumeroOrden).attr('stroke','#dc3545');
                            $('.text-hover' + element.NumeroOrden).css('fill', '#fff');
                            NichosControl[element.NumeroOrden].off=true;
                            $('.btn-hover' + element.NumeroOrden).attr('activeok',false);
                            $('.nicho'+element.NumeroOrden).attr('data-original-title',"Ocupado");

                        }else{
                            console.log(element);
                        }
                    })



                    
                }
        });

    }






$(document).on('changeNichos',function (objectEvent, data){
       loadNichos(data);
});



















    //{"idTitulo":"1","NumeroTitulo":"092034","Tipo":"Perpetuidad por Primera Vez","Ciudadano":"pedro paramo","Parcela":"01214","Cementerio":"Vera Cruz","Proceso":null,"Estado":"1"}

    function formatSearching(data){
        return(
            '<a class="dropdown-item list-fallecidos-search" data="'+btoa(JSON.stringify(data))+'"><div><b>'+data.Ciudadano+'</b>,Titulo: '+data.NumeroTitulo+', '+data.Cementerio+', Parcela: '+data.Parcela+'</div></a>'
        )
        
    }

    //<p class="my-1"><b class="mt-1">\'+datos.Ciudadano+\'</b>,Titulo: \'+datos.NumeroTitulo+\', \'+datos.Cementerio+\', Parcela: \'+datos.Parcela+\'</p>



    function listaSearch(data){
        var listado = '';
        data.forEach(function(element){
            listado +=formatSearching(element);
        });

        return listado+'<script type="text/javascript">$(".dropdown-item").click(function(event) { var datos = JSON.parse(atob($(this).attr("data"))); var htmlData = \' <p class="my-1"><b class="mt-1">\'+datos.Ciudadano+\'</b>,Titulo: \'+datos.NumeroTitulo+\', \'+datos.Cementerio+\', Parcela: \'+datos.Parcela+\'</p> \'; $("#searchFallecido").val(datos.NumeroTitulo);  $("#TituloInhumacion").html(htmlData);     $(document).trigger("changeNichos", datos.idParcela );     /*loadNichos(datos.idParcela);*/ });<\/script>' 
    }

    $('#searchFallecido').keyup(function(event) {

        var dataSend = { actionId: "2", TituloSearch: $('#searchFallecido').val() };

        $.ajax({
                url:   '<?php echo $server;?>/inhumacionesActions/',
                data:  dataSend,
                type:  'post',
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    //console.log(response);
                    if (response == 'Sin Resultados') {
                        $('#divFallecidos').html('<a class="dropdown-item">'+response+'</a>');
                        $("#TituloInhumacion").html("");


                        clearNichos();

                    } else {
                        var resultado = JSON.parse(response);
                            $('#divFallecidos').html(listaSearch(resultado.data));
                            
                    }
                }
        });



    });





$('.form-add').on('submit',function(e){
    if($("#idNichoSend").attr('value')=="" || $("#nombre").attr('value')=="" || $("#txt1").attr('value')=="" || $("#txt4").attr('value')==""){
        e.preventDefault();
        $('.alert').css('display','block');
       
    }
    
});


$('.alert').alert();
//$('.alert').alert('fade');


})


</script>