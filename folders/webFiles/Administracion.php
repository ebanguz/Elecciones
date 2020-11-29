<?php

require_once '../layouts/layout.php';
require_once '../JsonHandler/JsonFileHandler.php';
require_once '../databaseHandler/databaseMethods.php';
require_once '../objects/Puestos.php';

session_start();

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: loginAdministracion.php');
}

$layout = new Layout(true, 'Administración', false);
$data = new DataBaseMethods('../databaseHandler');
$puestos = $data->getPuestosActivos();

?>

<?php $layout->Header(); ?>

<div class="row">
    <div class="col-md-2"><a class="btn btn-danger" href="agregarPuesto.php">Agregar puesto electivo</a></div>
    <div class="col-md-2"></div>
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
</div>
<br>
<br>
<br>
<br>
<div class="row">
    <div class="col-md-2"></div>
    <?php if ($puestos == "" || $puestos == null) : ?>
        <div class="col-md-4">
            <h2 style='color: #FFFFFF;'>No hay puestos electivos disponibles.</h2><a class="nav-link active btn btn-danger" href="agregarPuesto.php">Agregar puesto electivo</a>
        </div>

    <?php else : ?>
        <?php foreach ($puestos as $post) : ?>
            <div class="col-md-2">
                <a class='nav-link active btn btn-danger' href="PuestoAdministracion.php?id_puesto=<?= $post->id_puesto; ?>"><?= $post->nombre; ?></a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php $layout->Footer(); ?>