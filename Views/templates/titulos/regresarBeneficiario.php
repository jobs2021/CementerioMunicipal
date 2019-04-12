<?php
regresarBeneficiario($_POST['idBeneficiario'],$_POST['idTitulo']);


    function regresarBeneficiario($idBeneficiario, $idTitulo){
        if (isset($idBeneficiario) && isset($idTitulo)){
            $insert = new ConexionDB();
            $insert->Query("UPDATE Beneficiarios SET Estado=1 where idBeneficiario={$idBeneficiario}");
            header("location:".$server.'/beneficiarios/'.$idTitulo);
        }
    }
    
    
?>