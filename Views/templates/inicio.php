<?php 

	$titulo='Inicio';
	require_once('Views/default/header.php'); 
  
    @$busqueda=$_GET['search'];
    if (isset($busqueda) && $busqueda!="") {
      require_once('Views/templates/inicio/search.php');
    }else{
      require_once('Views/templates/inicio/inicio.php');
    }


?>
<!-- aca ira todo el codigo html de la vista-->



<!---hasta aca -->

<?php require_once('Views/default/footer.php'); ?>

