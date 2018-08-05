<?php 
    $titulo='Cementerios';

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
                <div class="col-sm-6 col-md-4 col-lg-3 padding-top-15">
                    <a href="<?php echo $server;?>/admincementerio" class="card-link text-dark">
                        <div class="card text-center">
                            <div class="card-header bg-principal text-light"><strong>Cementerio #2</strong></div>
                            <div class="card-body">
                                <p>Tipo: Publico</p>
                                <p>Parcelas: 120</p>
                                <p>Nichos: 540</p>
                                <p>Nichos Disponibles: 75</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 padding-top-15">
                    <a href="<?php echo $server;?>/admincementerio" class="card-link text-dark">
                        <div class="card text-center">
                            <div class="card-header bg-principal text-light"><strong>Cementerio Monte Piedad</strong></div>
                            <div class="card-body">
                                <p>Tipo: Privado</p>
                                <p>Parcelas: 120</p>
                                <p>Nichos: 540</p>
                                <p>Nichos Disponibles: 87</p>
                            </div>
                        </div>
                    </a>
                </div>
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
                        <input type="text" class="form-control" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="edad">Direccion:</label>
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
                            <label for="edad">Area:</label>
                            <input type="text" class="form-control" id="edad">
                        </div>
                        <div class="form-group col-6">
                            <label for="sel2" :>Legalidad:</label>
                            <select class="form-control" id="sel2">
                                <option>Si</option>
                                <option>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edad">Panteonero:</label>
                        <input type="text" class="form-control" id="edad">
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