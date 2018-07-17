<?php 
    $titulo='Cementerios';

    require_once('Views/default/header.php'); 
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <p class="margin-top-15">Seleccione un Cementerio para continuar...</p>
            <div class="row padding-bottom-15">
                <div class="col-sm-6 col-md-4 col-lg-3 padding-top-15">
                    <a href="/admincementerio" class="card-link text-dark">
                        <div class="card text-center">
                            <div class="card-header bg-primary text-light"><strong>Cementerio #2</strong></div>
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
                    <a href="/admincementerio" class="card-link text-dark">
                        <div class="card text-center">
                            <div class="card-header bg-primary text-light"><strong>Cementerio Monte Piedad</strong></div>
                            <div class="card-body">
                                <p>Tipo: Privado</p>
                                <p>Parcelas: 120</p>
                                <p>Nichos: 540</p>
                                <p>Nichos Disponibles: 87</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 padding-top-15" style="min-height: 125px;">
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-outline-primary w-100 h-100 btn-nuevo-cementerio" data-toggle="modal" data-target="#myModal">Nuevo Cementerio</button>
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
                <form action="./admincementerio" method="POST">
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
                    <div class="form-group">
                        <label for="edad">Area:</label>
                        <input type="text" class="form-control" id="edad">
                    </div>
                    <div class="form-group">
                        <label for="edad">Legalidad:</label>
                        <input type="text" class="form-control" id="edad">
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


