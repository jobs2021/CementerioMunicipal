<?php

class MvcController{

    public function enlacesPaginasController(){
        
        if (isset($_GET['action'])) {
            $enlacesController = $_GET['action'];

        } else {
        
            $enlacesController = "inicio";
        }

        $enlace= new enlacesPaginas();
        $resultado=$enlace -> enlacesPaginasModel($enlacesController);
        include($resultado);

    }
}

?>