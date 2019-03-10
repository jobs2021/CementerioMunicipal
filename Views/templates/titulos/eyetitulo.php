<?php
  $titulo='Crear Titulo';
  require_once('Views/default/header.php');

  $insert = new ConexionDB();
  if (isset(explode('/',$_GET['action'])[1])){
    $idta=explode('/',$_GET['action'])[1];
    $query = $insert->Query("SELECT t1.NumeroTitulo, t1.FechaExpedido, t1.NumeroRecibo, t1.FechaRecibo, t1.Observaciones, 
    t1.Estado, t1.Proceso, t2.Numero, t2.Poligono, t3.Tipo, t3.Descripcion, t4.NombresCiudadano, t4.ApellidosCiudadano,
    t4.Domicilio, t4.DUI, t4.Profesion, t4.FechaNacimiento, t5.Nombre, t1.Estado FROM Titulos t1 INNER JOIN Parcelas t2 
    ON t1.idParcela=t2.idParcela INNER JOIN TipoTitulos t3 ON t1.idTipoTitulo=t3.idTipoTitulo INNER JOIN Ciudadanos t4 
    ON t1.idCiudadanoTitular=t4.idCiudadano INNER JOIN Cementerios t5 ON t2.idCementerio=t5.idCementerio 
    WHERE t1.idTitulo = $idta");

    $beneficiario=$insert->Query("SELECT t2.NombresCiudadano, t2.ApellidosCiudadano, 
    t2.Domicilio, t2.DUI
    FROM Beneficiarios t1 INNER JOIN Ciudadanos t2 ON t1.idCiudadano=t2.idCiudadano WHERE t1.idTitulo = $idta ");
  }
  else{
    $query = -1;
    $beneficiario = -1;
  }

  ?>

<style>
  .text-area {
    padding: 15px;
    border: 1px solid gray;
    background: rgb(215, 215, 215);
    border-radius: .5rem;
  }
</style>

<!--BREADCUMB-->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $server;?>/inicio">Inicio</a></li>
    <li class="breadcrumb-item"><a href="<?php echo $server;?>/titulos">Titulos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ver Titulo</li>
  </ol>
</nav>

<!-- aca ira todo el codigo html de la vista-->
<div class="container-fluid">
  <div class="row">


    <!-- ######## INFORMACION TITULAR ######### -->
    <div class="col-12 col-sm-12 col-md-6">
      <div class="card ">
        <div class="card-header text-center">
          <h4>Informacion del Titular</h4>
        </div>
        <div class="card-body">
          <?php       
            if ($query!="-1") {
              foreach ($query as $value) {
                echo "
                <div class=\"row\">
                  <div class=\"col-6 col-sm-6 col-md-4\">
                    <p><strong>NOMBRES:</strong></p>
                    <P>{$value['NombresCiudadano']}</P>
                  </div>
                  <div class=\"col-6 col-sm-6 col-md-4\">
                    <p><strong>APELLIDOS:</strong></p>
                    <p>{$value['ApellidosCiudadano']}</p>
                  </div>
                  <div class=\"col-6 col-sm-6 col-md-4\">
                    <p><strong>DIRECCION:</strong></p>
                    <p>{$value['Domicilio']}</p>
                  </div>
                
                  <div class=\"col-6 col-sm-6 col-md-4\">
                    <p><strong>DUI:</strong></p>
                    <P>{$value['DUI']}</P>
                  </div>
                  <div class=\"col-6 col-sm-6 col-md-4\">
                    <p><strong>PROFESION:</strong></p>
                    <p>{$value['Profesion']}</p>
                  </div>
                  <div class=\"col-6 col-sm-6 col-md-4\">
                    <p><strong>FECHA DE NAC:</strong></p>
                    <p>{$value['FechaNacimiento']}</p>
                  </div>
                </div>
              ";
            }
          }else{
            echo "<center>No hay informacion Asociada</center>";
          }
  
        ?>
        </div>
      </div>
    </div>
    <!-- ######## FIN INFORMACION TITULAR ######### -->



    <!-- ######## INFORMACION BENEFICIARIO ######### -->
    <div class="col-12 col-sm-12 col-md-6">
      <div class="text-center">
        <h4>Beneficiarios Asociados</h4>
      </div>
      <div class="table-responsive" style="max-height:210px; overflow-y:scroll">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>N°</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>DUI</th>
              <th>Domicilio</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if  ($beneficiario!="-1") {
                $i = 0;
                foreach ($beneficiario as $value) {
                  $i++;
                  echo "
                    <tr>
                    <td>$i</td>
                    <td>{$value['NombresCiudadano']}</td>
                    <td>{$value['ApellidosCiudadano']}</td>
                    <td>{$value['DUI']}-9</td>
                    <td>{$value['Domicilio']}</td>
                    </tr>";
                    }
                  }
                  else{
                    echo"
                    <tr>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                  </tr>";
                  }
              ?>
          </tbody>
        </table>
      </div>
    </div>


    <!-- ######## INFORMACION DE LA PARCELA ######### -->
    <div class="col-12 col-sm-12 mt-2">
      <div class="card card-register mx-auto mt-2">
        <div class="card-header text-center">
          <div class="card-title">
            <h4>Informacion del Titulo y Parcela</h4>
          </div>
        </div>
        <div class="card-body">
          <div class="row text-center">
            <?php
              if  ($query!="-1") {
                foreach ($query as $value) {
                  echo "
                    <div class=\"col-6 col-sm-6 col-md-1\">
                      <h6>N° Titulo:</h6>
                      <p>{$value['NumeroTitulo']}</p>
                    </div>
                    <div class=\"col-6 col-sm-6 col-md-1\">
                      <h6>Numero Parcela:</h6>
                      <p>{$value['Numero']}</p>
                    </div>
                    <div class=\"col-6 col-sm-6 col-md-1\">
                      <h6>Numero Poligono:</h6>
                      <p>{$value['Poligono']}</p>
                    </div>
                    <div class=\"col-6 col-sm-6 col-md-2\">
                      <h6>Cementerio:</h6>
                      <p>{$value['Nombre']}</p>
                    </div>
                    <div class=\"col-6 col-sm-6 col-md-3\">
                      <h6>Tipo de Titulo:</h6>
                      <p>{$value['Tipo']}</p>
                    </div>
                    <div class=\"col-6 col-sm-6 col-md-2\">
                      <h6>Fecha Expedido:</h6>
                      <p>{$value['FechaExpedido']}</p>
                    </div>
                    <div class=\"col-6 col-sm-6 col-md-2\">
                      <h6>Estado:</h6>
                      "; if ($value['Estado'] == 1 && $value['Proceso'] == 1)  {
                        echo "<p>Activo</p>";
                      }else{
                        echo "<p>Inactivo</p>";
                      }
                  echo "
                    </div>
    
                    <div class=\"col-12 col-sm-12 col-md-12 \">
                      <h6>Descripcion del Titulo:</h6>
                      <pre>{$value['Descripcion']}</pre>
                    </div>";
                }
              } else{
                echo "
                  <center>No hay informacion Asociada</center>
                  ";
              }
            ?>
          </div>
        </div>
      </div>
<!-- ######## FIN INFORMACION TITULO ######### -->


<!-- ######## INFORMACION FACTURA ######### -->
      <div class="col-12 col-sm-12 mt-4"></div>
        <div class="card">
          <div class="card-header text-center">
            <h4>Datos de Facturación</h4>
          </div>
          <div class="card-body">
            <div class="row text-center">
            <?php
              if  ($query!="-1") {
                foreach ($query as $value) {
                  echo "
                    <div class=\"col-12 col-sm-6 col-md-4 mx-auto\">
                      <label for=\"Recibo\"><strong>Numero de Recibo</strong></label>
                      <p>{$value['NumeroRecibo']}</p>
                    </div>
                    <div class=\"col-12 col-sm-6 col-md-4 mx-auto\">
                      <label ><strong>Fecha de Recibo</strong></label>
                      <p>{$value['FechaRecibo']}</p>
                    </div>
                    <div class=\"col-12 col-sm-12 col-md-4 mx-auto\">
                      <label><strong>A favor de:</strong></label>
                      <p>Alcaldia Mucicipal de Chalatenango</p>
                    </div>
                    <div class=\"form-group col-md-12 mx-auto\">
                      <label><strong>Observaciones</strong></label>
                      <p class=\"text-area\">{$value['Observaciones']}</p>
                    </div>";
                  }
                } else{
                  echo "
                    <center>No hay informacion Asociada</center>
                    ";
                }
              ?>
              <div class="col col-md-12">
                <a class="btn btn-danger float-right" href="<?php echo $server;?>/repotrastitulo ?>">Regresar</a>
            </div>
          </div>
        </div>
      </div>
<!-- ######## FIN FACTURA ######### -->


    </div>
  </div>

  <!---hasta aca -->

  <?php require_once('Views/default/footer.php'); ?>