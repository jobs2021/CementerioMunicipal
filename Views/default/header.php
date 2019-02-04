<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $server;?>/Views/static/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $server;?>/Views/static/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $server;?>/Views/static/assets/favicon/favicon-16x16.png">
    <title>
        <?php echo $titulo; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $server;?>/Views/static/css/bootstrap.min.css" />
    <link href="<?php echo $server;?>/Views/static/vendor/font-awesome/css/all.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?php echo $server;?>/Views/static/vendor/chalate-icon/icon-chalate.css">

    <!-- estilos css-->
    <style type="text/css">


.fixed-action-btn {
    position: fixed;
    z-index: 998;
    right: 10px;
    bottom: 10px;
    margin-bottom: 0;
}
.btn-floating.btn-lg {
    width: 61.1px;
    height: 61.1px;
    border-radius: 100%;
    line-height: 50px;
    text-align: center;
}

.btn-floating {
    -webkit-box-shadow: 0 5px 11px 0 rgba(0,0,0,.18), 0 4px 15px 0 rgba(0,0,0,.15);
    box-shadow: 0 5px 11px 0 rgba(0,0,0,.18), 0 4px 15px 0 rgba(0,0,0,.15);
    width: 47px;
    height: 47px;
    position: relative;
    z-index: 1;
    vertical-align: middle;
    display: inline-block;
    overflow: hidden;
    -webkit-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    transition: all .2s ease-in-out;
    margin: 10px;
    -webkit-border-radius: 50%;
    border-radius: 50%;
    padding: 0;
    cursor: pointer;
}

.btn-group-lg>.btn, .btn-lg {
    padding: .5rem 1rem;
    font-size: 1.25rem;
    line-height: 1.5;
    border-radius: .3rem;
}
    /* csss */








.bs-switch {
  position: relative;
  display: inline-block;
  width: 45px;
  height: 25.4px; }
  .bs-switch input {
    display: none; }
    .bs-switch input:checked + .slider {
      background-color: #2196F3; }
      .bs-switch input:checked + .slider:before {
        -webkit-transform: translateX(19.5px);
        -ms-transform: translateX(19.5px);
        transform: translateX(19.5px); }
    .bs-switch input:focus + .slider {
      -webkit-box-shadow: 0 0 1px #2196F3;
      box-shadow: 0 0 1px #2196F3; }
  .bs-switch .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    -o-transition: .4s;
    transition: .4s; }
    .bs-switch .slider:before {
      position: absolute;
      content: "";
      height:19.5px;
      width:19.5px;
      left: 3px;
      bottom: 3px;
      background-color: white;
      -webkit-transition: .4s;
      -o-transition: .4s;
      transition: .4s; }
    .bs-switch .slider.round {
      -webkit-border-radius: 25.4px;
      border-radius: 25.4px; }
      .bs-switch .slider.round:before {
        -webkit-border-radius: 50%;
        border-radius: 50%; }


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
    .margin-left-0{
        margin-left: 0!important;
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
        text-align: right!important;
    }

    .icon {
        font-size: 1.2rem;
        margin-left: 5px;
    }
    .margin-right-5{
        margin-right: 5px;
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
    .bg-principal{
    background-color: #373737 !important; /*373737*/
    }
    nav .dropdown-item:active{
    background-color: #373737!important;
    }
    .dropdown-item:active{
    color: #fff!important;
    }
    .breadcrumb{
        background-color: rgba(210, 213, 216, .3)!important;
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
     <link rel="stylesheet" href="<?php echo $server;?>/Views/static/css/table-style.css">
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-principal">
        <a class="navbar-brand" href="<?php echo $server;?>/"><i class="icon-chalate" style="font-size: 2em!important;float: left;position: absolute;top: 10px;"></i> <span style="margin-left: 45px">Municipalidad</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $server;?>/"><i class="fas fa-home icon margin-right-5"></i>Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $server;?>/cementerios"><i class="fas fa-church icon margin-right-5"></i>Cementerios</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-skull icon margin-right-5"></i>Inhumaciones</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo $server;?>/inhumacion">Inhumacion</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo $server;?>/exhumacion">Exhumacion</a>
                         <a class="dropdown-item" href="<?php echo $server;?>/traslado">Traslado</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-file-alt icon margin-right-5"></i>Titulos & Arrendamientos</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <a class="dropdown-item" href="<?php echo $server;?>/titulos">Titulos</a>
                        <a class="dropdown-item" href="<?php echo $server;?>/repotrastitulo">Operaciones a Titulo</a>
                        <a class="dropdown-item" href="<?php echo $server;?>/arrendamientos">Arrendamientos</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo $server;?>/creartitulo">Nuevo Titulo</a>
                        
                    </div>
                </li>
                
                
            </ul>
            <ul class="navbar-nav padding-left-0 mr-sm-4">
            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-users-cog margin-right-5"></i>Configurar</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <a class="dropdown-item" href="<?php echo $server;?>/configurar">Configuraciones</a>
                       
                       

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" style="color:#FF4500" href="<?php echo $server;?>/desconectar">Desconectar</a>
                    </div>
                </li>
            </ul>
            

            
            <!--form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form -->
        </div>
    </nav>
</header>

<body>
