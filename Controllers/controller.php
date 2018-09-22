<?php

class MvcController{

<<<<<<< HEAD
// HEAD
    #public $serverUrl='http://10.42.0.1';
    #public $serverUrl='http://localhost/CementerioMunicipal';
    #public $serverUrl='http://192.168.0.90/CementerioMunicipal';
//=======
    #public $serverUrl='http://192.168.1.19';
    #public $serverUrl='http://localhost';
    #public $serverUrl='http://localhost/CementerioMunicipal';
//    //public $serverUrl='http://cementerio.eshost.com.ar';
=======
    public $serverUrl='http://192.168.43.39';
    //public $serverUrl='http://localhost';
    //public $serverUrl='http://localhost/CementerioMunicipal';

    //public $serverUrl='http://localhost/CementerioMunicipal';
    //public $serverUrl='http://192.168.1.18/CementerioMunicipal';

    //public $serverUrl='http://cementerio.eshost.com.ar';
>>>>>>> 47ffe172db739dd2c954a11d8c528a0091f685f2

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
