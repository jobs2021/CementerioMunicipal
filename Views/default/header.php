<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $titulo; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./Views/static/css/bootstrap.min.css" />  
    <!--evento hover de la etiqueta desconectar-->
    <style type="text/css">
        a{
          color: #A2A2A2  ;
        }
        a:Desconectar{
          text-decoration: none;
          color: #C14412;
        }
        a:hover{
        text-decoration: none;
        color: #FFFFFF  ;
       
        }
        
    </style>
</head>
<header>
<nav style="background-color: #C16F4E !important;" class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Municipalidad</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="inicio">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Cementerios</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Titulos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="titulos">Titulos</a>

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="creartitulo">Crear Titulos</a>
        </div>
      </li>
     
    </ul>

        <a class="btn" href="#">Desconectar</a>
 
    <!--form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form-->
  </div>
</nav>
</header>
<body>
