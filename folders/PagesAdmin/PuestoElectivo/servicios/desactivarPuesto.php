<?php 

require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../databaseHandler/databaseMethods.php';

session_start();

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: loginAdministracion.php');
}

$data = new DataBaseMethods('../../../databaseHandler');

if(isset($_GET['id_puesto'])) {

    $idPuesto = $_GET['id_puesto'];

    $data->DeshabilitarPuesto($idPuesto);

    header('Location: ../../Login/vista/Administracion.php');
}

?>