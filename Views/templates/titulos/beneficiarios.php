<!-- BENEFICIARIOS -->

<?php 
 //session para enviar notificacion
session_start();

$titulo='Titulos Vigentes';

$consulta = new ConexionDB();


require_once('Views/default/header.php'); 
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
        <h1 class="text-center mt-4">Agregar Beneficiarios al Titulo</h1>
            <div class="row padding-bottom-15">
            <?php

            $idta=explode('/',$_GET['action'])[1];
            $beneficiarios= $consulta->Query("SELECT t1.NombresCiudadano, t1.ApellidosCiudadano, t1.FechaNacimiento, t1.Profesion, t1.Domicilio, t1.DUI, t2.idBeneficiario from Ciudadanos t1 INNER JOIN Beneficiarios t2 ON t1.idCiudadano = t2.idCiudadano WHERE t2.idTitulo = {$idta} AND t2.Estado=1");            
            
            if ($beneficiarios!="-1") {
                    foreach ($beneficiarios as $value) {
                        
                        echo "        
                            <div class=\"col-sm-6 col-md-3 col-lg-3 padding-top-15\">
                                <a class=\"card-link text-dark\">
                                    <div class=\"card text-center\">
                                        <div class=\"card-header bg-principal text-white\"><strong style=\"color:white\">{$value['NombresCiudadano']} {$value['ApellidosCiudadano']}</strong>
                                            <form method=\"POST\" action=\"{$server}/tituloActions\">
                                                <input type=\"hidden\" name=\"actionId\" value=\"10\">
                                                <input type=\"hidden\" name=\"idBeneficiario\" value=\"{$value['idBeneficiario']}\">
                                                <input type=\"hidden\" name=\"idTitulo\" value=\"$idta\">
                                                <button  type=\"submit\" style=\"background:transparent; border:none; display:flex; margin-top:-1.3rem; cursor:pointer;\" class=\"float-right\"> 
                                                    <i style=\"color:white; background:transparent; font-size:1rem;\" class=\"far fa-times-circle\"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class=\"card-body\">
                                            <p>DUI: {$value['DUI']}</p>
                                            <p>Fecha de nac: {$value['FechaNacimiento']}</p>
                                            <p>Profesion: {$value['Profesion']}</p>
                                            <p>Domicilio: {$value['Domicilio']}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>    
                                    ";
                                }
                            }
                ?>
                <div class="col-sm-6 col-md-4 col-lg-3 padding-top-15 " style="min-height: 125px;">
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-outline-dark w-100 h-100 btn-nuevo-cementerio " data-toggle="modal" data-target="#myModal2"><i class="fas fa-plus icon margin-right-5"></i>Agregar Beneficiario</button>
                </div>
            </div>


        </div>
    </div>
</div>

<div class="modal fade" id="myModal2">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Beneficiario</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?php echo $server;?>/tituloActions" method="POST">
                    <input type="hidden" name="actionId" value="9">
                    <?php
                        if (isset(explode('/',$_GET['action'])[1])){
                            $idta=explode('/',$_GET['action'])[1];
                            echo"
                                <input type=\"hidden\" name=\"idTitulo\" value=\"$idta\">

                            ";
                        }
                    ?>
                     <div class="form-group">
                        <label for="searchCiudadano">DUI:</label>
                         <input required name="dui" type="text" class="form-control dropdown-toggle" id="searchCiudadano"
                                autocomplete="off" placeholder="Numero Unico de Identidad" data-toggle="dropdown">
                         <div id="div-ciudadano" class="dropdown-menu" style="width: 94%"></div>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombres:</label>
                        <input name="nombre" type="text" class="form-control" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Apellidos:</label>
                        <input name="apellido" type="text" class="form-control" id="Apellidos">
                    </div>
                   
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="Fecha">Fecha de Nacimiento:</label>
                            <input name="fecha" type="date" class="form-control" id="Fecha">
                        </div>
                        <div class="form-group col-6">
                            <label for="Profesion" :>Profesion:</label>
                            <input name="profesion" class="form-control" id="Profesion">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Domicilio">Domicilio:</label>
                        <input name="direccion" type="text" class="form-control" id="Domicilio">
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
<div id="myModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h4>¿Desea confirmar la persona siguiente?</h4>
                <div id="Person" class="text-center"></div>
                <form action="<?php echo $server; ?>/tituloActions" method="POST" id="TituloForm">
                    <input type="hidden" value="16" name="actionId">

                    <div class="text-right mt-2">
                        <button type="button" class="btn btn-outline-dark " data-dismiss="modal">Cancelar</button>
                        <button  type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>




<?php 
$beneficiariosTrash= $consulta->Query("SELECT t1.NombresCiudadano, t1.ApellidosCiudadano, t1.FechaNacimiento, t1.Profesion, t1.Domicilio, t1.DUI, t2.idBeneficiario from Ciudadanos t1 INNER JOIN Beneficiarios t2 ON t1.idCiudadano = t2.idCiudadano WHERE t2.idTitulo = {$idta} AND t2.Estado=0");    
    if ($beneficiariosTrash!="-1") {
        $i = 0;
        foreach ($beneficiariosTrash as $value) {
            $i++;
        }
    }
