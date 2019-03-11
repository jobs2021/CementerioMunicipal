<?php
    //aignar valores
        $idCementerio=explode('/',$_GET['action'])[1];

        $conexion = new ConexionDB();
        $values = $conexion->Query("select * from Cementerios where idCementerio='{$idCementerio}' and Estado='1'");

        if ($values==-1) {
            header("location:{$server}/cementerios/");
            exit();
        }

        $cementerio = new Cementerio($values[0]);
        $tipoParcela = $conexion->Query("select * from TipoParcela");
        
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
                       <form action="<?php echo $server;?>/parcelaActions" method="POST">
                      <div class="modal-body d-flex flex-wrap modal-trash">
                            <input type="hidden" name="actionId" value="4">
                            <input type="hidden" name="Came" value="<?php echo explode('/',$_GET['action'])[0]; ?>">
                            <input type="hidden" name="idCementerio" value="<?php echo $idCementerio; ?>">
                         <?php 
                            $parcelasTrash= $conexion->Query("select * from Parcelas where Estado='0' and idCementerio='{$idCementerio}'");
                            if ($parcelasTrash!="-1") {
         
                                foreach ($parcelasTrash as $objetoTrash) {

                                    echo "
                                    
                                    <div class=\"card card-trash\">
                                      <div class=\"card-header text-center\">
                                        <i class=\"fas fa-dungeon icon\" style=\"font-size: 80px!important;margin-left: 0px\"></i>
                                        <input type=\"checkbox\" class=\"float-right\" name=\"idParcela[]\" value=\"{$objetoTrash['idParcela']}\">
                                    </div>
                                      <div class=\"card-body\" style=\"padding: 5px !important;\">
                                        <p class=\"card-text\">{$objetoTrash['Numero']} </p>
                                      </div>
                                    </div> ";

                                }
                                
                            }else{
                                echo "<center>Papelera Vacia</center>";
                            }

                        ?>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Restaurar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end trash code-->


    <ul class="breadcrumb rounded-0 margin-l-r-15">
        <li class="breadcrumb-item"><a href="<?php echo $server;?>/cementerios">Cementerios</a></li>
        <li class="breadcrumb-item active"><?php echo $cementerio->Nombre; ?></li>
    </ul>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-10 margin-top-15">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="clearfix w-100">
                                <h3 class="float-left margin-bottom-0"><?php echo $cementerio->Nombre; ?></h3>
                                <form action="<?php echo "{$server}/cementerioActions"; ?>" method="POST">
                                    <input type="hidden" name="actionId" value="3">
                                    <input type="hidden" name="idCementerio" value="<?php echo $idCementerio; ?>">
                                    <button type="submit" class="btn btn-outline-danger float-right" data-toggle="modal" data-target="#modalEliminar"><i class="fas fa-trash icon margin-right-5 margin-left-0"></i></button>
                                </form>

                                <button type="button" class="btn btn-outline-primary float-right margin-right-5" data-toggle="modal" data-target="#modalEditar"><i class="fas fa-edit icon margin-right-5 margin-left-0"></i>Editar</button>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <?php
                        @$numeroParcelas=$conexion->Query("select count(*) as numero from Parcelas where idCementerio={$idCementerio}  and Estado='1'")[0];
                        @$nichosDisponibles=$conexion->Query("select (count(t1.idParcela) - count(t3.idEnterramiento)) as NichosDisponibles from Parcelas t1 inner join Nichos t2 on t1.idParcela=t2.idParcela left join Enterramientos t3 on t2.idNicho=t3.idNicho where t1.idCementerio='{$idCementerio}' and t2.Estado='1' and t1.Estado='1'")[0]['NichosDisponibles'];
                        echo '
                        <p>Tipo: '.$cementerio->Tipo.'</p>
                        <p>Area: '.$cementerio->Area.' m<sup>2</sup></p>
                        <p>Parcelas: '.$numeroParcelas['numero'].'</p>
                        <p>Nichos Disponibles: '.$nichosDisponibles.'</p>
                        <p>Legalidad: '.(($cementerio->Legalidad==1) ? "Si" : "No").'</p>
                        <p>Panteonero: '.$cementerio->Panteonero.'</p>
                        <p>Direccion: '.$cementerio->Direccion.'</p>';
                        ?>
                    </li>
                    <li class="list-group-item">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAgregarParcela" data-slide-to="0">Agregar Parcela</button>
                        <!--button type="button" class="btn btn-outline-primary" >Editar Parcela</button -->
                        <a href="<?php echo "{$server}/parcelas/{$idCementerio}";?>">
                            <button type="button" class="btn btn-outline-primary">Ver Parcelas</button>
                        </a>
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
                <h4 class="modal-title">Editar <?php echo $cementerio->Nombre ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?php echo $server;?>/cementerioActions" method="POST">
                    <input type="hidden" name="actionId" value="2">
                    <input type="hidden" name="idCementerio" value="<?php echo $idCementerio; ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $cementerio->Nombre ?>">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion:</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $cementerio->Direccion ?>">
                    </div>
                    <div class="form-group">
                        <label for="tipo" :>Tipo:</label>
                        <select class="form-control" id="tipo" name="tipo">
                            <option value="Publico" <?php echo (($cementerio->Tipo=="Publico") ? "selected=true":"");  ?> >Publico</option>
                            <option value="Privado" <?php echo (($cementerio->Tipo=="Privado") ? "selected=true":"");  ?> >Privado</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="area">Area:</label>
                            <input type="text" class="form-control" id="area" name="area" value="<?php echo $cementerio->Area ?>">
                        </div>
                        <div class="form-group col-6">
                            <label for="legalidad" :>Legalidad:</label>
                            <select class="form-control" id="legalidad" name="legalidad">
                                <option value="1" <?php echo (($cementerio->Legalidad==1) ? "selected=true":"");  ?>>Si</option>
                                <option value="0" <?php echo (($cementerio->Legalidad==0) ? "selected=true":"");  ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="panteonero">Panteonero:</label>
                        <input type="text" class="form-control" id="panteonero" name="panteonero" value="<?php echo $cementerio->Panteonero ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="modalAgregarParcela">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar Parcela</h4>
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
                                    <form action="<?php echo $server;?>/parcelaActions" method="POST">
                                        <input type="hidden" name="actionId" value="1">
                                        <input type="hidden" name="Came" value="<?php echo explode('/',$_GET['action'])[0]; ?>">
                                        <input type="hidden" name="idCementerio" value="<?php echo $idCementerio; ?>">
                                        <input type="hidden" name="nichos" id="nichosSend">
                                        <div class="form-group">
                                            <label for="nombre">Número:</label>
                                            <input type="text" class="form-control" id="numero" name="numero">
                                        </div>
                                        <div class="form-group">
                                            <label for="edad">Poligono:</label>
                                            <input type="text" class="form-control" id="poligono" name="poligono">
                                        </div>
                                        <div class="form-group">
                                            <label for="sel2" :>Tipo:</label>
                                            <select class="form-control" id="tipo" name="tipo">
                                                <?php
                                                foreach ($tipoParcela as $value) {
                                                    echo"<option value=\"{$value['idTipoParcela']}\">{$value['Descripcion']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-6">
                                                <label for="coordenadaX">Coordenadas X:</label>
                                                <input type="text" class="form-control" id="coordenadaX" name="coordenadaX">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="coordenadaY">Coordenadas Y:</label>
                                                <input type="text" class="form-control" id="coordenadaY" name="coordenadaY">
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




    <?php require_once('Views/default/footer.php'); ?>
    <script type="text/javascript">
    $(document).ready(function() {

        class nichoBtn {
            constructor(n) {
                this.activo = false;
                this.clase = '.nicho' + n;
                this.posicion = n;
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

        $('#btnSave').click(function() {
            var resultado = [];

            for (var i = 0; i <= 3; i++) {
                if (document.getElementById("checkbox" + i).checked == true) {
                    resultado.push(document.getElementById("checkbox" + i).value);

                }
            }
            $('#nichosSend').attr('value',resultado);
            //alert(resultado);
        });



        //alert('working');
    });
    </script>
    <script type="text/javascript">
    $(".card-trash").click(function(){
        if ($(this).find('input')[0].checked) {
            $(this).find('input').prop('checked',false);
            $(this).removeClass('card-trash-checked');
        }else{
            $(this).find('input').prop('checked',true);
            $(this).addClass('card-trash-checked');
        }
    })
</script>