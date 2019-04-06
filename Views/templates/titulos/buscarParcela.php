<?php 
$insert = new ConexionDB();

$salida= "";

if(isset($_POST['consulta'])){
    $q = ($_POST['consulta']);
    $query = "SELECT t1.idParcela, t1.Estado, t1.Numero, t1.Poligono, t2.Descripcion, t3.Nombre FROM Parcelas t1 INNER JOIN TipoParcela t2 ON t1.idTipoParcela = t2.idTipoParcela INNER JOIN Cementerios t3 ON t1.idCementerio = t3.idCementerio WHERE t1.Titulado=0 AND (t1.Numero LIKE '%{$q}%' OR t3.Nombre LIKE '%{$q}%' OR t1.Poligono LIKE '%{$q}%')";
}
@$resultado = $insert->query($query);

if($resultado != -1){
    $salida.="<div class='table-responsive'>
                            <table class='table'>
                            <thead>
                                <tr>
                                    <th>Sel</th>
                                    <th>Parcela</th>
                                    <th>Tipo</th>
                                    <th>Cementerio</th>
                                    <th>Poligono</th>
                                    <th>Coord X</th>
                                    <th>Coord Y</th>
                                </tr>
                            </thead>
                            <tbody>";
    
   foreach ($resultado as $fila) {
       
        $salida.="<tr>                          
                    <div class=\"form-check\">
                        <td>
                            <input class=\"form-check-input mx-auto\" type=\"radio\" name=\"idParcela\" id=\"exampleRadios1\" value=\"{$fila['idParcela']}\">
                        </td>
                        <td>{$fila['Numero']}</td>
                        <td>{$fila['Descripcion']}</td>
                        <td>{$fila['Nombre']}</td>
                        <td>{$fila['Poligono']}</td>
                        <td>--</td>
                        <td>--</td>
                                            
                    </div>
                </tr>";
       
    }
        
    $salida.="</tbody></table>";
    
} else {
    $salida.="No hay resultados";
        
}

echo $salida;
































?>