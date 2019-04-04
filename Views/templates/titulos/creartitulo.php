<?php 
$titulo='Crear Titulo';

$consulta = new ConexionDB();
$variable= $consulta->Query("SELECT idTipoTitulo, Tipo FROM TipoTitulos");


require_once('Views/default/header.php'); 
?>



<!--BREADCUMB-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $server;?>/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo $server;?>/titulos">Titulos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Crear Titulo</li>
    </ol>
</nav>



<!-- aca ira todo el codigo html de la vista-->

<div class="container-fluid">
    <div class="row col-lg-12">
            <div class="card card-register mx-auto mt-0">
                <div class="card-header">
                    <h4>Informacion del Titular</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo $server;?>/tituloActions" method="POST">
                        <input type="hidden" name="actionId" value="1">
                        <div class=" col-sm-12 col-md-12 col-lg-12 padding-0">
                            <div class="row padding-bottom-15">
                                <div class="col-sm-12 col-md-9 col-lg-9 padding-top-15 mx-auto">
                                    <?php
                                        if (isset(explode('/',$_GET['action'])[1])){
                                            $idta=explode('/',$_GET['action'])[1];
                                            $tablaParcela = $consulta->Query("SELECT t1.Numero, t1.Poligono, t2.Descripcion, t3.Nombre FROM Parcelas t1  INNER JOIN TipoParcela t2 ON t1.idTipoParcela = t2.idTipoParcela INNER JOIN Cementerios t3 ON t1.idCementerio = t3.idCementerio where t1.idParcela={$idta} AND t1.Estado=1");
                                            if ($tablaParcela != -1){
                                                foreach ($tablaParcela as $value) {
                                                    echo "
                                                    <div class=\"card text-center\">
                                                        <div class=\"card-header bg-principal text-light\">Cementerio: <strong>{$value['Nombre']}</strong></div>
                                                            <div class=\"card-body\">
                                                                <p>Parcela: {$value['Numero']}</p>
                                                                <p>Tipo: {$value['Descripcion']}</p>
                                                                <p>Poligono: {$value['Poligono']}</p>
                                                            </div>
                                                        <div class=\"col-sm-4 col-md-2 col-lg-2 padding-top-10 mx-auto\" style=\"min-height: 65px;\">
                                                            <button type=\"button\" class=\"btn btn-outline-dark w-200 h-75 btn-nuevo-cementerio\" data-toggle=\"modal\" data-target=\"#parcela\">
                                                            <i class=\"fas fa-edit icon mx-0\"></i>
                
                                                            </button>
                                                        </div>
                                                    </div>
                                        
                                                ";}
                                                
                                            }
                                            } else {
                                                    echo "
                                                    <div class=\"col-sm-4 col-md-6 col-lg-6 mx-auto padding-top-15\" style=\"min-height: 80px;\">
                                                        <button type=\"button\" class=\"btn btn-outline-dark w-100 h-100 btn-nuevo-cementerio\" data-toggle=\"modal\" data-target=\"#parcela\">
                                                        <i class=\"fas fa-plus icon mx-0\"></i>
                                                        <span class=\"mx-4\">Agregar Parcela</span></button>
                                                    </div>";
                                                }
                    
                                                ?>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Dui">DUI</label>
                            <input required name="dui" type="text" class="form-control" id="Dui" placeholder="Numero Unico de Identidad">
                        </div>
                        <div class="form-row mt-0">

                            <div class="form-group col-md-6">
                                <label for="Nombres">Nombres</label>
                                <input required name="nombre" type="text" class="form-control" id="Nombres" placeholder="Nombres">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Apellidos">Apellidos</label>
                                <input required name="apellido" type="text" class="form-control" id="Apellidos" placeholder="Apellidos">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="Direccion">Direccion</label>
                            <input required name="direccion" type="text" class="form-control" id="Direccion" placeholder="Direccion de domicilio">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Profesion">Profesion</label>
                                <input required name="profesion" type="text" class="form-control" id="Profesion" placeholder="Profesion u Ocupacion">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Fecha_Nacimiento">Fecha de Nacimiento</label>
                                <input required name="fecha" class="form-control" id="Fecha_Nacimiento" type="date">
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-12 col-lg-12 padding-0 mx-auto">
                            <div class="form-row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="Numero_Titulo">Numero de Titulo</label>
                                    <input class="form-control" type="text" name="numero" id="Numero_Titulo" placeholder="Numero del titulo (opcional)">
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="select">Tipo de titulo</label>
                                    <select required class="custom-select" name="tipo" id="inputGroupSelect01">
                                        <option selected>--- Seleccione el tipo de titulo ---</option>
                                        <?php
                                                    // listar cementerios
                                                    if ($variable!=-1) {
                                                        foreach ($variable as $value) {
                                                            echo "
                                                            <option value=\"{$value['idTipoTitulo']}\">{$value['Tipo']}</option>" ;
                                                        }
                                                    }
                                                ?>
                                    </select>
                                </div>
                            </div>
                            <input hidden type="number" name="idParcela" value="<?php if (isset(explode('/',$_GET['action'])[1])){
                                                                            echo explode('/',$_GET['action'])[1];
                                                                            } else{
                                                                            echo " 0"; } ?>">
                        </div>
                        <button class="btn btn-primary mt-4 float-right" type="submit">Registrar</button>
                        <a class="btn btn-dark mt-4 mx-2 float-right" href="<?php echo $server;?>/repotrastitulo">Cancelar</a>
                    </form>
                </div>
        
        </div>
    </div>
</div>



<!-- Modal Parcela-->
<div class="modal fade bd-example-modal-lg" id="parcela" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Parcela</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <label for="BuscarParcela">Buscara Parcela</label>
                    <input class="form-control col-md-12 mx-auto" type="search" name="buscarParcela" placeholder="Numero de Parcela" aria-label="Search" id="buscarParcela" value="">
                    
                    <input type="hidden" id="Urlbuscar" value="<?php echo $server;?>/buscarParcela">
                </div>
                <form method="post" action="<?php echo $server;?>/tituloActions">
                    <div id="datos" class="mx-auto mt-4">
                    </div>
                        <input type="hidden" name="actionId" value="4">              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    var buscar = "<?php echo $server;?>/buscarParcela";
</script>
<!---hasta aca -->

<?php require_once('Views/default/footer.php'); ?>



























