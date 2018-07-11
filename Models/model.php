<?php

class enlacesPaginas{

    public $links = array('inicio','registrar','creartitulo');

    public function enlacesPaginasModel($enlacesModel){

        if (in_array($enlacesModel,$this->links)) {
            $module = "Views/templates/".$enlacesModel.".php";
    
        } else {
            $module = "Views/templates/inicio.php";
        }

        return $module;
    }
}


?>
