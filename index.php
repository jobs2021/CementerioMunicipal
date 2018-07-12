<?php

$serverUrl='http://www.localhost';

require_once "Controllers/controller.php";
require_once "Models/model.php";

$mvc = new MvcController();
$mvc -> enlacesPaginasController();


?>