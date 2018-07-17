<?php
// enlaces

class enlacesPaginas{

<<<<<<< HEAD
    public $links = array('inicio',array('cementerios','admincementerio','parcelas','verparcela'),array('titulos','creartitulo','repotrastitulo', 'vertitulo', 'eyetitulo'),'desconectar');

    public function enlacesPaginasModel($enlacesModel){

        if (in_array($enlacesModel,$this->links[1]) and isset($enlacesModel)) {
            $module = "Views/templates/cementerios/".$enlacesModel.".php";

        }elseif (in_array($enlacesModel,$this->links[2]) and isset($enlacesModel)) {
            $module = "Views/templates/titulos/".$enlacesModel.".php";

        }elseif (in_array($enlacesModel,$this->links) and isset($enlacesModel)) {
            $module = "Views/templates/".$enlacesModel.".php";

            if (!file($module)) {
            $module = "Views/templates/404.php";
            }
    
        } else {
            $module = "Views/templates/404.php";
=======
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
>>>>>>> ad54a052f95e5277a481d4e3dd51b4f37b0e5567
        }

        return $module;
    }
}




?>
