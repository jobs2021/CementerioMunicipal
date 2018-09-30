<?php
// enlaces

class enlacesPaginas{

    public $links = array('inicio',array('cementerios','admincementerio','parcelas','verparcela'),array('titulos','creartitulo','repotrastitulo', 'finalizartitulo', 'eyetitulo', 'arrendamientos', 'repotitulo'),array('inhumacion','exhumacion','traslado'), array('configurar'),'desconectar');

    public function enlacesPaginasModel($enlacesModel){

        if (in_array($enlacesModel,$this->links[1]) and isset($enlacesModel)) {
            $module = "Views/templates/cementerios/".$enlacesModel.".php";

        }elseif (in_array($enlacesModel,$this->links[2]) and isset($enlacesModel)) {
            $module = "Views/templates/titulos/".$enlacesModel.".php";

        }elseif (in_array($enlacesModel,$this->links[3]) and isset($enlacesModel)) {
            $module = "Views/templates/inhumaciones/".$enlacesModel.".php";

        }elseif (in_array($enlacesModel,$this->links[4]) and isset($enlacesModel)) {
            $module = "Views/templates/configuraciones/".$enlacesModel.".php";

            if (!file($module)) {
            $module = "Views/templates/404.php";
            }
    
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

/**
* 
*/
class Cementerio{
    public $Nombre;
    public $Direccion;
    public $Area;
    public $Legalidad;
    public $Panteonero;
    public $Tipo;
    
    function __construct($_array) //$_nombre,$_direccion,$_area,$_legalidad,$_panteonero,$_tipo,
    {
        if (isset($_array)) {
        $this->Nombre=$_array['Nombre'];
        $this->Direccion=$_array['Direccion'];
        $this->Area=$_array['Area'];
        $this->Legalidad=$_array['Legalizado'];
        $this->Panteonero=$_array['Panteonero'];
        $this->Tipo=$_array['Tipo'];
        }else{
            $this->Nombre=$_nombre;
            $this->Direccion=$_direccion;
            $this->Area=$_area;
            $this->Legalidad=$_legalidad;
            $this->Panteonero=$_panteonero;
            $this->Tipo=$_tipo;
            
        }
    }
}

class ConexionDB{
    private  $Server="192.168.43.39";
    private  $User="root_";
    private  $Password="cementerio123";
    private  $DataBaseName="cementerio";


    function Query($query){
        $conexion = mysqli_connect($this->Server,$this->User,$this->Password) or die("no se pudo conectar");
        mysqli_select_db($conexion,$this->DataBaseName) or die("no se puede seleccionar la base");
        mysqli_query($conexion,"SET NAMES 'UTF8'");
        $result=mysqli_query($conexion,$query) or die("no se pueded ejecuatar la consulta");
        $datos=array();
        while ($dato=mysqli_fetch_assoc($result)){
            array_push($datos, $dato);
        }
        mysqli_close($conexion);

        if (empty($datos)) {
            return -1;
        }
        return $datos;

    }

}


?>
