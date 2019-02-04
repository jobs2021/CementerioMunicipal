<?php 
    $titulo='Cementerios';
    $consulta = new ConexionDB();
    $variable= $consulta->Query("select * from Cementerios where Estado='1'");
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
                </li>
            </ul>

            <p class="margin-top-15">Seleccione un Cementerio para continuar...</p>

            <div class="row padding-bottom-15">












                <?php
                    // listar cementerios
                if ($variable!=-1) {
                    foreach ($variable as $value) {
                        @$numeroParcelas=$consulta->Query("select count(*) as Nichos,(select count(*) from Parcelas t4 where t4.idCementerio='{$value['idCementerio']}') as Parcelas from Nichos t1 inner join Parcelas t2 on t1.idParcela=t2.idParcela inner join Cementerios t3 on t3.idCementerio=t2.idCementerio where t3.idCementerio='{$value['idCementerio']}' and t1.Estado='1'")[0];
                        $nichosDisponibles=$consulta->Query("select (count(t1.idParcela) - count(t3.idEnterramiento)) as NichosDisponibles from Parcelas t1 inner join Nichos t2 on t1.idParcela=t2.idParcela left join Enterramientos t3 on t2.idNicho=t3.idNicho where t1.idCementerio='{$value['idCementerio']}' and t2.Estado='1'")[0]['NichosDisponibles'];
                        echo "
                <div class=\"col-sm-6 col-md-4 col-lg-3 padding-top-15\">
                    <a href=\"{$server}/admincementerio/{$value['idCementerio']}\" class=\"card-link text-dark\">
                        <div class=\"card text-center\">
                            <div class=\"card-header bg-principal text-light\"><strong>{$value['Nombre']}</strong></div>
                            <div class=\"card-body\">
                                <p>Tipo: {$value['Tipo']}</p>
                                <p>Parcelas: {$numeroParcelas['Parcelas']}</p>
                                <p>Nichos: {$numeroParcelas['Nichos']}</p>
                                <p>Nichos Disponibles: {$nichosDisponibles}</p>
                            </div>
                        </div>
                    </a>
                </div>";

                    }
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
                <form action="<?php echo $server;?>/cementerioActions" method="POST">
                    <input type="hidden" name="actionId" value="1">
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
                            <input name="area" type="number" class="form-control" id="area" max="1000000000">
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
                            $cementeriosTrash= $consulta->Query("select * from Cementerios where Estado='0'");
                            $date=date('d/m/Y');
                            if ($cementeriosTrash!="-1") {
         
                                foreach ($cementeriosTrash as $objetoTrash) {
                                    echo "<form action=\"{$server}/cementerioActions\" method=\"POST\">
                                    <p>{$date} - {$objetoTrash['Nombre']} 
                                    
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


<?php require_once('Views/default/footer.php'); ?>
<script type="text/javascript">
    $(document).ready(function(event) {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    });
</script>

