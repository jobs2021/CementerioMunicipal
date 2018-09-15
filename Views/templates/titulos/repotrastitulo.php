<!-- TITULOS VIGENTES-->

<?php 
$titulo='Titulos Vigentes';
require_once('Views/default/header.php'); 
?>


<!--BREADCUMB-->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $server;?>/inicio">Inicio</a></li>
    <li class="breadcrumb-item"><a href="<?php echo $server;?>/titulos">Titulos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Operacones</li>
  </ol>
</nav>



<!-- Body -->
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="card-header mx-2">
      <h4 class="card-title ">Reposicion, Traspaso o Cancelacion De Titulos<a id="crear" title="Crear" class="btn btn-secondary mx-2" style="color: white" href="<?php echo $server;?>/inicio">Inicio</a>  </h4>
    </div>
    <div class="card-body">
      <form class="form-inline" method="GET">
        <div class="col-md-5 mx-auto" >
          <div class="form-group">
            <p align="center">
              Para realizar busquedas, ingrese un Nombre o Numero de Titulo
            </p>

            <input class="form-control col-lg-10 mr-sm-1" type="search" name="titulo" placeholder="Nombre o Codigo del Titulo" aria-label="Search">
            <button class="btn btn-dark my-2 my-sm-0"  type="submit">Buscar</button>
          </div>
        </div>
      </form>

    </div>
  </div>
  <div class="col-12 col-sm-12 col-md-10 col-lg-10 padding-0 mx-auto">
    
   <div class="table-responsive">
    <table class="table table table table-hover margin-top-15">
      <tr>
        <th scope="col">N°</th>
        <th scope="col">Titulo</th>
        <th scope="col">Tipo</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellidos</th>
        <th scope="col">Parcela</th>
        <th scope="col">Cementerio</th>
        <th scope="col"></th>
      </tr>
      <tr class="row-hover">
        <td scope="row">1</td>
        <td style="color: green">120937</td>
        <td>Perpetuidad</td>
        <td>Kevin</td>
        <td>Rivas</td>
        <td>P055</td>
        <td>Central</td>
        <td>
          <div class="row-btn">
            <a style="color: FORESTGREEN" title="Ver Titulo" href="<?php echo $server;?>/eyetitulo" class="fas fa-eye"></a>   
            <a style="color: DODGERBLUE" href="<?php echo $server;?>/creartitulo" title="Traspasar Titulo" class="fas fa-edit"></a>
            <a style="color: #2F2F2F" href="<?php echo $server;?>/repotitulo" title="Reponer Titulo" class="fas fa-copy"></a>
            <a style="color: #FF4500" title="Cancelar Titulo" class="fas fa-times-circle" data-toggle="modal" data-target="#exampleModal"></a>
          </div>
        </td>
      </tr>
      <tr class="row-hover">
        <td scope="row">2</td>
        <td style="color: green">145968</td>
        <td>Arrendamiento</td>
        <td>Carlos</td>
        <td>Rivas</td>
        <td>P78</td>
        <td>Reubicacion</td>
        
        <td>
          <div class="row-btn">
            <a style="color: FORESTGREEN" title="Ver Titulo" href="<?php echo $server;?>/eyetitulo" class="fas fa-eye"></a>   
            <a style="color: DODGERBLUE" href="<?php echo $server;?>/creartitulo" title="Traspasar Titulo" class="fas fa-edit"></a>
            <a style="color: #2F2F2F" href="<?php echo $server;?>/repotitulo" title="Reponer Titulo" class="fas fa-copy"></a>
            <a style="color: #FF4500" title="Cancelar Titulo" class="fas fa-times-circle" data-toggle="modal" data-target="#exampleModal"></a>
          </div>
        </td>
      </tr>
    </table>      
  </div>
</div>
</div>






<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cancelar Titulo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-register col-md-12 mx-auto ">
          <div class="card-header"></div>
          <div class="card-body">
            <p>Esta seguro que desea ELiminar el titulo a nombre de <h6>""</h6></p>
            <div form-group>
              <label>Observaciones</label>
              <textarea class="form-control"></textarea>
            </div>
          </div>
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>


<!--END-->


<!--END-->


<?php require_once('Views/default/footer.php'); ?>