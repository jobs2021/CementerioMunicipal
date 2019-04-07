<!-- TITULOS VIGENTES-->
<?php
//session para enviar notificacion
session_start();

$titulo = 'Titulos Vigentes';

$consulta = new ConexionDB();
$variable = $consulta->Query("SELECT t1.NumeroTitulo, t3.Tipo, t4.NombresCiudadano, t4.ApellidosCiudadano, t2.Numero, t5.Nombre, t1.Estado FROM Titulos t1 INNER JOIN Parcelas t2 ON t1.idParcela=t2.idParcela INNER JOIN TipoTitulos t3 ON t1.idTipoTitulo=t3.idTipoTitulo INNER JOIN Ciudadanos t4 ON t1.idCiudadanoTitular=t4.idCiudadano INNER JOIN Cementerios t5 ON t2.idCementerio=t5.idCementerio");

require_once('Views/default/header.php');
?>

<!--BREADCUMB-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $server; ?>/inicio">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Historial Titulos</li>
    </ol>
</nav>

<!-- Body -->
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card-body">
            <form method="GET">
                <div class="form-group ">
                    <div class="col-12  text-center">
                        <h1 style="text-align:center">Historial Titulos <a id="crear" title="Crear" class="btn btn-outline-primary" href="<?php echo $server; ?>/creartitulo">
                                Nuevo
                            </a></h1>

                    </div>
                    <input class="form-control col-12 col-lg-8 mx-auto" type="search" name="titulo" placeholder="Nombre o Codigo del Titulo" aria-label="Search" id="buscarTitulo">
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12 mx-0 padding-10 mt-2">
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
    <?php 
    require_once('Views/default/footer.php');

    //enviar notitificacion
    @session_start();
    
    if (isset($_SESSION['JsonNotification'])) {
        echo "
    <script type=\"text/javascript\">
    $.ajax({
        url : '{$server}:8585/send_noti?sms={$_SESSION['JsonNotification']}'
    });

    </script> ";
        session_destroy();
    }

    //agregar notificacion a tabla
    //$consulta = new ConexionDB();
    //$fechaNow = date('Y-m-d');
    //$query = "INSERT into Notificaciones (Fecha,Data,RolAccess,Visto) values ('{$fechaNow}','{$_SESSION['JsonNotification']}','1','0')";
    //$consulta->Query($query);

    ?>


    <script>
        function buscar_titulo(valor) {
            $.ajax({
                    url: '<?php echo $server; ?>/tituloActions/?action=1',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        actv: 1,
                        valor: valor
                    },
                })
                .done(function(respuesta) {
                    if (respuesta == 'no se puede ejecutar la consulta') {
                        $("#data").html('<h5 align="center" class="mt-4">No hay resultados</h5>');
                    } else {
                        $("#data").html(respuesta);
                    }
                })
                .fail(function() {
                    console.log("error");
                })
        }
        
        var buscar = $("#buscarTitulo");
        if (buscar.val() === "") {
            buscar_titulo("*")
        }

        buscar.keyup(function() {
            var valor = $(this).val();
            if (valor != "") {
                buscar_titulo(valor);
            } else {
                valor = "*";
                buscar_titulo(valor);
            }
        });
    </script> 