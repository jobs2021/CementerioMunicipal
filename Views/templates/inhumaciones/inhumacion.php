<?php 
    $titulo='Inhumacion';
    require_once('Views/default/header.php'); 
?>
<!-- aca ira todo el codigo html de la vista-->
<div class="container">
    <h1>Inhumacion</h1>
    <div class="row">
        <div class="col">
            <form action="<?php echo $server;?>/admincementerio" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombres Fallecido:</label>
                    <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                    <label for="edad">Apellidos Fallecido:</label>
                    <input type="text" class="form-control" id="edad">
                </div>
                <div class="form-group">
                    <label for="sel2" :>Tipo Inhumación:</label>
                    <select class="form-control" id="sel2">
                        <option>Tipo 1</option>
                        <option>Tipo 2</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="edad">Fecha Inicio:</label>
                        <input type="text" class="form-control" id="edad">
                    </div>
                    <div class="form-group col-6">
                        <label for="edad">Fecha Fin:</label>
                        <input type="text" class="form-control" id="edad">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edad">observaciones:</label>
                    <textarea class="form-control" id="edad" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!---hasta aca -->
<?php require_once('Views/default/footer.php'); ?>