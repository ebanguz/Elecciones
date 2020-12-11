<?php

require_once 'folders\layouts\layout.php';
require_once 'folders\helpers\FileHandler\JsonFileHandler.php';
require_once 'folders\databaseHandler\databaseConnection.php';
require_once 'folders\iDataBase\IDatabase.php';
require_once 'folders\PagesAdmin\PuestoElectivo\servicios\PuestosHandler.php';
require_once 'folders\PagesAdmin\Elecciones\servicios\EleccionesHandler.php';
require_once 'folders\objects\Puestos.php';
require_once 'folders\objects\EleccionesAuditoria.php';

session_start();

if (!isset($_SESSION['elecciones'])) {

    echo '<script>alert("No hay elecciones activas");</script>';
}

if (isset($_SESSION['administracion'])) {

    header('Location: folders/PagesAdmin/Login/vista/Administracion.php');
}

if (isset($_SESSION['elecciones']) && isset($_SESSION['ciudadano'])) {

    $currentElecciones = json_decode($_SESSION['elecciones']);
    $currentCiudadano = json_decode($_SESSION['ciudadano']);
} else {

    header('Location: folders\VistaElector\login\vista\login.php');
}

$layout = new Layout(false, 'Puesto Electivo', true);
$dataPuestos = new PuestosHandler('folders/databaseHandler');
$filterPuestos = new EleccionesHandler('folders/databaseHandler');
$puestosParciales = $dataPuestos->getAll();
$puestos = $filterPuestos->FilterPuesto($currentCiudadano->cedula,$currentElecciones->id_elecciones,$puestosParciales);

?>

<?php $layout->Header(); ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-2"></div>
    <div class="col-md-8"></div>
</div>
<br>
<br>
<div class="row">
    <div class="col-md-2"></div>
    <?php if ($puestos == "" || $puestos == null) : ?>
        <div class="col-md-4">
            <h2>Ya votaste por los puestos disponibles.</h1>
        </div>

    <?php else : ?>
        <?php foreach ($puestos as $post) : ?>
            <div class="col-md-2">
                <div class="card" style="width: 14rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $post->nombre; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $post->descripcion; ?></h6>
                        <hr>
                        <a href="folders\VistaElector\login\vista\CandidatosVotacion.php?id_puesto=<?= $post->id_puesto; ?>" class="btn btn-danger">Ver candidatos</a>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php $layout->Footer(); ?>