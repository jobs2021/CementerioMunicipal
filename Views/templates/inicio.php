<?php 
	$titulo='Inicio';
	require_once('Views/default/header.php'); 
?>
<!-- aca ira todo el codigo html de la vista-->

  <div class="container">
  	<div class="row justify-content-center" style="margin-top: 20vh">
  	<h1>Dark Google</h1>
  		<form class="form-inline justify-content-center padding-top-15 padding-bottom-15 col-12" method="GET" action="<?php echo $server;?>/parcelas">
                <div class="input-group col-6">
                    <input type="text" class="form-control" name="busqueda" placeholder="Busqueda General">
                    <div class="input-group-prepend rounded">
						<button type ="submit" class="btn btn-dark rounded-right">Buscar</button>
					</div>
				</div>
            </form>
</div>	
	</div>

<!---hasta aca -->

<?php require_once('Views/default/footer.php'); ?>
