<!-- TITULOS VIGENTES-->
<?php
$titulo = 'Titulos Vigentes';

$consulta = new ConexionDB();



require_once('Views/default/header.php');
?>

<style>
    .ms {
        width: 100%;
        overflow-x: hidden;
    }

    @media screen and (max-width:850px) {
        .ms {
            width: 100%;
            overflow-x: scroll;
        }
    }

    @media screen and (max-width:728px) {
        .ms {
            width: 100%;
            overflow-x: scroll;
        }
    }
</style>

<!--BREADCUMB-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $server; ?>/inicio">Inicio</a></li>
        <li class="breadcrumb-item active" arial-current="page">Titulos</li>
    </ol>
</nav>

<!-- Body -->
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card-body">
            <form method="GET">
                <div class="form-group ">
                    <div class="col-12  text-center">
                        <h1 style="text-align:center">Titulos Activos <a id="crear" title="Crear" class="btn btn-outline-primary" href="<?php echo $server; ?>/creartitulo">
                                Nuevo
                            </a></h1>

                    </div>
                    <input class="form-control col-12 col-lg-8 mx-auto" type="search" name="titulo" placeholder="Nombre o Codigo del Titulo" aria-label="Search" id="buscarTitulo">
                </div>
            </form>

        </div>
    </div>
    <div class="col-12 padding-10 mx-auto">
        <div class="col-12 padding-10 mx-auto"></div>
        <div id="data">
            <div class='table-responsive'>
                <table class='table table-hover'>
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Titulo</th>
                            <th>Tipo</th>
                            <th>Cementerio</th>
                            <th>Parcela</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar-->
    <div class="modal fade" id="eliminarMd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?php echo $server; ?>/tituloActions" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cancelar Titulo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-auto">
                        <p>Esta seguro que desea ELiminar el titulo a nombre de: <h4 style="text-align:center" id="numeroTitulo"></h4>
                        </p>
                        <div form-group>
                            <label>Observaciones:</label>
                            <textarea class="form-control" id="observa" name="Observaciones"></textarea>
                            <input type="hidden" id="idTitulo" name="idTitulo" value="">
                            <input type="hidden" id="actionId" name="actionId" value="3">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Reponer-->
    <div class="modal fade" id="reponerMd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?php echo $server; ?>/tituloActions" method="post">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reporner Titulo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="Titulo">Nuevo Numero Titulo:</label>
                            <input class="form-control" type="text" name="numeroTitulo" required>
                            <input type="hidden" name="idTitulo" id="idTitulo2" value="">
                            <input type="hidden" name="actionId" value="8">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-info">Reponer</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <!--END-->
    <script>
        selTitulo = function(NumeroTitulo, idTitulo, Observaciones) {
            document.getElementById('observa').value = Observaciones;
            document.getElementById('numeroTitulo').innerHTML = NumeroTitulo;
            id = document.getElementById("idTitulo");
            id.value = idTitulo;
        };
        reponerTitulo = function(idTitulo2) {
            id2 = document.getElementById("idTitulo2");
            id2.value = idTitulo2;
        }
    </script>
    <!--END-->


    <?php require_once('Views/default/footer.php'); ?>


    <script type="text/javascript">
        function buscar_titulo(valor) {
            $.ajax({
                    url: '<?php echo $server; ?>/tituloActions/',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        actv: 2,
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