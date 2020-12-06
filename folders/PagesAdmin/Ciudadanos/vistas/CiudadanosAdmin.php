<?php

require_once '../../../layouts/layout.php';
require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../iDataBase/IDatabase.php';
require_once '../../Ciudadanos/servicios/CiudadanosHandler.php';
require_once '../../../objects/Ciudadanos.php';

session_start();

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: ../../Login/vista/loginAdministracion.php');
}

$layout = new Layout(true, 'Ciudadano', false);
$dataCiudadanos = new CiudadanosHandler('../../../databaseHandler');
$puestosCiudadanos = $dataCiudadanos->getAll();

?>

<?php $layout->Header(); ?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-2"><a class="btn btn-danger" href="agregarCiudadano.php">Agregar ciudadano</a></div>
    <div class="col-md-8"></div>
</div>
<br>
<br>
<div class="row">
    <div class="col-md-3"></div>
    <?php if ($puestosCiudadanos == "" || $puestosCiudadanos == null) : ?>
        <div class="col-md-4">
            <h2>No hay ciudadanos agregados.</h2>
        </div>

    <?php else : ?>
        <?php foreach ($puestosCiudadanos as $post) : ?>
            <div class="col-md-2">
                <div class="card" style="width: 14rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $post->nombre; ?>  <?= $post->apellido; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $post->cedula; ?><hr><br><?= $post->email; ?></h6>
                        <hr>
                        <br>
                        <?php if ($post->estado == 1) : ?>
                            <a href="../servicios/desactivarCiudadano.php?cedula=<?= $post->cedula; ?>" class="btn btn-danger">Desactivar</a>
                        <?php else : ?>
                            <a href="../servicios/activarCiudadano.php?cedula=<?= $post->cedula; ?>" class="btn btn-dark">Activar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php $layout->Footer(); ?>