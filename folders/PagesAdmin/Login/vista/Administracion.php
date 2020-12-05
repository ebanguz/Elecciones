<?php

require_once '../../../layouts/layout.php';
require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../servicios/AdministrationHandler.php';
require_once '../../../iDataBase/IDatabase.php';
require_once '../../PuestoElectivo/servicios/PuestosHandler.php';
require_once '../../../objects/Puestos.php';

session_start();

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
    <div class="col-md-2"><a class="btn btn-danger" href="../../PuestoElectivo/vistas/agregarPuesto.php">Agregar puesto electivo</a></div>
    <div class="col-md-2"><a class="btn btn-danger" href="../../PuestoElectivo/vistas/activarPuesto.php">Activar puestos</a></div>
    <div class="col-md-2"><a class="btn btn-danger" href="../../Partidos/vistas/agregarPartido.php">Agregar partido político</a></div>
    <div class="col-md-2"><a class="btn btn-danger" href="../../Partidos/vistas/agregarPartido.php">Ver partidos políticos</a></div>
    <div class="col-md-2"><a class="btn btn-danger" href="../../Candidatos/vistas/agregarCandidato.php">Agregar candidato</a></div>
    <div class="col-md-2"><a class="btn btn-danger" href="../../Candidatos/vistas/agregarCandidato.php">Ver candidatos</a></div>
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
                <div class="card" style="width: 14rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $post->nombre; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $post->descripcion; ?></h6>
                        <hr>
                        <a href="../../PuestoElectivo/vistas/PuestoAdministracion.php?id_puesto=<?= $post->id_puesto; ?>" class="btn btn-danger">Ver candidatos</a>
                        <br>
                        <br>
                        <a href="../../PuestoElectivo/vistas/modificarPuesto.php?id_puesto=<?= $post->id_puesto; ?>" class="btn btn-danger">Modificar</a>
                        <br>
                        <br>
                        <a href="../../PuestoElectivo/servicios/desactivarPuesto.php?id_puesto=<?= $post->id_puesto; ?>" class="btn btn-danger">Desactivar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php $layout->Footer(); ?>