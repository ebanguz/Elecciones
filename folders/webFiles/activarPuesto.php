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
$puestos = $data->getPuestosInactivos();

if(isset($_GET['id_puesto'])) {

    $idPuesto = $_GET['id_puesto'];

    $data->HabilitarPuesto($idPuesto);

    header('Location: activarPuesto.php');
}

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
            <h2 style='color: #FFFFFF;'>No hay puestos electivos inactivos.</h2><a class="nav-link active btn btn-danger" href="agregarPuesto.php">Agregar puesto electivo</a>
        </div>

    <?php else : ?>
        <?php foreach ($puestos as $post) : ?>
            <div class="col-md-2">
                <div class="card" style="width: 14rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $post->nombre; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $post->descripcion; ?></h6>
                        <hr>
                        <a href="PuestoAdministracion.php?id_puesto=<?= $post->id_puesto; ?>" class="btn btn-danger">Ver candidatos</a>
                        <br>
                        <br>
                        <a href="modificarPuesto.php?id_puesto=<?= $post->id_puesto; ?>" class="btn btn-danger">Modificar</a>
                        <br>
                        <br>
                        <a href="activarPuesto.php?id_puesto=<?= $post->id_puesto; ?>" class="btn btn-danger">Activar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php $layout->Footer(); ?>