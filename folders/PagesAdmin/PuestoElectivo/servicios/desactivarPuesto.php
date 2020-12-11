<?php 

require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../databaseHandler/databaseConnection.php';
require_once '../../../iDataBase/IDatabase.php';
require_once '../../PuestoElectivo/servicios/PuestosHandler.php';

session_start();

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: loginAdministracion.php');
}

$data = new PuestosHandler('../../../databaseHandler');

if(isset($_GET['id_puesto'])) {

    $idPuesto = $_GET['id_puesto'];

    $data->Deshabilitar($idPuesto);

    header('Location: ../vistas/PuestoElectivo.php');
}

?>