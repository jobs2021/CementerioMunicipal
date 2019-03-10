<?php 

    @$idParcela=explode('/',$_GET['action'])[1];

    if (!isset($idParcela)) {
        header("location:".$server.'/cementerios/');
        exit();
    }
    
    $consulta = new ConexionDB();

    $parcela= $consulta->Query("select (select (count(t1.idParcela) - count(t3.idEnterramiento)) from Parcelas t1 inner join Nichos t2 on t1.idParcela=t2.idParcela left join Enterramientos t3 on t2.idNicho=t3.idNicho where t1.idParcela='{$idParcela}' and t2.Estado='1') as NichosDisponibles, t1.idParcela, idCementerio, Numero, Poligono, (select count(idNicho) from Parcelas t1 inner join Nichos t2 on t1.idParcela=t2.idParcela where t2.Estado='1' and t1.idParcela='{$idParcela}') as Nichos,(select idTitulo from Titulos where idParcela=t1.idParcela limit 1) as Titular,(select Descripcion from TipoParcela tp where tp.idTipoParcela=t1.idTipoParcela) as TipoParcela,CoordenadaX,CoordenadaY from Parcelas t1 left join Nichos t2 on t1.idParcela=t2.idParcela where t1.idParcela='{$idParcela}' group by idParcela,Numero,Poligono,Titular,idCementerio,TipoParcela,CoordenadaX,CoordenadaY")[0];

    $tipoParcela = $consulta->Query("select * from TipoParcela");

    if ($parcela==-1) {
        header("location:".$server.'/cementerios/');
        exit();
    }



    //$parcela= $consulta->Query("select * from Parcelas where idParcela={$idParcela}")[0];
    @$nombreCementerio=$consulta->Query("select Nombre from Cementerios where idCementerio={$parcela['idCementerio']}")[0];
    $titular=($parcela['Titular']) ? $parcela['Titular']:'  - - -  - - - ';


    $titulo='Admin Cementerio';
    require_once('Views/default/header.php');
