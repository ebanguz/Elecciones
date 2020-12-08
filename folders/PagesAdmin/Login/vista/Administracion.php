<?php

require_once '../../../layouts/layout.php';
require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../servicios/AdministrationHandler.php';
require_once '../../../iDataBase/IDatabase.php';
require_once '../../PuestoElectivo/servicios/PuestosHandler.php';
require_once '../../../objects/Puestos.php';

session_start();

if(isset($_SESSION['ciudadano'])) {
    header('Location: ../../../../index.php');
}

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: loginAdministracion.php');
}

$layout = new Layout(true, 'Administración', false);
$data = new AdministrationHandler('../../../databaseHandler');
$dataPuestos = new PuestosHandler('../../../databaseHandler');
$puestos = $dataPuestos->getActive();

?>

<?php $layout->Header(); ?>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <h1>Pendiente agregar algo acá.</h1>
    </div>
    <div class="col-md-4"></div>
</div>

<?php $layout->Footer(); ?>