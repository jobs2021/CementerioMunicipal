<?php 
$titulo='Crear Titulo';
require_once('Views/default/header.php'); 
?>



<!--BREADCUMB-->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $server;?>/inicio">Inicio</a></li>
    <li class="breadcrumb-item"><a href="<?php echo $server;?>/titulos">Titulos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ver Titulo</li>
  </ol>
</nav>

<!-- aca ira todo el codigo html de la vista-->

<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="card card-register col-md-8 col-md-pull-9 mx-auto mt-4">
        <div class="card-header"> <h4>Informacion del Titular</h4></div>
        <div class="card-body">
          <form>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="Nombres">Nombres</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="Nombres">
              </div>
              <div class="form-group col-md-6">
                <label for="Apellidos">Apellidos</label>
                <input type="text" class="form-control" id="inputPassword4" placeholder="Apellidos">
              </div>

            </div>
            <div class="form-group">
              <label for="Direccion">Direccion</label>
              <input type="text" class="form-control" id="inputAddress" placeholder="Direccion de domicilio">
            </div>
            <div class="form-group">
              <label for="Dui">DUI</label>
              <input type="text" class="form-control" id="inputAddress2" placeholder="Numero Unico de Identidad">
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="Profesion">Profesion</label>
                <input type="text" class="form-control" id="Profesion" placeholder="Profesion u Ocupacion">
              </div>
              <div class="form-group col-md-6">
                <label for="fecha">Fecha de Nacimiento</label>
                <input class="form-control" id="datepicker" type="date">
              </div >
            </div>
          </form>
        </div>
      </div>  



      <div class="card card-register col-xs-4 mx-auto mt-4">
        <div class="card-header"><h5 style="position: relative;">Beneficiarios</h5></div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>N°</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>DUI</th>
                
              </tr>
              <tr>
                <td>1</td>
                <td>Kevin</td>
                <td>Rivas</td>
                <td>05505416-9</td>
                <td></td>
              </tr>
              <tr>
                <td>2</td>
                <td>Samuel</td>
                <td>Cartagena</td>
                <td>05706516-9</td>
                
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
    <div class="container-fluid">   
  <div class="col-12 col-sm-12 col-md-10 col-lg-10 padding-0">
    <div class="table-responsive">
      <table class="table table-hover margin-top-15 ">
        <tr>
          <th scope="col">N° Parcela</th>
          <th scope="col">Cementerio</th>
          <th scope="col">Tipo</th>
          <th scope="col">Poligono</th>
        </tr>
        <tr class="row-hover">
          <td scope="row">148723</td>
          <td>Sn. José</td>
          <td>Perpetuidad</td>
          <td>P013</td>             
        </tr>
      </table>
    </div>
  </div>



  <div class="card card-register col-md-12 mx-auto mt-4">
    <div class="card-header">
      <div class="card-title">Informacion Titular</div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="form-group col-xs-4 col-md-pull-9 mt-4">
          <h6>N° Titulo:</h6> <p>1567</p>
        </div>
        <div class="form-group col-xs-4 mx-auto mt-4">
          <h6>Nombre Titular:</h6> <p>Kevin Rivas</p>
        </div>
        <div class="form-group col-xs-4 mx-auto mt-4">
          <h6>Tipo de Titulo:</h6> <p style="color:#83FE2E">Perpetuidad Por Primera Vez</p>
        </div>
        <div class="form-group col-md-4 mx-auto mt-4">
          <h6>Descripcion:</h6> <pre>Título expedido por la autoridad municipal por primera vez</pre>
        </div>

        <div class="form-group col-xs-4 mx-auto mt-4">
          <h6>Fecha Expedido:</h6> <p>15/07/2018</p>
        </div>
      </div>
    </div>
  </div>
  <div class="card card-register col-md-12 mx-auto mt-4">
    <div class="card-header"> <h4>Datos de Facturación</h4></div>
    <div class="card-body">
      <form action="POST">
        <div class="form-row">
          <div class="form-group col-md-6 mx-auto">
            <label for="Recibo">Numero de Recibo</label>
            <input type="text" class="form-control" id="recibo" placeholder="N° Recibo">
          </div>
          <div class="form-group col-md-6 mx-auto">
            <label for="">Fecha de Recibo</label>
            <input class="form-control" type="date" name="Fecha" placeholder="DD/MM/AA">
          </div>

          <div class="form-group col-md-12">
            <label for="">Observaciones</label>
            <textarea class="form-control" type="" name=""></textarea> 
          </div>
          
          <div class="col col-md-12 mt-4">
            <a  class="btn btn-danger" href="<?php echo $server;?>/repotrastitulo">Regresar</a>
            <!--a href="<?php echo $server;?>/repotrastitulo" class="btn btn-dark">Cancelar</a -->
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

    </div>
  </div>
</div>


    <!---hasta aca -->

    <?php require_once('Views/default/footer.php'); ?>