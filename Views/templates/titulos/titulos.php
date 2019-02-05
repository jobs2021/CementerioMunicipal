<!-- TITULOS VIGENTES-->

<?php 
$titulo='Titulos Vigentes';

$consulta = new ConexionDB();
$variable= $consulta->Query("SELECT t1.NumeroTitulo, t3.Tipo, t4.NombresCiudadano, t4.ApellidosCiudadano, t2.Numero, t5.Nombre, t1.Estado FROM Titulos t1 INNER JOIN Parcelas t2 ON t1.idParcela=t2.idParcela INNER JOIN TipoTitulos t3 ON t1.idTipoTitulo=t3.idTipoTitulo INNER JOIN Ciudadanos t4 ON t1.idCiudadanoTitular=t4.idCiudadano INNER JOIN Cementerios t5 ON t2.idCementerio=t5.idCementerio");

require_once('Views/default/header.php'); 
?>



<!--BREADCUMB-->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $server;?>/inicio">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Titulos</li>
</ol>
</nav>






<!-- Body -->
<div class="content-wrapper">
    <div class="container-fluid">
            <div class="card-body">
                <form class="form-inline" method="GET">
                    <div class="col-sm-12 col-md-6 col-lg-6 mx-auto" >
                        <div class="form-group">
                            <p align="center">
                                Para realizar busquedas, ingrese un Nombre o Numero del Titulo a buscar.
                            </p>
                            <input class="form-control col-sm-2 col-md-8 col-lg-8" type="search" name="titulo" placeholder="Nombre o Codigo del Titulo" aria-label="Search">
                            <button class="btn btn-dark col-sm-4 col-md-2 col-lg-2" type="submit">Buscar</button>
                        </div>
                    </div>               
                </form>
            
        
        </div>
    </div>
    <div class="col-md-12 mx-0 padding-0 mt-2">
        <a style="margin-right:10px; margin-bottom:10px" id="crear" title="Crear" class="btn btn-secondary float-right" href="<?php echo $server;?>/creartitulo">Crear Titulo</a>
          <div class="table-responsive">
          <table class="table table table-hover">
            <tr>
              <th>N°</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Titulo</th>
              <th>Tipo</th>
              <th>Cementerio</th>
              <th>Parcela</th>
              <th>Estado</th>
              <th></th>
            </tr>
            
             <?php
                if ($variable != -1){
                    $i=0;
                    foreach ($variable as $value){
                        $i++;
                        echo "
                        <tr class=\"row-hover\">
                        <td>{$i}</td>
                        <td>{$value['NombresCiudadano']}</td>
                        <td>{$value['ApellidosCiudadano']}</td>
                        <td style=\"color: green\">{$value['NumeroTitulo']}</td>
                        <td>{$value['Tipo']}</td>
                        <td>{$value['Nombre']}</td>
                        <td>{$value['Numero']}</td>
                        ";
                        if($value['Estado']==1){
                            echo "<td style=\"color: #BD54F5\">Activo</td>";
                        }else{
                            echo "<td style=\"color: #BD54F5\">Inactivo</td>";
                        }
                        echo "
                        <td>
                        <div class=\"row-btn\">
                            <a style=\"color: FORESTGREEN\" title=\"Ver Titulo\" href=\"<?php echo $server;?>/eyetitulo\" class=\"fas fa-eye\"></a>   
                        </div>
                        </td>
                        </tr>
                        ";
                    }
                }else{
                    
                }
                ?>
              <!--td>1</td>
              <td style="color: green">120937</td>
              <td>Perpetuidad</td>
              <td>Kevin</td>
              <td>Rivas</td>
              <td>P055</td>
              <td>Central</td>
              <td style="color: #BD54F5">True</td-->            
          </table>
       

        </div>
</div>
</div>



 

<!--END-->


<?php require_once('Views/default/footer.php'); ?>