?>
<div class="container-fluid">

    <!-- trash code-->

                <div class="fixed-action-btn" data-toggle="tooltip" title="Papelera" data-placement="left">
                    <a class="btn-floating btn-lg bg-primary" data-toggle="modal" data-target="#ModalTrash">
                        <i class="fas fa-trash" style="color:#FFF;font-size: 25px;"></i>
                    </a>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="ModalTrash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Papelera de Reciclaje</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        ...
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Guardar</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end trash code-->
                
    <ul class="breadcrumb rounded-0 margin-l-r-15">
        <li class="breadcrumb-item"><a href="<?php echo $server;?>/cementerios">Cementerios</a></li>
        <li class="breadcrumb-item">
            <?php echo "<a href=\"{$server}/admincementerio/{$parcela['idCementerio']}\">{$nombreCementerio['Nombre']}</a>";?>
        </li>
        <li class="breadcrumb-item"><?php echo "<a href=\"{$server}/parcelas/{$parcela['idCementerio']}\">Parcelas</a>";?></li>
        <li class="breadcrumb-item active"><?php echo $parcela['Numero']; ?></li>
    </ul>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-10 padding-top-15">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="clearfix w-100">
                                <h3 class="float-left margin-bottom-0"><?php echo $parcela['Numero']; ?></h3>
                                <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#modalEditar">Editar</button>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <?php
                        echo "
                        <p>Titular: {$titular}</p>
                        <p>Poligono: {$parcela['Poligono']}</p>
                        <p>Tipo: {$parcela['TipoParcela']}</p>
                        <p>Nichos: {$parcela['Nichos']}</p>
                        <p>Nichos Disponibles: {$parcela['NichosDisponibles']}</p>
                        ";
                        ?>
                    </li>
                    <li class="list-group-item">
                        <h4>Ubicacion</h4>
                        <div id="map" class="bg-light" style="width: 100%;height: 300px;max-width: 500px;">


                              <script>
                                  function initMap() {
                                    var myLatLng = {lat: 14.041644, lng: -88.938102};

                                    // Create a map object and specify the DOM element
                                    // for display.
                                    var map = new google.maps.Map(document.getElementById('map'), {
                                      center: myLatLng,
                                      zoom: 16
                                    });

                                    // Create a marker and set its position.
                                    var marker = new google.maps.Marker({
                                      map: map,
                                      position: myLatLng,
                                      title: 'Hello World!'
                                    });
                                  }

                                </script>
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKO_WwA9ZbX1C-arxe8_52eZmJJhXHraw&callback=initMap"
                                    async defer></script>





                        </div>
                    </li>
                    <li class="list-group-item padding-l-r-0 margin-l-r-15">
                        <h4 style="margin-left: 30px;">Nichos</h4>
                        <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-8 padding-0">
                            
                            <div class="table-responsive">
                                <table class="table table-hover margin-top-15">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Difunto</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col" style="width: 125px;"><a class="hidden">Acciones___</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query="select NumeroOrden,t1.idNicho,(select Descripcion from CtlEstadosNichos where idCtlEstadosNicho=t1.idCtlEstadosNicho) as Estado,(select FechaInicio from Enterramientos t2 where idNicho=t1.idNicho) as Fecha,(select concat(NombresFallecido,' ',ApellidosFallecido) from Enterramientos t2 where idNicho=t1.idNicho) as Difunto from Nichos t1 where t1.idParcela='{$idParcela}' and t1.Estado='1' order by NumeroOrden asc;";
                                        $resultado=$consulta->Query($query);
                                        $nombres=[];

                                        if ($resultado!=-1) {
                                            foreach ($resultado as $row) {
                                            $difunto=($row['Difunto']!='')? $row['Difunto']:' - - -  - - -';
                                            $fecha=($row['Fecha']!='')? $row['Fecha']:' - - -';
                                            //array_push($nombres, ($row['Difunto']!='')? $row['Difunto'] : 'Disponible');
                                            $nombres[$row['NumeroOrden']]=($row['Difunto']!='')? $row['Difunto'] : 'Disponible';
                                            echo "
                                            <tr class=\"row-hover\">
                                                <td scope=\"row\">{$row['NumeroOrden']}</th>
                                                <td>{$difunto}</td>
                                                <td>{$fecha}</td>
                                                <td class=\"text-primary\">{$row['Estado']}</td>
                                                <td class=\"text-right\">
                                                    <div class=\"row-btn\">
                                                        <a href=\"#\" data-toggle=\"modal\" data-target=\"#modalInfoNicho\"><i class=\"fas fa-info-circle icon\" title=\"Ver Resumen\"></i></a>
                                                        <a href=\"#\" data-toggle=\"modal\" data-target=\"#modalEliminar\" class=\"text-danger\"><i class=\"fas fa-trash icon\" title=\"Eliminar\"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            ";
                                            }
                                        }

                                        
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>









                        <div class="col-12 col-sm-12 col-md-12 col-lg-4">


                            <svg version="1.1" id="nicho" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="300px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve">
    <g class="nicho3"<?php echo (isset($nombres[3]))? " data-toggle=\"tooltip\" title=\"{$nombres[3]}\" data-placement=\"right\"":""; ?>>
        <rect class="btn-hoverS3" x="100.666" y="124.698" fill="rgba(0,0,0,0)" stroke="rgba(0,0,0,0)" stroke-width="1" stroke-miterlimit="10" width="99.776" height="32" />
        <text class="text-hoverS3" transform="matrix(1 0 0 1 143.5537 145.0308)" fill="rgba(0,0,0,0)" font-family="'Arial'" font-size="15">3</text>
    </g>
    <g class="nicho2"<?php echo (isset($nombres[2]))? " data-toggle=\"tooltip\" title=\"{$nombres[2]}\" data-placement=\"right\"":""; ?>>
        <rect class="btn-hoverS2" x="100.666" y="163.838" fill="rgba(0,0,0,0)" stroke="rgba(0,0,0,0)" stroke-width="1" stroke-miterlimit="10" width="99.776" height="32" />
        <text class="text-hoverS2" transform="matrix(1 0 0 1 143.5537 183.0313)" fill="rgba(0,0,0,0)" font-family="'Arial'" font-size="15">2</text>
    </g>
    <g class="nicho1"<?php echo (isset($nombres[1]))? " data-toggle=\"tooltip\" title=\"{$nombres[1]}\" data-placement=\"right\"":""; ?>>
        <rect class="btn-hoverS1" x="100.666" y="202.15" fill="rgba(0,0,0,0)" stroke="rgba(0,0,0,0)" stroke-width="1" stroke-miterlimit="10" width="99.776" height="32" />
        <text class="text-hoverS1" transform="matrix(1 0 0 1 143.5537 221.6973)" fill="rgba(0,0,0,0)" font-family="'Arial'" font-size="15">1</text>
    </g>
    <g class="nicho0"<?php echo (isset($nombres[0]))? " data-toggle=\"tooltip\" title=\"{$nombres[0]}\" data-placement=\"right\"":""; ?>>
        <rect class="btn-hoverS0" x="100.666" y="259.414" fill="rgba(0,0,0,0)" stroke="rgba(0,0,0,0)" stroke-width="1" stroke-miterlimit="10" width="99.776" height="32" />
        <text class="text-hoverS0" transform="matrix(1 0 0 1 144.8867 280.0605)" fill="rgba(0,0,0,0)" font-family="'Arial'" font-size="15">0</text>
    </g>
    <path fill="#494A47" d="M235.761,240.162V110.478c0.177-0.626,0.31-1.27,0.383-1.933h8.85c8.512,0,15.412-5.373,15.412-12v-6.435
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

                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="modalEditar">
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
                                    <form id="formEditar" action="<?php echo $server."/parcelaActions/{$idParcela}";?>" method="POST">
                                        <input type="hidden" name="actionId" value="2">
                                        <input type="hidden" name="vista" value="1">
                                        <input type="hidden" name="idCementerio" value="<?php echo $parcela['idCementerio']; ?>">
                                        <input type="hidden" name="nichosNew" id="nichosNew">
                                        <input type="hidden" name="nichosDelete" id="nichosDelete">
                                        <div class="form-group">
                                            <label for="numero">Número:</label>
                                            <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $parcela['Numero']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="poligono">Poligono:</label>
                                            <input type="text" class="form-control" id="poligono" name="poligono" value="<?php echo $parcela['Poligono']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="tipo" :>Tipo:</label>
                                            <select class="form-control" id="tipo" name="tipo">
                                                <?php

                                                foreach ($tipoParcela as $value) {
                                                    echo"<option id=\"tipo{$value['idTipoParcela']}\" value=\"{$value['idTipoParcela']}\">{$value['Descripcion']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-6">
                                                <label for="coordenadaX">Coordenadas X:</label>
                                                <input type="text" class="form-control" id="coordenadaX" name="coordenadaX" value="<?php echo $parcela['CoordenadaX']; ?>">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="coordenadaY">Coordenadas Y:</label>
                                                <input type="text" class="form-control" id="coordenadaY" name="coordenadaY" value="<?php echo $parcela['CoordenadaY']; ?>">
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
                                            <input id="checkbox0" type="checkbox" name="nicho0" value="0" hidden="true">
                                            <input id="checkbox1" type="checkbox" name="nicho1" value="1" hidden="true">
                                            <input id="checkbox2" type="checkbox" name="nicho2" value="2" hidden="true">
                                            <input id="checkbox3" type="checkbox" name="nicho3" value="3" hidden="true">
                                            <button type="button" class="btn btn-primary btn-block" data-target="#carruselAgregarNicho" data-slide-to="0">Volver</button>
                                        </div>
                                        <div class="col-6">
                                            <button id="btnSave" type="submit" class="btn btn-primary btn-block">Guardar</button>
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
<div class="modal fade" id="modalInfoNicho">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Nicho 0</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">

                <p>Parcel: 0003</p>
                <p>Titular: Jose Pedrito del Rancho</p>
                <p>control estado: optimo</p>
                <p>Fecha Contruccion: 08/02/1999</p>
                <p>Estado: Disponible&emsp;<label class="bs-switch">.
                      <input id="disponible" class="bs-switch" type="checkbox" checked="true">
                      <span class="slider round"></span>
                    </label></p>
                    
            </div>
        </div>
    </div>
</div>



<?php require_once('Views/default/footer.php'); ?>

<script type="text/javascript">
        // editar nicho

        class nichoBtn {
            constructor(n) {
                this.activo = false;
                this.clase = '.nicho' + n;
                this.posicion = n;
                //this.toggleActivador();
            }

            nichoHover(n) {
                $(".btn-hover" + n).css("fill", "#007bff");
                $(".text-hover" + n).css("fill", "#fff");
            }

            nichoLeave(n) {
                if (this.activo == false) {
                    $(".btn-hover" + n).css("fill", "#fff");
                    $(".text-hover" + n).css("fill", "#007bff");
                }
            }

            toggleActivador() {
                if (this.activo == false) {
                    this.activo = true;
                    this.nichoHover(this.posicion);
                    document.getElementById("checkbox" + this.posicion).checked = true;
                } else {
                    this.activo = false;
                    this.nichoLeave(this.posicion);
                    document.getElementById("checkbox" + this.posicion).checked = false;
                }
            }
        }

        function crearEvent(obj) {
            $(obj.clase).mouseover(function() { obj.nichoHover(obj.posicion); });
            $(obj.clase).mouseleave(function() { obj.nichoLeave(obj.posicion); });
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

            var nichosArray =[nicho0,nicho1,nicho2,nicho3];

            var nichosR=[];

            <?php
                foreach ($resultado as $num) {
                    echo "nicho".$num['NumeroOrden'].'.toggleActivador();';
                    echo "nichosR.push('{$num['NumeroOrden']}');";
                }
            ?> 

    // nicho vector
   $(document).ready(function() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $('#disponible').click(function(event) {
            if ($(this).val()=='on') {
                $(this).val('off');
            }else{
                $(this).val('on');
            }
            //alert($(this).val());
        });

    <?php

    for ($i = 0; $i < 4; $i++) {
       echo "
        $('.btn-hoverS' + {$i}).css('fill', 'rgba(0,0,0,0)');
        $('.text-hoverS' + {$i}).css('fill', 'rgba(0,0,0,0)');
        ";
    }
    foreach ($resultado as $n) {
       echo "
        $('.btn-hoverS' + {$n['NumeroOrden']}).css('fill', '#007bff');
        $('.text-hoverS' + {$n['NumeroOrden']}).css('fill', '#fff');
        ";
    }

    ?> 



    $('#btnSave').click(function(event) {
                    var resultado=[];
                    var nichosD=[];
                    var nichosA=[];


                     for (var i = 0; i <= 3; i++) {
                        if (document.getElementById("checkbox" + i).checked == true) {
                            resultado.push(document.getElementById("checkbox" + i).value);

                        }
                    }



                    //alert("nichos iniciales "+nichosR);
                    alert("nichos Resultantes "+resultado);

                    if ($.isEmptyObject(resultado)) {
                       nichosD = nichosR;
                       alert('entro en vacio');
                    }else if($.isEmptyObject(nichosR)){
                        nichosA=resultado;
                        alert('entro en todos new');

                    }else{

                        alert('entro en bilateral');

                    
                    resultado.forEach(function(elementNew){
                        nichosR.forEach(function(elementOld){

                            if(resultado.indexOf(elementOld)==-1 && nichosD.indexOf(elementOld)==-1){
                                    nichosD.push(elementOld);

                            }else{
                                     if(nichosA.indexOf(elementNew)==-1 && nichosR.indexOf(elementNew)==-1){
                                        nichosA.push(elementNew);
                                    }   
                                }

                        })
                    })

                    }

                    $('#nichosNew').attr('value',nichosA);
                    $('#nichosDelete').attr('value',nichosD);

                    alert("nichos incial "+nichosR);
                    alert("nichos Eliminar "+nichosD);
                    alert("nichos agregar "+nichosA);
        });

            
   });

    // nocho vecto end



    




</script>
