<?php

require_once '../../../layouts/layout.php';
require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../iDataBase/IDatabase.php';
require_once 'PartidosHandler.php';
require_once '../../../objects/Puestos.php';

session_start();

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: ../../Login/vista/loginAdministracion.php');
}

$data = new PartidosHandler('../../../databaseHandler');

if(isset($_GET['id_partido'])) {

    $idPartido = $_GET['id_partido'];

    $data->Habilitar($idPartido);

    header('Location: ../vistas/PartidoAdministracion.php');
}

?>