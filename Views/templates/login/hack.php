<?php

$consulta = new ConexionDB();    
$resultado= $consulta->Query("INSERT INTO `cementerio`.`Usuarios` (`idUsuario`, `NombreUsuario`, `CorreoUsuario`, `Password`, `create_time`, `Rol`) VALUES ('1', 'root', 'root@cementerio.com', 'toor', '2019-02-04', '0');");

header("location:{$server}/login/");
exit();

?>