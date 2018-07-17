<?php

class MvcController{

    public $serverUrl='http://localhost';

    public function enlacesPaginasController(){

        
        if (isset($_GET['action'])) {
            $enlacesController = $_GET['action'];
            $enlacesController=explode('/', $enlacesController);

        } else {
        
            $enlacesController[0] = "inicio";
        }

        $server=$this->serverUrl;

        $enlace= new enlacesPaginas();
        $resultado=$enlace -> enlacesPaginasModel($enlacesController[0]);

        if ($resultado=="Views/templates/404.php") {
            header("location:".$server);
            exit();
        }


        include($resultado);


    }
}

?>