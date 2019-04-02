<?php

$busqueda = $_GET['search'];

 $consulta = new ConexionDB();
 $resultado=$consulta->Query("select concat(t4.NombresCiudadano,' ',t4.ApellidosCiudadano) as Titular from Titulos t3 inner join Ciudadanos t4 on t3.idCiudadanoTitular=t4.idCiudadano where t4.NombresCiudadano like '%{$busqueda}%' or t4.ApellidosCiudadano='%{$busqueda}%'");




?>

<div class="container-fluid">
    <div class="row">
        <div class="col padding-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item padding-0">

                    <form class="form-inline justify-content-center padding-top-15 padding-bottom-15" method="GET"
                        action="<?php echo $server;?>">
                        <div class="input-group col-12 col-sm-8 col-md-6 col-lg-4">
                            <input type="text" class="form-control" name="search" value="<?php echo $busqueda ?>">
                            <div class="input-group-prepend rounded">
                                <button type="submit" class="btn btn-dark rounded-right">Buscar</button>
                            </div>
                        </div>
                    </form>
                </li>
                <li class="list-group-item padding-0">

                    <!-- contenido de search -->
                    <div class="container">

                        <div class="list-group">

                            <?php

                  if ($resultado == -1) {
                    echo "<p class=\"text-center\" style=\"margin-top:15px\">No hay resultados que mostrar</p>";
                  }else{
                    foreach ($resultado as $key) {

                        echo "
                          <a href=\"#\" class=\"list-group-item list-group-item-action flex-column align-items-start\">
                    <div class=\"d-flex w-100 justify-content-between\">
                      <h5 class=\"mb-1\">{$key['Titular']}</h5>
                      <small>15/08/2018</small>
                    </div>
                    <p class=\"mb-1\">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    <small>Titulares</small>
                  </a>  ";
                        
                      }
                  }

                  

                  ?>

                        </div>
                    </div>

                    <!-- fin -->
                </li>
            </ul>
        </div>
    </div>
</div>