<?php
// enlaces

class enlacesPaginas{

    public $links = array('inicio',array('cementerios','admincementerio','parcelas','verparcela'),array('titulos','creartitulo','repotrastitulo', 'finalizartitulo', 'eyetitulo'),array('inhumacion','exhumacion','traslado'),'desconectar');

    public function enlacesPaginasModel($enlacesModel){

        if (in_array($enlacesModel,$this->links[1]) and isset($enlacesModel)) {
            $module = "Views/templates/cementerios/".$enlacesModel.".php";

        }elseif (in_array($enlacesModel,$this->links[2]) and isset($enlacesModel)) {
            $module = "Views/templates/titulos/".$enlacesModel.".php";

        }elseif (in_array($enlacesModel,$this->links[3]) and isset($enlacesModel)) {
            $module = "Views/templates/inhumaciones/".$enlacesModel.".php";

        }elseif (in_array($enlacesModel,$this->links) and isset($enlacesModel)) {
            $module = "Views/templates/".$enlacesModel.".php";

            if (!file($module)) {
            $module = "Views/templates/404.php";
            }
    
        } else {
            $module = "Views/templates/404.php";
        }

        return $module;
    }
}


?>
