<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php echo $titulo; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./Views/static/css/bootstrap.min.css" />
    <link href="./Views/static/vendor/font-awesome/css/all.css" rel="stylesheet" type="text/css">
    <!-- estilos css-->
    <style type="text/css">
    /* Estilos del boton desconectar by Live

    a {
        color: ROYALBLUE;
    }

    a[id="Desconectar"] {
        text-decoration: none;
        color: #C14412;
    }

    a:hover {
        text-decoration: none;
        color: #FFFFFF;
    }

    #crear {
        margin: 10px 10px;
    }
    /*------------------------------------------*/
    .padding-left-0{
        padding-left: 0;
    }
    .margin-top-15 {
        margin-top: 15px;
    }

    .padding-bottom-15 {
        padding-bottom: 15px;
    }

    .padding-top-15 {
        padding-top: 15px;
    }

    .btn-nuevo-cementerio {
        border-style: dotted;
        border-width: 2px;
    }

    .margin-l-r-15 {
        margin-left: -15px;
        margin-right: -15px;
    }

    .padding-l-r-0 {
        padding-left: 0px;
        padding-right: 0px;
    }

    .margin-bottom-0 {
        margin-bottom: 0px;
    }

    .padding-0 {
        padding: 0px;
    }

    .hidden {
        visibility: hidden;
    }

    .text-right {
        text-align: right;
    }

    .icon {
        font-size: 1.2rem;
        margin-left: 5px;
    }
    /* mostar acciones de row */

    .row-btn {
        visibility: hidden;
    }

    .row-hover:hover .row-btn {
        visibility: visible;
    }
    .nav-link{
        color: rgba(255,255,255,.5);
    }
  .nav-link:hover{
        color: rgba(255,255,255,.75);
    }
    /* estilos personalizados solamente de prueba para los nichos

.btn-hover0 {
    fill: #007bff;
}
.btn-hover1,.btn-hover2{
    fill: #39A54A;
}
.text-hover0,.text-hover1,.text-hover2 {
    fill: #fff;
}
.btn-hover3{
     visibility: hidden;
}
.text-hover3{
   visibility: hidden;
}

end estilos personalizados*/
    </style>
     <link rel="stylesheet" href="./Views/static/css/table-style.css">
</head>
<header>
    <nav style="background-color: #C16F4E !important;" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="./">Municipalidad</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./cementerios">Cementerios</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Inhumaciones</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./historialinhumaciones">Historial Inhumaciones</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="./registrarinhumacion">Registrar Inhumación</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Titulos</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <a class="dropdown-item" href="./titulos">Titulos</a>
                        <a class="dropdown-item" href="./repotrastitulo">Operaciones a Titulo</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="./creartitulo">Crear Titulo</a>
                    </div>
                </li>
                
                
            </ul>
            <a class="nav-link padding-left-0" href="#">Desconectar</a>
            
            <!--form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form -->
        </div>
    </nav>
</header>

<body> 
