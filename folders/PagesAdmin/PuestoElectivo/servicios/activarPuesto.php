<?php

require_once '../../../layouts/layout.php';
require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../databaseHandler/databaseConnection.php';
require_once '../../../iDataBase/IDatabase.php';
require_once '../../PuestoElectivo/servicios/PuestosHandler.php';
require_once '../../../objects/Puestos.php';

session_start();

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: ../../Login/vista/loginAdministracion.php');
}

$data = new PuestosHandler('../../../databaseHandler');

if(isset($_GET['id_puesto'])) {

    $idPuesto = $_GET['id_puesto'];

    $data->Habilitar($idPuesto);

    header('Location: ../vistas/PuestoElectivo.php');
}

?>