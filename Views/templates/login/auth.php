<?php

$user = $_POST['user'];
$password = $_POST['password'];

$consulta = new ConexionDB();    
$resultado= $consulta->Query("select * from Usuarios where NombreUsuario='{$user}' and Password='{$password}'");

if ($resultado!=-1) {
	setcookie('user_session',"{ \"user\" : \"{$resultado[0]['NombreUsuario']}\",\"rol\" : \"{$resultado[0]['Rol']}\" }",time()+60*60*12,'/');
	header("location:{$server}/inicio/");
    exit();
}else{
	header("location:{$server}/login/");
    exit();
}


?>