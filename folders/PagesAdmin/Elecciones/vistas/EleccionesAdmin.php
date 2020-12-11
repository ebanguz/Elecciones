<?php

require_once '../../../layouts/layout.php';
require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../iDataBase/IDatabase.php';
require_once '../servicios/EleccionesHandler.php';
require_once '../../../databaseHandler/databaseConnection.php';
require_once '../../Candidatos/servicios/CandidatosHandler.php';
require_once '../../Partidos/servicios/PartidosHandler.php';
require_once '../../PuestoElectivo/servicios/PuestosHandler.php';
require_once '../../../objects/Elecciones.php';
require_once '../../../objects/EleccionesAuditoria.php';
require_once '../../../objects/Candidatos.php';
require_once '../../../objects/Partidos.php';
require_once '../../../objects/Puestos.php';

session_start();

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: ../../Login/vista/loginAdministracion.php');
}

$layout = new Layout(true, 'Elecciones', false);
$data = new EleccionesHandler('../../../databaseHandler');
$dataCandidate = new CandidatosHandler('../../../databaseHandler');
$dataPartido = new PartidosHandler('../../../databaseHandler');
$dataPuesto = new PuestosHandler('../../../databaseHandler');
$eleccionesCharge = $data->getAll();
$interruptor = false;
$CandidatosCount = $dataCandidate->getActiveAll();
$PartidosCount = $dataPartido->getActive();
$PuestosCount = $dataPuesto->getActive();

if (count($CandidatosCount) > 2 && count($PartidosCount) > 2 && count($PuestosCount) > 0) {

    $interruptor = true;
}

?>

<?php $layout->Header(); ?>
<div class="row">
    <div class="col-md-3"></div>
    <?php if (isset($_SESSION['elecciones'])) : ?>
        <div class="col-md-2"><a class="btn btn-danger" href="../servicios/terminarElecciones.php">Terminar elecciones.</a></div>
    <?php elseif ($interruptor == true) : ?>
        <div class="col-md-2"><a class="btn btn-danger" href="iniciarElecciones.php">Iniciar elecciones.</a></div>
    <?php elseif ($interruptor == false) : ?>
        <h5>Debe tener al menos tres candidatos, partidos y un puesto activo para iniciar una elección.</h3>
    <?php endif; ?>
    <div class="col-md-8"></div>
</div>
<br>
<br>
<?php if ($eleccionesCharge == "" || $eleccionesCharge == null) : ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-4">
            <h2>No hay elecciones almacenadas.</h2>
        </div>
    </div>

<?php else : ?>
    <?php foreach ($eleccionesCharge as $eleccion) : ?>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <h3>Nombre: <?= $eleccion->nombre; ?></h3>
                <br>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Candidatos</th>
                            <th scope="col">Partidos</th>
                            <th scope="col">Puestos</th>
                            <th scope="col">Votos totales</th>
                            <th scope="col">Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $currentCandidateId = $data->getEleccionesCandidates($eleccion->id_elecciones); ?>
                        <?php foreach ($currentCandidateId as $candID) : ?>
                            <tr>
                                <?php $currentCandidate = $dataCandidate->getById($candID->id_candidato);
                                echo '<th scope="row">' . $currentCandidate->nombre . ' ' . $currentCandidate->apellido . '</th>';

                                ?>
                                <?php $currentPartidoId = $data->getEleccionesPartidos($eleccion->id_elecciones, $candID->id_candidato); ?>
                                <?php foreach ($currentPartidoId as $partID) : ?>

                                    <?php $currentPartido = $dataPartido->getById($partID->id_partido);
                                    echo '<td>' . $currentPartido->nombre . '</td>';

                                    ?>

                                    <?php $currentPuestoId = $data->getEleccionesPuestos($eleccion->id_elecciones, $candID->id_candidato); ?>
                                    <?php foreach ($currentPuestoId as $puestoId) : ?>
                                        <?php $currentPuesto = $dataPuesto->getById($puestoId->id_puesto);
                                        echo '<td>' . $currentPuesto->nombre . '</td>';

                                        ?>

                                        <?php $currentVotosTotales = $data->getEleccionesVotoTotal($eleccion->id_elecciones, $candID->id_candidato); ?>

                                        <td><?= $currentVotosTotales->total; ?></td>

                                        <?php $currentVotosPorcentaje = $data->getEleccionesContByID($eleccion->id_elecciones); ?>
                                        <td><?= $currentVotosTotales->total * 100 / $currentVotosPorcentaje->total; ?>%</td>


                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php $layout->Footer(); ?>