?>

<!-- trash code-->
<div class="fixed-action-btn" data-toggle="tooltip" title="Papelera" data-placement="left">
    <a class="btn-floating btn-lg bg-danger" data-toggle="modal" data-target="#ModalTrash">
        <i class="fas fa-trash" style="color:#FFF;font-size: 25px;"><span style="font-size:1rem"><?php if (isset($i)){echo"{$i}";} ?></span></i>
    </a>
</div>


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
                <div class="row padding-bottom-15" >
                <form action="<?php echo $server;?>/tituloActions" id="Guardar" method="POST">
                    <input type="hidden" name="actionId" value="11">
                </form>
                <?php       
                    if ($beneficiariosTrash!="-1") {
                        $i = 0;
                        foreach ($beneficiariosTrash as $value) {
                            $i++;
                            echo "
                                    
                                <div class=\"col-sm-6 col-md-6 col-lg-6 padding-top-15\">
                                    <a class=\"card-link text-dark\">
                                    <div class=\"card text-center\">      
                                    <div class=\"card-header bg-principal text-white\"><strong style=\"color:white\">{$value['NombresCiudadano']} {$value['ApellidosCiudadano']}</strong>
                                        <form method=\"POST\" action=\"{$server}/regresarBeneficiario\">
                                            <input type=\"hidden\" name=\"idBeneficiario\" value=\"{$value['idBeneficiario']}\">
                                            <input type=\"hidden\" name=\"idTitulo\" value=\"$idta\">
                                            <button  type=\"submit\" style=\"background:transparent; border:none; display:flex; margin-top:-1.3rem; cursor:pointer;\" class=\"float-right\"> 
                                                <i style=\"color:white; background:transparent; font-size:1rem;\" class=\"fas fa-plus\"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class=\"card-body\">
                                        <p>DUI: {$value['DUI']}</p>
                                        <p>Fecha de nac: {$value['FechaNacimiento']}</p>
                                        <p>Profesion: {$value['Profesion']}</p>
                                        <p>Domicilio: {$value['Domicilio']}</p>
                                    </div>
                                </div>
                                </a>
                            </div>
                                    ";
                                }
                            }else{
                                echo "<center>Papelera Vacia</center>";
                            }

                        ?>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Guardar</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end trash code-->



<!-- SAVE code-->
<div class="fixed-action-btn " style="margin-right:75px" data-toggle="tooltip" title="Guardar" data-placement="left">
     <button class="btn-floating btn-lg bg-primary" type="submit" form="Guardar" >
            <i class="fas fa-save" style="color:#FFF;font-size: 25px;"></i>
    </button>
</div>





<!--END-->
<?php require_once('Views/default/footer.php'); ?>
<script>
    $(document).ready(function () {

        function formatSearching(data) {
            return ('<a class="dropdown-item" idPer="' + data.idCiudadano + '" dataId="' + data.DUI + '" dataNombre="' + data.NombresCiudadano +
                '" dataApellido="' + data.ApellidosCiudadano + '"><div><b>' + data.DUI + '</b><br>' +
                data.NombresCiudadano + ' ' + data.ApellidosCiudadano + '</div></a>')

        }


        function listaSearch(data) {
            var listado = '';
            data.forEach(function (element) {
                listado += formatSearching(element);
            });

            return listado + '<script type="text/javascript">$(".dropdown-item").click(' +
                'function(event) { var x;\n' +
                'try {\n' +
                'x = location.pathname;\n' +
                'x = x.match(/(\\d+)/g);\n' +
                'console.log(x[0]);\n' +
                '} catch (e) {\n' +
                'x = \'None\';\n' +
                'console.log(x);\n' +
                '}$(\'#myModal2\').modal(\'hide\');$(\'#myModal\').modal(\'show\');' +
                '$(\'#Person\').html("<p>DUI: "+$(this).attr("dataId")+"</p><p>Persona: "+$(this).attr("dataNombre")+' +
                '" "+$(this).attr("dataApellido")+"</p>");' +
                '$(\"#TituloForm\").append("<input type=\\"hidden\\" value="+ $(this).attr("idPer") +" name=\\"idCiudadano\\">"+"<input type=\\"hidden\\" value="+ x[0] +" name=\\"idTitulo\\">")' +
                '});<\/script>'
        }

        $('#searchCiudadano').keyup(function (event) {

            var dataSend = {actionId: "14", searchCiudadano: $('#searchCiudadano').val()};

            $.ajax({
                url: '<?php echo $server;?>/tituloActions/',
                data: dataSend,
                type: 'post',
                success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    console.log(response);
                    if (response == 'Ningun registro previo' || response == '' || response == '-1') {
                        $('#div-ciudadano').html('<a class="dropdown-item">Sin Resultados</a>');

                    } else if (response != "") {
                        var resultado = JSON.parse(response);
                        $('#div-ciudadano').html(listaSearch(resultado.data));

                    }
                }
            });
        });
    });
</script>

