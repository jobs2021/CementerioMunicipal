<?php 
$titulo='Crear Titulo';
require_once('Views/default/header.php'); 
?>



<!--BREADCUMB-->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
    <li class="breadcrumb-item"><a href="titulos">Titulos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Crear Titulo</li>
  </ol>
</nav>



<!-- aca ira todo el codigo html de la vista-->

<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="card card-register col-md-6 col-md-pull-9 mx-auto mt-4">
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
            <a href="vertitulo" class="btn btn-primary">Guardar</a>
            <a href="repotrastitulo" class="btn btn-danger">Cancelar</a>
          </form>
        </div>
      </div>  







      <div class="card card-register col-xs-4 mx-auto mt-4">
        <div class="card-header"><h5 style="color:#D16C2A; position: relative;">Añadir Beneficiarios <button class="btn" style="background-color: #C16F4E ; color:white" data-toggle="modal" data-target="#bnfModal">Agregar</button></h5></div>
        <div class="card-body">
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
            </tr>
            <tr>
              <td>2</td>
              <td>Samuel</td>
              <td>Cartagena</td>
              <td>05706516-9</td>
            </tr>
          </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="bnfModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Beneficiarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">



                <div class="card card-register">
                  <div class="card-header">Agregar Beneficiarios</div>
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
                      <button type="submit" class="btn btn-primary">Guardar</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </form>
                  </div>
                </div> 



              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!---hasta aca -->

  <?php require_once('Views/default/footer.php'); ?>