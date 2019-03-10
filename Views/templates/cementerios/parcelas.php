<?php 
    @$idCementerio=explode('/',$_GET['action'])[1];

    if (!isset($idCementerio)) {
        header("location:".$server.'/cementerios/');
        exit();
    }

    $consulta = new ConexionDB();
    @$nombreCementerio=$consulta->Query("select Nombre from Cementerios where idCementerio={$idCementerio} and Estado='1'")[0];

    $parcelas= $consulta->Query("select t1.idParcela, Numero, Poligono, (select count(idNicho) from Parcelas t1 left join Nichos t2 on t1.idParcela=t2.idParcela where t1.idCementerio='{$idCementerio}' and t1.Estado='1' and t2.Estado='1') as Nichos,(select concat(t4.NombresCiudadano,' ',t4.ApellidosCiudadano) from Titulos t3 inner join Ciudadanos t4 on t3.idCiudadanoTitular=t4.idCiudadano where t3.idParcela=t1.idParcela limit 1) as Titular from Parcelas t1 left join Nichos t2 on t1.idParcela=t2.idParcela where t1.idCementerio='{$idCementerio}' and t1.Estado='1' group by idParcela,Numero,Poligono,Titular");

    //select t1.idParcela, Numero, Poligono, count(idNicho) as Nichos,(select idTitulo from Titulos where idParcela=t1.idParcela) as Titular from Parcelas t1 left join Nichos t2 on t1.idParcela=t2.idParcela where t1.idCementerio='{$idCementerio}'  and t2.Estado='1' and t1.Estado='1' group by idParcela,Numero,Poligono,Titular

    $tipoParcela = $consulta->Query("select * from TipoParcela");

	$titulo='Parcelas';
	require_once('Views/default/header.php'); 
