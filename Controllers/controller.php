<?php

class MvcController{
// HEAD
    public $serverUrl='http://192.168.1.39';
    #public $serverUrl='http://192.168.1.4';
    #public $serverUrl='http://localhost/CementerioMunicipal';
    #public $serverUrl='http://192.168.0.90/CementerioMunicipal';
//=======
    #public $serverUrl='http://192.168.1.19';
    #public $serverUrl='http://localhost';
    #public $serverUrl='http://192.168.1.4';
//    //public $serverUrl='http://cementerio.eshost.com.ar';


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
