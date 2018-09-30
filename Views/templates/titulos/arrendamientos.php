<!-- TITULOS VIGENTES-->

<?php 
$titulo='Titulos Vigentes';
require_once('Views/default/header.php'); 
?>


<!--BREADCUMB-->
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo $server;?>/inicio">Inicio</a></li>
		<li class="breadcrumb-item active" aria-current="page">Arrendamientos</li>
	</ol>
</nav>



<!-- Body -->
<!-- Body -->
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="card-header mx-2">
			<h4 class="card-title ">Arrendamientos<a title="Crear" class="btn btn-secondary mx-2" style="color: white" data-toggle="modal" data-target="#crear">Nuevo Arrendamiento</a>  </h4>
		</div>
		<div class="card-body">
			<form class="form-inline" method="GET">
				<div class="col-md-5 mx-auto" >
					<div class="form-group">
						<p align="center">
							Para realizar busquedas, ingrese un Nombre o Numero de Arrendamiento
						</p>

						<input class="form-control col-lg-10 mr-sm-1" type="search" name="arrendamiento" placeholder="Nombre o Codigo de Arrendamineto" aria-label="Search">
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
					<th scope="col">Nombres</th>
					<th scope="col">Apellidos</th>
					<th scope="col">Direccion</th>
					<th scope="col">Fecha de Pago</th>
					<th scope="col">F1SAM</th>
					<th scope="col">Años</th>
					<th scope="col">Estado</th>
					<th scope="col"></th>
				</tr>
				<tr class="row-hover">
					<td scope="row">1</td>
					<td >Juan Antonio</td>
					<td>Guardado</td>
					<td>B° El Centro</td>
					<td>23/02/2004</td>
					<td style="color: green">P055456</td>
					<td>20</td>
					<td style="color: #3498DB">TRUE</td>
					<td>
						<div class="row-btn">
							<a style="color: DODGERBLUE" title="Traspasar Titulo" class="fas fa-edit" data-toggle="modal" data-target="#editar"></a>
							<a style="color: #FF4500" title="Cancelar Titulo" class="fas fa-trash" data-toggle="modal" data-target="#eliminar"></a>
						</div>
					</td>
				</tr>
				<tr class="row-hover">
					<td scope="row">1</td>
					<td >Carlos Ernesto</td>
					<td>Fausto</td>
					<td>B° El Calvario, Chalatenango</td>
					<td>12/06/1997</td>
					<td style="color: green">XF465TG</td>
					<td>5</td>
					<td style="color: #3498DB">TRUE</td>
					<td>
						<div class="row-btn">
							<a style="color: DODGERBLUE"  title="Traspasar Titulo" class="fas fa-edit" data-toggle="modal" data-target="#editar"></a>
							<a style="color: #FF4500" title="Cancelar Titulo" class="fas fa-trash" data-toggle="modal" data-target="#eliminar"></a>
						</div>
					</td>
				</tr>
			</table>      
		</div>
	</div>
</div>


<!-- Modal Crear-->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Crear Arrendamiento</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST">
					<div class="form-row">
						<div class="form-group col-6">
							<label for="nombre">Nombres:</label>
							<input type="text" class="form-control" id="nombre" placeholder="Nombres">
						</div>
						<div class="form-group col-6">
							<label for="nombre">Apellidos:</label>
							<input type="text" class="form-control" id="apellido" placeholder="Apellidos">
						</div>
					</div>
					<div class="form-group">
						<label for="edad">Direccion:</label>
						<input type="text" class="form-control" id="direccion" placeholder="Direccion">
					</div>
					<div class="form-row">
						<div class="form-group col-6">
							<label for="sel2" :>Fecha de Pago:</label>
							<input class="form-control" type="date" name="fecha">
						</div>
						<div class="form-group col-6">
							<label for="edad">F1SAM:</label>
							<input type="text" class="form-control" id="f1sam" placeholder="PDF3456">
						</div>
						
					</div>
					
					<div class="form-group">
						<label for="anios">Años de Arrendamiento:</label>
						<input type="number" class="form-control" id="anios" placeholder="Años">

					</div>
					<div class="form-group ">
						<button type="button" class="btn btn-primary btn-block">Guardar</button>
						<button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</button>							
					</div>
				</form>

			</div>

			
		</div>
	</div>
</div>



<!-- Modal Editar-->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar Arrendamiento</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST">
					<div class="form-row">
						<div class="form-group col-6">
							<label for="nombre">Nombres:</label>
							<input type="text" class="form-control" id="nombre" placeholder="Nombres">
						</div>
						<div class="form-group col-6">
							<label for="nombre">Apellidos:</label>
							<input type="text" class="form-control" id="apellido" placeholder="Apellidos">
						</div>
					</div>
					<div class="form-group">
						<label for="edad">Direccion:</label>
						<input type="text" class="form-control" id="direccion" placeholder="Direccion">
					</div>
					<div class="form-row">
						<div class="form-group col-6">
							<label for="sel2" :>Fecha de Pago:</label>
							<input class="form-control" type="date" name="fecha">
						</div>
						<div class="form-group col-6">
							<label for="edad">F1SAM:</label>
							<input type="text" class="form-control" id="f1sam" >
						</div>
						
					</div>
					
					<div class="form-group">
						<label for="anios">Años de Arrendamiento:</label>
						<input type="number" class="form-control" id="anios">
						
					</div>
					<div class="form-group ">
						<button type="button" class="btn btn-info btn-block">Guardar</button>
						<button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</button>							
					</div>
				</form>
		</div>
	</div>
</div>
</div>




<!-- Modal Eliminar-->
<div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Cancelar Arrendamiento</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="card card-register col-md-12 mx-auto ">
					<div class="card-header"></div>
					<div class="card-body">
						<p>Esta seguro que desea ELiminar el Arrendamiento a nombre de: <h6 style="color: #3498DB">"fgdhdtf"</h6></p>
						
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


<?php require_once('Views/default/footer.php'); ?>