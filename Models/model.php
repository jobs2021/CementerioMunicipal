<?php

class enlacesPaginas{

    public $links = array('inicio','registrar','titulos','creartitulo','repotrastitulo', 'vertitulo', 'eyetitulo');

    public function enlacesPaginasModel($enlacesModel){

        if ($this->links[2]==$enlacesModel) {
            $module = "Views/templates/titulos/".$enlacesModel.".php";
    
        }elseif ($this->links[3]==$enlacesModel) {
            $module = "Views/templates/titulos/".$enlacesModel.".php";
    
        }elseif ($this->links[4]==$enlacesModel) {
            $module = "Views/templates/titulos/".$enlacesModel.".php";

        }elseif ($this->links[5]==$enlacesModel) {
            $module = "Views/templates/titulos/".$enlacesModel.".php";

        }elseif ($this->links[6]==$enlacesModel) {
            $module = "Views/templates/titulos/".$enlacesModel.".php";

        }else {
            $module = "Views/templates/inicio.php";
        }

        return $module;
    }
}


?>
