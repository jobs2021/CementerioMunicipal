<?php 
    $titulo='Cementerios';
    $consulta = new ConexionDB();
    $variable= $consulta->Query("select * from Cementerios");


    require_once('Views/default/header.php'); 
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">

             <ul class="list-group list-group-flush">
                    <li class="list-group-item padding-0">
           
            <form class="form-inline justify-content-center padding-top-15 padding-bottom-15" method="GET" action="<?php echo $server;?>/parcelas">
                <div class="input-group col-12 col-sm-8 col-md-6 col-lg-4">
                    <input type="text" class="form-control" name="busqueda" placeholder="Buscar Parcela Numero o Poligono">
                    <div class="input-group-prepend rounded">
                        <button type="submit" class="btn btn-dark rounded-right">Buscar</button>
                    </div>
                </div>
            </form>
        </li></ul>

            <p class="margin-top-15">Seleccione un Cementerio para continuar...</p>

            <div class="row padding-bottom-15">

                <?php
                    // listar cementerios
                    foreach ($variable as $value) {
                        echo '
                <div class="col-sm-6 col-md-4 col-lg-3 padding-top-15">
                    <a href="'.$server.'/admincementerio/'.$value['idCementerio'].'" class="card-link text-dark">
                        <div class="card text-center">
                            <div class="card-header bg-principal text-light"><strong>'.$value['Nombre'].'</strong></div>
                            <div class="card-body">
                                <p>Tipo: '.$value['Tipo'].'</p>
                                <p>Parcelas: 0</p>
                                <p>Nichos: 0</p>
                                <p>Nichos Disponibles: 0</p>
                            </div>
                        </div>
                    </a>
                </div>';

                    }


                ?>
                <div class="col-sm-6 col-md-4 col-lg-3 padding-top-15 " style="min-height: 125px;">
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-outline-dark w-100 h-100 btn-nuevo-cementerio " data-toggle="modal" data-target="#myModal"><i class="fas fa-plus icon margin-right-5"></i>Nuevo Cementerio</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Cementerio</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?php echo $server;?>/admincementerio" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input name="nombre" type="text" class="form-control" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion:</label>
                        <input name="direccion" type="text" class="form-control" id="direccion">
                    </div>
                    <div class="form-group">
                        <label for="tipo" :>Tipo:</label>
                        <select name="tipo" class="form-control" id="tipo">
                            <option value="Publico">Publico</option>
                            <option value="Privado">Privado</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="area">Area:</label>
                            <input name="area" type="text" class="form-control" id="area">
                        </div>
                        <div class="form-group col-6">
                            <label for="legalidad" :>Legalidad:</label>
                            <select name="legalidad" class="form-control" id="legalidad">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="panteonero">Panteonero:</label>
                        <input name="panteonero" type="text" class="form-control" id="panteonero">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once('Views/default/footer.php'); ?>