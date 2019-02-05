<!-- TITULOS VIGENTES-->

<?php 
$titulo='Titulos Vigentes';
require_once('Views/default/header.php'); 
?>


<!--BREADCUMB-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $server;?>/inicio">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Titulos</li>
    </ol>
</nav>

<!-- Body -->
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card-body">
            <form class="form-inline" method="GET">
                <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">
                    <div class="form-group">
                        <p align="center">
                            Para realizar busquedas, ingrese un Nombre o Numero del Titulo a buscar.
                        </p>
                        <input class="form-control col-sm-2 col-md-10 col-lg-10" type="search" name="titulo" placeholder="Nombre o Codigo del Titulo" aria-label="Search" id="buscarTitulo">
                        
                        
                    </div>
                </div>
            </form>


        </div>
    </div>
    <div class="col-md-12 mx-0 padding-0 mt-2">
        <a style="margin-right:10px; margin-bottom:10px" id="crear" title="Crear" class="btn btn-secondary float-right" href="<?php echo $server;?>/creartitulo">Crear Titulo</a>
                <div id="data">
                <div class='table-responsive'>
                            <table class='table'>
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Titulo</th>
                                    <th>Tipo</th>
                                    <th>Cementerio</th>
                                    <th>Parcela</th>
                                    <th>Estado</th>
                                    <th>Proceso</th>
                                    <th></th>
                                </tr>
                            </thead>
                        <tbody>
                                </tbody>
                    </table>
                </div>
</div>
</div>
<!--END-->
<?php require_once('Views/default/footer.php'); ?>
<script>
    function buscar_titulo(valor){
    $.ajax({
        url: '<?php echo $server;?>/tituloActions/?action=9',
        type: 'POST',
        dataType: 'html',
        data: {valor: valor},
    })
    .done(function(respuesta){
        if (respuesta=='no se puede ejecutar la consulta'){
            $("#data").html('<h5 align="center" class="mt-4">No hay resultados</h5>');
        } else {
            $("#data").html(respuesta);
        }
        
    })
    .fail(function(){
        console.log("error");
        })
    }
    
 $("#buscarTitulo").keyup(function(){
     var valor = $(this).val();
     
        if(valor != ""){
            buscar_titulo(valor);
        } else {
            buscar_titulo();
        }  
    });

</script>
