<?php

class MvcController{
    public function plantilla(){
        include "../views/default/base.php";
    }
    public function enlacesPaginasController(){
        
        if (isset($_GET['action'])) {
            $enlacesController = $_GET['action'];
        } else {
            
            $enlacesController = "inicio";
        }
        
        
        

        $respuesta = enlacesPaginas::enlacesPaginasModel($enlacesController);

        include ($respuesta);
    }
}

?>