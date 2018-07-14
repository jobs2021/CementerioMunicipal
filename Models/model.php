<?php

class enlacesPaginas{

    public $links = array('inicio','registrar','titulos','creartitulo');

    public function enlacesPaginasModel($enlacesModel){

        if ($this->links[2]==$enlacesModel) {
            $module = "Views/templates/titulos/".$enlacesModel.".php";
    
        }elseif ($this->links[3]==$enlacesModel) {
            $module = "Views/templates/titulos/".$enlacesModel.".php";
    
        }
         elseif (in_array($enlacesModel,$this->links)) {
            $module = "Views/templates/inicio.php";
        }

        return $module;
    }
}


?>
