<?php

class enlacesPaginas{
    public function enlacesPaginasModel($enlacesModel){
        if ($enlacesModel=="registrar"||
            $enlacesModel=="inicio"||
            $enlacesModel=="usuarios") {
        
            $module = "views/templates/".$enlacesModel.".php";
        } elseif ($enlacesModel=="index"){
            $module = "views/templates/registrar.php";
        } elseif ($enlacesModel=="salir"){
            $module = "views/templates/inicio.php";
        } else {
            $module = "views/templates/registrar.php";
        }
        
        return $module;
    }
}


?>
