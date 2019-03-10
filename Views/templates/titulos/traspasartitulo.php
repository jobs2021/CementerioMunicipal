<?php 
$titulo='Traspasar Titulo';

$consulta = new ConexionDB();
$variable= $consulta->Query("select idTipoTitulo, Tipo from TipoTitulos");


require_once('Views/default/header.php'); 
?>



<!--BREADCUMB-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $server;?>/inicio">Inicio</a></li>
        <li class="breadcrumb-item"><a href="<?php echo $server;?>/titulos">Titulos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Traspasar Titulo</li>
    </ol>
</nav>



<!-- aca ira todo el codigo html de la vista-->

<div class="container-fluid">
    <div class="row col-lg-12">
            <div class="card card-register mx-auto mt-0">
                <div class="card-header">
                    <h4>Traspaso de Titulo Informacion General</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo $server;?>/tituloActions" method="POST">
                        <input type="hidden" name="actionId" value="13">
                        <div class=" col-sm-12 col-md-12 col-lg-12 padding-0">
                            <div class="row padding-bottom-15">
                                <div class="col-sm-12 col-md-9 col-lg-9 padding-top-15 mx-auto">
                                    <?php
                                    if (isset(explode('/',$_GET['action'])[1])){
                                        $idTi = explode('/',$_GET['action'])[1];
                                        echo"<input type=\"hidden\" name=\"idTitulo\" value=\"{$idTi}\">";
                                    }
                                        if (isset(explode('/traspaso/',$_GET['action'])[1])){
                                            $idta=explode('/traspaso/',$_GET['action'])[1];
                                            $tablaParcela = $consulta->Query("SELECT t1.Numero, t1.Poligono, t2.Descripcion, t3.Nombre FROM Parcelas t1  INNER JOIN TipoParcela t2 ON t1.idTipoParcela = t2.idTipoParcela INNER JOIN Cementerios t3 ON t1.idCementerio = t3.idCementerio where t1.idParcela={$idta}");
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
                                                    </div>
                                                ";}
                                            }else {
                                                    echo "
                                                    ERROR 404 al Mostrar Parcela";
                                                }
                                        }
                                        else {
                                            echo "
                                                ERROR 404 al Mostrar Parcela explode";
                                            }
                                    ?>

                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-0">
                            <div class="form-group col-md-6">
                                <label for="Nombres">Nombres</label>
                                <input name="nombre" type="text" class="form-control" id="Nombres" placeholder="Nombres">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Apellidos">Apellidos</label>
                                <input name="apellido" type="text" class="form-control" id="Apellidos" placeholder="Apellidos">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="Direccion">Direccion</label>
                            <input name="direccion" type="text" class="form-control" id="Direccion" placeholder="Direccion de domicilio">
                        </div>
                        <div class="form-group">
                            <label for="Dui">DUI</label>
                            <input name="dui" type="text" class="form-control" id="Dui" placeholder="Numero Unico de Identidad">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Profesion">Profesion</label>
                                <input name="profesion" type="text" class="form-control" id="Profesion" placeholder="Profesion u Ocupacion">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Fecha_Nacimiento">Fecha de Nacimiento</label>
                                <input name="fecha" class="form-control" id="Fecha_Nacimiento" type="date">
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
                                    <select class="custom-select" name="tipo" id="inputGroupSelect01">
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
                        <button class="btn btn-primary mt-4 float-right" type="submit">Traspasar</button>
                        <a class="btn btn-dark mt-4 mx-2 float-right" href="<?php echo $server;?>/repotrastitulo">Cancelar</a>
                    </form>
                </div>
        
        </div>
    </div>
</div>




<script>
    var buscar = "<?php echo $server;?>/buscarParcela";
</script>
<!---hasta aca -->

<?php require_once('Views/default/footer.php'); ?>



























