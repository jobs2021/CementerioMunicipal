<!-- TITULOS VIGENTES-->

<?php 
$titulo='Titulos Vigentes';
require_once('Views/default/header.php'); 
?>



<!--BREADCUMB-->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Titulos</li>
</ol>
</nav>






<!-- Body -->
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card col-12 mx-auto mt-2">
            <div class="card-header mx-2">
                <h4 class="card-title ">Busqueda De Titulos<a id="crear" title="Crear" class="btn btn-fill mx-2" style="background-color: #C16F4E ; color:white" href="creartitulo">Crear Titulo</a>  </h4>
            </div>
            <div class="card-body">
                <form class="form-inline" method="GET">
                    <div class="col-md-6 mx-auto" >
                        <div class="form-group">
                            <p align="center">
                                Para realizar busquedas, ingrese un Nombre o Numero del Titulo a buscar.
                            </p>
                            <input class="form-control col-lg-8 mr-sm-1" type="search" name="titulo" placeholder="Nombre o Codigo del Titulo" aria-label="Search">
                            <button class="btn btn-dark my-2 my-sm-0" type="submit">Buscar</button>
                        </div>
                    </div>               
                </form>
            </div>

        </div>
        <div class="card card-register col-md-12 mx-auto mt-4">
        <div class="card-body">
          <div class="table-responsive">
          <table class="table">
            <tr>
              <th>N°</th>
              <th>Titulo</th>
              <th>Tipo</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Parcela</th>
              <th>Cementerio</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
            <tr>
              <td>1</td>
              <td style="color: green">120937</td>
              <td>Perpetuidad</td>
              <td>Kevin</td>
              <td>Rivas</td>
              <td>P055</td>
              <td>Central</td>
              <td style="color: #BD54F5">True</td>
              <td>
                  <a style="color: FORESTGREEN" title="Ver Titulo" href="eyetitulo" class="fas fa-eye"></a>   
                  
                  
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td style="color: green">145968</td>
              <td>Arrendamiento</td>
              <td>Carlos</td>
              <td>Rivas</td>
              <td>P78</td>
              <td>Reubicacion</td>
              <td style="color: #BD54F5">False</td>
              <td>
                  <a style="color: FORESTGREEN" title="Ver Titulo" href="eyetitulo" class="fas fa-eye"></a>                 
                  
              </td>
            </tr>
          </table>
          </div>
        </div>
    </div>
</div>
</div>



 

<!--END-->


<?php require_once('Views/default/footer.php'); ?>