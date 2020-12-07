<?php

require_once '../../../layouts/layout.php';
require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../iDataBase/IDatabase.php';
require_once '../servicios/PartidosHandler.php';
require_once '../../../objects/Partidos.php';

session_start();

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: ../../Login/vista/loginAdministracion.php');
}

$layout = new Layout(true, 'Partidos Políticos', false);
$dataPartidos = new PartidosHandler('../../../databaseHandler');
$partidosCharge = $dataPartidos->getAll();

?>

<?php $layout->Header(); ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-2"><a class="btn btn-danger" href="agregarPartido.php">Agregar partido</a></div>
    <div class="col-md-8"></div>
</div>
<br>
<br>
<div class="row">
    <div class="col-md-2"></div>
    <?php if ($partidosCharge == "" || $partidosCharge == null) : ?>
        <div class="col-md-4">
            <h2>No hay puestos agregados.</h1>
        </div>

    <?php else : ?>
        <?php foreach ($partidosCharge as $post) : ?>
            <div class="col-md-3">

                <div class="card" style="width: 18rem;">
                    <img src="../../../assets/images/partidos/<?= $post->logo; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $post->nombre; ?></h5>
                        <p class="card-text"><?= $post->descripcion; ?></p>
                        <hr>
                        <a href="modificarPartido.php?id_partido=<?= $post->id_partido; ?>" class="btn btn-secondary">Modificar</a>
                        <hr>
                        <?php if ($post->estado == 1) : ?>
                            <a href="../servicios/desactivarPartido.php?id_partido=<?= $post->id_partido; ?>" class="btn btn-danger">Desactivar</a>
                        <?php else : ?>
                            <a href="../servicios/activarPartido.php?id_partido=<?= $post->id_partido; ?>" class="btn btn-dark">Activar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php $layout->Footer(); ?>