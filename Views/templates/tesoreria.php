<?php
//session para enviar notificacion
session_start();


$titulo = 'Tesoreria';

$query = "SELECT t1.idTitulo, t1.NumeroTitulo, t1.Proceso, t1.Observaciones, t3.Tipo, t4.NombresCiudadano, 
                t4.ApellidosCiudadano, t2.Numero, t5.Nombre, t1.Estado FROM Titulos t1 INNER JOIN Parcelas t2 
                ON t1.idParcela=t2.idParcela INNER JOIN TipoTitulos t3 ON t1.idTipoTitulo=t3.idTipoTitulo INNER JOIN 
                Ciudadanos t4 ON t1.idCiudadanoTitular=t4.idCiudadano INNER JOIN Cementerios t5 ON 
                t2.idCementerio=t5.idCementerio WHERE t1.Estado=1 
                ORDER BY t1.idTitulo DESC ";
$consulta = new ConexionDB();
$TitulosCount = $consulta->Query("SELECT COUNT(*) FROM Titulos WHERE Proceso=0");
$CementeriosCount = 12;
$ArrendamientosCount = 0;
$OperacionesCount = 9;
$Titulos = $consulta->Query($query);

require_once('Views/default/header.php');
?>

<!--suppress CssInvalidFunction -->
<style>
    .pointer{
        cursor: pointer;
    }
    .dataTables_filter {
        display: block;
    }

    .header {
        display: flex;
        margin: 0;
        height: 55px;
        background: white;
        width: 100%;
        color: #4285F4;
    }

    .activo {
        border-bottom: 2.5px solid #4285F4;
        background: rgb(22, 22, 22, 0.05);
    }

    .pad {
        padding-top: 10px;
        margin-left: -115px;
        width: 100%;
    }

    .grr:hover {
        background: rgb(22, 22, 22, 0.05);
        cursor: pointer;
    }

    .span {
        color: white;
        background: rgb(210, 0, 0, .8);
        border-radius: 50%;
        font-size: .7rem;
        display: inline-block;
        width: 20px;
        height: 20px;
        font-weight: 700;
        margin-left: -113px;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: .1rem .22rem;
        line-height: 1.2;
    }

</style>
<div class="container-fluid">
    <div class="row">
        <div class="header">

            <div class="text-center col-12 col-sm-6 col-lg-3 grr">
                <a class="btn pad" href="#">RECEPCION</a><div id="cont" class="span"></div>
            </div>
            <div class="text-center col-12 col-sm-6 col-lg-3 activo grr">
                <a class="btn pad">RECIBIDOS</a>
            </div>
            <div class="text-center col-12 col-sm-6 col-lg-3 grr">
                <a class="btn pad">OBSERVADOS</a>
            </div>
            <div class="text-center col-12 col-sm-6 col-lg-3 grr">
                <a class="btn pad">APROBADOS</a>
            </div>
        </div>

        <div class="col-12">
            <h1 style="text-align: center">Titulos en proceso</h1>
            <h4 align="center">Toca un registro para realizar operaciones</h4>
            <div id="Prueba"></div>
            <div class="table-responsive">
                <table class="table table-hover mt-4">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Titulo</th>
                        <th class="col-3">Tipo</th>
                        <th>Parcela</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php require_once('Views/default/footer.php'); ?>

<script type="text/javascript">
    $(document).ready(function () {

        const socket = io('<?php echo $server;?>:8585');
        var audio = document.getElementById("NotificationSound");


        function mi() {
            window.location.replace("<?php echo $server;?>/eyetitulo");
            //alert("click");
        }

        socket.on('message', function (msj) {

            var mmsj = JSON.parse(msj);
            var data = JSON.parse(mmsj.msj);

            toastr.success(data['msg'], data['title'], {
                "onclick": mi,
                "positionClass": "toast-top-right",
                "closeButton": true,
                "newestOnTop": true,
                "timeOut": "0",
                "extendedTimeOut": "0"
            });
            audio.play();

        });

        socket.on('timeout', function () {
            console.log("se murio");
        });


    })
</script>

<script type="text/javascript">
    $(document).ready(function () {
        const socket = io('<?php echo $server;?>:8585');
        var table = $('table').DataTable(tableLanguage);


        socket.on('message', function (msj) {

            var mmsj = JSON.parse(msj);
            var data = JSON.parse(mmsj.msj);

            /* toastr.success(data['msg'],data['title'],{"onclick" :mi ,"positionClass": "toast-top-right","closeButton": true,"newestOnTop": true,"timeOut": "0","extendedTimeOut": "0"});
             audio.play();
             */
            recepcion();

        });

        socket.on('timeout', function () {
            console.log("se murio");
        });

        function formatSearching(data) {
            return ('<tr class="pointer" title="Ver registro">' +
                '<td>'+data.NombresCiudadano+'</td>' +
                '<td>'+data.ApellidosCiudadano+'</td>' +
                '<td>'+data.NumeroTitulo+'</td>' +
                '<td>'+data.Tipo+'</td>' +
                '<td>'+data.Numero+'</td>' +
                '</tr>')

        }

        function listaSearch(data) {
            var listado = '';
            data.forEach(function (element) {
                listado += formatSearching(element);
            });

            return listado;
        }

        function recepcion() {
            var dataSend = {actionId: "17", operacion: "1"};

            $.ajax({
                url: '<?php echo $server;?>/tituloActions/',
                data: dataSend,
                type: 'post',
                success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    //console.log(response);
                    if (response == 'Ningun registro previo' || response == '' || response == '-1') {
                        $('#div-ciudadano').html('<a class="dropdown-item">Sin Resultados</a>');

                    } else if (response != "") {
                        var resultado = JSON.parse(response);
                        toggleSpan(resultado.spop[0]['COUNT(*)']);
                        $('#tbody').html(listaSearch(resultado.data));

                    }
                }
            });
        }
        function toggleSpan(e){
            var spoper = $("#cont");
            console.log(e);
            if (e == 0 || e == '' ){
                spoper.removeClass('span');
                spoper.html("");
            } else{
                spoper.removeClass('span');
                spoper.addClass('span');
                spoper.html("<span>"+ e +"</span>");
            }

        }
        recepcion()
    });

</script>