?>
<!-- aca ira todo el codigo html de la vista-->
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
                        <?php 
                            $parcelasTrash= $consulta->Query("select * from Parcelas where Estado='0' and idCementerio='{$idCementerio}'");
                            $date=date('d/m/Y');
                            if ($parcelasTrash!="-1") {
         
                                foreach ($parcelasTrash as $objetoTrash) {
                                    echo "<form action=\"{$server}/cementerioActions\" method=\"POST\">
                                    <p>{$date} - {$objetoTrash['Numero']} 
                                    
                                        <input type=\"hidden\" name=\"actionId\" value=\"4\">
                                        <input type=\"hidden\" name=\"idCementerio\" value=\"{$objetoTrash['idCementerio']}\">
                                        <button type=\"submit\" class=\"btn btn-outline-danger\" data-toggle=\"modal\" data-target=\"#modalEliminar\" style=\"height:30px;\"><i class=\"fas fa-redo-alt icon margin-right-5\"></i></button>
                                    </form>
                                    </p>";
                                }
                            }else{
                                echo "<center>Papelera Vacia</center>";
                            }

                        ?>
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
        <li class="breadcrumb-item active">
        <?php echo "<a href=\"{$server}/admincementerio/{$idCementerio}\">{$nombreCementerio['Nombre']}</a>";?>
        </li>
        <li class="breadcrumb-item active">Parcelas</li>
    </ul>
    <div class="row justify-content-center">
        <div class="col-12 padding-top-15 padding-bottom-15">
            <form class="form-inline justify-content-center" method="GET">
                    <div class="col col-sm-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="busqueda" placeholder="Numero o Poligono">
                                <div class="input-group-prepend rounded">
                                    <button type="submit" class="btn btn-dark rounded-right">Buscar</button>
                                </div>
                            </div>
                        
                    </div>
                    <div class="col col-sm-1">
                <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#modalEditar"><i class="fas fa-plus icon margin-right-5 margin-left-0"></i>Añadir</button>
                        
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
                            <th scope="col">Titular</th>
                            <th scope="col">Nichos</th>
                            <th scope="col" style="width: 125px;"><a class="hidden">Acciones___</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter=1;
                        if ($parcelas!=-1) {
                           
                            foreach ($parcelas as $parcela) {
                                $titular=($parcela['Titular']) ? $parcela['Titular']:'-';
                                echo 
                                "<tr class=\"row-hover\">
                                <td scope=\"row\">{$counter}</td>
                                <td>{$parcela['Numero']}</td>
                                <td>{$parcela['Poligono']}</td>
                                <td>{$titular}</td>
                                <td>{$parcela['Nichos']}</td>
                                <td class=\"text-right\">
                                    <div class=\"row-btn\">
                                        <a href=\"{$server}/verparcela/{$parcela['idParcela']}\"><i class=\"fas fa-eye icon\" title=\"Ver Parcela\"></i></a>
                                        <a id=\"btnE{$parcela['idParcela']}\" class=\"btn-editar-parcela\" href=\"#\" data-toggle=\"modal\" data-target=\"#modalEditarParcela\" data-slide-to=\"0\"><i class=\"fa fa-edit icon\" title=\"Editar\"></i></a>
                                        <a id=\"btnD{$parcela['idParcela']}\" class=\"btn-eliminar-parcela\" href=\"#\" data-toggle=\"modal\" data-target=\"#modalEliminar\" class=\"text-danger\"><i class=\"fas fa-trash icon\" title=\"Eliminar\"></i></a>
                                    </div>
                                </td>
                            </tr>
                                ";
                                $counter++;
                            }
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!---hasta aca -->

<!-- The Modal -->
<div class="modal fade" id="modalEditarParcela">
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
                                    <form id="formEditar" action="<?php echo $server;?>/parcelaActions" method="POST">
                                        <input type="hidden" name="actionId" value="2">
                                         <input type="hidden" name="vista" value="0">
                                        <input type="hidden" name="idCementerio" value="<?php echo $idCementerio; ?>">
                                        <input type="hidden" name="nichosNew" id="nichosNew">
                                        <input type="hidden" name="nichosDelete" id="nichosDelete">
                                        <div class="form-group">
                                            <label for="numero">Número:</label>
                                            <input type="text" class="form-control" id="numero" name="numero">
                                        </div>
                                        <div class="form-group">
                                            <label for="poligono">Poligono:</label>
                                            <input type="text" class="form-control" id="poligono" name="poligono">
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
</div>


<!-- The Modal -->

<div class="modal fade" id="modalEliminar">
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
                <form action="<?php echo "{$server}/parcelaActions"?>" method="POST">
                    <input type="hidden" name="actionId" value="3">
                    <input id="parcelaDelete" type="hidden" name="idParcela" value="0">
                    <input type="hidden" name="idCementerio" value="<?php echo $idCementerio; ?>">
                    <button type="submit" class="btn btn-danger">Eliminar</button> <!-- data-dismiss="modal" -->
                </form>
            </div>
        </div>
    </div>
</div>







<?php require_once('Views/default/footer.php'); ?>

 <script type="text/javascript">

        // script for nichos
    $(document).ready(function() {

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

        // new script ajax
        var nichosR=[];

        $('.btn-editar-parcela').click(function(event) {
            var id=this.id.substring(4);

            $.ajax({
                url : '<?php echo "{$server}/parcelaActions/";?>'+id,
                success : function(json) {
                    var datos=JSON.parse(json)[0];
                    //alert(datos['Poligono']);
                    $('#formEditar').attr('action','<?php echo "{$server}/parcelaActions/";?>'+datos['idParcela']);
                    $('#numero').attr('value',datos['Numero']);
                    $('#poligono').attr('value',datos['Poligono']);
                    $('#coordenadaX').attr('value',datos['CoordenadaX']);
                    $('#coordenadaY').attr('value',datos['CoordenadaY']);
                    $('#tipo'+datos['idTipoParcela']).attr('selected','true');

                    //alert(datos['Nichos']);

                    //reseteando los nichos
                    nichosArray.forEach(function(objNicho){
                                objNicho.activo=true;
                                objNicho.toggleActivador();
                    })

                    $('.carousel').carousel(0);
                    $('.carousel').carousel('pause');

                    nichosR=datos['Nichos'];

                    datos['Nichos'].forEach(function(element){
                        nichosArray.forEach(function(objNicho){
                            if(objNicho.clase=='.nicho' + element){
                                objNicho.activo=false;
                                objNicho.toggleActivador();
                            }
                        })
                    })

                   



                },
                error : function(xhr, status) {
                    alert('Disculpe, existió un problema');
                }/*,
                complete : function(xhr, status) {
                    alert('Petición realizada');
                }*/
            });


        });


        $('.btn-eliminar-parcela').click(function(event) {
           var id=this.id.substring(4);
           $('#parcelaDelete').attr('value',id);
        });

        $('#btnSave').click(function(event) {
                    var resultado=[];
                    var nichosD=[];
                    var nichosA=[];
                     for (var i = 0; i <= 3; i++) {
                        if (document.getElementById("checkbox" + i).checked == true) {
                            resultado.push(document.getElementById("checkbox" + i).value);

                        }
                    }
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

                    $('#nichosNew').attr('value',nichosA);
                    $('#nichosDelete').attr('value',nichosD);

                    alert(nichosR);
                    alert(nichosD);
                    alert(nichosA);
        });



        




    });
    

</script>
   