<!-- TITULOS Finalizar-->

<?php 
$titulo='Titulos Vigentes';
require_once('Views/default/header.php'); 
?>

<!--BREADCUMB-->
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo $server;?>/inicio">Inicio</a></li>
		<li class="breadcrumb-item"><a href="<?php echo $server;?>/titulos">Titulos</a></li>
		<li class="breadcrumb-item"><a href="<?php echo $server;?>/creartitulo">Crear Titulo</a></li>
		<li class="breadcrumb-item active" aria-current="page">Finalizar Titulo</li>
	</ol>
</nav>

<!-- Body -->

<div class="container-fluid">		
	<div class="card-header"><h4>Terminar Registro del Titulo</h4></div>				
	<h5 style="color: #474747; position: relative;" class="mx-4 mt-4">Añadir Parcela al Titulo<button data-toggle="modal" data-target="#parcela" style="background-color: #4A4A4B; color: white" class="btn mx-2">Selecionar</button></h5>
	<div class="class="col-12 col-sm-12 col-md-10 col-lg-10 padding-0">
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
					
					</div>
					<div class="col col-md-12 mt-4">
						<button class="btn btn-primary" type="submit">Guardar</button>
						<a href="<?php echo $server;?>/repotrastitulo" class="btn btn-dark">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>



<!-- Modal Parcela-->
<div class="modal fade bd-example-modal-lg" id="parcela" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" >Parcela</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col col-lg-12">
				<form class="form-inline">
					<input class="form-control col-lg-9 mr-sm-1 mx-4" type="search" placeholder="Numero de Parcela" aria-label="Search">
					<button class="btn btn-dark my-2 my-sm-0" type="submit">Buscar</button>
				</form>
					</div>
				<div class="col-lg-12 mx-auto">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<tr>
									<th>Sel</th>
									<th>Parcela</th>
									<th>Tipo</th>
									<th>Cementerio</th>
									<th>Poligono</th>
									<th>Coord X</th>
									<th>Coord Y</th>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
										</div>
									</td>
									<td>129876</td>
									<td>Perpetuidad</td>
									<td>Sn. José</td>
									<td>P04</td>
									<td>14.0818567</td>
									<td>-88.9014130</td>
								</tr>
								<tr>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
										</div>
									</td>
									<td>129877</td>
									<td>Arrendamiento</td>
									<td>Central</td>
									<td>P101</td>
									<td>15.0818567</td>
									<td>-86.9014130</td>
								</tr>
							</table>
					
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary">Guardar</button>
			</div>

		</div>



		<!---hasta aca -->

		<?php require_once('Views/default/footer.php'); ?>