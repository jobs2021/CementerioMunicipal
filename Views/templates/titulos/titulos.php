<!-- TITULOS VIGENTES-->

<?php 
	$titulo='Titulos Vigentes';
	require_once('Views/default/header.php'); 
?>

<!-- Body -->
<div class="content-wrapper">
    <div class="container-fluid">
<div class="card col-5 mx-auto mt-5">
    <div class="card-header"><h4>Busqueda de Titulos</h4></div>
      <div class="card-body">
        <form class="form-inline" method="GET">
            <p>Para realizar busquedas, ingrese un Nombre o Numero de Titulo</p>
            <input class="form-control col-lg-10 mr-sm-2" type="search" name="titulo" placeholder="Nombre o Codigo del Titulo" aria-label="Search">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>

</div>
</div>
</div>




<!--END-->


<?php require_once('Views/default/footer.php'); ?>