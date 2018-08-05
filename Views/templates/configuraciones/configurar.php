<?php 
$titulo='Crear Titulo';
require_once('Views/default/header.php'); 
?>



<!--BREADCUMB-->
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo $server;?>/inicio">Inicio</a></li>
		<li class="breadcrumb-item active" aria-current="page">configuraciones</li>

	</ol>
</nav>



<!-- aca ira todo el codigo html de la vista-->
<div class="content-wrapper">
	<div class="container-fluid">
		<h1 style="text-align: center;">Configuraciones <span class="badge badge-secondary"><a style="color: white;" data-toggle="modal" data-target="#crear">Nuevo</a></span></h1>
		<div class="row position-relative">
			<div class="col col-lg-6 mx-auto mt-4">	
				<div class="table-responsive">	
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Valor</th>
								<th></th>
								
							</tr>
						</thead>
						<tr class="row-hover">
							<th  style="background-color: white; color: black" scope="row">Titulacion</th>
							<td>$0.00</td>
							<td>
								<div class="row-btn">						
									<a style="color: DODGERBLUE" href="<?php echo $server;?>/editarconfig" title="Traspasar Titulo" class="fas fa-edit" data-toggle="modal" data-target="#editar"></a>
									<a style="color: #FF4500" title="Cancelar Titulo" class="fas fa-trash"data-toggle="modal" data-target="#eliminar"></a> 
								</div>
							</td>					
						</tr>

						<tr>
							<th style="background-color: white; color: black" scope="row">Traspaso</th>
							<td>$0.00</td>
							<td>
								<div class="row-btn">								
									<a style="color: DODGERBLUE" href="<?php echo $server;?>/editarconfig" title="Traspasar Titulo" class="fas fa-edit" data-toggle="modal" data-target="#editar"></a>
									<a style="color: #FF4500" title="Cancelar Titulo" class="fas fa-trash" data-toggle="modal" data-target="#eliminar"></a> 
								</div>
							</td>		
						</tr>
						<tr class="row-hover">
							<th style="background-color: white; color: black" scope="row">Enterramiento Tierra</th>
							<td>$0.00</td>
							<td>
								<div class="row-btn">
									<a style="color: DODGERBLUE" href="<?php echo $server;?>/editarconfig" title="Traspasar Titulo" class="fas fa-edit" data-toggle="modal" data-target="#editar"></a>
									<a style="color: #FF4500" title="Cancelar Titulo" class="fas fa-trash" data-toggle="modal" data-target="#eliminar"></a> 
								</div>
							</td>
						</tr>
						<tr>

							<th style="background-color: white; color: black" scope="row">Construccion Nivel</th>
							<td>$0.00</td>
							<td>
								<div class="row-btn">
									<a style="color: DODGERBLUE" href="<?php echo $server;?>/editarconfig" title="Traspasar Titulo" class="fas fa-edit" data-toggle="modal" data-target="#editar"></a>
									<a style="color: #FF4500" title="Cancelar Titulo" class="fas fa-trash" data-toggle="modal" data-target="#eliminar"></a> 
								</div>
							</td>							
						</tr>


						<tr class="row-hover">
							<th style="background-color: white; color: black" scope="row">Enterramiento Nicho</th>
							<td>$0.00</td>
							<td>
								<div class="row-btn">
									<a style="color: DODGERBLUE" href="<?php echo $server;?>/editarconfig" title="Traspasar Titulo" class="fas fa-edit" data-toggle="modal" data-target="#editar"></a>
									<a style="color: #FF4500" title="Cancelar Titulo" class="fas fa-trash" data-toggle="modal" data-target="#eliminar"></a> 
								</div>
							</td>
						</tr>
						<tr class="row-hover">
							<th style="background-color: white; color: black" scope="row">Abrir Cerrar</th>
							<td>$0.00</td>
							<td>
								<div class="row-btn">
									<a style="color: DODGERBLUE" title="Traspasar Titulo" class="fas fa-edit" data-toggle="modal" data-target="#editar"></a>
									<a style="color: #FF4500" title="Cancelar Titulo" class="fas fa-trash" data-toggle="modal" data-target="#eliminar"></a> 
								</div>
							</td>
						</tr>
						<tr class="row-hover">
							<th style="background-color: white; color: black" scope="row">Traslado</th>
							<td>$0.00</td>
							<td>
								<div class="row-btn">
									<a style="color: DODGERBLUE" href="<?php echo $server;?>/editarconfig" title="Traspasar Titulo" class="fas fa-edit" data-toggle="modal" data-target="#editar"></a>
									<a style="color: #FF4500" title="Cancelar Titulo" class="fas fa-trash" data-toggle="modal" data-target="#eliminar"></a> 
								</div>
							</td>
						</tr>

						<tr class="row-hover">
							<th style="background-color: white; color: black" scope="row">Ruta Titulo</th>
							<td>C://</td>
							<td>
								<div class="row-btn">
									<a style="color: DODGERBLUE" href="<?php echo $server;?>/editarconfig" title="Traspasar Titulo" class="fas fa-edit" data-toggle="modal" data-target="#editar"></a>
									<a style="color: #FF4500" title="Cancelar Titulo" class="fas fa-trash" data-toggle="modal" data-target="#eliminar"></a> 
								</div>
							</td>							
						</tr>

						<tr class="row-hover">
							<th style="background-color: white; color: black" scope="row">Encabezado</th>
							<td>dfgsdjhdfkfuklgjd</td>
							<td>
								<div class="row-btn">
									<a style="color: DODGERBLUE" href="<?php echo $server;?>/editarconfig" title="Traspasar Titulo" class="fas fa-edit" data-toggle="modal" data-target="#editar"></a>
									<a style="color: #FF4500" title="Cancelar Titulo" class="fas fa-trash" data-toggle="modal" data-target="#eliminar"></a> 
								</div>
							</td>
						</tr>
						
					</table>
				</div>
			</div>	
		</div>	
	</div>
</div>




<!-- Modal crear -->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Crear Configuracion</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
 					<div class="form-group">
 						<p>
 							<label for="">Nombre</label>
 							<input type="text" class="form-control" id="#" placeholder="Configuracion">
 						</p>
 						<p>
 							<label for="">Valor</label>
 							<input type="text" class="form-control" id="#" placeholder="3.00">
 						</p>
 						<p>
 							<button type="button" class="btn btn-primary btn-block" >Guardar</button>
 							<button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</button>
 						</p>
 					</div>
 				</form>
			</div>

			
		</div>
	</div>
</div>




<!-- Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar Configuracion</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="card card-register col-md-12 mx-auto ">
					<div class="card-body">
						<div class="card-header"><h7>Usted esta editando el <h7 style="color:#3498DB">fhdfgbAZsfdbx</h7></h7></div>
						<div form-group>
							<p class="mt-4">
								<label class="for">Valor:</label>	
								<input type="text" class="form-control" name="" placeholder="Nuevo valor">
							</p>         
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-info">Editar</button>
			</div>
		</div>
	</div>
</div>



<!-- Modal Eliminar -->
<div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					<div class="card-header"><p>Esta seguro que desea ELiminar la configuracion <h6>"xxxdfsfrfg"</h6></p></div>

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





<!---hasta aca -->

<?php require_once('Views/default/footer.php'); ?>